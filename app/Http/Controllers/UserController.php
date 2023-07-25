<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\Demo;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userDetails(Request $req){
    $data = $req->all();

        return  view('welcome',['name' => $req->name, 'city'=> $data['city']]);
    }
    // public function UserCity(Request $req){
    //     return  view('welcome',['name' => $name , 'city'=> $city]);
    // }

    public function index(){
    $employee = Employees::all();
    return response()->json(['employees'=>$employee]);
    }

    public function addEmp(Request $req){
        $demo = new Demo();
        $demo->ID=$req->ID;
        $demo->firsName=$req->firstName;
        $demo->lastName=$req->lastName;
        $demo->email=$req->email;
        $demo->save();
        

    }
}
