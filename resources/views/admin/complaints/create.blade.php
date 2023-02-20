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
                        <div class="card-header">Add Complaint
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route("admin.complaints.store") }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="required" for="title">Title</label>
                                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                                    @if($errors->has('title'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Complaint Title/Name Required *</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="description">Description</label>
                                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description"  required></textarea>
                                    @if($errors->has('description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('Description') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Complaint Description Required *</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="phone">Phone</label>
                                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required placeholder="2547XXXXXXXX">
                                    @if($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Phone Required *</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="title">Priority Level</label>
                                    <select name="level" id="" class="form-control">
                                        <option selected disabled>Click to Select</option>
                                        <option value="low">LOW</option>
                                        <option value="medium">MEDIUM</option>
                                        <option value="high">HIGH</option>
                                    </select>
                                    @if($errors->has('level'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('level') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Level Required *</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="industrys">Assign to</label>
                                    {{-- <div style="padding-bottom: 4px">
                                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">Select All</span>
                                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">Deselect All</span>
                                    </div> --}}
                                    <select class="form-control select2 {{ $errors->has('company_id') ? 'is-invalid' : '' }}" name="company_id" id="company_id" multiple required>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ strtoupper($company->name) }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('company_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('company_id') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Assigned Agency *</span>
                                </div>
                                {{-- <div class="form-group">
                                    <label class="required" for="title">Address</label>
                                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                                    @if($errors->has('title'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
                                    <span class="help-block">complaint Address Required *</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="title">City/Town</label>
                                    <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                                    @if($errors->has('city'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('city') }}
                                        </div>
                                    @endif
                                    <span class="help-block">City Required *</span>
                                </div> --}}
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
@endsection
