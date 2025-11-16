@php
  $menu = App\Models\Master::firstOrCreate(['name' => 'Menu']);
@endphp

<section class="reservation-section">
    <div class="container">
        <div class="section-title text-center">
            <h2>Our Menu</h2>
            <h4>Food at first sight</h4>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <img src="{{ asset('images/meta_image/' . $menu->meta_image) }}"
                      alt="{{ $menu->name ?? 'Banner Image' }}"
                      class="img-fluid w-100 rounded mt-3">
            </div>
        </div>
    </div>
</section>