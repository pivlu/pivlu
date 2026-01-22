<?php

namespace Pivlu\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Pivlu\Models\User;
use Pivlu\Models\Config;

class DashboardController extends Controller
{

    /**
     * Show the general dashboard.
     */
    public function index()
    {

        // generate css for default theme on first access of admin dashboard after install
        if (! Config::get_config('default_theme_css_generated_at')) {
            $active_theme = \Pivlu\Models\Theme::where('is_active', 1)->first();
            \Pivlu\Functions\ThemeFunctions::generate_theme_css($active_theme->code);
            Config::update_config('default_theme_css_generated_at', now());
        }

        // generate css for default custom style on first access of admin dashboard after install
        if (! Config::get_config('default_style_css_generated_at')) {
            \Pivlu\Functions\ThemeFunctions::generate_styles_css();
            Config::update_config('default_style_css_generated_at', now());
        }

        $count_accounts = User::count();
        $last_accounts = User::orderByDesc('id')->limit(10)->get();

        return view('pivlu::admin.index', [
            'view_file' => 'admin.dashboard.index',
            'nav_section' => 'dashboard',
            'active_menu' => 'dashboard',
            'count_accounts' => $count_accounts,
            'last_accounts' => $last_accounts,
            'media_count_files' => $media_count_files ?? null,
            'media_size_total' => null,
        ]);
    }

    /**
     * Show the website dashboard.
     */
    public function website()
    {
        $count_accounts = User::count();
        $last_accounts = User::orderByDesc('id')->limit(10)->get();

        return view('pivlu::admin.index', [
            'view_file' => 'admin.dashboard.website',
            'nav_section' => 'website',
            'active_menu' => 'dashboard',
            'count_accounts' => $count_accounts,
            'last_accounts' => $last_accounts,
            'media_count_files' => $media_count_files ?? null,
            'media_size_total' => null,
        ]);
    }
}
