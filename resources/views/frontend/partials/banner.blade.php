@props([
    'title' => 'RDT Catering',
    'image' => asset('banner.jpg')
])

<section class="hero section dark-background" style="background-image: url('{{ $image }}'); background-size: cover; background-position: center;">
    <div class="info d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 text-center text-white">
                    <h2>{{ $title }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>