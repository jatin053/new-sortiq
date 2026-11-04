<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\SiteLayoutSetting;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class CertificateController extends Controller
{
    /**
     * Display the Certificate Authenticate page.
     */
    public function show(): View
    {
        try {
            $pageMeta = Page::query()
                ->where('route_name', 'frontend.certificate-authenticate')
                ->orWhere('url_path', '/certificate-authenticate')
                ->first();
        } catch (Throwable $e) {
            report($e);
            $pageMeta = null;
        }

        return view('frontend.pages.certificate-authenticate', [
            'pageMeta' => $pageMeta,
            'siteSettings' => SiteLayoutSetting::main(),
        ]);
    }

    /**
     * Verify certificate through ERP endpoint.
     */
    public function check(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'certificateId' => 'required|string|max:255',
        ]);

        $certId = trim($validated['certificateId']);

        try {
            $client = new Client([
                'cookies' => true,
                'verify' => false,
                'timeout' => 15,
            ]);

            // 1. Fetch verification page to acquire session and CSRF token
            $response = $client->get('https://erp.sortiqsolutions.com/certificate-verify');
            $html = (string) $response->getBody();

            preg_match('/name="_token" value="([^"]+)"/', $html, $matches);
            $token = $matches[1] ?? null;

            if (! $token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to connect to certificate verification service. Please try again later.',
                ], 500);
            }

            // 2. Post verification check to ERP
            $checkResponse = $client->post('https://erp.sortiqsolutions.com/certificate-verify/check', [
                'form_params' => [
                    'certificateId' => $certId,
                    '_token' => $token,
                ],
                'headers' => [
                    'X-Requested-With' => 'XMLHttpRequest',
                    'Accept' => 'application/json',
                ],
            ]);

            $result = json_decode((string) $checkResponse->getBody(), true);

            if (is_array($result)) {
                return response()->json($result);
            }

            return response()->json([
                'success' => false,
                'message' => 'Unexpected response from verification server.',
            ], 500);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Certificate verification service is temporarily unavailable. Please try again later.',
            ], 500);
        }
    }
}

