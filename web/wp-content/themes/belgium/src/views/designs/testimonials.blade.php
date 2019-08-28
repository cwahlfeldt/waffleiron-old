<style>
.slick-dots li.slick-active button::before {
    opacity: .75;
    color: {{ get_sub_field('style')['foreground_color'] }};
}
</style>
<section class="testimonials py-3">
  <div class="container h-full" style="background-color: {{ get_sub_field('style')['background_color'] }}">
    <div class="container-sm pt-20 pb-10 mx-auto">
      <h3 class="text-xl uppercase text-center font-wide tracking-widest pb-6" style="color: {{ get_sub_field('style')['foreground_color'] }};">
        {!! get_sub_field('title') !!}
        <hr style="border-color: {{ get_sub_field('style')['line_color'] }};" class="w-10 my-6 border border-orange border-solid border-1">
      </h3>
      <div class="carrousel w-full h-full pb-12">
        @foreach (get_sub_field('testimonial') as $testimonial)
          <div class="testimonial-item md:px-24 sm:px-12 xs:px-2 ">
            <div class="text-base font-serif" style="color: {{ get_sub_field('style')['foreground_color'] }};">
              {!! get_field('copy', $testimonial->ID) !!}
            </div>
            <h3 class="font-condensed text-2xl font-thin tracking-wider text-center my-8" style="color: {{ get_sub_field('style')['foreground_color'] }};">
              {{ get_field('name', $testimonial->ID)['name'] }}
            </h3>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
