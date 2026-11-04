<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientLogoResource;
use App\Models\ClientLogo;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

class ClientLogoController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        try {
            $clientLogos = ClientLogo::query()
                ->where('status', 'published')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            $clientLogos = collect();
        }

        return ClientLogoResource::collection($clientLogos);
    }

    public function show(ClientLogo $clientLogo): ClientLogoResource
    {
        if ($clientLogo->status !== 'published') {
            abort(404);
        }

        return new ClientLogoResource($clientLogo);
    }
}
