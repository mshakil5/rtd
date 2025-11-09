@extends('frontend.master')

@section('content')
    @include('frontend.partials.banner', [
        'title' => 'Menu',
        'image' => $page->banner_image ?? asset('banner.jpg'),
    ])

    @include('frontend.partials.menu')
@endsection