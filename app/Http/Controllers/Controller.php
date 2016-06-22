<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Auth;
use App\Info;
use App\Skill_group;
use App\Skill;
use App\Work;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    function index() {
        $info = Info::select('id', 'name', 'value', 'protect', 'type')->get();
        if(!Auth::check()) {
            $info = $info->each(function($item, $key) {
                if($item->protect == true) {
                    $item->value = '';
                } 
            });
        }
        $info = $info->groupBy('type');
        
        $skill_groups = Skill_group::select('id', 'name')->get();
        $skill = Skill::select('id', 'name', 'group')->get()->groupBy('group');
        $work = Work::all();
        return view('index')
                ->with('info_data', $info)
                ->with('skill_data', compact('skill_groups', 'skill'))
                ->with('work_data', $work);
    }
}
