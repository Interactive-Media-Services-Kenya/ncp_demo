<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class GenerateDemoController extends Controller
{
    public function index()
    {
        return view('admin.generate.createdemo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'startdate' => 'required',
            'enddate' => 'required',
        ]);

        try {
            $startdate = $request->startdate;
            $enddate = $request->enddate;

            $this->generateDemoData($startdate, $enddate);

            return back()->with('success', 'DataGenerated Successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Operation Failed: => ' . $th->getMessage());

        }
    }

    public function generateDemoData($startdate, $enddate)
    {
        $data = DB::table('messages_incoming')->select('id', 'timereceived')->cursor();

        foreach ($data as $value) {
            $date = $this->randomDate($startdate, $enddate);
            DB::table('messages_incoming')->update([
                'timereceived' => $date
            ])->where('id', $value->id);
        }
        $dataValidPool = DB::table('validpool')->select('id', 'date_created')->cursor();
        foreach ($dataValidPool as $value) {
            $date = $this->randomDate($startdate, $enddate);
            DB::table('validpool')->update([
                'date_created' => $date
            ])->where('id', $value->id);
        }
    }

    public function randomDate($startdate, $enddate)
    {
        // Convert to timetamps
        $min = strtotime($startdate);
        $max = strtotime($enddate);

        // Generate random number using above bounds
        $val = rand($min, $max);

        // Convert back to desired date format
        return date('Y-m-d H:i:s', $val);
    }
}
