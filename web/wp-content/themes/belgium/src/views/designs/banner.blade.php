@php
  global $post;

  $variant          = $variant ?: false;
  $title            = $title ?: get_sub_field('title')['title'] ?: get_the_title();
  $logo             = $logo ?: get_sub_field('branding')['logo']['url'] ?: '/wp-content/uploads/2019/07/TM_Icon_Orange.svg';
  $bg_image         = $bg_image ?: get_sub_field('branding')['background_image']['url'];
  $line_color       = $line_color ?: get_sub_field('color')['line_color'] ?: '#a45a2a';
  $foreground_color = $foreground_color ?: get_sub_field('color')['foreground_color'] ?: '#ffffff';
  $background_color = $background_color ?: get_sub_field('color')['background_color'] ?: '#333f48';
  $meta_info        = date_format(date_create($post->post_date), 'l, F jS, Y');
@endphp

<section class="banner w-full h-auto relative m{{ $variant ? 'b' : 'y' }}-3 {{ $variant ?: 'variant' }}" style="background-color: {{ $background_color }};">
  <img class="see-through-image z-0 absolute right-0" src="/wp-content/uploads/2019/07/TM_Icon_White.svg" />
  <div
    class="banner w-full h-auto relative container py-{{ $variant ? '16' : '24' }} bg-cover bg-center"
    style="background-image: url({{ $bg_image }});"
  >
    <div class="container-sm mx-auto h-full">
      <div class="flex flex-col sm:items-start sm:justify-between justify-center">
        <hr style="border-color: {{ $line_color }};" class="w-10 my-4 border border-orange mx-0 border-solid border-1">
        <h2
          class="text-white font-base font-slab font-thin sm:text-4xl text-xl uppercase tracking-wider leading-tight"
          style="color: {{ $foreground_color }};"
        >
          {!! $title !!}
        </h2>
      </div>
      @if (!$variant)
        <div class="md:pt-24 pt-16 logo">
          <img class="w-1/2" src="{{ $logo }}" alt="">
        </div>
      @else
        <div class="md:pt-24 pt-16 meta-info">
          <p class="post-meta my-0 text-gray leading-none font-condensed sm:text-lg text-base font-thin tracking-wider">
            {{ $meta_info }}
          </p>
        </div>
      @endif
    </div>
  </div>
</section>
