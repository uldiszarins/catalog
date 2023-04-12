@extends('layouts.app')

@section('menu')
    @include('menu')
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

        <form method="POST" action="{{ route('catalog.store') }}" id="catalog_create">
            @csrf
            <div class="card mt-3">
                <div class="card-header">
                    <h5>Pievienot jaunu ierakstu</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Kategorija</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="category" id="category" onchange="getInventoryNumber()">
                                @foreach ($categories as $key => $category)
                                    <option value="{{ $category }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Nosaukums</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" required
                                value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Inventāra numurs</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" required name="inventory_number"
                                id="inventory_number"
                                value="@if ($max_inventory_number) {{ $max_inventory_number }} @else {{ old('inventory_number') }} @endif">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Valoda</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="language" id="language">
                                @foreach ($languages as $language)
                                    <option value="{{ $language['id'] }}">{{ $language['language'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Autors</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="author" id="author"
                                value="{{ old('author') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Izdošanas gads</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="year" id="year"
                                value="{{ old('year') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Lapaspušu skaits</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="page_count" id="page_count"
                                value="{{ old('page_count') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Vāka foto</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="photo" id="photo" value="1">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Atrašanās vieta</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="location" id="location"
                                value="{{ old('location') }}">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Pievienot</button>
                    <a href="/" class="btn btn-secondary">Atcelt</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
    @if (env('APP_ENV') != 'testing')
        <script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
        {!! JsValidator::formRequest('App\Http\Requests\CatalogRequest', '#catalog_create') !!}
    @endif
    <script>
        function getInventoryNumber() {
            fetch('/get_inventory_number/' + document.querySelector('#category option:checked').value)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('inventory_number').value = data;
                })
                .catch(error => alert(error));
        }
    </script>
@stop
