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
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header"><b>Resolve Complaint : {{ $complaint->title }}</b>
                    {{-- <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                </div>
                            </div> --}}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-info" href="{{ route('admin.complaints.index') }}">
                                Back To complaint List
                            </a>
                        </div>

                        <form method="POST" action="{{ route('admin.complaints.resolveComplaint', [$complaint->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="required" for="description">Description</label>
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description"
                                    id="description" required></textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span class="help-block">Complaint Description Required *</span>
                                <input type="hidden" name="company_id" value="{{$complaint->company_id}}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
