@php
  $navigation = array(
    'primary' => get_field('primary', 'options'),
    'secondary' => get_field('secondary', 'options'),
    'ternary' => get_field('ternary', 'options'),
    'footer' => get_field('primary', 'options'),
  );
  $brand = get_field('branding', 'options')['Logo']['url'];
  $areas_copy = $navigation['primary']['menu'];
  $attorneys_copy = $navigation['primary']['menu'];
  $areas_menu = array_slice($areas_copy, 3, 9);
  $attorneys_menu = array_slice($attorneys_copy, 13, 17);
  $the_menu = $areas_menu;

  if ($nav->post_name == 'areas-of-practice') {
    $the_menu = $areas_menu;
  }

  if ($nav->post_name == 'our-attorneys') {
    $the_menu = $attorneys_menu;
  }

@endphp

<header class="primary-navigation container mx-auto h-full">
  <nav class="primary flex flex-row items-center sm:justify-center h-full w-full">
    <a href="/{{ $navigation['primary']->post_name }}" class="nav-wrap hover:opacity-75 relative">
      <img class="brand" src="{{ $brand }}" />
    </a>
    <section class="primary-menu md:flex hidden flex-row sm:items-center w-full justify-end ml-auto">
      @foreach ($navigation['primary']['menu'] as $nav)
        @if ($loop->index == 1)
          @continue
        @endif

          @if ($nav->post_parent == 0 && $nav->post_type == 'page')
            <div id="menu-link-{{ $nav->post_name }}" class="{{$nav->post_name}} md:py-7 menu-link w-auto relative h-full relative top-0 left-0 sm:mx-6">
              <a class="py-7 dib font-wide w-full uppercase h-full font-normal lg:text-sm text-xs text-tan hover:opacity-75 tracking-wide" href="/{{ $nav->post_name }}">
                {{ $nav->post_title }}
              </a>
            </div>

            @if ($nav->post_name == 'areas-of-practice' || $nav->post_name == 'our-attorneys')
              <div id="dropdown-{{ $nav->post_name }}" class="py-10 container bg-orange dropdown-menu flex absolute w-full pt-8 pb-10 h-auto z-30 top-0">
                <div class="container-sm relative flex flex-col mx-auto justify-between pt-5 pb">
                  <div class="relative h-full">
                    <h2 class="font-sans uppercase text-3xl font-thin border-bottom text-white tracking-widest">
                      {{ $nav->post_title }}
                      <hr class="w-10 my-3 border border-tan border-solid border-1 ml-0">
                    </h2>
                    <div class="flex flex-auto flex-wrap items-between w-full py-6">
                      @foreach($the_menu as $menu)
                        <div class="w-1/4">
                          <a class="text-white font-condensed font-medium text-base tracking-wide leading-relaxed" href="/{{ $menu->post_name }}/{{ $menu->post_name }}/">{{ $menu->post_title }}</a>
                        </div>
                      @endforeach
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
