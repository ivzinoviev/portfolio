<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use App\Info;


class InfoController extends Controller
{
    /* Get image from AJAX */
    public function image(Request $request) {
        $file = array('image' => Input::file('image'));
        $validator = Validator::make($file, array('image' => 'required|image|max:5000000',));
        if ($validator->fails()) {
            return ['success' => false];
        }
        $destinationPath = 'img'; 
        $extension = Input::file('image')->getClientOriginalExtension(); 
        $fileName = rand(11111,99999).'.'.$extension; 
        
        if($image = Info::whereRaw('name = "image" AND type = "image"')->first()) {
            File::delete($destinationPath . '/' . $fileName);
            $image->update(['value' => $fileName]);
        } else {
            $image = new Info();
            $image->name = 'image';
            $image->type = 'image';
            $image->value = $fileName;
            $image->save();
        }
        
        Input::file('image')->move($destinationPath, $fileName);
        return ['success' => true, 'image' => $destinationPath . '/' . $fileName];
    }
    
    /* Delete image */
    public function destroyImage() {
        $image = Info::whereRaw('name = "image" AND type = "image"')->first();
        File::delete('img/' . $image->value);
        return Info::destroy($image->id);
    }
    
    /* Save info row */
    public function store(Request $request)
    {
        $info = new Info();
        $info->name = $request->get('name');
        $info->value = $request->get('value');
        $info->protect = ($request->get('protect') == 'true') ? 1 : 0;
        $info->type = 'string';
        if($info->save()) {
            return $info;
        }
    }
    
    /* Delete info */
    public function destroy($id)
    {
        return Info::destroy($id);
    }
    
    /* Update info */
    public function update(Request $request)
    {   
        $info = Info::find($request->get('pk'));
        $info->update([$request->get('name') => $request->get('value')]);
        return [$request->get('value')];
    }
    
    /* Send protected data fot unauthorized user */
    public function secret(Request $request) {
        $validator = Validator::make(Input::all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);
        if ($validator->fails()) {
            return [false];
        }
        $data = Info::select('id', 'name', 'value', 'protect')->whereRaw('protect = 1')->get();
        return $data;
    }
}
