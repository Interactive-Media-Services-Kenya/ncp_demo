<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Draw;
use App\Models\DrawWinner;
use App\Models\Price;
use App\Models\Region;
use App\Models\Reject;
use App\Models\RejectWinner;
use App\Models\WeekDraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class DrawController extends Controller
{
    public function index()
    {
        $draws = Draw::select('*')->where('deleted_at', null)->orderBy('id', 'DESC')->get();

        return view('admin.draws.index', compact('draws'));
    }

    public function drawWinnersAll()
    {
        $rejectedWinnersIDs = RejectWinner::select('draw_winner_id')->cursor();

        $draw_winners = DB::table('draw_winners')->select('draw_winners.*')->whereNotIn('id', $rejectedWinnersIDs)->orderBy('draw_winners.id', 'DESC')->cursor();

        return view('admin.draws.draw-winners-all', compact('draw_winners'));
    }

    public function create()
    {
        $weeks = WeekDraw::orderBy('id', 'DESC')->get();
        $rejectedWinnersIDs = RejectWinner::select('draw_winner_id')->cursor();
        $prizes = Price::get();
        $draw_winners = DrawWinner::select('draw_winners.*')->where('created_at', '>', \Carbon\Carbon::today()->subDays(3))->whereNotIn('id', $rejectedWinnersIDs)->orderBy('draw_winners.id', 'DESC')->get();
       // dd($draw_winners);
        return view('admin.draws.create', compact('weeks', 'draw_winners','prizes'));
    }

    public function createRegion()
    {
        $regions = Region::get();
        $rejectedWinnersIDs = RejectWinner::select('draw_winner_id')->cursor();
        $prizes = Price::get();
        $draw_winners = DrawWinner::select('draw_winners.*')->where('created_at', '>', \Carbon\Carbon::today()->subDays(3))->whereNotIn('id', $rejectedWinnersIDs)->orderBy('draw_winners.id', 'DESC')->cursor();

        return view('admin.draws.create-region', compact('regions', 'draw_winners','prizes'));
    }




    // Get all the blacklisted participants
    public function blacklist()
    {
        $blacklists = DB::table('blacklist')->select('*')->get();
        return view('admin.draws.blacklist', compact('blacklists'));
    }

    public function createBlacklist()
    {
        return view('admin.draws.create-blacklist');
    }

    public function storeBlacklist(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|digits_between:10,12'
        ]);
        $name = \Str::substr($request->name, 0, 2);

        DB::table('blacklist')->insert([
            'phone' => '254' . substr($request->phone, -9, 9),
            'name' => $name,
        ]);
        return redirect()->route('admin.draw.blacklists')->with('message', 'Blacklist Added Successfully');
    }
    public function editBlacklist($id)
    {
        $blacklist = DB::table('blacklist')->select('*')->where('id', $id)->get();
        return view('admin.draws.edit-blacklist', compact('blacklist'));
    }

    public function updateBlacklist(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required|numeric|digits_between:10,12'
        ]);
        $blacklist = DB::table('blacklist')->select('*')->where('id', $id)->get();
        $name = \Str::substr($request->name, 0, 2);

        DB::table('blacklist')->where('id', $blacklist[0]->id)->update([
            'phone' => '254' . substr($request->phone, -9, 9),
            'name' => $name,
        ]);
        return redirect()->route('admin.draw.blacklists')->with('message', 'Blacklist Updated Successfully');
    }

    //Add a draw and run draw through Api
    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required|string|max:255',
            'start_date' => 'required|string|max:50',
            'end_date' => 'required|string|max:50',
            // 'to' => 'required|integer',
            // 'from' => 'required|integer',
            'no_winners' => 'required|numeric',
            'prize' => 'required|numeric',
            //'region'=> 'integer',
        ]);

        if ($request->end_date > \Carbon\Carbon::yesterday()) {
            return back()->with('error', 'Draw Period Selected is Invalid');
        }
        $period = \Carbon\CarbonPeriod::create($request->start_date, $request->end_date)->toArray();

        $weekExist = WeekDraw::where('name', 'DRAW From: ' . $request->start_date . ' To: ' . $request->end_date)->get();

        if (count($weekExist) > 0) {
            $week = WeekDraw::create([
                'name' => 'DRAW From: ' . $request->start_date . ' To: ' . $request->end_date . ' ' . mt_rand(1000000, 9999999),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date . ' 23:59:00',
            ]);
        } else {
            $week = WeekDraw::create([
                'name' => 'DRAW From: ' . $request->start_date . ' To: ' . $request->end_date . ' ' . mt_rand(1000000, 9999999),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date . ' 23:59:00',
            ]);
        }

        if($week) {
            if ($request->prize == 2000000) { //Check if Is Gra
                $draw = Draw::create([
                    'name' => 'GRAND '.$week->name,
                    'start_date' => $week->start_date,
                    'end_date' => $week->end_date,
                    // 'to' => $request->to,
                    // 'from' => $request->from,
                    'region_id' => $request->region,
                    'no_winners' => $request->no_winners,
                    'prize' => $request->prize,
                    'created_by' => Auth::id(),
                    'weekly_draw_id' => $week->id,
                ]);
                $from = $draw->start_date;
                $to = $draw->end_date;
                $from_date = $draw->start_date;
                $to_date = $draw->end_date;
                $list = $draw->no_winners;
                $prize = $draw->prize;


                $runDraw = $this->runGrandDrawApi($from, $to, $from_date, $to_date, $list, $draw, $prize);
            }else{
                $draw = Draw::create([
                    'name' => $week->name,
                    'start_date' => $week->start_date,
                    'end_date' => $week->end_date,
                    // 'to' => $request->to,
                    // 'from' => $request->from,
                    'region_id' => $request->region,
                    'no_winners' => $request->no_winners,
                    'prize' => $request->prize,
                    'created_by' => Auth::id(),
                    'weekly_draw_id' => $week->id,
                ]);
                //Define All the parameters required for the Api
                //Pass all the parameters to the function
                $from = $draw->start_date;
                $to = $draw->end_date;
                $from_date = $draw->start_date;
                $to_date = $draw->end_date;
                $list = $draw->no_winners;
                $prize = $draw->prize;
                $region = $draw->region_id;

            $runDraw = $this->runDrawApi($from, $to, $from_date, $to_date, $list, $draw, $prize,$region);
            }





        }
        if ($week->count() > 0) {
            return back()->with('message', 'Draw Run Successfully for: '.$week->name);
        }
        return back()->with('error', 'No Draw Was Run');

    }

    public function redraw($id)
    {
        // ? Fetch Draw with the required number of draw winners,
        $draw_winners = DrawWinner::where('draw_id', $id)->get();

        //Remove the Selected Winners from Draw winners and add them to rejected_winners table
        if ($draw_winners != null) {
            foreach ($draw_winners as $winner) {

                $rejected_winner = RejectWinner::create([
                    'draw_winner_id' => $winner->id,
                    'rejected_by' => Auth::id(),
                    'reject_id' => 1,
                ]);
                $winner->update([
                    'status' => 0,
                ]);
            }
        }


        $draw = Draw::findOrFail($id);

        $rerun_number = 1;


        // ? Define All the parameters required for the Api
        // ! Pass all the parameters to the function
        $from = $draw->start_date;
        $to = $draw->end_date;
        $from_date = $draw->start_date;
        $to_date = $draw->end_date;
        $list = $rerun_number;
        $prize = $draw->prize;
        $region = $draw->region;
        $runDraw = $this->rerunDrawApi($from, $to, $from_date, $to_date, $list, $draw, $prize,$region);
        if ($runDraw) {
            return redirect()->route('admin.draws.show', [$draw->id])->with('message', 'Draw Rerun was Successful');
        } else {
            return redirect()->route('admin.draws.index')->with('error', 'Draw Api not Running');
        }
    }

    public function show($id)
    {
        $draw = Draw::findOrFail($id);
        $rejectedWinnersIDs = RejectWinner::select('draw_winner_id')->cursor();
        $draw_winners = DrawWinner::where('draw_winners.draw_id', $id)->whereNotIn('id', $rejectedWinnersIDs)->get();

        return view('admin.draws.show', compact('draw', 'draw_winners'));
    }

    public function destroy($id)
    {
        $draw = Draw::findOrFail($id);


        if ($draw->delete()) {
            return back()->with('message', 'Operation Successful');
        } else {
            return back()->with('error', 'Draw Resource not found');
        }
    }

    public function runDrawApi($from, $to, $from_date, $to_date, $list, $draw, $prize,$region)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://54.166.14.30:8080/DOLA/getDOLA_API',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'from:' . $from,
                    'to:' . $to,
                    // 'from:' . 1,
                    // 'to:' . 90000,
                    'KEY:KXVT-8IOT6-UTUT-BFT34-FDJJG-74BG',
                    'date_from:' . $from_date . ' 00:00:00',
                    'date_to:' . $to_date . '23:59:00',
                    'list:'.$list,
                    'region:' . $region,
                    'type:' . 11,
                    'prize:'.$prize,
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $data = substr($response, 16);
            $int_array = array_map("intval", explode(",", $data));
            foreach ($int_array as $selected_winner) {
                // ? Get winners with the same id generated from the Api,
                $draw_winner = DB::table('validpool')->where('id', $selected_winner)->first();

                if ($draw_winner != null) {

                    $winnerDraw = DrawWinner::create([
                        'phone' => $draw_winner->phonenumber,
                        'draw_id' => $draw->id,
                        'code' => $draw_winner->validcode,
                        'status' => 1,
                    ]);
                }
                //break;
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('admin.draws.index')->with('error', 'Draw Run Was Successfully But No Draw winners found');
        }
    }
    public function runGrandDrawApi($from, $to, $from_date, $to_date, $list, $draw, $prize)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://54.166.14.30:8080/DOLA/getDOLA_API',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'from:' . $from,
                    'to:' . $to,
                    // 'from:' . 1,
                    // 'to:' . 90000,
                    'KEY:KXVT-8IOT6-UTUT-BFT34-FDJJG-74BG',
                    'date_from:' . $from_date . ' 00:00:00',
                    'date_to:' . $to_date . '23:59:00',
                    'list:'.$list,
                    'type:' . 11,
                    'prize:'.$prize,
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $data = substr($response, 16);
            $int_array = array_map("intval", explode(",", $data));
            foreach ($int_array as $selected_winner) {
                // ? Get winners with the same id generated from the Api,
                $draw_winner = DB::table('validpool')->where('id', $selected_winner)->first();

                if ($draw_winner != null) {

                    $winnerDraw = DrawWinner::create([
                        'phone' => $draw_winner->phonenumber,
                        'draw_id' => $draw->id,
                        'code' => $draw_winner->validcode,
                        'status' => 1,
                    ]);
                }
                //break;
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('admin.draws.index')->with('error', 'Draw Run Was Successfully But No Draw winners found');
        }
    }
    public function rerunDrawApi($from, $to, $from_date, $to_date, $list, $draw, $prize,$region)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://54.166.14.30:8080/DOLA/getDOLA_API',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'from:' . $from,
                    'to:' . $to,
                    'KEY:KXVT-8IOT6-UTUT-BFT34-FDJJG-74BG',
                    'date_from:' . $from_date . ' 00:00:00',
                    'date_to:' . $to_date . '23:59:00',
                    'list:'.$list,
                    'region:' . $region,
                    'type:' . 11,
                    'prize:'.$prize,
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $data = substr($response, 16); //GRAND WIN VALUE:
            $int_array = array_map("intval", explode(",", $data));
            foreach ($int_array as $selected_winner) {
                // ? Get winners with the same id generated from the Api,
                $draw_winner = DB::table('validpool')->where('id', $selected_winner)->first();

                if ($draw_winner != null) {
                    $winnerDraw = DrawWinner::create([
                        'phone' => $draw_winner->phonenumber,
                        'draw_id' => $draw->id,
                        'code' => $draw_winner->validcode,
                        'status' => 1,
                    ]);

                    if ($winnerDraw) {
                        return redirect()->route('admin.draws.index')->with('message', 'Draw Run Successfully & Draw Winner Found');
                    } else {
                        return back()->with('error', 'No Draw winner added from the validpool!');
                    }
                }
                //break;
                else {
                    return back()->with('error', 'No Draw winners match found from validpool!');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->route('admin.draws.index')->with('message', 'Draw Run Successfully But No Draw winners found');
        }
    }


    public function confirmDrawWinner($id)
    {
        $confirmed = DB::table('draw_winners')->where('id', $id)
            ->update([
                'status' => 1,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        if ($confirmed) {
            return back()->with('message', 'Operation Successful');
        } else {
            return back()->with('message', 'Confirmation not Successful');
        }
    }
    public function rejectDrawWinner($id)
    {
        $drawWinner = DrawWinner::findOrFail($id);
        $reasons = Reject::all();
        return view('admin.draws.rejectWinners.reject-winners', compact('drawWinner', 'reasons'));
    }
    public function rejectDrawWinnerPost(Request $request, $id)
    {
        $drawWinner = DrawWinner::findOrFail($id);

        $drawWinner->update([
            'status' => 0,
        ]);

        $reject = RejectWinner::create([
            'rejected_by' => Auth::id(),
            'draw_winner_id' => $drawWinner->id,
            'description' => $request->description,
            'reject_id' => $request->reject_id,
        ]);

        return redirect()->route('admin.draws.draw-winners-all')->with('message', 'Operation Successful');
    }


    //All Airtime Wins
    public function allAirtimeWins(Request $request){

        if ($request->ajax()) {
            $query = DB::table('daily_winners')->select('*')->orderBy('id','DESC');
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('action', 'action');
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ?'<a href="/admin/validpool/show/'.$row->phone_number.'" class="text-primary">'.$row->phone_number.'</a>': '';
            });
            $table->editColumn('prize_type', function ($row) {
                return $row->prize_type ?? '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ?? '';
            });
            $table->editColumn('id', function ($row) {
                return $row->id ?? '';
            });

            $table->editColumn('code', function ($row) {
                return $row->code ?? '';
            });
            $table->editColumn('date', function ($row) {
                return $row->date ?? '';
            });
            $table->editColumn('action', function ($row) {
                return '<a href="/admin/entry/show/'.$row->id.'" class="btn btn-sm btn-primary">Details</a>';
            });

            $table->rawColumns(['placeholder','id', 'date', 'prize_type', 'phone_number', 'amount', 'code','action']);

            return $table->make(true);
        }

        return view('admin.wins.allairtime');
    }

    public function airtimeWins25(Request $request){

        if ($request->ajax()) {
            $query = DB::table('daily_winners')->select('*')->whereamount(25)->orderBy('id','DESC');
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('action', 'action');
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ?'<a href="/admin/validpool/show/'.$row->phone_number.'" class="text-primary">'.$row->phone_number.'</a>': '';
            });
            $table->editColumn('prize_type', function ($row) {
                return $row->prize_type ?? '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ?? '';
            });
            $table->editColumn('id', function ($row) {
                return $row->id ?? '';
            });

            $table->editColumn('code', function ($row) {
                return $row->code ?? '';
            });
            $table->editColumn('date', function ($row) {
                return $row->date ?? '';
            });
            $table->editColumn('action', function ($row) {
                return '<a href="/admin/entry/show/'.$row->id.'" class="btn btn-sm btn-primary">Details</a>';
            });

            $table->rawColumns(['placeholder','id', 'date', 'prize_type', 'phone_number', 'amount', 'code','action']);

            return $table->make(true);
        }
        return view('admin.wins.25airtime');
    }

    public function airtimeWins50(Request $request){

        if ($request->ajax()) {
            $query = DB::table('daily_winners')->select('*')->whereamount(50)->orderBy('id','DESC');
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('action', 'action');
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ?'<a href="/admin/validpool/show/'.$row->phone_number.'" class="text-primary">'.$row->phone_number.'</a>': '';
            });
            $table->editColumn('prize_type', function ($row) {
                return $row->prize_type ?? '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ?? '';
            });
            $table->editColumn('id', function ($row) {
                return $row->id ?? '';
            });

            $table->editColumn('code', function ($row) {
                return $row->code ?? '';
            });
            $table->editColumn('date', function ($row) {
                return $row->date ?? '';
            });
            $table->editColumn('action', function ($row) {
                return '<a href="/admin/entry/show/'.$row->id.'" class="btn btn-sm btn-primary">Details</a>';
            });

            $table->rawColumns(['placeholder','id', 'date', 'prize_type', 'phone_number', 'amount', 'code','action']);

            return $table->make(true);
        }
        return view('admin.wins.50airtime');
    }

    public function airtimeWins100(Request $request){
        if ($request->ajax()) {
            $query = DB::table('daily_winners')->select('*')->whereamount(100)->orderBy('id','DESC');
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('action', 'action');
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ?'<a href="/admin/validpool/show/'.$row->phone_number.'" class="text-primary">'.$row->phone_number.'</a>': '';
            });
            $table->editColumn('prize_type', function ($row) {
                return $row->prize_type ?? '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ?? '';
            });
            $table->editColumn('id', function ($row) {
                return $row->id ?? '';
            });

            $table->editColumn('code', function ($row) {
                return $row->code ?? '';
            });
            $table->editColumn('date', function ($row) {
                return $row->date ?? '';
            });
            $table->editColumn('action', function ($row) {
                return '<a href="/admin/entry/show/'.$row->id.'" class="btn btn-sm btn-primary">Details</a>';
            });

            $table->rawColumns(['placeholder','id', 'date', 'prize_type', 'phone_number', 'amount', 'code','action']);

            return $table->make(true);
        }

        return view('admin.wins.100airtime');
    }
}
