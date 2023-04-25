@extends('layouts.app')

@section('menu')
    @include('menu')
@endsection

@section('content_header')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row row-cols-2">
            <div class="col">
                <div class="mt-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Katalogs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">kategorijas</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col text-end">
            </div>
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

            <form method="POST" action="{{ route('category.update', ['category' => $category->id]) }}"
                id="language_update">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Labot</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Nosaukums</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="category_name" id="category_name" required
                                    value="{{ $category->category_name }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Labot</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
    @if (env('APP_ENV') != 'testing')
        <script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
        {!! JsValidator::formRequest('App\Http\Requests\CategoryRequest', '#language_update') !!}
    @endif
@stop
