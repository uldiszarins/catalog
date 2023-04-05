@extends('layouts.app')

@section('menu')
    @include('menu');
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Katalogs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kategorijas</li>
                </ol>
            </nav>
        </div>
        <table class="table table-bordered table-striped">
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category['category_name'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
