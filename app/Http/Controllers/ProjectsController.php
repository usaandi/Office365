<?php

namespace App\Http\Controllers;

use App\Position;
use App\Project;
use App\ProjectTechnologyUser;
use App\ProjectUserPosition;
use App\Technology;
use App\TechnologyUser;
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

                $projectData = [
                    'projectTitle' => $data['projectTitle'],
                    'projectDescription' => $data['projectDescription'],
                    'startDate' => $data['startDate'],
                    'endDate' => $data['endDate'],
                    'clientId' => $clientId,
                ];

                $projectId = Project::createProject($projectData);

                $projectUsers = $data['projectUsers'];

                foreach ($projectUsers as $key => $user) {
                    $currentUserId = $user['id'];
                    $positionName = $user['position'];

                    $userTechnologies = $user['technologies'];
                    if($userTechnologies){
                        $this->technologyArrayUserProject($userTechnologies, $currentUserId, $projectId);

                    }
                    $positionId = $this->getPositionIdByName($positionName);

                    $status = $this->createProjectUserPosition($projectId, $currentUserId, $positionId);
                }
                return response('Success', 200);

            }
        } catch (\Exception $e) {
            return response('Something went wrong', 403);
        }
    }

    protected function checkTechnologyUser($userId, $technologyId)
    {
        $userTechnology = TechnologyUser::where('user_id', $userId)->where('technology_id', $technologyId)->first();

        if ($userTechnology === null) {
            TechnologyUser::create([
                'user_id' => $userId,
                'technology_id' => $technologyId,
            ]);
        }

    }

    protected function createTechnologyUserProject($technologyId, $userId, $projectId)
    {
        ProjectTechnologyUser::create([
            'user_id' => $userId,
            'project_id' => $projectId,
            'technologies_id' => $technologyId
        ]);
    }

    protected function technologyArrayUserProject($technologyNamesArray, $userId, $projectId)
    {
        foreach ($technologyNamesArray as $technology) {
            $technologyGet = Technology::getTechnologyObjectByName($technology['technologyName']);
            if ($technologyGet === null) {
                $technologyGet = Technology::createTechnology($technology['technologyName']);
            }
            $technologyId = $technologyGet->id;
            $this->checkTechnologyUser($userId, $technologyId);
            $status = $this->createTechnologyUserProject($technologyId, $userId, $projectId);
        }
        return true;
    }

    protected function getClientId($name)
    {
        $client = Client::getClientObjectByName($name);
        if ($client === null) {
            $client = Client::createClient($name);
        }
        return $clientId = $client->id;
    }

    protected function getPositionIdByName($positionName)
    {
        $position = Position::getPositionObjectByName($positionName);
        if ($position === null) {
            $position = Position::createPosition($positionName);
        }
        return $positionId = $position->id;
    }

    protected function createProjectUserPosition($projectId, $userId, $positionId)
    {
        $pup = ProjectUserPosition::create([
            'user_id' => $userId,
            'project_id' => $projectId,
            'position_id' => $positionId
        ]);
        return $pup;
    }


}
