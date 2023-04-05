@extends('layouts.app')

@section('menu')
    @include('menu');
@endsection

@section('content')
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Katalogs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pievienot jaunu</li>
            </ol>
        </nav>
    </div>
    <div class="container">

        <form method="post" action="{{ route('catalog.store') }}">
            @method('POST')
            @csrf
            <div class="card mt-3">
                <div class="card-body">

                    <div class="mb-4 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Kategorija</label>
                        <div class="col-sm-9">
                            <select class="form-select">
                                @foreach ($categories as $category)
                                    <option value="">{{ $category['category_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Nosaukums</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="staticEmail" value="">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Inventāra numurs</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="staticEmail" value="{{ $inventoryNumber }}">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Valoda</label>
                        <div class="col-sm-9">
                            <select class="form-select">
                                @foreach ($languages as $language)
                                    <option value="">{{ $language['language'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Autors</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="staticEmail" value="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Izdošanas gads</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="staticEmail" value="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Lapaspušu skaits</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="staticEmail" value="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Vāka foto</label>
                        <div class="col-sm-9">

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Atrašanās vieta</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="staticEmail" value="">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Pievienot</button>
                </div>
            </div>
        </form>
    </div>
@endsection
