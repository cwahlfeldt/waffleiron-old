@extends('master')

@section('content')
  <div class="container w-full-h-full bg-tan">
    <div class="container-sm mx-auto w-full h-full py-24 px-32">

      @if (!have_posts())
        <div class="alert alert-warning">
          {{ __('Sorry, no results were found.', 'sage') }}
        </div>
        {!! get_search_form(false) !!}
      @else
        <h1 class="mb-8 font-sans text-lg uppercase tracking-loose text-center text-orange">
          Search Results:
        </h1>

        @while(have_posts()) @php the_post() @endphp
          <article class="py-4">
            <header>

              <h2 class="font-slab font-lg mb-2">
                <a class="hover:text-white text-orange" href="{{ get_permalink() }}">{!! get_the_title() !!}</a>
              </h2>
              @if (get_post_type() === 'page')
                <p class="font-serif text-base text-blue leading-loose">
                  
                </p>
              @endif
            </header>
            <div class="font-serif text-base text-blue leading-loose">
              @php the_excerpt() @endphp
            </div>
          </article>
        @endwhile
      @endif

    </div>
  </div>
@endsection
