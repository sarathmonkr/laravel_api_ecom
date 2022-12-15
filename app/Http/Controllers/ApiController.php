<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\items_model;

class ApiController extends Controller
{
    //get all data from items table
    function getdata($id = null)
    {
        $id == null ? $data = items_model::all() : $data = items_model::find($id);

        return response()->json([
            'status' => '200',
            'data' => $data
        ]);
    }
    // add to cart 
    function addcart($id)
    {
        $data = items_model::findOrFail($id); //primary id
        $count = $data->status;
        $data->status = $count + 1;
        $result = $data->save();
        if ($result) {
            return ['status' => 200, 'message' => '1 Item added to cart'];
        } else {
            return ['error' => 'Error Occured'];
        }
    }

    // remove item from cart 
    function remcart($id)
    {
        $data = items_model::findOrFail($id); //primary id
        $count = $data->status;
        if ($count > 0) {
            $data->status = $count - 1;
            $result = $data->save();
            if ($result) {
                return ['status' => 200, 'message' => '1 Item removed from cart'];
            } else {
                return ['error' => 'Error Occured'];
            }
        } else {
            return ['status' => 200, 'message' => 'Invalid call'];
        }
    }
    // Delete item 
    function delete($id)
    {
        $data = items_model::findOrFail($id);
        $result = $data->delete();
        if ($result) {
            return ['status' => 200, 'message' => 'Item Deleted'];
        } else {
            return ['error' => 'Error Occured'];
        }
    }

    // add data to table 
    function adddata(Request $req)
    {
        $itm_model = new items_model;
        $itm_model->name = $req->name;
        $itm_model->descr = $req->descr;
        $itm_model->price = $req->price;
        if ($req->hasFile('img')) {
            $path = $req->file('img')->store('public');
            $fileinfo = $req->file('img');
        }
        $itm_model->img = $path;
        $result = $itm_model->save();
        if ($result) {
            return ['status' => 200, 'message' => 'success'];
        } else {
            return ['error' => 'Error Occured'];
        }
    }

    function updatedata(Request $req){
        // return [$req ];
        $data = items_model::findOrFail($req->id);
        $data->name = $req->name;
        $data->descr = $req->descr;
        $data->price = $req->price;
        if ($req->hasFile('img')) {
            $path = $req->file('img')->store('public');
            $fileinfo = $req->file('img');
            $data->img = $path;
        }
        $result = $data->save();
        if ($result) {
            return ['status' => 200, 'message' => 'success'];
        } else {
            return ['error' => 'Error Occured'];
        }
    }
}