<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // public function userDetails(String $name,$city){
    //     return  view('welcome',['name' => $name , 'city'=> $city]);
    // }
    // // public function UserCity(String $name, String $city){
    // //     return  view('welcome',['name' => $name , 'city'=> $city]);
    // // }

    public function index(){
    $employee = Employees::all();
    return response()->json(['employees'=>$employee]);
    }
}
