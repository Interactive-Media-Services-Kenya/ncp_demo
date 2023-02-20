<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LogActivityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = LogActivity::with(['user'])->select(['log_activities.*'])->orderBy('log_activities.id','DESC');
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('url', function ($row) {
                return $row->url ? $row->url : '';
            });
            $table->editColumn('method', function ($row) {
                return $row->method ? $row->method : '';
            });
            $table->editColumn('ip', function ($row) {
                return $row->ip ? $row->ip : '';
            });
            $table->editColumn('agent', function ($row) {
                return $row->agent ? $row->agent : '';
            });

            $table->editColumn('user', function ($row) {
                return $row->user ? $row->user->first_name.' '. $row->user->last_name : 'user Removed';
            });

            $table->rawColumns(['placeholder', 'id', 'url', 'ip', 'agent', 'method', 'user']);

            return $table->make(true);
        }

        return view('admin.logs.index');
    }
}
