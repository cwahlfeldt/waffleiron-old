@php
  $navigation = array(
    'primary' => get_field('primary', 'options'),
    'secondary' => get_field('secondary', 'options'),
    'ternary' => get_field('ternary', 'options'),
    'footer' => get_field('primary', 'options'),
  );
  $brand = get_field('branding', 'options')['Logo']['url'];
@endphp
<header class="primary-navigation">
  <nav class="primary flex flex-row">
    <a href="/{{ $navigation['primary']->post_name }}" class="hover:opacity-75 relative -ml-3">
      <img class="brand md:w-88 w-48" src="{{ $brand }}" />
    </a>
    <section class="primary-menu md:flex hidden flex-row items-center w-full justify-end">
      @foreach ($navigation['primary'] as $nav)
        @if ($loop->index == 1)
          @continue
        @endif
        <div class="menu-link w-auto relative">
          <a class="dib font-wide uppercase font-normal lg:text-sm text-xs text-tan hover:opacity-75 mb-10 tracking-wide {{ $loop->first ? 'md:pr-4 pr-2' : 'md:p-4 p-2' }} {{ $loop->last ? 'md:pl-4 pl-2' : '' }}" href="/{{ $nav->post_name }}">
            {{ $nav->post_title }}
            <div class="menu-guide px-6 py-5 absolute -mb-4 w-full h-4 bg-orange z-20">&nbsp;</div>
          </a>
        </div>

        <div class="dropdown-menu absolute w-full h-auto z-30 pl-10">
          <div class="relative w-full flex flex-col justify-center mx-auto bg-orange pt-5 pb-16">
            <div class="head-col justify-start">
              <h2 class="font-wide text-4xl border-bottom text-white tracking-widest">
                Title
                <hr class="line">
              </h2>
            </div>
            <div class="head-col justify-between">
              <div class="col h-auto w-auto">
                <h4 class="subtitle uppercase font-wide tracking-wide text-tan mb-4">Subtitle</h4>
                <ul class="text-white w-auto font-condensed font-medium leading-snug list-none pl-0 ml-0">
                  <li>Link</li>
                  <li>Another Link</li>
                  <li>Oh yeah</li>
                  <li>Oh yeah</li>
                </ul>
              </div>

              <div class="col h-auto w-auto">
                <h4 class="subtitle uppercase font-wide tracking-wide text-tan mb-4">Subtitle</h4>
                <ul class="text-white w-auto font-condensed font-medium leading-snug list-none pl-0 ml-0">
                  <li>Link</li>
                  <li>Another Link</li>
                  <li>Oh yeah</li>
                  <li>Oh yeah</li>
                </ul>
              </div>

              <div class="col h-auto w-auto">
                <h4 class="subtitle uppercase font-wide tracking-wide text-tan mb-4">Subtitle</h4>
                <ul class="text-white w-auto relative font-condensed font-medium leading-snug list-none pl-0 ml-0">
                  <li>Link</li>
                  <li>Another Link</li>
                  <li>Oh yeah</li>
                  <li>Oh yeah</li>
                </ul>
              </div>

              <div class="col h-auto w-auto">
                <h4 class="subtitle uppercase font-wide tracking-wide text-tan mb-4">Subtitle</h4>
                <ul class="text-white w-auto font-condensed font-medium leading-snug list-none pl-0 ml-0">
                  <li>Link</li>
                  <li>Another Link</li>
                  <li>Oh yeah</li>
                  <li>Oh yeah</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        {{-- <div class="menu-item"><a class="menu-link font-sans font-normal text-lg text-tan" href="/{{ $nav['post_name'] }}">{{ $nav['post_title'] }}</a></div> --}}
      @endforeach

      <div class="menu-item w-auto relative">
        <button class="button text-white pl-2 hover:bg-white hover:text-orange"><i class="fa fa-search bg-gray p-1"></i></button>
      </div>
      </div>
    </section>
  </nav>
</header>
