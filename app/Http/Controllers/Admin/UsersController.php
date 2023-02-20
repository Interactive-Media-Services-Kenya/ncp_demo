<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiStoreUserRequest;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendEscalationMail;
use App\Mail\UpdatePasswordUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with(['roles','company'])->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');
        $companies = Company::all();

        return view('admin.users.create', compact('roles','companies'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $url_login = URL::to('/');
        $message = "Hello, You have been assigned an account at $url_login . Kindly Use the following details to login to your Account.     Email: $user->email and Password: $request->password ";
            $details = [
                'title' => 'Mail from '.config('app.name'),
                'body' => $message,
            ];

        Mail::to($user->email)->send(new UpdatePasswordUser($details));
        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');
        $companies = Company::pluck('name', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user','companies'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('admin.users.show', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    //Creating the user
    public function register(ApiStoreUserRequest $request){

        $user = User::where('email', $request['email'])->first();

        if($user){
            $response['status'] = 0;
            $response['message'] = 'Email Already Exists';
            $response['code'] = 409;
        }else{
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'password'   => bcrypt($request->password)
            ]);

            //defining the response
            $response['status'] = 1;
            $response['message'] = 'User Registered Successfully';
            $response['code'] = 200;
        }

        //returning the response
        return response()->json($response);
    }

    public function login(Request $request){
        //defining the credentials
        $credentials = $request->only('email', 'password');
        //try catch exception
        try{
            if(!JWTAuth::attempt($credentials)){
                $response['status'] = 0;
                $response['code'] = 401;
                $response['data'] = null;
                $response['message'] = 'Email or Password is incorrect';
                    //returning the response in json
                return response()->json($response);
            }
        }catch(JWTException $e){
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Could Not Create Token';
                //returning the response in json
            return response()->json($response);
        }

        //checking if the user is authenticated
        $user = auth()->user();
        //defining the token that claims the user id
        $data['token'] = auth()->claims([
            'user_id' => $user->id,
            'email'   => $user->email
        ])->attempt($credentials);

        //defining the response
        $response['data'] = $data;
        $response['status'] = 1;
        $response['code'] = 200;
        $response['message'] = 'login Successful';

        //returning the response in json
        return response()->json($response);
    }

    //logout functionn
    public function logout(){
        auth()->logout();

        //defining the response
        $response['message'] = 'User successfully signed out';

        //returning the response in json
        return response()->json($response);
    }

    //this function retrieves the user details
    public function userProfile(){
        return response()->json(auth()->user());
    }

    //this function refreshes the token
    public function refresh(){
        return $this->createNewToken(auth()->refresh());
    }

    //creates a new token for the current loged in user
    private function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'baarer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
            'user'         => auth()->user()
        ]);
    }

}
