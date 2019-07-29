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
  <header class=" primary-navigation">
    <nav class="primary w-full flex flex-row">
      <a href="/{{ $navigation['primary']->post_name }}">
        <img class="brand sm:w-64 w-48" src="{{ $brand }}" />
      </a>
      <section class="primary-menu relative sm:flex flex-row justify-end hidden">
        @foreach ($navigation['primary'] as $nav)
          @if ($loop->index == 1)
            @continue
          @endif
          <div class="menu-item"><a class="menu-link font-sans font-normal text-lg text-tan" href="/{{ $nav->post_name }}">{{ $nav->post_title }}</a></div>
          {{-- <div class="menu-item"><a class="menu-link font-sans font-normal text-lg text-tan" href="/{{ $nav['post_name'] }}">{{ $nav['post_title'] }}</a></div> --}}
        @endforeach
      </section>
    </nav>
  </header>
@endsection
