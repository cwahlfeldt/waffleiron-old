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
  <section class="w-full h-full pt-8 pb-2 container">

    <header class="primary-navigation -mt-6">
      <nav class="primary w-full flex flex-row">
        <a href="/{{ $navigation['primary']->post_name }}" class="hover:opacity-75 relative -ml-3">
          <img class="brand md:w-88 w-48" src="{{ $brand }}" />
        </a>
        <section class="primary-menu md:flex hidden flex-row items-center w-full justify-end">
          @foreach ($navigation['primary'] as $nav)
            @if ($loop->index == 1)
              @continue
            @endif
            <div class="menu-item w-auto relative">
              <a class="menu-link dib font-wide uppercase font-normal lg:text-sm text-xs text-tan hover:opacity-75 mb-10 tracking-wide {{ $loop->first ? 'md:pr-4 pr-2' : 'md:p-4 p-2' }} {{ $loop->last ? 'md:pl-4 pl-2' : '' }}" href="/{{ $nav->post_name }}">
                {{ $nav->post_title }}
                <div class="menu-guide px-6 absolute -mb-5 w-full h-4 bg-orange">&nbsp;</div>
              </a>
            </div>

            @if ( get_page_children( $nav->ID, array($nav) ) )
              <div class="dropdown-menu absolute w-screen bg-orange">
                <h2 class="font-wide text-4xl border-bottom"></h2>
                <div class="container-sm flex flex-row"></div>
              </div>
            @endif
            {{-- <div class="menu-item"><a class="menu-link font-sans font-normal text-lg text-tan" href="/{{ $nav['post_name'] }}">{{ $nav['post_title'] }}</a></div> --}}
          @endforeach
          <div class="menu-item w-auto relative">
            <button class="button text-white pl-2 hover:bg-white hover:text-orange"><i class="fa fa-search bg-gray p-1"></i></button>
          </div>
          </div>
        </section>
      </nav>
    </header>

    @if (have_rows('designs'))
      @while (have_rows('designs')) @php(the_row())

        @if (get_row_layout() === 'heading')
          @include('designs.heading')
        @endif

        @if (get_row_layout() === 'intro')
          @include('designs.intro')
        @endif

        @if (get_row_layout() === 'content')
          @include('designs.content')
        @endif

        @if (get_row_layout() === 'contact')
          @include('designs.contact')
        @endif

        @if (get_row_layout() === 'image')
          @include('designs.image')
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
