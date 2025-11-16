@extends('frontend.master')

@section('content')
    @include('frontend.partials.banner', [
        'title' => 'About Us',
        'image' => $page->banner_image ?? asset('banner.jpg'),
    ])

    <section class="services section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <div class="services-content" data-aos="fade-left" data-aos-duration="900">
                        <span class="subtitle">{{ $about1->short_title ?? '' }}</span>
                        <h2>{{ $about1->long_title ?? '' }}</h2>
                        <p data-aos="fade-right" data-aos-duration="800">{!! $about1->long_description ?? '' !!}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="services-image" data-aos="fade-left" data-aos-delay="200">
                        <img src="{{ asset('images/meta_image/' . $about1->meta_image) }}" class="img-fluid"
                             alt="{{ $about1->short_title ?? '' }}">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services section light-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <div class="services-image" data-aos="fade-right" data-aos-duration="900">
                        <img src="{{ asset('images/meta_image/' . $about2->meta_image) }}" class="img-fluid rounded"
                             alt="{{ $about2->short_title ?? '' }}">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="services-content" data-aos="fade-left" data-aos-delay="200">
                        <span class="subtitle">{{ $about2->short_title ?? '' }}</span>
                        <h2>{{ $about2->long_title ?? '' }}</h2>
                        <p data-aos="fade-right" data-aos-duration="800">{!! $about2->long_description ?? '' !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <div class="services-content" data-aos="fade-left" data-aos-duration="900">
                        <span class="subtitle">{{ $about3->short_title ?? '' }}</span>
                        <h2>{{ $about3->long_title ?? '' }}</h2>
                        <p data-aos="fade-right" data-aos-duration="800">{!! $about3->long_description ?? '' !!}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="services-image" data-aos="fade-left" data-aos-delay="200">
                        <img src="{{ asset('images/meta_image/' . $about3->meta_image) }}" class="img-fluid"
                             alt="{{ $about3->short_title ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="text-center my-4">
            <div class="contact-card p-4 rounded shadow-sm bg-light d-inline-block download-section mt-3">
                <p class="mb-3">
                    Don't hesitate, Book Now for better help and services.
                </p>
                <a href="{{ route('book-now') }}" class="download-btn">Book Now</a>
            </div>
        </div>
        </div>
    </section>
@endsection