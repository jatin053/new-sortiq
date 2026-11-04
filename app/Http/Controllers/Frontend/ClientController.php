<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Throwable;

class ClientController extends Controller
{
    private const CLIENTS_PER_PAGE = 12;

    public function index(): View
    {
        $clientLogos = ClientLogo::query()
            ->published()
            ->ordered()
            ->get();

        return view('frontend.clients.clients-page', [
            'clientLogos' => $clientLogos,
        ]);
    }

    private function clientLogos(): LengthAwarePaginator
    {
        try {
            return ClientLogo::query()
                ->published()
                ->ordered()
                ->paginate(self::CLIENTS_PER_PAGE)
                ->withQueryString();
        } catch (Throwable $exception) {
            report($exception);

            return $this->emptyClientLogoPaginator();
        }
    }

    private function emptyClientLogoPaginator(): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            collect(),
            0,
            self::CLIENTS_PER_PAGE,
            Paginator::resolveCurrentPage(),
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
    }
}
