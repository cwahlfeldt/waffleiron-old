@php
  $title = get_sub_field('title');
  $subtitle = get_sub_field('subtitle');
  $link = get_sub_field('link');
  $style = get_sub_field('style');
@endphp

<section class="call-to-action">
  <div class="call-to-action-wrap flex md:flex-row flex-col h-full w-full justify-between w-full">
    <div class="item w-3/4 mr-3 relative h-full">
      <div class="bg-cover bg-center h-full py-12" style="background-image: url({{ $style['background_image']['url'] }});">
        <h3
          style="color: {{ $style['line_color'] }};"
          class="font-sans tracking-widest text-center">
          {{ $title }}
          <hr style="border-color: {{ $style['line_color'] }};" class="w-10 my-4 border border-orange border-solid border-1">
        </h3>
        <p
          style="color: {{ $style['foreground_color'] }};"
          class="font-slab text-center text-2xl leading-loose tracking-widest uppercase">
          {!! $subtitle !!}
        </p>
      </div>
    </div>
    <div class="item w-1/4 ml-3 relative flex flex-col" style="background-color: {{ $style['background_color'] }};">
      <img class="see-through-image z-0 absolute z-0 mx-auto" src="/wp-content/uploads/2019/07/TM_Icon_White.svg" />
      <div style="border-color: {{ $style['line_color'] }};" class="z-20 h-full m-4 flex flex-col justify-center items-center border border-tan border-solid">
        <a class="md:p-16 p-4 uppercase text-center font-sans " style="color: {{ $style['line_color'] }};" href="{{ $link }}">
          Get<br>
          in<br>
          Touch
        </a>
      </div>
    </div>
  </div>
</section>
