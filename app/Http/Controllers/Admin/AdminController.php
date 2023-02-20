<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Draw;
use App\Models\DrawWinner;
use Illuminate\Http\Request;
use DB;
use JavaScript;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->password_changed_at == null) {
            return view('auth.first_login.reset');
        } else {
            $draws =   Draw::count();
            $regions = DB::table('regions')
                ->orderBy('title')
                //->get()
                // ->join('participants','participants.region_id', 'regions.id')
                ->cursor();
            $incoming_messages = DB::table('messages_incoming')->count();
            $messagesAll = DB::table('messages_incoming')->cursor();

            // dd($incoming_messages);
            $unique_participants = DB::table('participants')->distinct()->cursor();
            $users = DB::table('users')->cursor();

            // $drawWinners = DB::table('draw_winners')->cursor();

            $dailyWinners = DB::table('draw_winners')->count() + DB::table('daily_winners')->count();
            $todayWinners = DB::table('draw_winners')->whereDate('created_at', Carbon::today())->count() + DB::table('daily_winners')->whereDate('date', Carbon::today())->count();

            //Airtime won Calculation
            $airtimeValue50 = 'WIN_50_AIRTIME';
            $airtimeValue100 = 'WIN_100_AIRTIME';
            $airtimeCount50 = DB::table('messages_incoming')->where('secondary_status', 'LIKE', '%' . $airtimeValue50 . '%')->count() * 50;
            $airtimeCount100 = DB::table('messages_incoming')->where('secondary_status', 'LIKE', '%' . $airtimeValue100 . '%')->count() * 100;

            $airtime = $airtimeCount50 + $airtimeCount100;

            $airtimeToday50 = DB::table('messages_incoming')->where('secondary_status', 'LIKE', '%' . $airtimeValue50 . '%')->whereDate('timereceived', Carbon::today())->count() * 50;
            $airtimeToday100 = DB::table('messages_incoming')->where('secondary_status', 'LIKE', '%' . $airtimeValue100 . '%')->whereDate('timereceived', Carbon::today())->count() * 100;
            $airtimeToday = $airtimeToday50 + $airtimeToday100;

            $airtimeWeek50 = DB::table('messages_incoming')->where('secondary_status', 'LIKE', '%' . $airtimeValue50 . '%')->whereBetween('timereceived', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count() * 50;
            $airtimeWeek100 = DB::table('messages_incoming')->where('secondary_status', 'LIKE', '%' . $airtimeValue100 . '%')->whereBetween('timereceived', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count() * 100;

            $airtimeWeek = $airtimeWeek50 + $airtimeWeek100;

            $perticipants_per_region = DB::table('regions')->select('regions.title', DB::raw("COUNT(*) as count_row"))
                ->orderBy("title")
                ->groupBy("region_id")
                ->join('participants', 'participants.region_id', 'regions.id')->cursor();

            $latestDrawWinners = DrawWinner::orderBy('id', 'DESC')->take(10)->cursor();
            $entries = DB::table('messages_incoming')->select('*')->count();
            $entriesValid = DB::table('messages_incoming')->select('*')->where('primary_status', 'VALID_MESSAGE')->count();
            $validpool = DB::table('validpool')->select('*')->count();

            return view('admin.dashboard', compact(
                'regions',
                'draws',
                'incoming_messages',
                'unique_participants',
                'perticipants_per_region',
                'users',
                'latestDrawWinners',
                // 'drawWinners',
                'entries',
                'entriesValid',
                'validpool',
                'dailyWinners',
                'airtime',
                'airtimeToday',
                'airtimeWeek',
                'todayWinners'
            ));
        }
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed'
            ],
        ]);

        $user = User::findOrFail(Auth::id());
        $password = Hash::make($request->password);
        $user->password = $password;
        $user->password_changed_at = \Carbon\Carbon::now();
        $user->save();

        if ($user) {
            return redirect()->route('admin.dashboard')->with('message', 'Password Change Was Successful');
        } else {

            return redirect()->route('admin.dashboard')->with('error', 'Operation Failed');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $messages = DB::table('messages_incoming')->where('originator', 'LIKE', '%' . $request->search . "%")->orderBy('id','DESC')->paginate(1000);
            if ($messages) {
                foreach ($messages as $message) {
                    $output .= '<tr>' .
                        '<td>' . $message->id . '</td>' .
                        '<td>' . $message->originator . '</td>' .
                        '<td>' . $message->message . '</td>' .
                        '<td>' . $message->replyMessage . '</td>' .
                        '<td>' . $message->timereceived . '</td>' .
                        '</tr>';
                }
                return response()->json($output);
            } else {
                $output .= '<tr>' .
                    '<td>No User Found</td>' .
                    '</tr>';
                return response()->json($output);
            }
        }
    }
}
