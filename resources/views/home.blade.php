@extends('layouts.app')

@section('menu')
    @include('menu')
@endsection


@section('content')
    <div class="container-fluid mt-4">
        <table class="table table-bordered" id="catalog_table">
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
                <?php
                /*
                @foreach ($catalogs as $catalog)
                    <tr>
                        <td>{{ $catalog->category }}</td>
                        <td>{{ $catalog->name }}</td>
                        <td>{{ $catalog->inventory_number }}</td>
                        <td>{{ $catalog->language }}</td>
                        <td>{{ $catalog->author }}</td>
                        <td class="text-end">{{ $catalog->year }}</td>
                        <td class="text-end">{{ $catalog->page_count }}</td>
                        <td>{{ $catalog->location }}</td>
                    </tr>
                @endforeach
                */
                ?>
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />


    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#catalog_table').DataTable({
                ajax: '/catalogData',
                columns: [{
                        data: 'category'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'inventory_number'
                    },
                    {
                        data: 'language'
                    },
                    {
                        data: 'author'
                    },
                    {
                        data: 'year'
                    },
                    {
                        data: 'page_count'
                    },
                    {
                        data: 'location'
                    }
                ],
                dom: '<"row"<"col"B><"col"f>><"tabula"rt><"row"<"col"i><"col"l><"col"p>>',
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-primary',
                        orientation: 'Landscape',
                        customize: function(doc) {
                            doc.content[1].table.widths =
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.pageMargins = [20, 20, 20, 20];
                        }
                    },
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/lv.json'
                },
                "lengthChange": true,
                lengthMenu: [20, 50, 100],
                "order": []
            });

        });
    </script>
@endsection
