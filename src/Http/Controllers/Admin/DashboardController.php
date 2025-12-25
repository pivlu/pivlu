<?php

namespace Pivlu\Cms\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Pivlu\Cms\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * Show the general dashboard.
     */
    public function index()
    {        
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
}
