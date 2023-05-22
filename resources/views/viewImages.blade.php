@extends('layouts.app')

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Katalogs</a></li>
                        <li class="breadcrumb-item" aria-current="page">Bildes</li>
                        <li class="breadcrumb-item active">{{ $selectedCategoryName }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col text-end">

            </div>
        </div>
        <div>
            <ul class="nav nav-pills">
                @foreach ($categories as $key => $category)
                    <li class="nav-item">
                        <a class="nav-link @if ($category == $selectedCategory) {{ 'active' }} @endif" aria-current="page"
                            href="/images/{{ $category }}">{{ $key }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="mt-4">
            <div class="container">
                <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 imageGallery1">
                    @foreach ($imagesData as $image)
                        <div class="col">
                            <div class="p-3 border bg-light">
                                <a href="{{ asset('storage/' . $image->id . '_big.jpg') }}" class="abc"
                                    title="{{ $image->name }}">
                                    <img src="{{ asset('storage/' . $image->id . '_big.jpg') }}"
                                        class="img-fluid rounded catalog-images" alt="asdf">
                                </a>
                                <a
                                    href="{{ route('catalog.show', [
                                        'catalog' => $image->id,
                                    ]) }}">Links</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <br />
    <br />
@endsection

@section('css')
    <link rel="stylesheet" href="/css/simpleLightbox.min.css">
@endsection

@section('js')
    <script src="/js/simpleLightbox.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.imageGallery1 a.abc').simpleLightbox();
        });
    </script>
@endsection
