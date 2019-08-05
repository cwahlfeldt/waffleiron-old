@php
  $link = get_sub_field('link', false, false);
  $link_text = get_sub_field('link_text');
  $link_title = get_the_title($link);
@endphp

<section class="heading w-full relative">
  <div class="flex sm:flex-row flex-col w-full h-full">

    <div class="h-full sm:order-1 order-2 2xl:w-1/4 md:w-1/2 lg:w-1/3 sm:w-full sm:mr-3 bg-blue relative py-12 px-4" style="background-color: {{ get_sub_field('style')['background_color'] }};">
      <div class="h-full flex flex-col justify-center items-center relative">
        <img class="logo" src="{{ get_sub_field('branding')['logo']['url'] }}" alt="">

        <div class="text my-auto">
          <hr style="color: {{ get_sub_field('style')['line_color'] }};" class="w-10 my-6 border border-orange border-solid border-1">
          <p class="text-white text-center tracking-wider font-amp uppercase leading font-thin {{ preg_match_all("/[\w']+/", get_sub_field('text')) <= 6 ? 'text-3xl leading-snug' : 'text-lg leading-loose' }}">
            {!! get_sub_field('text') !!}
          </p>
          <hr style="color: {{ get_sub_field('style')['line_color'] }};" class="w-10 my-6 border border-orange border-solid border-1">
        </div>
       
        <div class="flex flex-col justify-end items-end">
          <a style="color: {{ get_sub_field('style')['foreground_color'] }}; border-color: {{ get_sub_field('style')['line_color'] }};" class="link px-5 py-2 font-sans font-thin tracking-widest text-white uppercase hover:text-blue border border-solid border-orange hover:bg-orange" href="{{ get_sub_field('link') }}">
            {{ $link_text ?: $link_title }}
          </a>
        </div>
      </div>
    </div>

    <div class="sm:order-2 order-1 md:w-1/2 lg:w-3/4 sm:w-full sm:ml-3 md:bg-center bg-left bg-left bg-cover md:px-12 px-5 py-12" style="background-image: url({{ get_sub_field('branding')['stock']['url'] }});">
      <div class="flex flex-col justify-end sm:items-end items-center h-full">
        <p class="heading-branded-text lg:text-left text-center tracking-wider text-white sm:font-lg text-center font-slab font-thin uppercase leading-tight text-5xl">
          {!! get_sub_field('branding')['title'] !!}
        </p>
      </div>
    </div>

  </div>
</section>
