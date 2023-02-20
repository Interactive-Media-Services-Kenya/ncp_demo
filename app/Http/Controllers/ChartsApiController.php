<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ChartsApiResource;
use DB;

class ChartsApiController extends Controller
{
    public function networksIncomming()
    {
        $data = [];
        $networksNotToList = [5,6,9];
        $networks = DB::table('network')->select('*')->whereNotIn('network_id',$networksNotToList)->get();
        foreach ($networks as $network) {
            $messages = DB::table('messages_incoming')->where('network', $network->network_id)->count();
            $color = $network->network_id == 2?'#14cc12':($network->network_id==3?'red':($network->network_id == 4?'#08cef1':''));
            $messageIncomming = [
                'count' => $messages,
                'name' => $network->network_desc,
                'color' => $color,
            ];

            array_push($data, $messageIncomming);
        }
        return new ChartsApiResource($data);
    }

    public function incommingMessagesPerDay()
    {
        $data = [];
        //Get All Dates this month
        $today = today();
        $dates = [];

        for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
        }

        foreach ($dates as $date) {
            $dataDate = [
                'day' => $date,
                'count' => DB::table('messages_incoming')->whereDate('timereceived', $date)->count()
            ];

            array_push($data, $dataDate);
        }

        return new ChartsApiResource($data);
    }

    public function dailyWinnersVsValidEntriesThisMonth()
    {
        $data = [];
        $today = \Carbon\Carbon::now();
        $dates = [];
        for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
        }
        foreach ($dates as $date) {
            $dataDate = [
                'day' => $date,
                'validEntries' => [
                    'count' => DB::table('validpool')->whereDate('date_created', $date)->count()
                ],
                'dailyWinners' => [
                    'count' => DB::table('draw_winners')->whereDate('created_at', $date)->count() + DB::table('daily_winners')->whereDate('date',$date)->count()
                ]

            ];

            array_push($data, $dataDate);
        }

        return new ChartsApiResource($data);
    }
}
