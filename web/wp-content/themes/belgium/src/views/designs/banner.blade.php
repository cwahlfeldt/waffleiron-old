<section class="banner w-full h-auto py-12">
<div
  class="banner w-full h-auto relative container py-16 bg-cover bg-center"
  style="background-image: url({{ get_sub_field('branding')['background_image']['url'] }});"
>
  <div class="container-sm mx-auto h-full">
    <div class="flex flex-col items-start justify-between">
      <hr style="border-color: {{ get_sub_field('style')['line_color'] }};" class="w-10 my-4 border border-orange mx-0 border-solid border-1">
      <h2
        class="text-white font-base font-slab font-thin text-4xl uppercase tracking-wider leading-tight"
        style="color: {{ get_sub_field('color')['foreground_color'] }};"
      >
        {!! get_sub_field('title')['title'] !!}
      </h2>
    </div>
    <div class="md:pt-48 pt-24">
      <img class="w-1/2" src="{{ get_sub_field('branding')['logo']['url'] }}" alt="">
    </div>
  </div>
</div>
</section>

