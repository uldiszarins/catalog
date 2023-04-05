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
        @if (session('status'))
            <div class="row">
                <div class="col">
                    <div class="alert alert-success fade show" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        @endif

        @isset($errors)
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @isset($errors)
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br />
                        @endforeach
                    @endisset
                </div>
            @endif
        @endisset

        <form method="post" action="{{ route('catalog.store') }}">
            @method('POST')
            @csrf
            <div class="card mt-3">
                <div class="card-body">
                    <div class="mb-4 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Kategorija</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Nosaukums</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Inventāra numurs</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inventory_number"
                                value="{{ old('inventory_number') }}">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Valoda</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="language">
                                @foreach ($languages as $language)
                                    <option value="{{ $language['id'] }}">{{ $language['language'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Autors</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="author" value="{{ old('author') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Izdošanas gads</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="year" value="{{ old('year') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Lapaspušu skaits</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="page_count" value="{{ old('page_count') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Vāka foto</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="photo" value="1">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Atrašanās vieta</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="location" value="{{ old('location') }}">
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
