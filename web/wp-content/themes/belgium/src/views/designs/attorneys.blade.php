@php
  $attorneys = get_sub_field('attorneys');
  $title = get_sub_field('title');
  $style = get_sub_field('style')['color'];
@endphp
<section class="attorneys w-full h-full relative" style="background-color: {{ $style['background_color'] }};">

  <div class="py-16 w-full h-full container-sm mx-auto">
    <h3 class="w-full text-base font-sans tracking-widest text-center">
      {{ $title['title'] }}
      <hr style="border-color: {{ $style['color']['line_color'] }};" class="w-10 my-4 border border-orange border-solid border-1">
    </h3>

    <div class="flex flex-auto flex-wrap justify-between w-full">
      @foreach($attorneys as $attorney)
        <div class="flex-col flex lg:w-1/5 md:1/4 sm:1/2 h-full mx-3">
          <div class="w-full h-64 bg-cover h-64 bg-center bg-gray" style="background-image: url({{ get_field('picture', $attorney->ID)['url'] }});"></div>
          <div class="bg-white w-full h-auto bg-white py-2">
            <h4 class="font-sans text-blue font-bold tracking-wide">
              {{ get_the_title($attorney->ID) }}
            </h4>
            <h5 class="small-text font-slab font-thin text-xs tracking-widest text-orange">
              {{ get_field('title', $attorney->ID) }}
            </h5>
          </div> 
        </div>
      @endforeach
    </div>
  </div>
</section>
