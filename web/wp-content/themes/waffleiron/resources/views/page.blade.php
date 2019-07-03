@extends('layouts.app')

@section('content')

  @if (is_front_page())
    @if (get_field('gallery'))
      @include('partials.home-header')
    @endif
  @endif

  @if (have_rows('dynamic_layouts'))
    @while (have_rows('dynamic_layouts')) @php(the_row())

      @if (get_row_layout() === 'call_to_action_with_copy')
        @include('partials.call-to-action-with-copy')
      @endif

      @if (get_row_layout() === 'call_out')
        @include('partials.call-out')
      @endif

      @if (get_row_layout() === 'featured_menus')
        @include('partials.featured-menus')
      @endif

      @if (get_row_layout() === 'call_to_action_buttons')
        @include('partials.call-to-action-buttons')
      @endif

      @if (get_row_layout() === 'testimonial_carousel')
        @include('partials.testimonial-carousel')
      @endif

    @endwhile
  @endif

@endsection
