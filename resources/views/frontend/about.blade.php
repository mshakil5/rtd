@extends('frontend.master')

@section('content')

    @include('frontend.partials.banner', [
        'title' => 'About Us',
        'image' => $page->banner_image ?? asset('banner.jpg')
    ])

    <section id="services" class="services section mb-5">

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                <div class="col-lg-12">
                    <div data-aos="fade-left" data-aos-duration="900">
                        {!! $companyDetails->about_us !!}
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection