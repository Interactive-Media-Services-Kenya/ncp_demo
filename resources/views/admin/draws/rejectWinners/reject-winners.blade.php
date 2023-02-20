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
                <div class="card-header">Add Reasons to Reject: {{$drawWinner->phone}}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.draws.draw-winner-reject-post',$drawWinner->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="required" for="reject_id">Select Region</label>

                            <select class="form-control {{ $errors->has('reject_id') ? 'is-invalid' : '' }}"
                                name="reject_id" id="reject_id" required>
                                <option value="" selected disabled>Click to Select</option>
                                @foreach ($reasons as $reason)
                                    <option value="{{ $reason->id }}" id="{{ $reason->id }}">{{ $reason->reason }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('reject_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('reject_id') }}
                                </div>
                            @endif
                            <span class="help-block">Reason is Required</span>
                        </div>
                        <div class="form-group">
                            <label for="description">Reject Description</label>

                            <textarea name="description" class="form-control"></textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
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

