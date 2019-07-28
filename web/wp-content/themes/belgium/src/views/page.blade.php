@extends('master')

@section('content')
  <header class="primary-navigation">
    <nav class="primary">
      <a href="/">
        <img class="brand"></img>
      </a>
      {{ json_encode(get_field('primary_navigation', 'options')) }}
    </nav>
  </header>
@endsection
