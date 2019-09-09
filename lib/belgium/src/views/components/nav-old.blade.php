@php
  $navigation = array(
    'primary' => get_field('primary', 'options'),
    'secondary' => get_field('secondary', 'options'),
    'ternary' => get_field('ternary', 'options'),
    'footer' => get_field('primary', 'options'),
  );

  //echo json_encode($navigation['primary']['menu']);

  $areas_copy = $navigation['primary']['menu'];
  $attorneys_copy = $navigation['primary']['menu'];
  $areas_menu = array_slice($areas_copy, 3, 9);
  $attorneys_menu = array_slice($attorneys_copy, 13, 17);

  //echo json_encode($attorneys_menu);
  //echo json_encode($areas_menu);

  $brand = get_field('branding', 'options')['Logo']['url'];
@endphp

<header class="primary-navigation">
  <nav class="primary flex flex-row">
    <a href="/{{ $navigation['primary']->post_name }}" class="hover:opacity-75 relative -ml-3">
      <img class="brand md:w-88 w-48" src="{{ $brand }}" />
    </a>
    <section class="primary-menu md:flex hidden flex-row items-center w-full justify-end">
      @foreach ($navigation['primary']['menu'] as $nav)
        @if ($loop->index == 1)
          @continue
        @endif

          @if ($nav->post_parent == 0 && $nav->post_type == 'page')
            <div id="menu-link-{{ $nav->post_name }}" class="menu-link h-auto w-auto relative md:px-4">
              <a class="dib font-wide hover:text-orange uppercase h-full font-normal lg:text-sm text-xs text-tan hover:opacity-75 mb-10 tracking-wide" href="/{{ $nav->post_name }}">
                {{ $nav->post_title }}
                @if ($nav->post_name === 'areas-of-practice' || $nav->post_name === 'our-attorneys')
                  <div class="menu-guide px-6 py-5 absolute w-full h-4 bg-orange z-20">&nbsp;</div>
                @endif
              </a>
            </div>

            @if ($nav->post_name == 'areas-of-practice')
              <div id="dropdown-{{ $nav->post_name }}" class="invisible dropdown-menu flex absolute w-full h-auto z-30 pl-10">
                <div class="relative w-full flex flex-col justify-center mx-auto bg-orange pt-5 pb-16">
                  <div class="head-col justify-start">
                    <h2 class="font-sans uppercase text-4xl font-thin border-bottom text-white tracking-widest">
                      Areas of Practice
                      <hr class="w-10 my-2 border border-tan border-solid border-1 ml-0">
                    </h2>
                  </div>
                    <div class="head-col justify-between">
                  @foreach($areas_menu as $area_menu)
                    @if($loop->index % 4 == 0)
                      @continue
                    @endif
                      <div class="col w-1/4 h-auto">
                        <a class="text-white font-condensed font-medium text-lg leading-relaxed" href="/areas-of-practice/{{ $area_menu->post_name }}/">{{ $area_menu->post_title }}</a>
                      </div>
                  @endforeach
                    </div>
                </div>
              </div>
            @endif

            @if ($nav->post_name == 'our-attorneys')
              <div id="dropdown-{{ $nav->post_name }}" class="invisible dropdown-menu flex absolute w-full h-auto z-30 pl-10">
                <div class="relative w-full flex flex-col justify-center mx-auto bg-orange pt-5 pb-16">
                  <div class="head-col justify-start">
                    <h2 class="font-sans uppercase text-4xl font-thin border-bottom text-white tracking-widest">
                      Areas of Practice
                      <hr class="w-10 my-2 border border-tan border-solid border-1 ml-0">
                    </h2>
                  </div>
                    <div class="head-col justify-between">
                  @foreach($attorneys_menu as $attorney_menu)
                      <div class="col w-1/4 h-auto">
                        <a class="text-white font-condensed font-medium text-lg leading-relaxed" href="/our-attorneys/{{ $attorney_menu->post_name }}/">{{ $attorney_menu->post_title }}</a>
                      </div>
                  @endforeach
                    </div>
                </div>
              </div>
            @endif

            @if ($nav->post_name == 'our-attorneys')
              <div id="dropdown-{{ $nav->post_name }}" class="invisible dropdown-menu flex absolute w-full h-auto z-30 pl-10">
                <div class="relative w-full flex flex-col justify-center mx-auto bg-orange pt-5 pb-16">
                  <div class="head-col justify-start">
                    <h2 class="font-sans uppercase text-4xl font-thin border-bottom text-white tracking-widest">
                      Attorneys
                      <hr class="w-10 my-2 border border-tan border-solid border-1 ml-0">
                    </h2>
                  </div>
                  @foreach($attorneys_menu as $attorney_menu)
                    @if($loop->index % 4 == 0)
                      @continue
                    @endif
                    <div class="head-col w-1/4 justify-between">
                      <a class="text-white font-condensed font-medium text-lg leading-relaxed" href="/our-attorneys/{{ $attorney_menu->post_name }}/">{{ $attorney_menu->post_title }}</a>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif

          @endif

        {{-- <div class="menu-item"><a class="menu-link font-sans font-normal text-lg text-tan" href="/{{ $nav['post_name'] }}">{{ $nav['post_title'] }}</a></div> --}}
      @endforeach

      <div class="menu-item w-auto relative">
        <button class="button text-white pl-2 hover:bg-white hover:text-orange"><i class="fa fa-search bg-gray p-1"></i></button>
      </div>
      </div>
    </section>
  </nav>
</header>
