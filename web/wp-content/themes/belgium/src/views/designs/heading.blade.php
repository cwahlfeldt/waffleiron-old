<section class="heading w-full relative">
  <div class="flex sm:flex-row flex-col w-full h-full">

    <div class="h-full sm:order-1 order-2 md:w-1/2 lg:w-1/4 sm:w-full sm:mr-3 bg-blue relative py-12">
      <div class="h-full flex flex-col justify-between items-center relative">
        <img class="w-auto px-12 pb-12" src="{{ get_sub_field('branding')['logo']['url'] }}" alt="">
        <hr class="w-10 my-2 border border-orange border-solid border-1">
        <p class="text-white text-center font-amp uppercase font-medium text-normal leading-loose py-3">
          {!! get_sub_field('text') !!}
        </p>
        <hr class="w-10 border border-orange border-solid border-1">
        <div class="flex flex-col justify-end items-end p-8">
          <a class="link px-5 py-2 font-sans font-thin tracking-widest text-white uppercase hover:text-blue border border-solid border-orange hover:bg-orange" href="{{ get_sub_field('link') }}">
            Our Attorneys
          </a>
        </div>
      </div>
    </div>

    <div class="sm:order-2 order-1 md:w-1/2 lg:w-3/4 sm:w-full sm:ml-3 bg-center bg-cover" style="background-image: url({{ get_sub_field('branding')['stock']['url'] }});">
      <div class="flex flex-col justify-end items-end p-8 h-full">
        <p class="heading-branded-text text-left tracking-wider text-white text-center font-slab font-thin uppercase leading-tight text-5xl">
          {!! get_sub_field('branding')['title'] !!}
        </p>
      </div>
    </div>

  </div>
</section>
