@extends('master')

@php
  $navigation = array(
    'primary' => get_field('primary', 'options'),
    'secondary' => get_field('secondary', 'options'),
    'ternary' => get_field('ternary', 'options'),
    'footer' => get_field('primary', 'options'),
  );
  $brand = get_field('branding', 'options')['Logo']['url'];

 /* function has_children(child) {
    $children = get_pages( array( 'child_of' => $child ) );
    if( count( $children ) == 0 ) {
        return false;
    } else {
        return true;
    }
  }*/
@endphp

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

      @if (get_row_layout() === 'contact')
        @include('designs.contact')
      @endif

      @if (get_row_layout() === 'banner')
        @include('designs.banner')
      @endif

      @if (get_row_layout() === 'list')
        @include('designs.list')
      @endif

      @if (get_row_layout() === 'accordions')
        @include('designs.accordions')
      @endif

      @if (get_row_layout() === 'attorneys')
        @include('designs.attorneys')
      @endif

    @endwhile
  @endif
</section>
@endsection
