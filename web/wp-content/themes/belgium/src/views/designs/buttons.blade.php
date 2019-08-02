@php
  $buttons = get_sub_field('buttons');
  // echo json_encode($buttons);
@endphp
<section class="buttons">
  <div class="container mx-auto w-full h-full py-5">
    <div class="flex md:flex-row flex-col h-full w-full">
      @foreach ($buttons as $button)
        <a
          style="background-image: url({{ wp_get_attachment_url($button['image']['id']) }});"
          class="link h-auto w-auto bg-cover bg-center"
          href="{{ get_permalink($button['link']->ID) }}">
          {{ $button['label'] }}
        </a>
      @endforeach
    </div>
  </div>
</section>
