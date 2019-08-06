@php
  $buttons = get_sub_field('buttons');
  // echo json_encode($buttons);
@endphp
<section class="buttons py-3">
  <div class=" mx-auto w-full h-full">
    <div class="flex md:flex-row flex-col h-full w-full md:justify-between justify-center">
      @foreach ($buttons as $button)
        <a
          href="{{ $button['link'] }}"
          style="background-image: url({{ wp_get_attachment_url($button['image']['id']) }});"
          class="
            button-wrap
            flex bg-cover bg-center
            flex-col justify-center items-center
            w-full h-full py-12 px-5
            {{ $loop->last ? 'md:w-1/2' : 'md:w-1/4' }}"
          >
          <p
            class="link h-auto leading-tight text-tan w-auto text-2xl text-tan font-slab text-center">
            @php
              $last_word = array_pop(explode(' />', $button['label']));
              $the_rest = explode(' />', $button['label'])[0];
            @endphp
            {!! $the_rest !!}<br><br>
            <span class="text-white font-amp font-medium leading-widest uppercase text-5xl">{!! $last_word !!}</span>
          </p>
        </a>
      @endforeach
    </div>
  </div>
</section>
