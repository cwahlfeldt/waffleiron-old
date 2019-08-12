@extends('master')

@section('content')

<section class="designs">
  @if (have_rows('designs'))
    @while (have_rows('designs')) @php(the_row())

      @if (get_row_layout() === 'heading')
        @include('designs.heading')
      @endif

      @if (get_row_layout() === 'content')
        @include('designs.content')
      @endif

      @if (get_row_layout() === 'banner')
        @include('designs.banner')
      @endif

      @if (get_row_layout() === 'buttons')
        @include('designs.buttons')
      @endif

      @if (get_row_layout() === 'call_to_action')
        @include('designs.call-to-action')
      @endif

      @if (get_row_layout() === 'attorneys')
        @include('designs.attorneys')
      @endif

      @if (get_row_layout() === 'testimonials')
        @include('designs.testimonials')
      @endif

      @if (get_row_layout() === 'areas_of_practice')
        {{-- {{ 'wtf' }} --}}
        @include('designs.areas-of-practice')
      @endif

      @if (get_row_layout() === 'accordions')
        @include('designs.accordions')
      @endif

      @if (get_row_layout() === 'contact')
        @include('designs.contact')
      @endif

    @endwhile
  @endif

</section>
@endsection
