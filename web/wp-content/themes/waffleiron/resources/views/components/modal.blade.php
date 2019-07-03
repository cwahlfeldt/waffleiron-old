<section class="modal fixed invisible w-screen pin-l pin-b z-10 {{ $className ?? '' }}">
  <div class="relative w-screen h-full bg-orange">
    <div class="close-modal relative z-20">
      <button
        style="font-family: Arial Unicode MS;"
        class="modal-toggle absolute pin-r pin-t text-white hover:text-grey-lighter font-sans font-thin text-4xl mt-5 border-0 bg-transparent">&#x2715;</button>
    </div>
    <div class="flex flex-col justify-center items-center">
      {{ $slot }}
    </div>
  </div>
</section>
