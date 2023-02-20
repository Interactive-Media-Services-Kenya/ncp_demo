<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyComplaintRequest;
use App\Http\Requests\StoreComplaintRequest;
use App\Http\Requests\UpdateComplaintRequest;
use App\Models\Company;
use App\Models\Resolve;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('complaint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaints = Complaint::orderBy('created_at', 'DESC')->get();

        return view('admin.complaints.index', compact('complaints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('complaint_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::all();

        return view('admin.complaints.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComplaintRequest $request)
    {
        $complaint = Complaint::create($request->all());

        return redirect()->route('admin.complaints.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaint $complaint)
    {
        abort_if(Gate::denies('complaint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $companies = Company::all();
        return view('admin.complaints.edit', compact('complaint','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComplaintRequest $request, complaint $complaint)
    {
        $complaint->update($request->all());

        return redirect()->route('admin.complaints.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        abort_if(Gate::denies('complaint_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.complaints.show', compact('complaint'));
    }

    public function destroy(Complaint $complaint)
    {
        abort_if(Gate::denies('complaint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaint->delete();

        return back();
    }

    public function massDestroy(MassDestroyComplaintRequest $request)
    {
        Complaint::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function resolve($id){
        //Get Complain to be resolves and pass to blade
        $complaint = Complaint::findOrFail($id);

        return view('admin.complaints.resolve', compact('complaint'));
    }
    public function resolveComplaint(Request $request, $id){
        //Get Complain to be resolves and pass to blade
        $request->validate([
            'description' => 'required|string',
            'company_id' => 'required|numeric',
        ]);

        Resolve::create([
            'user_id' => Auth::id(),
            'description' => $request->description,
            'company_id'=> $request->company_id,
        ]);
        $complaint = Complaint::findOrFail($id);

        $complaint->update([
            'status' => 1,
        ]);

        return redirect()->route('admin.complaints.index')->with('message', 'Operation Successfull');
    }
}
