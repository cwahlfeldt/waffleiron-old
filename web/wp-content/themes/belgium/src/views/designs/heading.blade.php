@php
  $text             = $text ?: get_sub_field('text') ?: get_the_title();
  $link             = $link ?: get_sub_field('link');
  $link_text        = $link_text ?: get_sub_field('link_text');
  $link_title       = $link_title ?: get_the_title($link);
  $branding_logo    = $branding_logo ?: get_sub_field('branding')['logo']['url'];
  $branding_title   = $branding_title ?: get_sub_field('branding')['title'];
  $style_line_color = $style_line_color ?: get_sub_field('style')['line_color'];
  $style_bg_color   = $style_bg_color ?: get_sub_field('style')['background_color'];
  $style_fg_color   = $style_fg_color ?: get_sub_field('style')['foreground_color'];
  $variant          = $variant ?: false;
@endphp

<style>
  .heading a:hover {
    background-color: {{ $style_line_color }};
    color: {{ $style_bg_color }};
  }
</style>
<section class="heading {{ $variant ? 'variant' : '' }} w-full relative pb-3">
  <div class="flex sm:flex-row flex-col w-full h-full">

    <div class="h-full sm:order-1 order-2 2xl:w-1/4 md:w-1/2 lg:w-1/3 sm:w-full sm:mr-3 bg-blue relative md:py-20 py-12 px-4" style="background-color: {{ $style_bg_color }};">
      <div class="h-full flex flex-col justify-center items-center relative">
        <img class="logo" src="{{ $branding_logo }}" alt="">

        <div class="text m{{ $variant ? 't' : 'y' }}-auto">
          <hr style="border-color: {{ $style_line_color }};" class="w-10 my-6 border border-orange border-solid border-1 mx-auto">
          <p
            style="color: {{ $style_fg_color }};"
            class="text-white text-center tracking-wider font-amp uppercase leading font-thin {{ preg_match_all("/[\w']+/", $text) <= 6 ? 'text-3xl leading-snug' : 'text-lg leading-loose' }}">
            {!! $text !!}
          </p>
          <hr style="border-color: {{ $style_line_color }};" class="w-10 m{{ $variant ? 't' : 'y' }}-6 border border-orange border-solid border-1 mx-auto">
        </div>
        @if(!$variant)
          <div class="flex flex-col justify-end items-end">
            <a
              style="color: {{ $style_fg_color }}; border-color: {{ $style_line_color }};"
              class="link px-5 py-2 font-sans font-thin tracking-widest text-white uppercase hover:text-blue border-2 border-solid border-orange"
              href="{{ $link }}">
              {{ $link_text ?: $link_title }}
            </a>
          </div>
        @endif
      </div>
    </div>

    <div class="sm:order-2 flex order-1 md:w-1/2 lg:w-3/4 w-full sm:ml-3 md:bg-center bg-left bg-left bg-cover md:px-12 px-5 py-12 md:justify-end justify-center md:items-end justify-center" style="background-image: url({{ get_sub_field('branding')['stock']['sizes']['1440'] }});">
      <div class="heading-title-block flex flex-col md:justify-end justify-center w-auto h-full">
        @if ($branding_title)
          <hr style="border-color: {{ $style_line_color }};" class="w-10 my-4 border border-orange mx-0 border-solid border-1 md:mx-0 mx-auto md:block hidden">
          <h2 style="color: {{ $style_fg_color }};" class="heading-title text-white font-base font-slab text-center md:text-left font-thin 2xl:text-5xl lg:text-4xl md:text-3xl text-2xl uppercase tracking-wider leading-tight">
            {!! $branding_title !!}
          </h2>
        @endif
      </div>
    </div>

  </div>
</section>
