<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use App\Models\Block;
use App\Models\BlockContent;
use App\Models\Post;
use Auth;

class RecycleBinController extends Controller
{
    public function index()
    {
        if (Auth::user()->role != 'admin') return redirect(route('admin'));

        $rbAccountsCount = User::onlyTrashed()->count();
        $rbPostsCount = Post::onlyTrashed()->count();

        return view('admin.index', [
            'view_file' => 'admin.recycle-bin.index',
            'active_menu' => 'tools',
            'active_submenu' => 'recycle_bin',
            'rbAccountsCount' => $rbAccountsCount ?? 0,
            'rbPostsCount' => $rbPostsCount ?? 0,
        ]);
    }


    public function module(Request $request)
    {
        if (Auth::user()->role != 'admin') return redirect(route('admin'));

        $module = $request->module;
        if (!($module == 'accounts' || $module == 'pages')) return redirect(route('admin.recycle_bin'));

        // DELETED ACCOUNTS
        if ($module == 'accounts') {
            $deletedItemsCount = User::onlyTrashed()->count();

            $search_terms = $request->search_terms;

            $items = User::onlyTrashed();

            if ($search_terms) $items = $items->where(function ($query) use ($search_terms) {
                $query->where('users.name', 'like', "%$search_terms%")
                    ->orWhere('users.email', 'like', "%$search_terms%");
            });

            $items = $items->orderByDesc('id')->paginate(25);
        }



        // DELETED POSTS
        if ($module == 'posts') {
            $deletedItemsCount = Post::onlyTrashed()->count();

            $search_terms = $request->search_terms;
            $search_categ_id = $request->search_categ_id;

            $items = Post::with('author', 'category', 'language')->onlyTrashed();

            if ($search_terms)
                $items = $items->where(function ($query) use ($search_terms) {
                    $query->where('posts.title', 'like', "%$search_terms%")
                        ->orWhere('posts.search_terms', 'like', "%$search_terms%");
                });

            if ($search_post_type) {
                $items = $items->where('type', $search_post_type);
            }

            $items = $items->orderByDesc('id')->paginate(25);
        }



        return view('admin.index', [
            'view_file' => 'admin.recycle-bin.' . $module,
            'active_menu' => 'tools',
            'active_submenu' => 'recycle_bin',
            'deletedItemsCount' => $deletedItemsCount ?? 0,
            'items' => $items ?? null,

            // Search (for all modules):
            'search_terms' => $search_terms ?? null, //posts / pages
            'search_status' => $search_status ?? null,
            'search_replied' => $search_replied ?? null,
            'search_important' => $search_important ?? null,
            'search_categ_id' => $search_categ_id ?? null, // posts / forum
            'posts_categories' => $posts_categories ?? null, // posts
        ]);
    }



    public function single_action(Request $request)
    {
        if (Auth::user()->role != 'admin') return redirect(route('admin'));

        $module = $request->module;
        if (!($module == 'accounts' || $module == 'posts')) return redirect(route('admin.recycle_bin'));

        // ACCOUNTS
        if ($module == 'accounts') {
            if ($request->action == 'delete') User::where('id', $request->id)->forceDelete();
            if ($request->action == 'restore') User::where('id', $request->id)->restore();
        }

        // POSTS
        if ($module == 'posts') {
            if ($request->action == 'delete') {
                $post = Post::find($request->id);
                if (!$post) return redirect(route('admin.recycle_bin'));

                // delete main image
                if ($post->image) DriveFile::delete_image($post->image);

                // delete content blocks
                $blocks = Block::where('module', 'posts')->where('content_id', $request->id)->get();
                foreach ($blocks as $block) {
                    Block::where('id', $block->id)->delete();
                    BlockContent::where('block_id', $block->id)->delete();
                }

                Post::where('id', $request->id)->forceDelete(); // delete post                
            }
            if ($request->action == 'restore') Post::where('id', $request->id)->restore();
        }


        if (($request->return_to ?? null) == 'recycle_bin')
            return redirect(route('admin.recycle_bin.module', ['module' => $module]))->with('success', $request->action ?? null);
        elseif (($request->return_to ?? null) == 'contact')
            return redirect(route('admin.contact'))->with('success', $request->action ?? null);
        else return redirect(route('admin.recycle_bin'))->with('success', $request->action ?? null);
    }



    public function multiple_action(Request $request)
    {
        if (Auth::user()->role != 'admin') return redirect(route('admin'));

        // disable action in demo mode:
        if (config('app.demo_mode')) return redirect(route('admin'))->with('error', 'demo');

        $module = $request->module;
        if (!($module == 'accounts' || $module == 'posts')) return redirect(route('admin.recycle_bin'));

        // ACCOUNTS
        if ($module == 'accounts') {
            if (is_array($request->items_checkbox)) {
                foreach ($request->items_checkbox as $item_id) {
                    if ($request->action == 'multiple_delete') User::where('id', $item_id)->forceDelete();
                    if ($request->action == 'multiple_restore') User::where('id', $item_id)->restore();
                }
            }
        }


        // POSTS
        if ($module == 'posts') {
            if (is_array($request->items_checkbox)) {
                foreach ($request->items_checkbox as $item_id) {
                    if ($request->action == 'multiple_delete') {
                        $post = Post::find($item_id);
                        if (!$post) return redirect(route('admin.recycle_bin'));

                        // delete main image
                        if ($post->image) DriveFile::delete_image($post->image);

                        // delete content blocks
                        $blocks = Block::where('module', 'posts')->where('content_id', $item_id)->get();
                        foreach ($blocks as $block) {
                            Block::where('id', $block->id)->delete();
                            BlockContent::where('block_id', $block->id)->delete();
                        }

                        Post::where('id', $item_id)->forceDelete(); // delete post                                        
                    }
                    if ($request->action == 'multiple_restore') Post::where('id', $item_id)->restore();
                }
            }
        }


        return redirect(route('admin.recycle_bin.module', ['module' => $module]))->with('success', $request->action ?? null);
    }
}
