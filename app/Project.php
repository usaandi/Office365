<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{


    protected $fillable = ['client_id', 'project_title', 'description', 'begin_date', 'end_date'];

    public static function createProject($data)
    {
        $endDate = null;

        $beginDate = Carbon::parse($data['startDate'])->toDateTimeString();

        if ($data['endDate']) {
            $endDate = Carbon::parse($data['endDate'])->toDateTimeString();
        }


        $projectCreate = Project::create([
            'client_id' => $data['clientId'],
            'project_title' => $data['projectTitle'],
            'description' => $data['projectDescription'],
            'begin_date' => $beginDate,
            'end_date' => $endDate,
        ]);
        return $projectCreate->id;
    }
}
