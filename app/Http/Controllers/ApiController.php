<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\items_model;

class ApiController extends Controller
{
    //
    function getdata($id=null){
       $id==null? $data = items_model::all() : $data = items_model::find($id);
       
       return response()->json([
        'status' => '200',
        'data' => $data
       ]);
    }

    function adddata(Request $req){
        //  return ["result"=>$req->file('img')];
        $itm_model = new items_model;
        $itm_model->name = $req->name;
        $itm_model->descr = $req->descr;
        $itm_model->price = $req->price;
        // return ["result"=>$req->file];
        // $res=$req->file('img')->store('public');
        // // // return ["result"=>$res];


        if ($req->hasFile('img')) {
            $path = $req->file('img')->store('public');
            $fileinfo = $req->file('img');
            
            // $req->merge([
            //     'img'              => $path,
            //     'original_filename' => $fileinfo->getClientOriginalName(),
            // ]);
            // return ["result"=>$req->original_filename];
        }

        $itm_model->img = $path;
        $result=$itm_model->save();
        if($result){
            return ['status' => 200, 'message'=>'success'];
        }
        else{
            return ['error'=>'Error Occured'];
        }
    }
}
