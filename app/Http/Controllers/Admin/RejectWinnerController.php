<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RejectWinner;
use Illuminate\Http\Request;

class RejectWinnerController extends Controller
{
    public function index(){
        $rejected_winners =  RejectWinner::with('drawWinner')->get();
        return view('admin.draws.rejectWinners.index',compact('rejected_winners'));
    }
}
