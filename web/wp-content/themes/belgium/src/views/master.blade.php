<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('head')
  <body @php body_class() @endphp>
    <link rel="stylesheet" href="/public/out.css">
    @php do_action('get_header') @endphp
    @include('components.nav')
    <div class="content-wrap container" role="document">
      <div class="content">
        <main class="main">
          @yield('content')
        </main>
      </div>
    </div>
    @php do_action('get_footer') @endphp
    @include('components.footer')
    @php wp_footer() @endphp
    <script src="/public/out.js"></script>
  </body>
</html>
