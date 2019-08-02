@php
  /*
  $navigation = array(
    'primary' => get_field('primary_nav', 'options'),
    'secondary' => get_field('secondary', 'options'),
    'ternary' => get_field('ternary', 'options'),
    'footer' => get_field('primary', 'options'),
  );
  */
  $brand = get_field('branding', 'options')['Logo']['url'];
  $primary_nav = get_field('primary_nav', 'options');
  $home = (array) get_field('primary_nav', 'options')[0]['page']['page'];
  $menu = (array) get_field('primary_nav', 'options');
  array_shift($menu);
@endphp

<header class="primary-navigation container mx-auto h-full">
  <nav class="primary flex md:flex-row flex-col h-full w-full">

    <div class="flex flex-row justify-start items-center">
      <a href="/{{ $home['page_name'] }}" class="nav-wrap hover:opacity-75 relative">
        <img class="brand" src="{{ $brand }}" />
      </a>
      <div class="ml-auto md:hidden">
        <button class="hamburger" type="button">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button>
      </div>
    </div>

    <section class="primary-menu md:flex md:visible invisible flex-row sm:items-center w-full justify-end ml-auto">
      @foreach ($menu as $nav)

          @if (isset($nav['page']['page']))
            @php $new_nav = $nav['page']['page']; @endphp
            <div id="menu-link-{{ $new_nav->post_name }}" class="{{ $new_nav->post_name }} md:py-7 menu-link w-auto relative relative top-0 left-0 lg:mx-6 md:mx-2">
              <a class="py-7 dib font-wide w-full uppercase font-normal lg:text-sm text-xs text-tan hover:opacity-75 tracking-wide" href="/{{ $new_nav->post_name }}">
                {{ $nav['page']['label'] }}
              </a>
            </div>

            {{-- {{ $nav['page'] }} --}}

            @if ($nav['page']['post_name'] == 'areas-of-practice' || $nav['page']['post_name'] == 'our-attorneys')
              <div id="dropdown-{{ $nav['page']['post_name'] }}" class="py-10 container bg-orange dropdown-menu flex absolute w-full pt-8 pb-10 h-auto z-30 top-0">
                <div class="container-sm relative flex flex-col mx-auto justify-between pt-5">
                  <div class="relative h-full">
                    <h2 class="font-sans uppercase text-3xl font-thin border-bottom text-white tracking-widest">
                      {{ $nav['page']->post_title }}
                      <hr class="w-10 my-3 border border-tan border-solid border-1 ml-0">
                    </h2>
                    <div class="flex flex-auto flex-wrap items-between w-full py-6">
                      {{-- @foreach($the_menu as $menu) --}}
                      {{--   <div class="lg:w-1/4 md:w-1/3 w-full"> --}}
                      {{--     <a class="text-white font-condensed font-medium text-base tracking-wide leading-relaxed" href="/{{ $menu['page']['post_name'] }}/">{{ $menu->post_title }}</a> --}}
                      {{--   </div> --}}
                      {{-- @endforeach --}}
                    </div>
                  </div>
                </div>
              </div>
            @endif

          @endif

        {{-- <div class="menu-item"><a class="menu-link font-sans font-normal text-lg text-tan" href="/{{ $nav['post_name'] }}">{{ $nav['post_title'] }}</a></div> --}}
      @endforeach

      <div class="menu-item w-auto relative">
        <button class="button text-white pl-2 hover:bg-white hover:text-orange"><i class="fa fa-search bg-gray p-1"></i></button>
      </div>

    </section>
  </nav>
</header>
