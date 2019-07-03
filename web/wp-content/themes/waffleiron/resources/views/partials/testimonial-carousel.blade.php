<?php
  $doubledUp = count(get_sub_field('slides')) * 2;
  $j = 0;
?>
<section class="testimonial-carousel md:pt-24">
  @component('components/swiper', [
    'id' => 'testimonial-slider',
    'loop' => false,
    'pagination' => wp_is_mobile(),
    'slides_per_view' => 1.1
  ])
    @if (!wp_is_mobile())

      @while(have_rows('slides')) @php(the_row())
        @component('components/slide')
          <div class="slide-top w-full bg-no-repeat flex flex-col justify-end items-end" style="background-image: url({{ get_sub_field('image_top')['url'] }});">
            <div class="bg-green quote p-10 h-full">
              <h3 class="font-serif text-base font-normal leading-normal text-white italic">{{ get_sub_field('quote_top') }}</h3>
              <h3 class="text-white font-sans text-lg font-normal tracking-wide pt-3 uppercase">- {{ get_sub_field('name_top') }}</h3>
            </div>
          </div>
          <div class="slide-bottom w-full bg-no-repeat flex flex-col justify-start items-start" style="background-image: url({{ get_sub_field('image_bottom')['url'] }});">
            <blockquote class="bg-orange quote p-10 h-full">
              <h3 class="font-serif text-base font-normal leading-normal text-white italic">{{ get_sub_field('quote_bottom') }}</h3>
              <h3 class="text-white font-sans text-lg tracking-wide font-normal pt-3 uppercase">- {{ get_sub_field('name_bottom') }}</h3>
            </blockquote>
          </div>
        @endcomponent
      @endwhile

    @else

      @for ($i = 0; $i < $doubledUp; $i++)
        <?php
          $pos = 'top';
          $testimonial = get_sub_field('slides')[$j];
          if ($i % 2 !== 0) {
            $pos = 'bottom';
            $j++;
          }
        ?>
        @component('components/slide')
          <div class="slide-bottom w-full bg-no-repeat flex flex-col justify-start items-start" style="background-image: url({{ $testimonial['image_' . $pos] }});">
            <blockquote class="bg-{{ $i % 2 !== 0 ? 'orange' : 'green' }} quote p-10 h-full">
              <h3 class="font-serif text-base font-normal leading-normal text-white italic">{{ $testimonial['quote_' . $pos] }}</h3>
              <h3 class="text-white font-sans text-lg tracking-wide font-normal pt-3 uppercase">- {{ $testimonial['name_' . $pos] }}</h3>
            </blockquote>
          </div>
        @endcomponent
      @endfor

    @endif
  @endcomponent
</section>
