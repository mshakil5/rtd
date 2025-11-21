@extends('frontend.master')

@section('content')
    @foreach ($sections as $section)
        @if ($section->name == 'slider')
            <section id="hero" class="hero section dark-background">

                <div class="info d-flex align-items-center">
                    <div class="container">
                        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                            <div class="col-lg-12 text-center">
                                <h2 id="slider-title"></h2>
                                <p id="slider-sub"></p>

                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('book-now') }}" class="btn-get-started">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                    <div class="carousel-inner">

                        @foreach ($sliders as $key => $slider)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-title="{{ $slider->title }}"
                                data-sub="{{ $slider->sub_title }}">
                                <img src="{{ asset('images/slider/' . $slider->image) }}" class="d-block w-100">
                            </div>
                        @endforeach

                    </div>

                    <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bi bi-chevron-left"></span>
                    </a>

                    <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon bi bi-chevron-right"></span>
                    </a>
                </div>

                <script>
                    function updateSliderText() {
                        var active = document.querySelector('#hero-carousel .carousel-item.active');
                        document.getElementById('slider-title').innerText = active.dataset.title;
                        document.getElementById('slider-sub').innerText = active.dataset.sub;
                    }

                    // Initial load
                    updateSliderText();

                    // On slide change
                    var hero = document.getElementById('hero-carousel');
                    hero.addEventListener('slid.bs.carousel', updateSliderText);
                </script>

            </section>
        @endif

        @if ($section->name == 'video-1')
            <section class="services section">
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row align-items-center mb-5">

                        <div class="col-lg-6">
                            <div class="services-content" data-aos="fade-left" data-aos-duration="900">
                                <span class="subtitle">{{ $video1->short_title ?? '' }}</span>
                                <h2>{{ $video1->long_title ?? '' }}</h2>
                                <p data-aos="fade-right" data-aos-duration="800">
                                    {!! $video1->long_description ?? '' !!}
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="video-gallery text-center">
                                <div class="thumbnail position-relative">
                                    <img src="{{ asset('images/meta_image/' . $video1->meta_image) }}" alt="Video Thumbnail"
                                        class="fixed-thumb img-fluid rounded">

                                    <button type="button" class="video-play-float btn" data-bs-toggle="modal"
                                        data-bs-target="#videoModal"
                                        data-video="{{ asset('images/meta_video/' . $video1->video) }}">
                                        <i class="bi bi-play-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        @endif

        @if ($section->name == 'video-2')
            <section class="services section light-background">
                <div class="container" data-aos="fade-up" data-aos-delay="100">

                    <div class="row align-items-center mb-5">

                        <div class="col-lg-6">
                            <div class="video-gallery text-center">
                                <div class="thumbnail position-relative">
                                    <img src="{{ asset('images/meta_image/' . $video2->meta_image) }}" alt="Video Thumbnail"
                                        class="fixed-thumb img-fluid rounded">

                                    <button type="button" class="video-play-float btn" data-bs-toggle="modal"
                                        data-bs-target="#videoModal"
                                        data-video="{{ asset('images/meta_video/' . $video2->video) }}">
                                        <i class="bi bi-play-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="services-content" data-aos="fade-left" data-aos-duration="900">
                                <span class="subtitle">{{ $video2->short_title ?? '' }}</span>
                                <h2>{{ $video2->long_title ?? '' }}</h2>
                                <p data-aos="fade-right" data-aos-duration="800">
                                    {!! $video2->long_description ?? '' !!}
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
            </section>
        @endif

        @if ($section->name == 'about')
            <section id="services" class="services section">

                <div class="container" data-aos="fade-up" data-aos-delay="100">

                    <div class="row align-items-center mb-5">
                        <div class="col-lg-6">
                            <div class="services-content" data-aos="fade-left" data-aos-duration="900">
                                <span class="subtitle">{{ $hero->short_title ?? '' }}</span>
                                <h2>{{ $hero->long_title ?? '' }}</h2>
                                <p data-aos="fade-right" data-aos-duration="800">{!! $hero->long_description ?? '' !!}</p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="services-image" data-aos="fade-left" data-aos-delay="200">
                                <img src="{{ asset('images/meta_image/' . $hero->meta_image) }}" class="img-fluid"
                                    alt="{{ $hero->short_title ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h3 class="mb-3">Take a look at RDT Catering in ITV News</h3>
                            <ul class="check-list row" data-aos="fade-up" data-aos-delay="200">
                                @foreach (explode('|', $hero->short_description) as $item)
                                    <li class="col-md-6 col-sm-12 mb-2">
                                        <i class="bi bi-check-circle"></i> {{ trim($item) }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-lg-6">
                            <div class="video-gallery text-center">
                                <div class="thumbnail position-relative">
                                    <img src="{{ asset('video-thumbnail.png') }}" alt="Video Thumbnail"
                                        class="fixed-thumb img-fluid rounded">
                                    <button type="button" class="video-play-float btn" data-bs-toggle="modal"
                                        data-bs-target="#videoModal" data-video="{{ asset('promo.mp4') }}">
                                        <i class="bi bi-play-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content bg-transparent border-0">
                                    <div class="modal-body p-0">
                                        <video id="modalVideo" class="w-100" controls preload="none"></video>
                                    </div>
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                </div>

            </section>
        @endif

        @if ($section->name == 'services')
            <section id="main-services" class="main-services-section mt-5"
                style="background: url('{{ asset('service-bg.jpg') }}') no-repeat center center; background-size: cover;">
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center mb-2">
                        <span class="subtitle">TAKE LOOK AT</span>
                        <h2 class="section-title">Our Main Services</h2>
                    </div>

                    <div class="row g-4">
                        @foreach ($products as $product)
                            <div class="col-md-6 col-lg-3">
                                <div class="service-card text-center p-4 h-100">
                                    <div class="service-icon">
                                        <i class="bi {{ $product->icon }}"></i>
                                    </div>
                                    <h4>{{ $product->title }}</h4>
                                    <p>{{ $product->short_description }}</p>
                                    <a href="{{ route('service.show', $product->slug) }}" class="read-more-btn">Read
                                        More</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-4">
                        <p>Don't hesitate, contact us for better help and services.
                            <a href="{{ route('services') }}" class="view-more">View More Services</a>
                        </p>
                    </div>
                </div>
            </section>
        @endif

        @if ($section->name == 'menu')
            @include('frontend.partials.menu')
        @endif
    @endforeach
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.video-play-float').on('click', function() {

                let videoPath = $(this).data('video'); // dynamic for all

                $('#modalVideo').html(
                    '<source src="' + videoPath + '" type="video/mp4">'
                );

                $('#modalVideo')[0].load();
                $('#modalVideo')[0].play();
            });

            $('#videoModal').on('hidden.bs.modal', function() {
                let v = $('#modalVideo')[0];
                v.pause();
                v.currentTime = 0;
                $('#modalVideo').html('');
            });
        });
    </script>
@endsection