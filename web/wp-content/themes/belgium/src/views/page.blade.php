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
      <a href="/">
        <img class="brand w-48" src="{{ $brand }}" />
      </a>
    </nav>
  </header>
@endsection
