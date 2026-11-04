<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Support\Recaptcha;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class ApiDocumentationController extends Controller
{
    public function index(): JsonResponse
    {
        $documentation = config('api-docs', []);
        $documentationPath = (string) ($documentation['documentation_path'] ?? '/api/docs');

        $documentation['base_url'] = url('/api');
        $documentation['documentation_url'] = url(ltrim($documentationPath, '/'));

        $documentation['frontend_called_endpoints'] = array_values(array_map(
            fn (array $endpoint) => $this->withAbsoluteUrl($endpoint),
            $documentation['frontend_called_endpoints'] ?? []
        ));

        $documentation['endpoints'] = array_map(function (array $endpoint) {
            $endpoint = $this->withAbsoluteUrl($endpoint);

            if (($endpoint['path'] ?? null) === '/api/contact-messages' && ($endpoint['method'] ?? null) === 'POST') {
                $endpoint = $this->withContactRuntimeValues($endpoint);
            }

            return $endpoint;
        }, $documentation['endpoints'] ?? []);

        return response()->json($documentation);
    }

    public static function contactEndpointDocumentation(): array
    {
        $endpoint = config('api-docs.endpoints.contact_messages_store', []);

        $endpoint['endpoint'] = url(ltrim((string) ($endpoint['path'] ?? '/api/contact-messages'), '/'));
        $endpoint['documentation_url'] = url(ltrim((string) config('api-docs.documentation_path', '/api/docs'), '/'));
        $endpoint['doc_source'] = config('api-docs.doc_source');
        $endpoint['supported_methods'] = ['POST'];
        $endpoint['note'] = 'Opening this URL in the browser uses GET. To submit data, use POST from fetch, Postman, curl, or an HTML form.';

        return (new self())->withContactRuntimeValues($endpoint);
    }

    private function withAbsoluteUrl(array $endpoint): array
    {
        if (isset($endpoint['path'])) {
            $endpoint['url'] = url(ltrim((string) $endpoint['path'], '/'));
        }

        return $endpoint;
    }

    private function withContactRuntimeValues(array $endpoint): array
    {
        $recaptchaEnabled = Recaptcha::enabledForRequest(request());

        Arr::set($endpoint, 'request_fields.recaptcha.required', $recaptchaEnabled);
        Arr::set(
            $endpoint,
            'example_request.body.recaptcha',
            $recaptchaEnabled ? 'browser-generated-token' : 'optional-when-disabled'
        );

        return $endpoint;
    }
}
