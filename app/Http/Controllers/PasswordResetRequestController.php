<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Mail\SendMailreset;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetRequestController extends Controller
{
    //this function sends mail
    public function sendEmail(Request $request){
        //validating the email first before sending
        if(!$this->validateEmail($request->email)){
            return $this->failedResponse();
        }

        //sending the validated email
        $this->send($request->email);
        return $this->successResponse();
    }

    public function send($email){
        $token = $this->createToken($email);
        Mail::to($email)->send(new SendMailreset($token, $email));
    }

    public function createToken($email){
        $oldToken = DB::table('password_resets')->where('email', $email)->first();

        if($oldToken){
            return $oldToken->token;
        }

        $token = Str::random(40);
        $this->saveToken($token, $email);
        return $token;
    }

    //this function saves new password
    public function saveToken($token, $email){
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }

    //this function gets your email from the database
    public function validateEmail($email){
        return !!User::where('email', $email)->first();
    }

    public function failedResponse(){
        return response()->json([
            'error' => 'Email not found in our database.'
        ], Response::HTTP_NOT_FOUND);
    }

    public function successResponse(){
        return response()->json([
            'data' => 'Reset Email was sent successfuly, kindly check your inbox.'
        ], Response::HTTP_OK);
    }
}
