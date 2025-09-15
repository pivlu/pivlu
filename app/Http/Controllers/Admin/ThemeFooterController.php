<?php

namespace App\Http\Controllers\Admin;

use App\Models\Theme;
use App\Models\ThemeConfig;
use App\Models\Language;
use App\Models\ThemeFooterBlock;
use App\Models\ThemeFooterBlockContent;
use App\Models\BlockType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Functions\FileFunctions;

class ThemeFooterController extends Controller
{

    /**
     * Update template
     */
    public function update(Request $request)
    {

        $theme = Theme::find($request->theme_id);
        if (!$theme) return redirect(route('admin.themes.index'));

        ThemeConfig::update_config($request->theme_id, $request->except('_token'));

        if ($request->submit_action == 'footer_content')
            return redirect(route('admin.theme-footer.content', ['slug' => $theme->slug, 'footer' => 'primary']))->with('success', 'updated');
        elseif ($request->submit_action == 'footer2_content')
            return redirect(route('admin.theme-footer.content', ['slug' => $theme->slug, 'footer' => 'secondary']))->with('success', 'updated');
        else
            return redirect(route('admin.themes.show', ['slug' => $theme->slug, 'theme_tab' => 'footer']))->with('success', 'updated');
    }


    /**
     * Edit footer content
     */
    public function content(Request $request)
    {

        $theme = Theme::where('slug', $request->slug)->first();
        if (!$theme) return redirect(route('admin.themes.index'));

        return view('admin.index', [
            'view_file' => 'admin.theme.footer.content',
            'active_menu' => 'website',
            'active_submenu' => 'appearance',
            'nav_tab' => 'themes',
            'theme' => $theme,
            'theme_tab' => 'footer',
            'theme_config' => ThemeConfig::config($theme->id),

            'footer' => $request->footer,
            'block_types' => BlockType::get_block_types()->where('allow_in_footer', 1),
        ]);
    }


    /**
     * Update footer content   
     */
    public function update_content(Request $request)
    {
        if (!($request->footer == 'primary' || $request->footer == 'secondary')) return redirect(route('admin.theme-footer'));

        $theme = Theme::where('slug', $request->slug)->first();
        if (!$theme) return redirect(route('admin.themes.index'));

        $last_pos = ThemeFooterBlock::where('footer', $request->footer)->where('col', $request->col)->orderByDesc('position')->value('position');
        $position = ($last_pos ?? 0) + 1;

        if ($request->footer == 'primary') $layout = ThemeConfig::get_config($theme->id, 'tpl_footer_columns') ?? 1;
        if ($request->footer == 'secondary') $layout = ThemeConfig::get_config($theme->id, 'tpl_footer2_columns') ?? 1;

        $block = ThemeFooterBlock::create([
            'block_type_id' => $request->type_id,
            'theme_id' => $theme->id,
            'footer' => $request->footer,
            'col' => $request->col, // column number
            'layout' => $layout, // number of columns
            'position' => $position,
        ]);

        return redirect(route('admin.theme-footer.block', ['id' => $block->id, 'slug' => $request->slug]));
    }


    /**
     * Remove the specified block content from footer
     */
    public function delete_content(Request $request)
    {
        if (!($request->footer)) return redirect(route('admin.theme-footer'));

        ThemeFooterBlockContent::where('footer_block_id', $request->block_id)->delete();
        ThemeFooterBlock::where('id', $request->block_id)->delete();

        return redirect(route('admin.theme-footer.content', ['footer' => $request->footer, 'slug' => $request->slug]))->with('success', 'deleted');
    }


    /**
     * Ajax sortable footer blocks
     */
    public function sortable(Request $request)
    {
        $i = 0;

        $theme = Theme::where('slug', $request->slug)->first();
        if (!$theme) return;

        if ($request->footer == 'primary') $layout = ThemeConfig::get_config($theme->id, 'tpl_footer_columns') ?? 1;
        if ($request->footer == 'secondary') $layout = ThemeConfig::get_config($theme->id, 'tpl_footer2_columns') ?? 1;

        $records = $request->all();

        foreach ($records['item'] as $key => $value) {

            ThemeFooterBlock::where('footer', $request->footer)
                ->where('theme_id', $theme->id)
                ->where('col', $request->col)
                ->where('layout', $layout)
                ->where('id', $value)
                ->update([
                    'position' => $i,
                ]);

            $i++;
        }
    }


    /**
     * Show block
     */
    public function block(Request $request)
    {

        $block = ThemeFooterBlock::find($request->id);
        if (!$block) return redirect(route('admin'));

        if ($request->referer) $referer = $request->referer;
        else $referer = request()->headers->get('referer');

        return view('admin.index', [
            'view_file' => 'admin.blocks.block',
            'active_menu' => 'website',
            'active_submenu' => 'appearance',
            'nav_tab' => 'footer',
            'referer' => $referer,
            'footer' => $request->footer ?? 'primary',
            'block' => $block,
            'is_simple_block' => 1,
        ]);
    }



