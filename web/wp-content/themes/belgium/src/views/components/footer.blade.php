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
  <nav class="footer bg-gray pt-3 pb-3">

    <div class="container-sm flex flex-row m-auto justify-center items-start h-full">
      <section class="nav md:w-1/3 w-full h-full pt-10">
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

      <section class="logo-footer md:w-1/3 w-full flex flex-col h-full justify-between items-center pt-2">
        <a href="#" class="hover:opacity-75 relative -ml-1">
          <img class="brand md:w-500 w-48" src="{{ $brand }}" />
        </a>
        <p class="flex flex-row items-end h-full text-xs text-blue font-hairline">
          <a class="link uppercase font-wide tracking-wide hover:text-white" href="">Privacy Policy</a>&nbsp; | &nbsp;<br>
          <a class="link uppercase font-wide tracking-wide hover:text-white" href="">Disclaimer</a>&nbsp; | &nbsp;<br>
          <a class="link uppercase font-wide tracking-wide hover:text-white" href="">Site Map</a>
        </p>
      </section>

      <section class="contact h-full md:w-auto flex flex-col justify-start w-full leading-loose md:text-left text-center relative block ml-auto lg:-mr-12">
        <p class="text-left uppercase font-wide tracking-wide w-full pt-10">
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
      </section>

    </div>

  </nav>
</footer>
