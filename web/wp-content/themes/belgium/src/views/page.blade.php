@extends('master')

@php
  $navigation = array(
    'primary' => get_field('primary', 'options'),
    'secondary' => get_field('secondary', 'options'),
    'ternary' => get_field('ternary', 'options'),
    'footer' => get_field('primary', 'options'),
  );
  $brand = get_field('branding', 'options')['Logo']['url'];
@endphp

@section('content')
  <section class="w-full h-screen h-screen pt-2 pb-10 px-10">
    <header class=" primary-navigation">
      <nav class="primary w-full flex flex-row relative">
        <a href="/{{ $navigation['primary']->post_name }}" class="hover:opacity-75 relative">
          <img class="brand sm:w-88 w-48" src="{{ $brand }}" />
        </a>
        <section class="primary-menu relative sm:flex flex-row items-center w-full justify-end hidden">
          @foreach ($navigation['primary'] as $nav)
            @if ($loop->index == 1)
              @continue
            @endif
            <div class="menu-item w-auto relative">
              <a class="relative menu-link font-wide uppercase font-normal text-sm text-tan hover:opacity-75 mb-10 tracking-wide {{ $loop->first ? 'pr-4' : 'p-4' }} {{ $loop->last ? 'pl-4' : '' }}" href="/{{ $nav->post_name }}">
                {{ $nav->post_title }}
                <div class="px-6 absolute bottom-0 -mb-5 w-full h-2 bg-orange">&nbsp;</div>
              </a>
            </div>
            {{-- <div class="menu-item"><a class="menu-link font-sans font-normal text-lg text-tan" href="/{{ $nav['post_name'] }}">{{ $nav['post_title'] }}</a></div> --}}
          @endforeach
        </section>
      </nav>
    </header>
  </section>
@endsection
