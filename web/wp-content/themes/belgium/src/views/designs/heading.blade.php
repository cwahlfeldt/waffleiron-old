@php
  $text = $text ?: get_sub_field('text');
  $link = get_sub_field('link');
  $link_text = get_sub_field('link_text');
  $link_title = get_the_title($link);

  $branding_logo = $branding_logo ?: get_sub_field('branding')['logo']['url'];
  $branding_title = $branding_title ?: get_sub_field('branding')['title'];

  $style_line_color = $style_line_color ?: get_sub_field('style')['line_color'];
  $style_bg_color = $style_bg_color ?: get_sub_field('style')['background_color'];
  $style_fg_color = $style_fg_color ?: get_sub_field('style')['foreground_color'];
@endphp

<style>
  .heading a:hover {
    background-color: {{ $style_line_color }};
    color: {{ $style_bg_color }};
  }
</style>
<section class="heading w-full relative">
  <div class="flex sm:flex-row flex-col w-full h-full">

    <div class="h-full sm:order-1 order-2 2xl:w-1/4 md:w-1/2 lg:w-1/3 sm:w-full sm:mr-3 bg-blue relative py-20 px-4" style="background-color: {{ $style_bg_color }};">
      <div class="h-full flex flex-col justify-center items-center relative">
        <img class="logo" src="{{ $branding_logo }}" alt="">

        <div class="text my-auto">
          <hr style="border-color: {{ $style_line_color }};" class="w-10 my-6 border border-orange border-solid border-1">
          <p
            style="color: {{ $style_fg_color }};"
            class="text-white text-center tracking-wider font-amp uppercase leading font-thin {{ preg_match_all("/[\w']+/", $text) <= 6 ? 'text-3xl leading-snug' : 'text-lg leading-loose' }}">
            {!! $text !!}
          </p>
          <hr style="border-color: {{ $style_line_color }};" class="w-10 my-6 border border-orange border-solid border-1">
        </div>
        <div class="flex flex-col justify-end items-end">
          <a
            style="color: {{ $style_fg_color }}; border-color: {{ $style_line_color }};"
            class="link px-5 py-2 font-sans font-thin tracking-widest text-white uppercase hover:text-blue border-2 border-solid border-orange"
            href="{{ $link }}">
            {{ $link_text ?: $link_title }}
          </a>
        </div>
      </div>
    </div>

    <div class="sm:order-2 flex order-1 md:w-1/2 lg:w-3/4 sm:w-full sm:ml-3 md:bg-center bg-left bg-left bg-cover md:px-12 px-5 py-12 md:justify-end justify-center md:items-end justify-center w-full" style="background-image: url({{ get_sub_field('branding')['stock']['url'] }});">
      <div class="heading-title-block flex flex-col md:justify-end justify-center w-auto h-full">
        @if ($branding_title)
          <hr style="border-color: {{ $style_line_color }};" class="w-10 my-4 border border-orange mx-0 border-solid border-1">
          <h2 style="color: {{ $style_fg_color }};" class="heading-title text-white font-base font-slab font-thin 2xl:text-5xl md:text-4xl sm:text-3xl xs:text-xl uppercase tracking-wider leading-tight">
            {!! $branding_title !!}
          </h2>
        @endif
      </div>
    </div>

  </div>
</section>
