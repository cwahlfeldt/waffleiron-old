@php
  $navigation = array(
    'primary' => get_field('primary', 'options'),
    'secondary' => get_field('secondary', 'options'),
    'ternary' => get_field('ternary', 'options'),
    'footer' => get_field('footer', 'options'),
  );
  $brand = get_field('branding', 'options')['footer_logo']['url'];
@endphp
<footer class="w-full bg-gray-600">
  <nav class="footer w-full">

    <div class="w-full container-sm flex flex-row justify-center items-center m-auto">
      <section class="nav md:w-1/3 w-full">
        @foreach ($navigation['primary'] as $nav)
          @if ($loop->index == 1)
            @continue
          @endif
          <div class="footer-menu-item w-auto relative">
            <a class="menu-link font-wide uppercase font-normal lg:text-sm text-xs text-tan hover:opacity-75 mb-10 tracking-wide" href="/{{ $nav->post_name }}">
              {{ $nav->post_title }}
              <div class="menu-guide px-6 absolute -mb-5 w-full h-4 bg-orange">&nbsp;</div>
            </a>
          </div>
        @endforeach
      </section>

      <section class="logo-footer md:w-1/3 w-full flex flex-row justify-between items-center">
        <a href="#" class="hover:opacity-75 relative -ml-3">
          <img class="brand md:w-88 w-48" src="{{ $brand }}" />
        </a>
        <p class="flex flex-row">
          <a class="link uppercase font-sans tracking-wide" href="">Privacy Policy</a> | <br>
          <a class="link uppercase font-sans tracking-wide" href="">Disclaimer</a> | <br>
          <a class="link uppercase font-sans tracking-wide" href="">Site Map</a>
        </p>
      </section>

      <section class="contact md:w-1/3 flex flex-col justify-center items-center w-full">
        <p>
          <div class="address">
            {!! get_field('contact', 'options')['address'] !!}
          </div>
          <div class="email">
            {!! get_field('contact', 'options')['email'] !!}
          </div>
          <div class="phone">
            {!! get_field('contact', 'options')['phone'] !!}
          </div>
          <div class="fax">
            {!! get_field('contact', 'options')['fax'] !!}
          </div>
        </p>
      </section>

    </div>

  </nav>
</footer>
