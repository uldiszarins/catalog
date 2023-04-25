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
                        <li class="breadcrumb-item active" aria-current="page">Valodas</li>
                    </ol>
                </nav>
            </div>
            <div class="col text-end">

                <div class="btn-group">
                    <a class="btn btn-secondary" href="{{ route('language.create') }}">
                        Pievienot
                    </a>
                </div>

            </div>
        </div>
        <div class="mt-4">
            <table class="table table-bordered table-striped">
                @foreach ($languages as $language)
                    <tr>
                        <td><a
                                href="{{ route('language.show', ['language' => $language['id']]) }}">{{ $language['language'] }}</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
