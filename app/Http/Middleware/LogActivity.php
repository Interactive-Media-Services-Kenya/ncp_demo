<?php

namespace App\Http\Middleware;

use App\Models\LogActivity as ModelsLogActivity;
use Closure;
use Illuminate\Http\Request;

class LogActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle($request, Closure $next)
    {

        $response = $next($request);
        if (auth()->user() && ! request()->ajax()) {
            ModelsLogActivity::create([
                'url' => request()->fullUrl(),
                'ip' => request()->ip(),
                'user_id' => auth()->check() ? auth()->user()->id : 1,
                'method' => request()->method(),
                'agent' => request()->header('user-agent'),
            ]);
        }
        // if (auth()->user()) {
        //     ModelsLogActivity::create([
        //         'url' => request()->fullUrl(),
        //         'ip' => request()->ip(),
        //         'user_id' => auth()->check() ? auth()->user()->id : 1,
        //         'method' => request()->method(),
        //         'agent' => request()->header('user-agent'),
        //     ]);
        // }

        return $response;
    }
}
