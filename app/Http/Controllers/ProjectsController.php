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

            $clients = Client::getClientsNames();
            $positions = Position::getPositionsNames();
            return view('project.projectCreate')->with('clients', $clients)->with('positions', $positions);

        } catch (\Exception $e) {
        }
    }

    public function createProject(Request $request)
    {
        try {
            return response('coming soon');
            $data = $request->all();
            $rules = [
                'projectTitle' => 'required',
                'projectDescription' => 'required',
                'startDate' => 'required|date',
                'endDate' => 'nullable|date',
                'clientName' => 'required',
                'projectUsers.*.technologies' => 'nullable|array',
                'projectUsers.*.technologies.*.technologyName' => 'nullable',

                'projectUsers' => 'nullable|array',
                'projectUsers.*.name' => 'required',
                'projectUsers.*.id' => 'required',
                'projectUsers.*.position' => 'nullable',
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {

                $clientName = ucfirst(strtolower($data['clientName']));

                $clientId = $this->getClientId($clientName);


            }
        } catch (\Exception $e) {
        }
    }

    private function getClientId($name)
    {
        $client = Client::getClientObjectByName($name);
        if ($client === null) {
            $client = Client::createClient($name);
        }
        return $clientId = $client->id;
    }


}
