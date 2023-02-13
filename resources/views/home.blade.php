@once
    @push('header_links')
        <link rel='stylesheet' href = '/styles/home.css'>
        <script src = '/scripts/home.js' defer></script>
    @endpush
@endonce

<x-layout>

    <x-header>
    </x-header>

    <section class = 'search-box flex-row flex-end p-rel'>

        <x-search.search />

        

        <div class = 'result p-abs'>

          <x-loading />

          <div class = 'results'>

          </div>
        </div>
    </section>

    <section class = 'latest'>

            <div class = 'section-top'>
                <h1>L<span>atest Updates</span></h1>
            </div>

            <x-grid_box>
                <x-page_result.cards :books="$latest_books" />
            </x-grid_box>
    </section>

    <section  class = 'banner flex-center'>
        <div class = 'case ov-hidden'>
            {{-- <img src =  class = 'obj-fit'> --}}
            <div id="carouselExampleCaptions" class="carousel slide relative obj-fit" data-bs-ride="carousel" >
                <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-4">
                  <button
                    type="button"
                    data-bs-target="#carouselExampleCaptions"
                    data-bs-slide-to="0"
                    class="active"
                    aria-current="true"
                    aria-label="Slide 1"
                  ></button>
                  <button
                    type="button"
                    data-bs-target="#carouselExampleCaptions"
                    data-bs-slide-to="1"
                    aria-label="Slide 2"
                  ></button>
                  <button
                    type="button"
                    data-bs-target="#carouselExampleCaptions"
                    data-bs-slide-to="2"
                    aria-label="Slide 3"
                  ></button>
                </div>
                <div class="carousel-inner relative w-full overflow-hidden">
                  <div class="carousel-item active relative float-left w-full">
                    <img
                      src='/images/banner.webp'
                      class="block w-full obj-fit"
                      alt="..."
                    />
                    <div class="carousel-caption hidden md:block absolute text-center">
                      <h5 class="text-xl">First slide label</h5>
                      <p>Some representative placeholder content for the first slide.</p>
                    </div>
                  </div>
                  <div class="carousel-item relative float-left w-full">
                    <img
                      src="https://mdbootstrap.com/img/Photos/Slides/img%20(22).jpg"
                      class="block w-full"
                      alt="..."
                    />
                    <div class="carousel-caption hidden md:block absolute text-center">
                      <h5 class="text-xl">Second slide label</h5>
                      <p>Some representative placeholder content for the second slide.</p>
                    </div>
                  </div>
                  <div class="carousel-item relative float-left w-full">
                    <img
                      src="https://mdbootstrap.com/img/Photos/Slides/img%20(23).jpg"
                      class="block w-full"
                      alt="..."
                    />
                    <div class="carousel-caption hidden md:block absolute text-center">
                      <h5 class="text-xl">Third slide label</h5>
                      <p>Some representative placeholder content for the third slide.</p>
                    </div>
                  </div>
                </div>
                <button
                  class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                  type="button"
                  data-bs-target="#carouselExampleCaptions"
                  data-bs-slide="prev"
                >
                  <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button
                  class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                  type="button"
                  data-bs-target="#carouselExampleCaptions"
                  data-bs-slide="next"
                >
                  <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>
    </section>

    <section class = 'others'>

        <div class = 'section-top'>
            <h1>M<span>ost Read Books</span></h1>
        </div>

        <!--<div class = 'case'>-->
            <!--<div class = 'preview' >-->
            <!--    <div class = 'image full-w half-h ov-hidden'>-->
            <!--        <img src = '/images/cover_images/{{$most_read_books[0]->cover_image ?? ''}}' class = 'obj-fit'>-->
            <!--    </div>-->

                <!--<div class = 'description'>-->
                <!--    <h3><span>{{$most_read_books[0]->title ?? ''}}</span></h3>-->
                <!--    <p>-->
                <!--      {{Str::limit($most_read_books[0]->description ?? '', 400) }}-->
                <!--    </p>-->
                <!--</div>-->
            <!--</div>-->

            <x-grid_box>
              <x-page_result.cards :books="$most_read_books" />
            </x-grid_box>
        <!--</div>-->

    </section>

</x-layout>