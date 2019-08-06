@php
  $title = get_sub_field('title');
  $accordions = get_sub_field('accordions');
  $style_fg_color = get_sub_field('style')['foreground_color'];
  $style_bg_color = get_sub_field('style')['background_color'];
  $style_line_color = get_sub_field('style')['line_color'];

@endphp
@if ($accordions)
<div class="accordions w-full h-full">
  <div class="container h-full">
    <div class="container-sm mx-auto">
      <h2 class="text-center mb-5 font-sans tracking-widest font-xl uppercase" style="color: {{ $style_fg_color }};">
        {{ $title }}
        @if ($style_line_color)
          <hr style="border-color: {{ $style_line_color }}; text-align: {{$style_sizing['value']}};" class="w-10 my-2 border border-solid border-1 mt-6">
        @endif
      </h2>
      <div class="accordion-items md:px-32 sm:px-16 xs:px-4">
        @foreach($accordions as $a)
          <button class="accordion-item flex flex-col items-between py-2 h-auto w-full text-left border-t-2 border-solid border-blue hover:cursor-pointer">
            <h2 class="font-condensed font-semibold tracking-wide text-lg text-blue uppercase hover:text-orange hover:cursor-pointer">
              {{ $a['title'] }}
            </h2>
            <div class="accordion-content pt-4 pb-8 hidden" style="color: {{ $style_fg_color }};">
              {!! $a['content'] !!}
            </div>
          </button>
        @endforeach 
      </div>
    </div>
  </div>
</div>
@endif
