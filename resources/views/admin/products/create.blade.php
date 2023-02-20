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
                <div class="card-header">Add Merchandise
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="required" for="industrys">Merchandise Category</label>
                            <select
                                class="form-control select2 {{ $errors->has('product_category_id') ? 'is-invalid' : '' }}"
                                name="product_category_id" id="product_category_id" required>
                                <option selected disabled>Click to Select</option>
                                @foreach ($productCategories as $pcategory)
                                    <option value="{{ $pcategory->id }}">{{ strtoupper($pcategory->name) }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('product_category_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_category_id') }}
                                </div>
                            @endif
                            <span class="help-block">Merchandise Category *</span>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                    checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Single Merchandise
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                                    value="2">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Batch Merchandise
                                </label>
                            </div>
                        </div>

                        <div class="form-group" id="batch">
                            <label for="quantity" class="required">Quantity</label>
                            <input id="quantity" type="number"
                                class="form-control @error('quantity') is-invalid @enderror input" name="quantity"
                                autocomplete="number" placeholder="200" min="1">

                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script>
        $("#batch").hide();
        $("#quantity").val("");
        $("input[name='flexRadioDefault']").click(function() {
            var status = $(this).val();
            if (status == 2) {
                $("#batch").show();
            } else {
                $("#batch").hide();
                $("#quantity").val("");
            }
        });
    </script>
@endsection
