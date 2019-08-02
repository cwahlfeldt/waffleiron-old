@php
  $title = get_sub_field('title')['title'];
  $title_color = get_sub_field('title')['color'];
  $title_line_color = get_sub_field('title')['line_rule'];

  $use_columns = get_sub_field('use_columns');
  $content = $use_columns ? get_sub_field('columns') : get_sub_field('content');
  $columns = get_sub_field('columns');

  $style_bg_image = get_sub_field('branding')['background_image'];
  $style_logo = get_sub_field('branding')['logo']['url'];
  $style_bg_color = get_sub_field('color')['background_color'];
  $style_fg_color = get_sub_field('color')['foreground_color'];
  $style_sizing = get_sub_field('sizing')['alignment'];
@endphp

<section class="content w-full relative py-6">
  {{-- {{ $columns }} --}}
  <div class="container mx-auto" style="background-color: {{ $style_bg_color }};">
    @if ($content)
      <div class="container-sm mx-auto pt-16 pb-12">
        <h2 class="text-center mb-5 font-sans tracking-widest font-xl uppercase" style="color: {{ $title_color }}">
          {{ $title }}
          @if ($title_line_color)
            <hr style="border-color: {{$title_line_color}}; text-align: {{$style_sizing['value']}};" class="w-10 my-2 border border-solid border-1 mt-6">
          @endif
        </h2>

        
        @foreach ($content as $c)

          @if (!$use_columns)
              <div class="the-content lg:px-32 md:px-24 sm:px-0 copy font-serif leading-loose {{ $content[$loop->index++]['acf_fc_layout'] === 'link' ? 'font-amp' : '' }}" style="color: {{ $style_fg_color }};">
                {!! $c['copy'] !!}
              </div>
          @else

            <div class="flex w-full justify-between items-center flex-auto">
            @foreach ($columns as $col)
              <div
                class="w-1/2 the-content copy font-serif leading-loose {{ $content[$loop->index++]['acf_fc_layout'] === 'link' ? 'font-amp' : '' }}" style="color: {{ $style_fg_color }};">
                  {!! $c['copy'] !!}
                </div>
              </div>
            @endforeach
            </div>

          @endif

          @if ($style_logo)
            <img class="w-24 mx-auto mt-8 mb-5" style="text-align: {{ $style_sizing['value'] }};" src="{{ $style_logo }}" alt="">
          @endif

          @if ($c['acf_fc_layout'] === 'image')
            <img class="lg:px-24 md:px-24" src="{{ $c['image']['url'] }}" alt="">
          @endif

          @if ($c['acf_fc_layout'] === 'link')
            <div class="pt-5 pb-8" style="text-align: {{ $style_sizing['value'] }};">
              <a class="link px-5 py-2 font-sans tracking-widest font-amp font-thin uppercase text-orange hover:text-tan border border-solid border-orange hover:bg-orange" href="{{ $c['link'] }}">
                {{ $c['label'] }}
              </a>
            </div> 
          @endif

        @endforeach
      </div>
      </div>
    @endif 
  </div>
 
</section>
