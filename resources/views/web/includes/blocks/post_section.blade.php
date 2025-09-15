  @php
      $block_content = json_decode($block_data->content);
  @endphp

  @if ($block_content->title ?? null)
      <a id="{{ $block_content->slug }}" title="{{ $block_content->slug }}" href="#{{ $block_content->slug }}">{{ $block_content->title }}</a>
  @endif
