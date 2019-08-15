@php
  $title = get_sub_field('title');
  $subtitle = get_sub_field('subtitle');
  $link = get_sub_field('link');
  $style = get_sub_field('style');
@endphp

<section class="call-to-action py-3">
  <div class="call-to-action-wrap flex md:flex-row flex-col h-full w-full justify-between w-full">
    <div class="item md:w-3/4 w-full md:mr-3 relative h-full">
      <div class="bg-cover bg-center h-full py-12 px-6" style="background-image: url({{ $style['background_image']['url'] }});">
        <h3
          style="color: {{ $style['line_color'] }};"
          class="font-sans tracking-widest text-center">
          {{ $title }}
          <hr style="border-color: {{ $style['line_color'] }};" class="w-10 my-4 border border-orange border-solid border-1 mx-auto">
        </h3>
        <p
          style="color: {{ $style['foreground_color'] }};"
          class="font-slab text-center md:text-2xl text-xl leading-loose tracking-widest uppercase">
          {!! $subtitle !!}
        </p>
      </div>
    </div>
    <div class="item md:w-1/4 w-full md:ml-3 relative flex flex-col" style="background-color: {{ $style['background_color'] }};">
      <img class="see-through-image z-0 absolute" src="/wp-content/uploads/2019/07/TM_Icon_White.svg" />
      <a style="border-color: {{ $style['line_color'] }};" class="z-20 h-full m-4 flex flex-col justify-center items-center border-2 border-white border-solid hover:border-dotted" href="{{ $link }}">
        <p class="md:p-16 p-4 uppercase text-center font-sans text-lg leading-tight" style="color: {{ $style['line_color'] }};">
          Get in<br class="md:block hidden">
          Touch
        </p>
      </a>
    </div>
  </div>
</section>
