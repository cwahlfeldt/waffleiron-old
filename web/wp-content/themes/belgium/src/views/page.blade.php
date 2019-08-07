@extends('master')

@php
  global $post;
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

      @if (get_row_layout() === 'accordions')
        @include('designs.accordions')
      @endif

      @if (get_row_layout() === 'contact')
        @include('designs.contact')
      @endif

    @endwhile
  @endif

  @if ($post->post_name === 'news')
    <div class="flex flex-col">
      @foreach(get_posts() as $news_post) @php(setup_postdata($news_post))
        <h2 class="font-slab text-2xl uppercase text-blue tracking-wide leading-snug">{{ $news_post->post_title }}</h2>
        @foreach (get_field('designs', $news_post->ID) as $design)
          {{ json_encode($design) }}
        @endforeach
      @endforeach 
    </div>
   
  @endif

</section>
@endsection
