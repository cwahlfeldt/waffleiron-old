@extends('master')

@section('content')
  <header class="primary-navigation">
    <nav class="primary">
      <a href="/">
        <img class="brand"></img>
      </a>
      @php
        $navigation = array(
          get_field('primary', 'options'),
          get_field('secondary', 'options'),
          get_field('ternary', 'options'),
          get_field('footer', 'options'),
        );
      @endphp
      {{ $navigation('primary') }}

    </nav>
  </header>
@endsection
