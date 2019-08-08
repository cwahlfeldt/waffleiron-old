@extends('master')

@php
  global $post;
  $name = get_the_title();
@endphp

@section('content')
  @if (get_post_type() === 'attorneys')
    @php
      $pic = get_field('picture');
      $img = get_field('image');
      $job_title = get_field('title');
      $accordions = get_field('accordions');
      $content = get_field('content');
      $style = get_field('style');
    @endphp

    <section class="heading attorney-heading w-full relative">
      <div class="flex sm:flex-row flex-col w-full h-full">
        <div class="side-wrap h-full sm:order-1 order-2 2xl:w-1/4 md:w-1/2 lg:w-1/3 sm:w-full sm:mr-3 bg-blue relative py-12 px-4" style="background-color: {{ $style['background_color'] }};">
          <div class="h-full flex flex-col justify-start items-center relative">
            <img class="logo" src="/wp-content/uploads/2019/07/TM_Icon_Orange.svg" alt="">

            <div class="text my-auto">
              <hr style="color: {{ $style['line_color'] }};" class="w-10 my-4 border border-orange border-solid border-1"> 
              <p class="text-white text-center tracking-widest font-condensed uppercase font-thin text-3xl leading-snug">
                {{ $name }}
              </p>
              <p class="text-white text-center tracking-widest font-amp uppercase font-thin text-sm leading-snug">
                {{ $job_title }}
              </p>
              <hr style="color: {{ $style['line_color'] }};" class="w-10 my-5 border border-orange border-solid border-1"> 
            </div>
          </div>
        </div>

        <div class="title sm:order-2 order-1 md:w-1/2 lg:w-3/4 sm:w-full sm:ml-3 md:bg-top sm:bg-right bg-cover md:px-12 md:py-12 px-8 py-12" style="background-image: url({{ $img['url'] }});">
          <div class="flex flex-col justify-end sm:items-end items-center h-full">
            <p class="heading-branded-text lg:text-left text-center tracking-wider text-white sm:font-lg text-center font-slab font-thin uppercase leading-tight text-5xl">
              {!! get_field('branding')['title'] !!}
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="heading attorney-heading-content h-full w-full">
      <div class="flex sm:flex-row flex-col w-full h-full">
        <div class="side-wrap h-full sm:order-1 order-2 2xl:w-1/4 md:w-1/2 lg:w-1/3 sm:w-full bg-blue relative py-12 px-4" style="background-color: {{ $style['background_color'] }};">
          <div class="h-full flex flex-col justify-center items-center relative">
            <div class="profile md:block hidden flex flex-col items-center justify-center">
              <div class="bg-white p-6 w-auto">
                <img class="" src="{{ $pic['url'] }}" alt="">
                <div class="flex flex-col">
                  <p class="text-blue w-64 text-left tracking-widest font-slab uppercase font-thin text-lg leading-normal pt-3">
                    {{ $name }}
                  </p>
                  <p class="text-orange w-64 text-left tracking-widest font-amp uppercase font-thin text-sm leading-snug">
                    {{ $job_title }}
                  </p>             
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="content-thing bg-tan py-24 pl-48 pr-32 mt-6 title sm:order-2 order-1 md:w-1/2 lg:w-3/4 sm:w-full md:bg-center bg-left bg-left bg-cover border-l-8 border-solid border-white">
          <p class="lg:text-left text-left tracking-wider sm:text-lg text-center font-slab font-thin uppercase leading-tight text-5xl text-orange">
            Profile
            {{-- <hr style="border-color: {{ $style['color']['line_color'] }};" class="w-10 my-4 border border-orange border-solid border-1"> --}}
            <hr style="border-color: ;" class="w-10 my-6 border border-blue mx-0 border-solid border-1">
            @php
              $content = nl2br($post->post_content);
            @endphp
            <div class="font-serif text-blue py-6">{!! $content !!}</div>
          </p>
    
          @if ($accordions)
            <div class="accordions w-full h-full">
              {{-- {{ $accordions }} --}}

              <div class="accordion-items w-full h-full">
                @foreach($accordions as $a)
                  <button class="accordion-item flex flex-col items-between py-2 h-auto w-full text-left border-t-2 border-solid border-blue hover:cursor-pointer">
                    <h2 class="font-condensed font-semibold tracking-wide text-lg text-blue uppercase hover:text-orange hover:cursor-pointer">
                      {{ $a['title'] }}
                    </h2>
                    <div class="accordion-content hidden">
                      {!! $a['copy'] !!}
                    </div>
                  </button>
                @endforeach 
              </div>
            </div>
          @endif
        </div>
      </div>
    </section>

  @elseif (get_post_type() === 'post')

    @php
      $designs = get_field('designs');
    @endphp

    <section class="post">
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
    </section>
  @endif
@endsection
