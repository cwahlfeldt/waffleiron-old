@php
  /*
    grab acf fields
    TODO :
      - columns
      - thinner? more flex fields
   */

  global $post;

  $title = get_sub_field('title')['title'];
  $style_title_color = get_sub_field('title')['color'];
  $style_line_color = get_sub_field('title')['line_rule'];
  $style_bg_image = get_sub_field('branding')['background_image'];
  $style_logo = get_sub_field('branding')['logo']['url'];
  $style_bg_color = get_sub_field('color')['background_color'];
  $style_fg_color = get_sub_field('color')['foreground_color'];
  $style_sizing = get_sub_field('sizing')['alignment'];

  $content = array_merge(
    get_sub_field('content') ?: array(false),
    get_sub_field('columns') ?: array(false)
  );
  $use_columns = get_sub_field('use_columns');
@endphp
{{-- {{$content}} --}}
<section class="content w-full relative">
  <div class="container mx-auto" style="background-color: {{ $style_bg_color }};">
    <div class="container-sm mx-auto">
      @if ($title)
        <h2 class="text-center mt-5 font-sans tracking-widest font-xl uppercase" style="color: {{ $style_title_color }};">
          {{ $title }}
          @if ($style_line_color)
            <hr style="border-color: {{ $style_line_color }}; text-align: {{$style_sizing['value']}};" class="w-10 my-2 border border-solid border-1 mt-6">
          @endif
        </h2>
      @endif

      @if ( $content )
        <div class="the-content w-full h-full mx-auto {{ !$title && $style_bg_color !== "#ffffff" ? '' : 'py-3' }}">

					  @if ($use_columns) <div class="flex flex-auto flex-wrap"> @endif
            @foreach ($content as $c)

              @if ($c) {{-- if array val is false then default to ?html --}}

                @if ($c['acf_fc_layout'] === 'copy')
                  @if ($use_columns)
                    <div class="md:w-1/2 md:px-12 text-{{ $style_sizing }} font-serif leading-loose {{ $c[$loop->index++]['acf_fc_layout'] === 'link' ? 'font-amp' : '' }}" style="color: {{ $style_fg_color }};">
                      {!! $c['copy'] !!}
                    </div>
                  @else
                    <div class={{ preg_match_all("/[\w']+/", $c['copy']) <= 20 ? 'text-2xl' : '' }} "w-full mx-auto lg:px-32 md:px-24 sm:px-0 copy font-serif leading-loose {{ $c[$loop->index++]['acf_fc_layout'] === 'link' ? 'font-amp' : '' }}" style="color: {{ $style_fg_color }};">
                      {!! $c['copy'] !!}
                    </div>								
                  @endif
                @endif

                @if ($style_logo)
                  <img class="w-24 mx-auto mt-12 mb-5" style="text-align: {{ $style_sizing['value'] }};" src="{{ $style_logo }}" alt="">
                @endif

                @if ($c['acf_fc_layout'] === 'image')
                  <img class="lg:px-24 md:px-24 mx-auto py-8" src="{{ $c['image']['url'] }}" alt="">
                @endif

                @if ($c['acf_fc_layout'] === 'link')
                  <div class="pt-5 pb-8" style="text-align: {{ $style_sizing['value'] }};">
                    <a class="link px-5 py-2 font-sans tracking-widest font-amp font-thin uppercase text-orange hover:text-tan border border-solid border-orange hover:bg-orange" href="{{ $c['link'] }}">
                      {{ $c['label'] }}
                    </a>
                  </div> 
                @endif

              {{-- @else --}}

              {{--   <div class="false container-sm mx-auto py-20 bg-blue"> --}}
              {{--     <p class="text-2xl font-slab text-orange"> --}}
              {{--       No layout ?. --}}
              {{--     </p> --}}
              {{--     <a href="{{ get_edit_post_link($post->ID) }}" class="text-lg font-sans text-tan"> --}}
              {{--       dope --}}
              {{--     </a> --}}
              {{--   </div> --}}
              @endif

            @endforeach
          	@if ($use_columns) </div> @endif

        </div>
      @endif 

    </div>
  </div>
 
</section>
