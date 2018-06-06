<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class OutlookController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function mail()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $tokenCache = new \App\TokenStore\TokenCache;

        $graph = new Graph();
        $graph->setAccessToken($tokenCache->getAccessToken());

        $user = $graph->createRequest('GET', '/me')
            ->setReturnType(Model\User::class)
            ->execute();

        $messageQueryParams = array (
            // Only return Subject, ReceivedDateTime, and From fields
            "\$select" => "subject,receivedDateTime,from",
            // Sort by ReceivedDateTime, newest first
            "\$orderby" => "receivedDateTime DESC",
            // Return at most 10 results
            "\$top" => "10"
        );

        $getMessagesUrl = '/me/mailfolders/inbox/messages?'.http_build_query($messageQueryParams);
        $messages = $graph->createRequest('GET', $getMessagesUrl)
            ->setReturnType(Model\Message::class)
            ->execute();

        return view('mail', array(
            'username' => \Auth::user()->name,
            'email' => $user->getMail(),
            'messages' => $messages
        ));
    }
    public function contacts()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $tokenCache = new \App\TokenStore\TokenCache;

        $graph = new Graph();
        $graph->setAccessToken($tokenCache->getAccessToken());

        $user = $graph->createRequest('GET', '/me')
            ->setReturnType(Model\User::class)
            ->execute();


        $contactsQueryParams = array (
            // // Only return givenName, surname, and emailAddresses fields
            "\$select" => "givenName,surname,emailAddresses",
            // Sort by given name
            "\$orderby" => "givenName ASC",
            // Return at most 10 results
            "\$top" => "10"
        );

        $getContactsUrl = '/me/contacts?'.http_build_query($contactsQueryParams);
        $contacts = $graph->createRequest('GET', $getContactsUrl)
            ->setReturnType(Model\Contact::class)
            ->execute();

        return view('contacts', array(
            'username' => $user->getDisplayName(),
            'contacts' => $contacts
        ));
    }


}