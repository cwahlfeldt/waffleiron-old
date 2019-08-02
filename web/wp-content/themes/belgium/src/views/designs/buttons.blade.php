@php
  $buttons = get_sub_field('buttons');
  // echo json_encode($buttons);
@endphp
<section class="buttons">
  <div class=" mx-auto w-full h-full py-5">
    <div class="flex md:flex-row flex-col h-full w-full justify-between">
      @foreach ($buttons as $button)
        <div
          style="background-image: url({{ wp_get_attachment_url($button['image']['id']) }});"
          class="button-wrap flex bg-cover bg-center flex-col justify-center items-center {{ $loop->last ? 'md:w-1/2' : 'md:w-1/4' }} w-1/2 h-full py-12 px-5">
          <a
            class="link hover:text-orange h-auto w-auto text-xl text-tan font-slab text-center"
            href="{{ get_permalink($button['link']->ID) }}">
            {!! $button['label'] !!}
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>
