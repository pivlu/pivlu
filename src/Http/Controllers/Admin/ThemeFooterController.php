<?php

namespace App\Http\Controllers\Admin;

use App\Models\ThemeFooter;
use App\Models\Language;
use App\Models\ThemeFooterBlock;
use App\Models\ThemeFooterBlockContent;
use App\Models\BlockType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Functions\FileFunctions;
use Illuminate\Support\Facades\Validator;

class ThemeFooterController extends Controller
{

    /**
     * Show all resources
     */
    public function index()
    {
        $footers = ThemeFooter::orderByDesc('is_default')->orderBy('label')->paginate(25);

        return view('admin.index', [
            'view_file' => 'admin.theme.footers.index',
            'nav_section' => 'website',
            'active_menu' => 'themes',
            'nav_tab' => 'footers',
            'footers' => $footers,
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

        if ($validator->fails()) return redirect(route('admin.theme-footers.index'))->withErrors($validator)->withInput();

        if (ThemeFooter::where('label', $request->label)->exists()) return redirect(route('admin.theme-footers.index'))->with('error', 'duplicate');

        $footer = ThemeFooter::create([
            'label' => $request->label,
            'footer_columns' => $request->footer_columns,
            'footer2_show' => $request->has('footer2_show') ? 1 : 0,
            'footer2_columns' => $request->footer2_columns,
        ]);

        if ($request->has('is_default_footer')) $footer->update(['is_default' => 1]);

        return redirect(route('admin.theme-footers.show', ['id' => $footer->id]))->with('success', 'created');
    }


    /**
     * Show resource
     */
    public function show(Request $request)
    {
        $footer = ThemeFooter::find($request->id);
        if (!$footer) return redirect(route('admin.theme-footers.index'));

        return view('admin.index', [
            'view_file' => 'admin.theme.footers.show',
            'nav_section' => 'website',
            'active_menu' => 'themes',
            'nav_tab' => 'footers',
            'footer' => $footer,
        ]);
    }


    /**
     * Remove the specified resource
     */
    public function destroy(Request $request)
    {
        $footer = ThemeFooter::find($request->id);
        if (!$footer) return redirect(route('admin.theme-footers.index'));

        if ($footer->is_default == 1) return redirect(route('admin.theme-footers.index'))->with('error', 'delete_default');

        ThemeFooter::where('id', $request->id)->delete();

        return redirect(route('admin.theme-footers.index'))->with('success', 'deleted');
    }


    /**
     * Update
     */
    public function update(Request $request)
    {

        $footer = ThemeFooter::find($request->id);
        if (!$footer) return redirect(route('admin.theme-footers.index'));

        $validator = Validator::make($request->all(), [
            'label' => 'required',
        ]);

        if ($validator->fails()) return redirect(route('admin.theme-footers.index'))->withErrors($validator)->withInput();

        if (ThemeFooter::where('label', $request->label)->where('id', '!=', $request->id)->exists()) return redirect(route('admin.theme-footers.index'))->with('error', 'duplicate');

        $footer->update([
            'label' => $request->label,
            'footer_columns' => $request->footer_columns,
            'footer2_show' => $request->has('footer2_show') ? 1 : 0,
            'footer2_columns' => $request->footer2_columns,
        ]);

        return redirect(route('admin.theme-footers.show', ['id' => $request->id]))->with('success', 'updated');
    }


    /**
     * Edit footer content
     */
    public function content(Request $request)
    {

        $footer = ThemeFooter::find($request->id);
        if (!$footer) return redirect(route('admin.theme-footers.index'));

        $destination = $request->destination ?? 'primary';
        if (!($destination == 'primary' || $destination == 'secondary')) $destination = 'primary';

        return view('admin.index', [
            'view_file' => 'admin.theme.footers.content',
            'nav_section' => 'website',
            'active_menu' => 'themes',
            'nav_tab' => 'footers',
            'footer' => $footer,
            'destination' => $destination,
            'block_types' => BlockType::get_block_types()->where('allow_in_footer', 1),
        ]);
    }


    /**
     * Update footer content   
     */
    public function update_content(Request $request)
    {
        if (!($request->destination == 'primary' || $request->destination == 'secondary')) return redirect(route('admin.theme-footers.index'));

        $footer = ThemeFooter::find($request->id);
        if (!$footer) return redirect(route('admin.theme-footers.index'));

        $last_pos = ThemeFooterBlock::where('destination', $request->destination)->where('col', $request->col)->orderByDesc('position')->value('position');
        $position = ($last_pos ?? 0) + 1;

        if ($request->destination == 'primary') $layout = $footer->footer_columns ?? 1;
        if ($request->destination == 'secondary') $layout = $footer->footer2_columns ?? 1;

        $block = ThemeFooterBlock::create([
            'block_type_id' => $request->type_id,
            'footer_id' => $footer->id,
            'destination' => $request->destination,
            'col' => $request->col, // column number
            'layout' => $layout, // number of columns
            'position' => $position,
        ]);

        return redirect(route('admin.theme-footer.block', ['footer_id' => $footer->id, 'block_id' => $block->id]));
    }


    /**
     * Remove the specified block content from footer
     */
    public function delete_content(Request $request)
    {
        $footer = ThemeFooter::find($request->footer_id);
        if (!$footer) return redirect(route('admin.theme-footers.index'));

        if (!($request->destination)) return redirect(route('admin.theme-footers.index'));

        ThemeFooterBlock::where('id', $request->block_id)->delete();

        return redirect(route('admin.theme-footers.content', ['destination' => $request->destination, 'id' => $footer->id]))->with('success', 'deleted');
    }


    /**
     * Ajax sortable footer blocks
     */
    public function sortable(Request $request)
    {
        $i = 0;

        $footer = ThemeFooter::find($request->footer_id);
        if (!$footer) return;

        if ($request->destination == 'primary') $layout = $footer->footer_columns ?? 1;
        if ($request->destination == 'secondary') $layout = $footer->footer2_columns ?? 1;

        $records = $request->all();

        foreach ($records['item'] as $key => $value) {

            ThemeFooterBlock::where('destination', $request->destination)
                ->where('footer_id', $footer->id)
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
        $footer = ThemeFooter::find($request->footer_id);
        if (!$footer) return redirect(route('admin.theme-footers.index'));

        $block = ThemeFooterBlock::find($request->block_id);
        if (!$block) return redirect(route('admin.theme-footers.index'));

        if ($request->referer) $referer = $request->referer;
        else $referer = request()->headers->get('referer');

        return view('admin.index', [
            'view_file' => 'admin.blocks.block',
            'nav_section' => 'website',
            'active_menu' => 'themes',
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

        $footer = ThemeFooter::find($request->footer_id);
        if (!$footer) return redirect(route('admin.theme-footers.index'));

        $block = ThemeFooterBlock::find($request->block_id);
        if (!$block) return redirect(route('admin.theme-footers.index'));

        $block_type = BlockType::find($block->block_type_id);
        if (!$block_type) return redirect(route('admin.theme-footers.index'));

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
                ThemeFooterBlockContent::updateOrInsert(['footer_id' => $footer->id, 'footer_block_id' => $request->block_id, 'lang_id' => $lang->id], ['header' => $header_content]);
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

            ThemeFooterBlockContent::updateOrInsert(['footer_block_id' => $request->block_id, 'footer_id' => $request->footer_id, 'lang_id' => $lang->id], ['content' => $content]);
        } // end langs

        //dd($referer);
        if (($request->submit_return_to_block ?? null) == 'block') return redirect(route('admin.theme-footer.block', ['footer_id' => $request->footer_id, 'block_id' => $request->block_id, 'referer' => $referer ?? null]))->with('success', 'updated');
        elseif ($referer ?? null) return redirect($referer)->with('success', 'updated');
        else return redirect(route('admin.themes.index'))->with('success', 'updated');
    }
}
