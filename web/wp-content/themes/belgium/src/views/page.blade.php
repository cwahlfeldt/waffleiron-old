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


  function get_excerpt($str, $startPos=0, $maxLength=200) {
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

  @if ($post->post_name === 'news')
    <section class="news">
      <div class="flex flex-col lg:px-64 md:px-48 px-12 py-12">
        @foreach(get_posts(array('posts_per_page' => -1)) as $news_post) @php(setup_postdata($news_post))
          <div class="flex flex-col py-6">
            <h2 class="font-condensed 2xl:text-5xl md:text-4xl text-2xl uppercase hover:text-orange text-blue tracking-wide leading-none">
              <a href="/{{ $news_post->post_name }}">{{ $news_post->post_title }}</a>
            </h2>
            <p class="post-meta my-0 text-gray font-slab text-sm font-thin tracking-wide">
              {{ date_format(date_create($news_post->post_date), 'l, F jS, Y') }}
            </p>
            {{-- @if (get_field('designs', $news_post->ID)) --}}
            {{--   @foreach (get_field('designs', $news_post->ID) as $design) --}}
            {{--       {1{-- {{ var_dump($design) }} --}1} --}}
            {{--     @if ($design['acf_fc_layout'] === 'content') --}}
            {{--       <div class="content font-serif text-base leading-snug text-blue"> --}}
            {{--         {!! get_excerpt($design['content'][0]['copy']) !!} --}}
            {{--       </div> --}}
            {{--     @endif --}}
            {{--   @endforeach --}} 
            {{-- @endif --}}
          </div>
        @endforeach 
      </div>   
    </section>
  @endif

</section>
@endsection
