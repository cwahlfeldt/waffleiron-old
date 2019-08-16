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

<header class="primary-navigation container mx-auto h-full relative top-0 left-0">
  <nav class="primary flex md:flex-row flex-col md:justify-start md:items-center h-full w-full ">

    <div class="flex flex-row md:justify-start justify-center items-center h-full">
      <a href="/{{ $home['page_name'] }}" class="nav-wrap hover:opacity-75 relative h-full">
        <img class="brand" src="{{ $brand }}" />
      </a>
      <div class="ml-auto md:hidden block h-full">
        <i class="fas fa-bars font-3xl font-thin block text-blue"></i>
        <div style="display: none;" class="px-4 container bg-orange mobile-dropdown dropdown-menu flex absolute w-full pb-8 h-auto z-30 top-0">
          <div class="container-sm relative flex flex-col mx-auto justify-between pt-5">

            <div class="relative h-full">
              @foreach ($menu as $nav)
                @if (isset($nav['page']['page']))
                  @php $new_nav = $nav['page']['page']; @endphp
                  <div id="menu-link-{{ $new_nav->post_name }}" class="{{ $new_nav->post_name }} md:py-7 py-1 menu-link w-auto relative relative top-0 left-0 lg:mx-6 md:mx-2 z-30">
                    <a
                      class="{{ $nav['page']['sub_menu'] ? 'sub-menu-enabled' : '' }} py-7 dib font-wide w-full uppercase font-normal lg:text-base text-sm text-tan hover:opacity-75 tracking-wide"
                      href="{{ get_permalink($new_nav->ID) }}"
                    >
                      {{ $nav['page']['label'] }}
                    </a>
                  </div>
                @endif
              @endforeach
            </div>

          </div>
        </div>
      </div>
    </div>

    <section class="primary-menu md:flex md:visible invisible flex-row sm:items-center w-full justify-end ml-auto">
      @foreach ($menu as $nav)

          @if (isset($nav['page']['page']))
            @php $new_nav = $nav['page']['page']; @endphp
            <div id="menu-link-{{ $new_nav->post_name }}" class="{{ $new_nav->post_name }} md:py-7 menu-link w-auto relative relative top-0 left-0 lg:mx-6 md:mx-2 z-30">
              <a
                class="{{ $nav['page']['sub_menu'] ? 'sub-menu-enabled' : '' }} py-7 dib font-wide w-full uppercase font-normal lg:text-sm text-xs text-tan hover:opacity-75 tracking-wide"
                href="{{ $nav['page']['sub_menu'] ? '#' : get_permalink($new_nav->ID)  }}"
              >
                {{ $nav['page']['label'] }}
              </a>
            </div>

            @if ($nav['page']['sub_menu'])
              @php $sub_nav = $nav['page']['sub_menu']; @endphp
              {{-- {{ $sub_nav }} --}}
              <div style="display: none;" class="py-10 container bg-orange dropdown-menu flex absolute w-full pt-8 pb-10 h-auto z-20 top-0">
                <div class="container-sm relative flex flex-col mx-auto justify-between pt-5">
                  <div class="relative h-full">
                    <h2 class="font-sans uppercase text-3xl font-thin border-bottom text-white tracking-widest">
                      {{ $nav['page']['label'] }}
                      <hr class="w-10 my-3 border border-tan border-solid border-1 ml-0">
                    </h2>
                    <div class="flex flex-auto flex-wrap items-between w-full py-6">
                      @foreach($sub_nav as $sub)
                        <div class="lg:w-1/4 md:w-1/3 w-full">
                          <a class="text-white font-condensed font-medium text-base tracking-wide leading-relaxed" href="/{{ $sub->post_name }}/">{{ $sub->post_title }}</a>
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

      <div class="md:py-7 menu-link w-auto relative relative top-0 left-0 lg:ml-3 md:ml-2 z-20">
        <a
          class="fa fa-search sub-menu-enabled md:px-3 bg-gray pt-2 pb-2 py-7 dib font-wide w-full uppercase font-normal lg:text-sm text-xs text-tan hover:opacity-75 tracking-wide"
          href="#"
        >
        </a>
      </div>

        <div style="display:none;" class="px-4 container bg-orange dropdown-menu flex absolute w-full pt-8 pb-10 h-auto z-30 top-0">
          <div class="container-sm relative flex flex-col mx-auto justify-between pt-5">
            <div class="relative h-full">
              <h2 class="font-sans uppercase text-3xl font-thin border-bottom text-white tracking-widest">
                Search
                <hr class="w-10 my-3 border border-tan border-solid border-1 ml-0">
              </h2>
              <div class="search-form-dropdown flex flex-auto flex-wrap items-between w-full py-6">
                {!! get_search_form() !!}
              </div>
            </div>
          </div>
        </div>

    </section>
  </nav>
</header>
