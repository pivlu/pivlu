<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\ThemeMenu;
use App\Models\ThemeMenuItem;
use App\Models\ThemeMenuContent;
use App\Models\ThemeButton;
use App\Functions\ThemeFunctions;

class ThemeMenuController extends Controller
{

    /**
     * Show all resources
     */
    public function index()
    {
        $menus = ThemeMenu::orderByDesc('is_default')->orderBy('label')->paginate(25);

        return view('admin.index', [
            'view_file' => 'admin.theme.menus.index',
            'nav_section' => 'website',
            'active_menu' => 'themes',
            'nav_tab' => 'menus',
            'menus' => $menus,
        ]);
    }


    /**
     * Create resource
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required',
        ]);

        if ($validator->fails()) return redirect(route('admin.theme-menus.index'))->withErrors($validator)->withInput();

        if (ThemeMenu::where('label', $request->label)->exists()) return redirect(route('admin.theme-menus.index'))->with('error', 'duplicate');

        $menu = ThemeMenu::create([
            'label' => $request->label,
        ]);

        return redirect(route('admin.theme-menus.show', ['id' => $menu->id]))->with('success', 'created');
    }


    /**
     * Show resource
     */
    public function show(Request $request)
    {

        $menu = ThemeMenu::find($request->id);
        if (!$menu) return redirect(route('admin.theme-menus.index'));

        $links = ThemeMenuItem::where('menu_id', $menu->id)->whereNull('parent_id')->orderBy('position')->get();

        return view('admin.index', [
            'view_file' => 'admin.theme.menus.show',
            'nav_section' => 'website',
            'active_menu' => 'themes',
            'nav_tab' => 'menus',
            'menu' => $menu,
            'links' => $links,
            'buttons' => ThemeButton::orderByDesc('is_default')->orderBy('label')->get(),
        ]);
    }


    /**
     * Remove the specified resource
     */
    public function destroy(Request $request)
    {
        $menu = ThemeMenu::find($request->id);
        if (!$menu) return redirect(route('admin.theme-menus.index'));

        if ($menu->is_default == 1) return redirect(route('admin.theme-menus.index'));

        ThemeMenu::where('id', $request->id)->delete();

        return redirect(route('admin.theme-menus.index'))->with('success', 'deleted');
    }


    // Store menu link
    public function store_item(Request $request)
    {
        $menu = ThemeMenu::find($request->menu_id);
        if (!$menu) return redirect(route('admin.theme-menus.index'));

        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);

        if ($validator->fails()) return redirect(route('admin.theme-menus.show', ['id' => $menu->id]))->withErrors($validator)->withInput();

        $type = $request->type;

        if ($type == 'custom') {
            $value = $request->custom_url;
        }

        if ($type == 'page') {
            $value = $request->page_id;
        }

        $last_pos = ThemeMenuItem::where('menu_id', $menu->id)->orderByDesc('position')->value('position');
        $position = ($last_pos ?? 0) + 1;

        $item = ThemeMenuItem::create([
            'menu_id' => $menu->id,
            'type' => $type,
            'value' => $value ?? null,
            'position' => $position,
            'new_tab' => $request->has('new_tab') ? 1 : 0,
            'btn_id' => $request->btn_id ?? null,
            'icon' => $request->icon
        ]);

        foreach (admin_languages() as $lang) {
            $label_key = 'label_' . $lang->id;

            ThemeMenuContent::create(['menu_id' => $menu->id, 'item_id' => $item->id, 'lang_id' => $lang->id, 'label' => $request->$label_key]);
        }

        // regenerate menu links for each language and store in cache config
        ThemeFunctions::generate_menu_links($menu->id);

        return redirect(route('admin.theme-menus.show', ['id' => $menu->id]))->with('success', 'created');
    }


    // Update menu link
    public function update_item(Request $request)
    {
        $menu_item = ThemeMenuItem::find($request->item_id);
        if (!$menu_item) return redirect(route('admin.theme-menus.index'));

        $menu = ThemeMenu::find($menu_item->menu_id);
        if (!$menu) return redirect(route('admin.theme-menus.index'));

        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);

        if ($validator->fails()) return redirect(route('admin.theme-menus.show', ['id' => $menu->id]))->withErrors($validator)->withInput();

        $type = $request->type;

        if ($type == 'custom') {
            $value = $request->custom_url;
        }

        if ($type == 'page') {
            $value = $request->page_id;
        }

        $menu_item->update([
            'type' => $type,
            'value' => $value ?? null,
            'new_tab' => $request->has('new_tab') ? 1 : 0,
            'btn_id' => $request->btn_id ?? null,
            'icon' => $request->icon
        ]);

        foreach (admin_languages() as $lang) {
            $label_key = 'label_' . $lang->id;

            ThemeMenuContent::updateOrCreate(
                ['menu_id' => $menu->id, 'item_id' => $request->item_id, 'lang_id' => $lang->id],
                ['label' => $request->$label_key]
            );
        }

        // regenerate menu links for each language and store in cache config
        ThemeFunctions::generate_menu_links($menu->id);

        return redirect(route('admin.theme-menus.show', ['id' => $menu->id]))->with('success', 'updated');
    }


    public function delete_item(Request $request)
    {
        $menu_item = ThemeMenuItem::find($request->item_id);
        if (!$menu_item) return redirect(route('admin.theme-menus.index'));

        $menu = ThemeMenu::find($menu_item->menu_id);
        if (!$menu) return redirect(route('admin.theme-menus.index'));

        $parent_ids = ThemeMenuItem::where(['menu_id' => $menu->id, 'parent_id' => $request->item_id])->get();
        foreach ($parent_ids as $parent) {
            ThemeMenuContent::where(['menu_id' => $menu->id, 'item_id' => $parent->parent_id])->delete();
        }

        ThemeMenuItem::where(['menu_id' => $menu->id, 'parent_id' => $request->item_id])->delete();
        ThemeMenuItem::where(['menu_id' => $menu->id, 'id' => $request->item_id])->delete();

        // regenerate menu links for each language and store in cache config
        ThemeFunctions::generate_menu_links($menu->id);

        return redirect(route('admin.theme-menus.show', ['id' => $menu->id]))->with('success', 'deleted');
    }


    /**
     * Ajax sortable
     */
    public function sortable(Request $request)
    {
        $i = 1;

        $items = $request->all();

        foreach ($items['item'] as $key => $value) {

            ThemeMenuItem::where('menu_id', $request->menu_id)->where('id', $value)
                ->update([
                    'position' => $i,
                ]);

            $i++;
        }

        // regenerate menu links for each language and store in cache config
        TemplateMenu::generate_menu_links();
    }
}