    /**
     * Update block    
     */
    public function block_update(Request $request)
    {

        $block = ThemeFooterBlock::find($request->id);
        if (!$block) return;

        $block_type = BlockType::find($block->block_type_id);
        if (!$block_type) return;

        $referer = $request->referer;

        $inputs = $request->except('_token');

        $block->update(['label' =>  $request->label ?? null, 'hidden' => $request->has('hidden') ? 1 : 0]);

        // Extra content LINKS        
        if ($block_type->type == 'links') {
            $block_settings = [
                'new_tab' => $request->new_tab ?? null,
                'display_style' => $request->display_style
            ];
        }

        // Extra content IMAGE      
        if ($block_type->type == 'image') {
            $block_settings = [
                'shadow' => $request->shadow ?? null,
                'rounded' => $request->rounded ?? null,
            ];
        }

        ThemeFooterBlock::where('id', $request->id)->update(['settings' => json_encode($block_settings ?? null, JSON_UNESCAPED_UNICODE)]);


        // ***************************************************
        // Block CONTENT
        // ***************************************************
        $langs = Language::get_languages();

        $block->update(['settings' => json_encode($block_settings ?? null, JSON_UNESCAPED_UNICODE)]);


        // UPDATE CONTENT
        foreach ($langs as $lang) {
            $content = null;

            $key_content = 'content_' . $lang->id;
            $key_add_header = 'add_header_' . $lang->id;
            $key_header_title = 'header_title_' . $lang->id;
            $key_header_content = 'header_content_' . $lang->id;
            $key_existing_image = 'existing_image_' . $lang->id;
            $key_caption = 'caption_' . $lang->id;
            $key_title = 'title_' . $lang->id;
            $key_url = 'url_' . $lang->id;

            // EXTRA HEADER CONTENT
            if ($block_type->type == 'links' || $block_type->type == 'image') {
                $header_array = array('add_header' => $request->$key_add_header, 'title' => $request->$key_header_title, 'content' => $request->$key_header_content);
                $header_content = json_encode($header_array, JSON_UNESCAPED_UNICODE);
                ThemeFooterBlockContent::updateOrInsert(['footer_block_id' => $request->id, 'lang_id' => $lang->id], ['header' => $header_content]);
            }

            // EDITOR / CUSTOM
            if ($block_type->type == 'editor' || $block_type->type == 'custom') {
                $content = $request->$key_content;
                $content = trim($content);
            }

            // IMAGE
            if ($block_type->type == 'image') {
                $image = null;

                if ($request->hasFile('image_' . $lang->id)) {
                    $media = FileFunctions::store_image($request->file('image_' . $lang->id), $old_media_id = $request->$key_existing_image);
                }
                $content = array('media_id' => $media->id ?? $request->$key_existing_image, 'title' => $request->$key_title, 'caption' => $request->$key_caption, 'url' => $request->$key_url);
                $content = json_encode($content, JSON_UNESCAPED_UNICODE);
            }


            // LINKS
            if ($block_type->type == 'links') {
                $post_key_title = 'a_title_' . $lang->id;
                $post_key_url = 'a_url_' . $lang->id;
                $post_key_icon = 'a_icon_' . $lang->id;
                $links_array_key = 'links_array_' . $lang->id;
                $links_array_key = array();
                $counter_key = 'numb_items_' . $lang->id;
                $counter_key = count(array_filter($_POST[$post_key_url]));

                for ($i = 0; $i < $counter_key; $i++) {
                    if (!(empty(array_filter($request->$post_key_title)) && empty(array_filter($request->$post_key_url))))
                        $links_array_key[$i] = array('title' => $inputs["$post_key_title"][$i], 'url' => $inputs["$post_key_url"][$i], 'icon' => $inputs["$post_key_icon"][$i]);
                }
                $content = json_encode($links_array_key, JSON_UNESCAPED_UNICODE);
            }

            ThemeFooterBlockContent::updateOrInsert(['footer_block_id' => $request->id, 'lang_id' => $lang->id], ['content' => $content]);
        } // end langs

        //dd($referer);
        if (($request->submit_return_to_block ?? null) == 'block') return redirect(route('admin.theme-footer.block', ['slug' => $request->slug, 'id' => $request->id, 'referer' => $referer ?? null]))->with('success', 'updated');
        elseif ($referer ?? null) return redirect($referer)->with('success', 'updated');
        else return redirect(route('admin.themes.index'))->with('success', 'updated');
    }
}
