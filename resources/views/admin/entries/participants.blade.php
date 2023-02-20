@extends('layouts.backend')
@section('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        th.dt-left,
        td.dt-left {
            text-align: left;
        }

    </style>
@endsection

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ env('APP_NAME') }}
                    <div class="page-title-subheading"> This is the Backend UI for {{ env('APP_NAME') }}
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">All Participants

                </div>
                <div class="col-md-12">
                    <div class="table-responsive mt-3">
                        <table
                            class="align-middle mb-3 table table-bordered table-striped table-hover datatable"
                            id="entriesTable">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Phone
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endsection
        @section('scripts')
            <script>
                $(document).ready(function() {
                    $('#entriesTable').DataTable({
                        processing: true,
                method:'GET',
                serverSide: true,
                ajax: "{{ route('admin.entries.participants') }}",
                columns: [
                    {
                        data: 'placeholder',
                        name: 'placeholder'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },


                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'active',
                        name: 'active'
                    },
                    {
                        data: 'date_registered',
                        name: 'date_registered'
                    },
                ],
                        dom: 'lBfrtip',
                        pageLength: 100,
                        buttons: [
                            'copy',
                            {
                                extend: 'excelHtml5',
                                title: 'Participants_list',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                title: 'Participants_list',
                                exportOptions: {

                                }
                            },
                            'colvis'
                        ]
                    });
                });
            </script>
        @endsection
