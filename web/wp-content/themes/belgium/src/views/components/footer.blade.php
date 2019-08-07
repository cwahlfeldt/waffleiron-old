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
  <nav style="background-color: #e3e5e6;" class="footer ">

    <div class="container-sm flex md:flex-row flex-col m-auto justify-between items-start h-full md:pt-12 pt-5 pb-5">
      <section class="md:order-1 order-2 nav lg:w-1/3 w-full h-full flex flex-col justify-between">
        @foreach ($navigation['secondary'] as $nav)
          @if ($loop->index == 1)
            @continue
          @endif
          <div class="footer-menu-item w-auto relative">
            <a class="menu-link font-wide uppercase font-normal lg:text-xs text-xs text-gray hover:text-blue mb-10 tracking-wide" href="/{{ $nav->post_name }}">
              {{ $nav->post_title }}
            </a>
          </div>
        @endforeach
        <div class="bar-logo w-48 md:pt-24 pt-5">
          <img src="/wp-content/uploads/2019/07/IL_Bar_Logo-Horiz_TM-gray.png" alt="">
        </div>
      </section>

      <section class="md:order-2 order-1 lg:w-1/3 logo-footer w-full h-full">
        <div class="flex flex-col justify-between items-center h-full text-xs text-gray font-hairline md:text-left text-center">
          <img class="brand" src="{{ $brand }}" />
          <p class="flex flex-row justify-center text-center md:text-left md:pt-24 pt-5 h-full w-full">
            <a class="link uppercase font-wide tracking-wide hover:text-blue text-sm" href="/privacy-policy">Privacy Policy</a>&nbsp; | &nbsp;<br>
            <a class="link uppercase font-wide tracking-wide hover:text-blue text-sm" href="/disclaimer">Disclaimer</a>&nbsp; | &nbsp;<br>
            <a class="link uppercase font-wide tracking-wide hover:text-blue text-sm" href="#">Site Map</a>
          </p>
        </div>
      </section>

      <section class="order-3 lg:w-1/3 contact h-full leading-loose md:text-left text-center relative block">
        <div class="flex flex-col w-full">
          <p class="md:text-left text-center uppercase font-wide tracking-wide w-full">
            <div class="address font-wide uppercase tracking-wide text-xs font-hairline text-gray ml-auto">
              {!! get_field('contact', 'options')['address'] !!}
              <p class="email font-wide uppercase tracking-wide text-xs font-hairline text-gray">
                Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="text-gray hover:text-blue" href="mailto:{{ get_field('contact', 'options')['email'] }}">{{ get_field('contact', 'options')['email'] }}</a>
              </p>

              <p class="phone font-wide uppercase tracking-wide text-xs font-hairline text-gray">
                Phone&nbsp;&nbsp;&nbsp;&nbsp;<a href="tel:{{ get_field('contact', 'options')['phone'] }}" class="text-gray hover:text-blue text-regular text-base">{{ get_field('contact', 'options')['phone'] }}</a>
              </p>
              <p class="fax font-wide uppercase tracking-wide text-xs font-hairline text-gray">
                Fax&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="tel:{{ get_field('contact', 'options')['fax'] }}" class="text-regular text-gray hover:text-blue text-base">{{ get_field('contact', 'options')['fax'] }}</a>
              </p>
							<div class="ml-auto copyright w-64 md:pt-24 pt-5 flex flex-row justify-end justify-end w-auto">
								<p class="font-amp font-thin text-xs uppercase text-gray w-full ml-auto">
									&copy; {{ date("Y") }} Thomas Mamer, LLP | All Rights Reserved
								</p>
							</div>
            </div>

          </p>

          </div>
        </div>
      </section>

    </div>

  </nav>
</footer>
