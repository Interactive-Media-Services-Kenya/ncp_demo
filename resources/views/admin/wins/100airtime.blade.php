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
                <div class="card-header">ALL 100 AIRTIME WINNERS

                </div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table
                            class="align-middle mb-3 table table-bordered table-striped table-hover ajaxTable datatable datatable-entry"
                            id="entriesTable">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>

                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Phone
                                    </th>
                                    <th>
                                        Code
                                    </th>
                                    <th>
                                        Prize Type
                                    </th>
                                    <th>
                                        Amount
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                ajax: "{{ route('admin.airtime.all-wins-100') }}",
                columns: [
                    {
                        data: 'placeholder',
                        name: 'placeholder'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'prize_type',
                        name: 'prize_type'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },

                ],
                dom: 'lBfrtip',
                pageLength: 100,
                buttons: [
                    @can('user_management_access')
                    'copy',
                    {
                        extend: 'excelHtml5',
                        title: 'Complaints_list',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Entries_list',
                        exportOptions: {

                        }
                    },
                    'colvis'
                    @endcan

                ]
            });
        });
    </script>
@endsection
