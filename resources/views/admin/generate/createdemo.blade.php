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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Add Permission
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.generate.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="required" for="title">Start Date</label>
                                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                    type="datetime-local" name="startdate" id="startdate" value="{{ old('startdate', '') }}"
                                    required>
                                @if ($errors->has('startdate'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('startdate') }}
                                    </div>
                                @endif
                                <span class="help-block">Start Date Required *</span>
                            </div>
                            <div class="col-md-6">
                                <label class="required" for="title">End Date</label>
                                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                    type="datetime-local" name="enddate" id="enddate" value="{{ old('enddate', '') }}"
                                    required>
                                @if ($errors->has('enddate'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('enddate') }}
                                    </div>
                                @endif
                                <span class="help-block">End Date Required *</span>
                            </div>

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
