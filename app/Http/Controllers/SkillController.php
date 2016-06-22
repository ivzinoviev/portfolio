<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Skill;

class SkillController extends Controller
{
    /* Save skill */
    public function store(Request $request)
    {
        $skill = new Skill();
        $skill->name = $request->get('name');
        $skill->group = $request->get('group');
        if($skill->save()) {
            return $skill;
        }
    }
    
    /* Delete skill */
    public function destroy($id)
    {
        return Skill::destroy($id);
    }
    
    /* Delete skills of group */
    public function deleteByGroup($id) {
        return Skill::where('group', '=', $id)->delete();
            
    }
    
    
    /* Update skill record */
    public function update(Request $request)
    {   
        $skill = Skill::find($request->get('pk'));
        $skill->update(['name' => $request->get('value')]);
        return [$request->get('value')];
    }
}
