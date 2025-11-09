@php
  $menu = App\Models\Master::firstOrCreate(['name' => 'Menu']);
@endphp

<div class="page-title">
    <div class="heading">
        <div class="container" data-aos="fade-up" data-aos-delay="600">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <p>
                        {{ $menu->short_title ?? '' }}
                    </p>
                    <h1 class="heading-title">{{ $menu->long_title ?? '' }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="services" class="services section mb-5">

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
            <div class="col-lg-12">
                <div data-aos="fade-left" data-aos-duration="900">
                    <img src="{{ asset('images/meta_image/' . $menu->meta_image) }}"
                        alt="{{ $menu->name ?? 'Banner Image' }}" class="img-fluid w-100 rounded">
                </div>
            </div>
        </div>
    </div>

</section>