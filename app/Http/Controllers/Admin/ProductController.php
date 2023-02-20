<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = Product::with(['category', 'batch', 'company'])->where('products.company_id', Auth::user()->company_id);
            $table = Datatables::of($query);
            $table->addColumn('placeholder', ' ');
            $table->addColumn('actions', 'actions');
            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('serial', function ($row) {
                return $row->serial ? $row->serial : '';
            });
            $table->editColumn('batch', function ($row) {
                return $row->batch_id ? $row->batch->batch_code : 'N/A';
            });
            $table->editColumn('company', function ($row) {
                return $row->company_id ? $row->company->name : '';
            });
            $table->editColumn('category', function ($row) {
                return $row->product_category_id ? $row->category->name : '';
            });

            $table->editColumn('issued_status', function ($row) {
                return $row->issued_status == 0 ? 'Not Issued' : 'Issued';
            });

            $table->editColumn('actions', function ($row) {
                return $row->issued_status == 0 ? '<a href="products/issue/' . $row->id . '" class="btn btn-warning">Issue</a>' : '<a href="#" class="btn btn-success">Issued Out</a>';
            });

            $table->rawColumns(['actions', 'issued_status', 'category', 'company', 'batch', 'serial']);

            return $table->make(true);
        }
        //$products = Product::where('company_id',Auth::user()->company_id)->cursor();

        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $productCategories = ProductCategory::all();

        return view('admin.products.create', compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productname = substr(\DB::table('product_categories')->where('id', $request->product_category_id)->value('name'), 0, 1);
        $productname = strtoupper($productname);
        if ($request->quantity != null) {
            $quantity = $request->quantity;

            //Generate BatchCode
            $batchcode = $this->generateBatchCode() . $productname;

            //Save Batch Code
            $batch = Batch::create([
                'batch_code' => $batchcode,
                'company_id' => Auth::user()->company_id,
            ]);
            $merchandises = [];
            //loop through creating products with the same batch code using quantity
            for ($i = 0; $i < $quantity; $i++) {
                //generate productCode
                $product_code = $productname . $this->generateProductCode();

                $data = Product::create([
                    'serial' => $product_code,
                    'product_category_id' => $request->product_category_id,
                    'company_id' => Auth::user()->company_id,
                    'batch_id' => $batch->id,
                    'issued_status' => 0,
                ]);
                if (!$data) {
                    return back();
                }
                array_push($merchandises, $data);
            }
            if (count($merchandises) == $quantity) {
                return redirect()->route('admin.products.index')->with('message', 'Merchandises Added Successfull to Batch: ' . $batchcode);
            } else {
                return back()->with('message', 'Merchandise Not Added');
            }
        } else {
            # Save Single  Product with no Batch
            $product_code = $productname . $this->generateProductCode();
            $data = Product::create([
                'serial' => $product_code,
                'product_category_id' => $request->product_category_id,
                'company_id' => Auth::user()->company_id,
                'issued_status' => 0,
            ]);
            if ($data) {
                return redirect()->route('admin.products.index')->with('message', 'Merchandise Added Successfull - Serial : ' . $product_code);
            } else {
                return back()->with('error', 'Merchandise Not Added');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function issueProduct($id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'issued_status' => 1,
        ]);

        if ($product) {
            return back()->with('message', 'Product Issued Out Successfully');
        } else {
            return back()->with('error', 'Something went wrong! Please try again!');
        }
    }

    public function generateProductCode()
    {
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $permitted_chars = substr(str_shuffle($permitted_chars), 0, 4);
        $code = mt_rand(1000, 9999) . $permitted_chars;

        return $code;
    }

    public function generateBatchCode()
    {
        $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $batchcode = 'BAT-' . mt_rand(1000, 9999) . substr(str_shuffle($permitted_chars), 0, 4);

        return $batchcode;
    }

    public function issuedOut(Request $request)
    {
        if ($request->ajax()) {
            $query = Product::with(['category', 'batch', 'company'])->where('products.company_id', Auth::user()->company_id)->where('products.issued_status', 1);
            $table = Datatables::of($query);
            $table->addColumn('placeholder', ' ');
            $table->addColumn('actions', 'actions');
            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('serial', function ($row) {
                return $row->serial ? $row->serial : '';
            });
            $table->editColumn('batch', function ($row) {
                return $row->batch_id ? $row->batch->batch_code : 'N/A';
            });
            $table->editColumn('company', function ($row) {
                return $row->company_id ? $row->company->name : '';
            });
            $table->editColumn('category', function ($row) {
                return $row->product_category_id ? $row->category->name : '';
            });

            $table->editColumn('issued_status', function ($row) {
                return $row->issued_status == 0 ? 'Not Issued' : 'Issued';
            });

            $table->editColumn('actions', function ($row) {
                return $row->issued_status == 0 ? '<a href="products/issue/' . $row->id . '" class="btn btn-warning">Issue</a>&nbsp; <a href="products/issue/' . $row->id . '" class="btn btn-primary">view</a>' : '<a href="#" class="btn btn-success">Issued Out</a>';
            });
            $table->editColumn('updated_at', function ($row) {
                return $row->updated_at ? $row->updated_at : '';
            });

            $table->rawColumns(['actions', 'issued_status', 'category', 'company', 'batch', 'serial']);

            return $table->make(true);
        }

        return view('admin.products.issued-out');
    }

    public function remaining(Request $request)
    {
        //$productsIssued = Product::where('issued_status', 1)->get();
        if ($request->ajax()) {
            $query = Product::with(['category', 'batch', 'company'])->where('products.company_id', Auth::user()->company_id)->where('products.issued_status', 0);
            $table = Datatables::of($query);
            $table->addColumn('placeholder', ' ');
            $table->addColumn('actions', 'actions');
            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('serial', function ($row) {
                return $row->serial ? $row->serial : '';
            });
            $table->editColumn('batch', function ($row) {
                return $row->batch_id ? $row->batch->batch_code : 'N/A';
            });
            $table->editColumn('company', function ($row) {
                return $row->company_id ? $row->company->name : '';
            });
            $table->editColumn('category', function ($row) {
                return $row->product_category_id ? $row->category->name : '';
            });

            $table->editColumn('issued_status', function ($row) {
                return $row->issued_status == 0 ? 'Not Issued' : 'Issued';
            });

            $table->editColumn('actions', function ($row) {
                return $row->issued_status == 0 ? '<a href="issue/' . $row->id . '" class="btn btn-warning">Issue</a>&nbsp; <a href="' . $row->id . '" class="btn btn-primary">view</a>' : '<a href="#" class="btn btn-success">Issued Out</a>';
            });

            $table->rawColumns(['actions', 'issued_status', 'category', 'company', 'batch', 'serial']);

            return $table->make(true);
        }
        return view('admin.products.remaining');
    }
}
