<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use App\Client;
use Validator;

class ProjectsController extends Controller
{
    public function index()
    {
        try {

            return view('project.project');

        } catch (\Exception $e) {
        }
    }

    public function indexCreate()
    {
        try {

            $clients = Client::getClientsName();
            $positions = Position::getPositionsName();
            return view('project.projectCreate')->with('clients', $clients)->with('positions', $positions);

        } catch (\Exception $e) {
        }
    }

    public function createProject(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                'projectTitle' => 'required',
                'projectDescription' => 'required',
                'startDate' => 'required|date',
                'endDate' => 'nullable|date',
                'clientName' => 'required',

                'projectUsers' => 'nullable|array',
                'projectUsers.*.name' => 'required',
                'projectUsers.*.id' => 'required',
                'projectUsers.*.position' => 'nullable'
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $clientName = ucfirst(strtolower($data['clientName']));

                $clientId = Client::getClientId($clientName);
                if($clientId === null){
                    Client::createClient($clientName);
                }

            }
        } catch (\Exception $e) {
        }
    }


}
