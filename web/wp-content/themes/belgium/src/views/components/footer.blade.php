@php
  $navigation = array(
    'primary' => get_field('primary', 'options'),
    'secondary' => get_field('secondary', 'options'),
    'ternary' => get_field('ternary', 'options'),
    'footer' => get_field('footer', 'options'),
  );
  $brand = get_field('branding', 'options')['footer_logo']['url'];
@endphp
<footer class="w-full h-full container my-5">
  <nav style="background-color: #e3e5e6;" class="footer py-16">

    <div class="container-sm flex md:flex-row flex-col m-auto justify-between items-start h-full">
      <section class="md:order-1 order-2 nav lg:w-1/3 w-full h-full flex flex-col justify-between">
        @foreach ($navigation['secondary'] as $nav)
          @if ($loop->index == 1)
            @continue
          @endif
          <div class="footer-menu-item w-auto relative">
            <a class="menu-link font-wide uppercase font-normal lg:text-xs text-xs text-blue hover:text-white mb-10 tracking-wide" href="/{{ $nav->post_name }}">
              {{ $nav->post_title }}
            </a>
          </div>
        @endforeach
      </section>

      <section class="md:order-2 order-1 lg:w-1/3 logo-footer w-full flex flex-col h-full">
        <p class="flex flex-col items-center h-full text-xs text-blue font-hairline">
          <img class="brand" src="{{ $brand }}" />
          <div class="flex flex-row justify-center">
            <a class="link uppercase font-wide tracking-wide hover:text-white text-sm" href="/privacy-policy">Privacy Policy</a>&nbsp; | &nbsp;<br>
            <a class="link uppercase font-wide tracking-wide hover:text-white text-sm" href="/disclaimer">Disclaimer</a>&nbsp; | &nbsp;<br>
            <a class="link uppercase font-wide tracking-wide hover:text-white text-sm" href="#">Site Map</a>
          </div>
        </p>
      </section>

      <section class="order-3 lg:w-1/3 contact h-full leading-loose md:text-left text-center relative block">
        <div class="flex flex-col w-auto ml-auto">
          <p class="md:text-left text-center uppercase font-wide tracking-wide">
            <div class="address font-wide uppercase tracking-wide text-xs font-hairline text-blue">
              {!! get_field('contact', 'options')['address'] !!}
            </div>
          </p>
          <p class="email font-wide uppercase tracking-wide text-xs font-hairline text-blue">
            Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="text-blue hover:text-white" href="mailto:{{ get_field('contact', 'options')['email'] }}">{{ get_field('contact', 'options')['email'] }}</a>
          </p>
          <p class="phone font-wide uppercase tracking-wide text-xs font-hairline text-blue">
            Phone&nbsp;&nbsp;&nbsp;&nbsp;<a href="tel:{{ get_field('contact', 'options')['phone'] }}" class="text-blue hover:text-white text-regular text-base">{{ get_field('contact', 'options')['phone'] }}</a>
          </p>
          <p class="fax font-wide uppercase tracking-wide text-xs font-hairline text-blue">
            Fax&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="tel:{{ get_field('contact', 'options')['fax'] }}" class="text-regular text-blue hover:text-white text-base">{{ get_field('contact', 'options')['fax'] }}</a>
          </p>
        </div>
      </section>

    </div>

  </nav>
</footer>
