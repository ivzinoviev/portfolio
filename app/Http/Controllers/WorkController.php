<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use App\Work;

class WorkController extends Controller
{
    /* Save info row */
    public function store(Request $request)
    {
        $work = new Work();
        $work->name = $request->get('name');      
        $work->description = $request->get('description');
        $work->technology = $request->get('technology');
        $work->role = $request->get('role');
        
        //Process image & validate
        $file = array('image' => Input::file('image'));
        $validator = Validator::make($file, array('image' => 'image|max:5000000',));
        if ($validator->fails()) {
            return ['success' => false];
        }
        
        $destinationPath = 'img';
        $extension = Input::file('image')->getClientOriginalExtension(); 
        $fileName = date('YmdHis').'.'.$extension; 
        Input::file('image')->move($destinationPath, $fileName);
        
        $work->image = $fileName;
        
        if($work->save()) {
            return $work;
        }
    }
    
    /* Update work via AJAX */
    public function update(Request $request)
    {   
        $work = Work::find($request->get('pk'));
        $work->update([$request->get('name') => $request->get('value')]);
        return [$request->get('value')];
    }
    
    /* Delete work */
    public function destroy($id)
    {
        $work = Work::find($id);
        File::delete('img/' . $work->image);
        return Work::destroy($id);
    }
}
