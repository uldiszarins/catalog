@extends('layouts.app')

@section('menu')
    @include('menu');
@endsection


@section('content')
    <div class="container-fluid mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kategorija</th>
                    <th>Nosaukums</th>
                    <th>Numurs</th>
                    <th>Valoda</th>
                    <th>Autors</th>
                    <th>Gads</th>
                    <th>Lapaspušu skaits</th>
                    <th>Atrašanās vieta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($catalogs as $catalog)
                    <tr>
                        <td>{{ $catalog->category }}</td>
                        <td>{{ $catalog->name }}</td>
                        <td>{{ $catalog->inventory_number }}</td>
                        <td>{{ $catalog->language }}</td>
                        <td>{{ $catalog->author }}</td>
                        <td>{{ $catalog->year }}</td>
                        <td>{{ $catalog->page_count }}</td>
                        <td>{{ $catalog->location }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
