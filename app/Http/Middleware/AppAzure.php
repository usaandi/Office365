<?php
/**
 * Created by PhpStorm.
 * User: kaur-joonasusai
 * Date: 29.05.18
 * Time: 15:09
 */


namespace App\Http\Middleware;

use RootInc\LaravelAzureMiddleware\Azure as Azure;

use App\User;

class AppAzure extends Azure
{
    protected function success($request, $access_token, $refresh_token, $profile)
    {
        $email = strtolower($profile->unique_name);

        $user = User::updateOrCreate(['email' => $email], [
            'firstName' => $profile->given_name,
            'lastName' => $profile->family_name
        ]);

        $request->session()->put('user_id', $user->id);

        return parent::success($request, $access_token, $refresh_token, $profile);
    }
}