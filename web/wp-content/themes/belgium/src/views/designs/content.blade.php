@php
  $title = get_sub_field('title')['title'];
  $title_color = get_sub_field('title')['color'];
  $title_line_color = get_sub_field('title')['line_rule'];
  $use_columns = get_sub_field('use_columns');
  $content = $use_columns ? get_sub_field('columns') : get_sub_field('content');
  $style_bg_image = get_sub_field('branding')['background_image'];
  $style_bg_color = get_sub_field('color')['background_color'];
  $style_fg_color = get_sub_field('color')['foreground_color'];
  $style_logo = get_sub_field('branding')['logo']['url'];
  $style_sizing = get_sub_field('sizing')['alignment'];

  //echo json_encode($content);
@endphp

<section class="content w-full relative">
  <div class="container mx-auto" style="background-color: {{ $style_bg_color }};">
    @if ($content)
      @foreach ($content as $c)
        @if ($c['acf_fc_layout'] === 'copy')
          <h2 class="text-center" style="color: {{ $title_color }}">
            {{ $title }}
            @if ($title_line_color)
              <hr style="border-color: {{$title_line_color}}; text-align: {{$style_sizing['value']}};" class="w-10 my-2 border border-solid border-1 ml-0">
            @endif
          </h2>
          <div class="content" style="color: {{ $style_fg_color }};">{!! $c['copy'] !!}</div>
          <img class="w-32 mx-auto" style="text-align: {{ $style_sizing['value'] }};" src="{{ $style_logo }}" alt="">
        @endif

        @if ($c['acf_fc_layout'] === 'image')
          {!! $c['image'] !!}
        @endif

        @if ($c['acf_fc_layout'] === 'link')
          <div class="py-4" style="text-align: {{ $style_sizing['value'] }};">
            <a class="link px-5 py-2 font-wide tracking-widest font-amp font-thin uppercase text-orange hover:text-tan border border-solid border-orange hover:bg-orange" href="{{ $c['link'] }}">
              {{ $c['label'] }}
            </a>
          </div> 
        @endif
      @endforeach
    @endif 
  </div>
 
</section>
