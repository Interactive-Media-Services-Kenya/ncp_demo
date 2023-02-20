<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\UserCode;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OTPController extends Controller
{
    public function index()
    {
        return view('auth.otp');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);

        $find = UserCode::where('user_id', auth()->user()->id)
                        ->where('code', $request->code)
                        ->where('updated_at', '>=', now()->subMinutes(10))
                        ->first();

        if (!is_null($find)) {
            Session::put('user_otp', auth()->user()->id);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'You entered wrong code.');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function resend()
    {
        $user = User::where('id',Auth::id())->first();
        $user->generateCode($user);

        return back()->with('success', 'We sent you code on your mobile number.');
    }
}
