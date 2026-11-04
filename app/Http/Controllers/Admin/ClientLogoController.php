<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientLogoRequest;
use App\Models\ClientLogo;
use App\Support\LocalMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ClientLogoController extends Controller
{
    public function index(Request $request): View
    {
        $searchTerm = trim((string) $request->query('search'));
        $status = $request->query('status');

        if (!in_array($status, ['draft', 'published'], true)) {
            $status = null;
        }

        $clientLogoQuery = ClientLogo::query();

        if ($searchTerm !== '') {
            $clientLogoQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('website', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        $clientLogosQuery = clone $clientLogoQuery;

        if ($status !== null) {
            $clientLogosQuery->where('status', $status);
        }

        $clientLogos = $clientLogosQuery->ordered()
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => ClientLogo::query()->count(),
            'published' => ClientLogo::query()->published()->count(),
            'draft' => ClientLogo::query()->where('status', 'draft')->count(),
        ];

        $tabCounts = [
            'all' => (clone $clientLogoQuery)->count(),
            'published' => (clone $clientLogoQuery)->where('status', 'published')->count(),
            'draft' => (clone $clientLogoQuery)->where('status', 'draft')->count(),
        ];

        return view('admin.client-logos.client-logo-list', [
            'clientLogos' => $clientLogos,
            'searchTerm' => $searchTerm,
            'activeStatus' => $status,
            'stats' => $stats,
            'tabCounts' => $tabCounts,
        ]);
    }

    public function create(): View
    {
        $clientLogo = new ClientLogo([
            'status' => 'published',
            'sort_order' => 0,
        ]);

        return view('admin.client-logos.create-client-logo', [
            'clientLogo' => $clientLogo,
            'permalink' => $this->permalink($clientLogo),
        ]);
    }

    public function store(ClientLogoRequest $request): RedirectResponse
    {
        $clientLogo = ClientLogo::create($this->payload($request));

        return redirect()
            ->route('admin.client-logos.edit', $clientLogo)
            ->with('status', 'Client logo created successfully.');
    }

    public function show(ClientLogo $clientLogo): View
    {
        return view('admin.client-logos.client-logo-details', [
            'clientLogo' => $clientLogo,
        ]);
    }

    public function edit(ClientLogo $clientLogo): View
    {
        return view('admin.client-logos.edit-client-logo', [
            'clientLogo' => $clientLogo,
            'permalink' => $this->permalink($clientLogo),
        ]);
    }

    public function update(ClientLogoRequest $request, ClientLogo $clientLogo): RedirectResponse
    {
        $clientLogo->update($this->payload($request, $clientLogo));
        $clientLogo->refresh();

        return redirect()
            ->route('admin.client-logos.edit', $clientLogo)
            ->with('status', 'Client logo updated successfully.');
    }

    public function destroy(ClientLogo $clientLogo): RedirectResponse
    {
        if ($clientLogo->logo) {
            LocalMedia::deleteUploadedFile($clientLogo->logo);
        }

        $name = $clientLogo->name ?: 'Client logo';
        $clientLogo->delete();

        return redirect()
            ->route('admin.client-logos.index')
            ->with('status', "\"{$name}\" was deleted successfully.");
    }

    public function toggleStatus(ClientLogo $clientLogo): RedirectResponse
    {
        $newStatus = $clientLogo->status === 'published' ? 'draft' : 'published';
        $clientLogo->update(['status' => $newStatus]);

        $statusLabel = ucfirst($newStatus);
        return back()->with('status', "\"{$clientLogo->name}\" status changed to {$statusLabel}.");
    }

    private function permalink(ClientLogo $clientLogo): string
    {
        $slug = $clientLogo->slug;

        if (!$slug) {
            $slug = Str::slug($clientLogo->name ?: 'new-client-logo');
        }

        return url('clients#' . $slug);
    }

    private function payload(ClientLogoRequest $request, ?ClientLogo $clientLogo = null): array
    {
        $data = $request->validated();

        unset($data['logo']);

        if ($request->hasFile('logo')) {
            $data['logo'] = LocalMedia::storeUploadedFile(
                $request->file('logo'),
                'uploads/client-logos',
                $request->input('name', 'client-logo')
            );
        } elseif ($clientLogo) {
            $data['logo'] = $clientLogo->logo;
        }

        return $data;
    }
}
