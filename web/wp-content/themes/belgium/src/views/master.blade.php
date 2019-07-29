<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    <div class="container">
      @include('components.nav')
    </div>
    <div class="container" role="document">
      <div class="content">
        <main class="main">
          @yield('content')
        </main>
      </div>
    </div>
    @php do_action('get_footer') @endphp
    @include('components.footer')
    @php wp_footer() @endphp
  </body>
</html>
