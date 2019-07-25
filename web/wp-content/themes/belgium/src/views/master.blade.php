<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    @include('blocks.header')
    <div class="wrap" role="document">
      <div class="content">
        <main class="main">
          @yield('content')
        </main>
      </div>
    </div>
    @php do_action('get_footer') @endphp
    @include('components.footer')
    @php wp_footer() @endphp
    <script src="/public/mod.out.js"></script>
  </body>
</html>
