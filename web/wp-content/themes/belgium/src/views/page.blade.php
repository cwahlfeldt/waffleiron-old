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


  function get_excerpt($str, $startPos=0, $maxLength=100) {
    if(strlen($str) > $maxLength) {
      $excerpt   = substr($str, $startPos, $maxLength-3);
      $lastSpace = strrpos($excerpt, ' ');
      $excerpt   = substr($excerpt, 0, $lastSpace);
      $excerpt  .= '...';
    } else {
      $excerpt = $str;
    }
    
    return $excerpt;
  }
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
    <section class="news">
      <div class="flex flex-col px-48 py-12">
        @foreach(get_posts() as $news_post) @php(setup_postdata($news_post))
          <div class="flex flex-col py-6">
            <h2 class="font-slab text-2xl uppercase text-blue tracking-wide leading-snug">
             <a href="{{ $news_post }}">{{ $news_post->post_title }}</a>
            </h2>
            @if (get_field('designs', $news_post->ID))
              @foreach (get_field('designs', $news_post->ID) as $design)
                  {{-- {{ var_dump($design) }} --}}
                @if ($design['acf_fc_layout'] === 'content')
                  <div class="content font-serif text-base leading-loose text-blue">
                    {!! get_excerpt($design['content'][0]['copy']) !!}
                  </div>
                @endif
              @endforeach 
            @endif
          </div>
        @endforeach 
      </div>   
    </section>
  @endif

</section>
@endsection
