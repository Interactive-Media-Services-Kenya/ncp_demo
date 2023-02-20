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
                        <div class="card-header">Edit Company : {{$company->name}}
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route("admin.companies.update", [$company->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="required" for="title">Title</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ $company->name }}" required>
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Company Title/Name Required *</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="description">Description</label>
                                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description"  required>{{ $company->description? $company->description: "" }}</textarea>
                                    @if($errors->has('Description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('Description') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Company Description Required *</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="email">Email</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ $company->email?$company->email: "" }}" required>
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Company Phone Required *</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="title">Phone</label>
                                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ $company->phone ? $company->phone: "" }}" required>
                                    @if($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Company Phone Required *</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="industrys">Select Industry</label>
                                    {{-- <div style="padding-bottom: 4px">
                                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">Select All</span>
                                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">Deselect All</span>
                                    </div> --}}
                                    <select class="form-control select2 {{ $errors->has('industry_id') ? 'is-invalid' : '' }}" name="industry_id" id="industry_id" required>
                                        @foreach($industries as $id => $industry)
                                            <option value="{{ $id }}" {{ in_array($id, old('industry_id', [])) ? 'selected' : '' }}>{{ $industry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('industry_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('industry_id') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Company Category is Required</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="title">Address</label>
                                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ $company->address ? $company->address : "" }}" required>
                                    @if($errors->has('title'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Company Address Required *</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="title">City/Town</label>
                                    <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ $company->city ? $company->city : "" }}" required>
                                    @if($errors->has('city'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('city') }}
                                        </div>
                                    @endif
                                    <span class="help-block">City Required *</span>
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
