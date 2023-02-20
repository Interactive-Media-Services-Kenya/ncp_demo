@extends('layouts.backend')

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
                {{-- <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom"
                            class="btn-shadow mr-3 btn btn-dark">
                            <i class="fa fa-star"></i>
                        </button> --}}
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.products.create') }}">
                        <button type="button" class="btn-shadow btn btn-info">
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fa fa-plus fa-w-20"></i>
                            </span>
                            Add Merchandise
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Merchandise
                    {{-- <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                </div>
                            </div> --}}
                </div>
                <div class="col-md-11 mx-auto">
                    <div class="table-responsive mt-3">
                        <table class="align-middle mb-3 table table-bordered table-striped table-hover ajaxTable datatable" id="productsTable">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        Date Added
                                    </th>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Serial Number
                                    </th>

                                    <th>
                                        Category
                                    </th>
                                    <th>
                                        Company
                                    </th>
                                    <th>
                                        Batch ID
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Actions
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#productsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.products.index') }}",
                columns: [{
                        data: 'placeholder',
                        name: 'placeholder'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'serial',
                        name: 'serial'
                    },
                    {
                        data: 'category',
                        name: 'category.name'
                    },
                    {
                        data: 'company',
                        name: 'company.name'
                    },
                    {
                        data: 'batch',
                        name: 'batch.batch_code'
                    },
                    {
                        data: 'issued_status',
                        name: 'issued_status'
                    },
                    {
                        data: 'actions',
                        name: 'actions'
                    },
                ],
                pageLength: 10,
                dom: 'lBfrtip',
                buttons: [
                    'copy',
                    {
                        extend: 'excelHtml5',
                        title: 'users_list',
                        exportOptions: {
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, ':visible']
                            }
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'users_list',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    'colvis'
                ],
            });
        });
    </script>
@endsection
