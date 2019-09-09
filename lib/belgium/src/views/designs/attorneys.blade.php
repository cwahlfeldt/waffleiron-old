@php
  $attorneys = get_sub_field('attorneys');
  $title = get_sub_field('title');
  $style = get_sub_field('style')['color'];
@endphp
<section class="attorneys w-full h-full relative" style="background-color: {{ $style['background_color'] }};">

  <div class="py-16 w-full h-full container-sm mx-auto">
    <h3 class="w-full text-base font-sans tracking-widest text-center">
      {{ $title['title'] }}
      <hr style="border-color: {{ $style['color']['line_color'] }};" class="w-10 my-8 border border-orange border-solid border-1 mx-auto">
    </h3>

    <div class="flex flex-auto flex-wrap items-center {{ count($attorneys) > 4 ? 'md:justify-start' : 'justify-center'  }} justify-center py-12">
      @foreach($attorneys as $attorney)
        {{-- <a href="{{ get_permalink($attorney->ID) }}" class="flex-col flex 2xl:w-1/5 lg:w-1/4 md:w-1/4 sm:w-1/2 xs:w-full h-auto my-6 px-6"> --}}
        <a href="{{ get_permalink($attorney->ID) }}" class="flex-col flex h-auto my-6 px-6">
          <div class="attorney-item w-auto h-auto">
            <img class="w-auto h-auto bg-cover" src="{{ get_field('picture', $attorney->ID)['sizes']['340'] }}" />
            <h4 class="font-sans text-blue font-bold tracking-wide mt-3">
              {{ get_the_title($attorney->ID) }}
            </h4>
            <h5 class="small-text font-slab font-thin text-xs tracking-widest text-orange">
              {{ get_field('title', $attorney->ID) }}
            </h5>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>
