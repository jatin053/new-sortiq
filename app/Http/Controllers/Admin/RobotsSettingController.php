<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RobotsSettingRequest;
use App\Models\RobotsSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RobotsSettingController extends Controller
{
    /**
     * Show the simple robots.txt editor form.
     */
    public function edit()
    {
        $filePath = public_path('robots.txt');
        if (file_exists($filePath) && is_readable($filePath)) {
            $content = file_get_contents($filePath);
        } else {
            $settings = RobotsSetting::firstOrCreate(
                ['id' => 1],
                RobotsSetting::defaults()
            );
            $content = $settings->custom_rules ?: "User-agent: *\nAllow: /\nDisallow: /admin/\n\nSitemap: " . url('/sitemap.xml');
        }

        return view('admin.robots.settings', compact('content'));
    }

    /**
     * Update the robots.txt content directly.
     */
    public function update(RobotsSettingRequest $request)
    {
        $content = (string) $request->input('content', '');

        // Write directly to public/robots.txt
        try {
            file_put_contents(public_path('robots.txt'), $content);
        } catch (\Throwable $e) {
            // Log if filesystem error
            logger()->error('Failed to write robots.txt: ' . $e->getMessage());
        }

        // Also save to database
        try {
            DB::transaction(function () use ($content) {
                $settings = RobotsSetting::firstOrCreate(['id' => 1], RobotsSetting::defaults());
                $settings->update([
                    'crawling_mode' => 'custom',
                    'custom_rules' => $content,
                ]);
            });
        } catch (\Throwable $e) {
            logger()->error('Failed to update robots_settings in DB: ' . $e->getMessage());
        }

        Cache::forget('robots_txt_settings');

        return redirect()->route('admin.robots-settings.edit')
            ->with('status', 'Robots.txt file saved successfully!');
    }

    /**
     * Reset the robots.txt file to recommended defaults.
     */
    public function reset()
    {
        $defaultContent = "# Robots.txt for Sortiq Solutions\n"
            . "User-agent: Googlebot\nAllow: /\n\n"
            . "User-agent: Bingbot\nAllow: /\n\n"
            . "User-agent: Applebot\nAllow: /\n\n"
            . "User-agent: GPTBot\nAllow: /\n\n"
            . "User-agent: ClaudeBot\nAllow: /\n\n"
            . "User-agent: PerplexityBot\nAllow: /\n\n"
            . "User-agent: *\n"
            . "Allow: /\n"
            . "Disallow: /admin/\n"
            . "Disallow: /sortiqadmin/\n"
            . "Disallow: /api/\n"
            . "Disallow: /login\n"
            . "Disallow: /logout\n"
            . "Disallow: /register\n"
            . "Disallow: /password/\n\n"
            . "Sitemap: " . url('/sitemap.xml');

        try {
            file_put_contents(public_path('robots.txt'), $defaultContent);
        } catch (\Throwable $e) {}

        try {
            DB::transaction(function () use ($defaultContent) {
                $settings = RobotsSetting::firstOrCreate(['id' => 1], RobotsSetting::defaults());
                $settings->update([
                    'crawling_mode' => 'production',
                    'custom_rules' => $defaultContent,
                ]);
            });
        } catch (\Throwable $e) {}

        Cache::forget('robots_txt_settings');

        return redirect()->route('admin.robots-settings.edit')
            ->with('status', 'Robots.txt reset to recommended defaults.');
    }
}
