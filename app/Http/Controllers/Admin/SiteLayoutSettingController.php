<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteLayoutSettingRequest;
use App\Models\SiteLayoutSetting;
use App\Support\LocalMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteLayoutSettingController extends Controller
{
    public function edit(): View
    {
        $setting = SiteLayoutSetting::main();
        $settings = SiteLayoutSetting::defaults();

        if ($setting && !empty($setting->data)) {
            $settings = array_replace_recursive($settings, $setting->data);
        }

        return view('admin.site-layout.site-layout-settings', [
            'settings' => $settings,
            'footerColumnKeys' => ['company', 'services', 'solutions'],
        ]);
    }

    public function update(SiteLayoutSettingRequest $request): RedirectResponse
    {
        $setting = SiteLayoutSetting::main();
        $data = $request->validated();

        unset($data['header_logo_file'], $data['footer_badge_files']);

        $data['header']['logo'] = $setting->data['header']['logo'] ?? '';

        if ($request->hasFile('header_logo_file')) {
            $data['header']['logo'] = LocalMedia::storeUploadedFile(
                $request->file('header_logo_file'),
                'uploads/site-layout',
                'header-logo'
            );
        } elseif ($request->filled('header.logo')) {
            $data['header']['logo'] = $request->input('header.logo');
        }

        if (isset($data['footer_badges']) && is_array($data['footer_badges'])) {
            foreach ($data['footer_badges'] as $index => $badge) {
                $data['footer_badges'][$index]['image'] = $badge['image'] ?? '';

                if ($request->hasFile('footer_badge_files.' . $index)) {
                    $file = $request->file('footer_badge_files.' . $index);
                    $label = $badge['label'] ?? 'footer-badge-' . $index;

                    $data['footer_badges'][$index]['image'] = LocalMedia::storeUploadedFile(
                        $file,
                        'uploads/site-layout',
                        $label
                    );
                }
            }
        }

        $data['nav_links'] = $this->removeEmptyRows($data['nav_links'] ?? [], ['label', 'url']);
        $data['footer_badges'] = $this->removeEmptyRows($data['footer_badges'] ?? [], ['label', 'image']);

        if (isset($data['footer_columns']) && is_array($data['footer_columns'])) {
            foreach ($data['footer_columns'] as $key => $column) {
                $links = $column['links'] ?? [];

                $data['footer_columns'][$key]['links'] = $this->removeEmptyRows($links, ['label', 'url']);
            }
        }

        $setting->update([
            'data' => $data,
        ]);

        return redirect()
            ->route('admin.site-layout.edit')
            ->with('status', 'Header and footer settings updated successfully.');
    }

    public function editCustomCode(): View
    {
        $setting = SiteLayoutSetting::main();
        $customCode = $setting->data['custom_code'] ?? ['head' => '', 'body' => ''];

        return view('admin.site-layout.custom-code-settings', compact('customCode'));
    }

    public function updateCustomCode(\Illuminate\Http\Request $request): RedirectResponse
    {
        $data = $request->validate([
            'custom_code' => ['required', 'array'],
            'custom_code.head' => ['nullable', 'string', 'max:50000'],
            'custom_code.body' => ['nullable', 'string', 'max:50000'],
        ]);

        $setting = SiteLayoutSetting::main();
        $settings = $setting->data ?? SiteLayoutSetting::defaults();
        $settings['custom_code'] = [
            'head' => $data['custom_code']['head'] ?? '',
            'body' => $data['custom_code']['body'] ?? '',
        ];

        $setting->update(['data' => $settings]);

        return redirect()
            ->route('admin.site-layout.custom-code.edit')
            ->with('status', 'Custom JS / CSS settings updated successfully.');
    }

    private function removeEmptyRows(array $rows, array $keys): array
    {
        $result = [];

        foreach ($rows as $row) {
            foreach ($keys as $key) {
                if (!empty($row[$key])) {
                    $result[] = $row;
                    break;
                }
            }
        }

        return array_values($result);
    }
}
