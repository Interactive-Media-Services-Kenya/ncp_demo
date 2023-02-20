<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\Facades\DataTables;

class EntryController extends Controller
{
    // TODO: Change Connection for production db mysql3 or primary connection
    // ! For all the processes.



    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('messages_incoming')->select('*')->orderBy('id','DESC');
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('action', 'action');
            $table->editColumn('primary_status', function ($row) {
                return $row->primary_status ? $row->primary_status: '';
            });
            $table->editColumn('network', function ($row) {
                return $row->network == 2
                ? 'SAFARICOM_MO'
                : ($row->network == 3
                    ? 'AIRTEL_MO'
                    : ($row->network == 4
                        ? 'TELKOM_MO'
                        : ($row->network == 5
                            ? 'AIRTEL_BULK'
                            : ($row->network == 6
                                ? 'TELKOM_BULK'
                                : ($row->network == 9
                                    ? 'SAFARICOM_BULK'
                                    : '')))));
            });
            $table->editColumn('originator', function ($row) {
                return $row->originator ? $row->originator : '';
            });
            $table->editColumn('timereceived', function ($row) {
                return $row->timereceived ? $row->timereceived : '';
            });

            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });
            $table->editColumn('action', function ($row) {
                return '<a href="/admin/entry/show/'.$row->id.'" class="btn btn-sm btn-primary">Details</a>';
            });

            $table->rawColumns(['placeholder', 'network', 'message', 'originator', 'primary_status', 'timereceived','action']);

            return $table->make(true);
        }
        return view('admin.entries.index');
    }

    public function valid(Request $request)
    {

        if ($request->ajax()) {
            $query = DB::table('messages_incoming')->select('*')->where('primary_status', 'VALID_MESSAGE')->orderBy('id','DESC');
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('action', 'action');
            $table->editColumn('primary_status', function ($row) {
                return $row->primary_status ? $row->primary_status : '';
            });
            $table->editColumn('network', function ($row) {
                return $row->network == 2
                ? 'SAFARICOM_MO'
                : ($row->network == 3
                    ? 'AIRTEL_MO'
                    : ($row->network == 4
                        ? 'TELKOM_MO'
                        : ($row->network == 5
                            ? 'AIRTEL_BULK'
                            : ($row->network == 6
                                ? 'TELKOM_BULK'
                                : ($row->network == 9
                                    ? 'SAFARICOM_BULK'
                                    : '')))));
            });
            $table->editColumn('originator', function ($row) {
                return $row->originator ? $row->originator : '';
            });
            $table->editColumn('timereceived', function ($row) {
                return $row->timereceived ? $row->timereceived : '';
            });

            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });
            $table->editColumn('action', function ($row) {
                return '<a href="/admin/entry/show/'.$row->id.'" class="btn btn-sm btn-primary">Details</a>';
            });

            $table->rawColumns(['placeholder','action', 'network', 'message', 'originator', 'primary_status', 'timereceived']);

            return $table->make(true);
        }
        return view('admin.entries.valid');
    }

    public function show($id){

        $entry = \DB::table('messages_incoming')->where('id',$id)->first();
        return view('admin.entries.show',compact('entry'));
    }

    public function invalid(Request $request){

        if ($request->ajax()) {
            $query = DB::table('messages_incoming')->select('*')->where('primary_status','!=' ,'VALID_MESSAGE')->orderBy('id','DESC');
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('action', 'action');
            $table->editColumn('primary_status', function ($row) {
                return $row->primary_status ? $row->primary_status : '';
            });
            $table->editColumn('network', function ($row) {
                return $row->network == 2
                ? 'SAFARICOM_MO'
                : ($row->network == 3
                    ? 'AIRTEL_MO'
                    : ($row->network == 4
                        ? 'TELKOM_MO'
                        : ($row->network == 5
                            ? 'AIRTEL_BULK'
                            : ($row->network == 6
                                ? 'TELKOM_BULK'
                                : ($row->network == 9
                                    ? 'SAFARICOM_BULK'
                                    : '')))));
            });
            $table->editColumn('originator', function ($row) {
                return $row->originator ? $row->originator : '';
            });
            $table->editColumn('timereceived', function ($row) {
                return $row->timereceived ? $row->timereceived : '';
            });

            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });
            $table->editColumn('action', function ($row) {
                return '<a href="/admin/entry/show/'.$row->id.'" class="btn btn-sm btn-primary">Details</a>';
            });
            $table->rawColumns(['placeholder', 'network', 'message', 'originator', 'primary_status', 'timereceived','action']);

            return $table->make(true);
        }
        return view('admin.entries.invalid');
    }

    public function validPool(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('validpool')->select('*')->orderBy('id','DESC');
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('validcode', function ($row) {
                return $row->validcode ? $row->validcode : '';
            });

            $table->editColumn('phonenumber', function ($row) {
                return $row->phonenumber ? '<a href="/admin/validpool/show/'.$row->phonenumber.'" class="btn btn-sm btn-primary">'.$row->phonenumber.'</a>' : '';
            });
            $table->editColumn('date_created', function ($row) {
                return $row->date_created ? $row->date_created : '';
            });

            $table->editColumn('won', function ($row) {
                return $row->won == 0 ? 'Not Won' : 'Win';
            });


            $table->editColumn('action', function ($row) {
                return '<a href="/admin/entry/show/'.$row->id.'" class="btn btn-sm btn-primary">Details</a>';
            });
            $table->rawColumns(['placeholder', 'validcode', 'phonenumber', 'date_created', 'action']);

            return $table->make(true);
        }

        return view('admin.entries.validpool');
    }

    public function checkPhoneEntries($id){
        $phoneMessages = DB::table('messages_incoming')->whereoriginator($id)->cursor();

       return view('admin.entries.user_messages', compact('phoneMessages'));
    }

    public function participants(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('participants')->select('*')->orderBy('id', 'DESC');
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('active', function ($row) {
               return $row->active == 1 ? 'ACTIVE' : 'INACTIVE';
            });
            $table->editColumn('date_registered', function ($row) {
                return $row->date_registered ? $row->date_registered : '';
            });

            $table->rawColumns(['placeholder', 'id', 'phone_number', 'active', 'date_registered']);

            return $table->make(true);
        }
        return view('admin.entries.participants');
    }

}
