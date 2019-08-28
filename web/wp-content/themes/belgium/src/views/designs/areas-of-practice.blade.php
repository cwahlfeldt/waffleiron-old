@php
  $areas = get_sub_field('areas_of_practice');
  //echo json_encode($areas);
@endphp
<section class="areas pt-3">
  <div class=" mx-auto w-full h-full container-sm mx-auto">
    <div class="flex flex-auto flex-wrap h-full w-full md:justify-between justify-center">
      @foreach ($areas as $area)
				@php
					$banner = null;
					foreach (get_field('designs', $area->ID) as $design) {
						if ($design['acf_fc_layout'] === 'banner') {
							$banner = $design;
						}
					}
				@endphp
				<div class="md:w-1/3 sm:w-1/2 w-full h-full lg:p-5 sm:p-3 py-1">
        {{-- {{$banner['branding']['background_image']}} --}}
        <a
          href="/areas-of-practice/{{ $area->post_name }}"
          style="background-image: url({{ $banner['branding']['background_image']['sizes']['720'] }});"
          class="
            area-wrap
            flex bg-cover bg-center
            flex-col justify-center items-center
            h-full md:py-12 py-8 px-6"
          >
          <p
            class="link h-auto leading-tight text-tan w-auto lg:text-2xl text-xl hover:text-white font-slab text-center">
            @php
              $last_word = array_pop(explode(' />', $area->post_title));
              $the_rest = explode(' />', $area->post_title)[0];
            @endphp
            {!! $the_rest !!}
          </p>
        </a>
				</div>
      @endforeach
    </div>
  </div>
</section>
