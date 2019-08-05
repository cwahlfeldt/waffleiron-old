@php
  $buttons = get_sub_field('buttons');
  // echo json_encode($buttons);
@endphp
<section class="buttons py-3">
  <div class=" mx-auto w-full h-full py-8">
    <div class="flex md:flex-row flex-col h-full w-full justify-between">
      @foreach ($buttons as $button)
        <a
          href="{{ $button['link'] }}"
          style="background-image: url({{ wp_get_attachment_url($button['image']['id']) }});"
          class="button-wrap hover:border-2 border-0 border-orange border-solid flex bg-cover bg-center flex-col justify-center items-center {{ $loop->last ? 'md:w-1/2' : 'md:w-1/4' }} w-1/2 h-full py-12 px-5">
          <p
            class="link h-auto text-tan w-auto text-2xl text-tan font-slab text-center">
            {!! $button['label'] !!}
          </p>
        </a>
      @endforeach
    </div>
  </div>
</section>
