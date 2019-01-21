<?php

namespace App\Http\Controllers;

use App\User;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function signin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Initialize the OAuth client
        $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => env('OAUTH_APP_ID'),
            'clientSecret'            => env('OAUTH_APP_PASSWORD'),
            'redirectUri'             => env('OAUTH_REDIRECT_URI'),
            'urlAuthorize'            => env('OAUTH_AUTHORITY').env('OAUTH_AUTHORIZE_ENDPOINT'),
            'urlAccessToken'          => env('OAUTH_AUTHORITY').env('OAUTH_TOKEN_ENDPOINT'),
            'urlResourceOwnerDetails' => '',
            'scopes'                  => env('OAUTH_SCOPES')
        ]);

        // Generate the auth URL
        $authorizationUrl = $oauthClient->getAuthorizationUrl();

        // Save client state so we can validate in response
        $_SESSION['oauth_state'] = $oauthClient->getState();

        // Redirect to authorization endpoint
        header('Location: '.$authorizationUrl);

        exit();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Microsoft\Graph\Exception\GraphException
     */
    public function gettoken()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Authorization code should be in the "code" query param
        if (isset($_GET['code'])) {
            // Check that state matches
            if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth_state'])) {
                exit('State provided in redirect does not match expected value.');
            }

            // Clear saved state
            unset($_SESSION['oauth_state']);

            // Initialize the OAuth client
            $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
                'clientId'                => env('OAUTH_APP_ID'),
                'clientSecret'            => env('OAUTH_APP_PASSWORD'),
                'redirectUri'             => env('OAUTH_REDIRECT_URI'),
                'urlAuthorize'            => env('OAUTH_AUTHORITY').env('OAUTH_AUTHORIZE_ENDPOINT'),
                'urlAccessToken'          => env('OAUTH_AUTHORITY').env('OAUTH_TOKEN_ENDPOINT'),
                'urlResourceOwnerDetails' => '',
                'scopes'                  => env('OAUTH_SCOPES')
            ]);

            try {

                $accessToken = $oauthClient->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);

                $token = $accessToken->getToken();

                $graph = new Graph();
                $graph->setAccessToken($token);

                $officeUser = $graph->createRequest('GET', '/me')
                    ->setReturnType(Model\User::class)
                    ->execute();

                $officeUserEmail = $officeUser->getMail();

                $tokenCache = new \App\TokenStore\TokenCache;
                $tokenCache->storeTokens($token, $accessToken->getRefreshToken(),
                    $accessToken->getExpires());

                $user = User::where('email', '=', $officeUserEmail)->first();

                if ($user === NULL) {

                    $user = User::create(['email' => $officeUserEmail, 'name' => $officeUser->getDisplayName(), 'token' => $token]);
                    $userRole = Role::findByName('User');
                    $user->assignRole($userRole);

                }
                else {
                    $user->token = $token;
                    $user->save();
                }

                auth()->login($user, TRUE);

                if(Auth::user()){
                    return redirect()->route('home');
                }
                else {
                    return "error!";
                }
            }
            catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                exit('ERROR getting tokens: '.$e->getMessage());
            }
            exit();
        }
        elseif (isset($_GET['error'])) {
            exit('ERROR: '.$_GET['error'].' - '.$_GET['error_description']);
        }
    }


}