<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee_Demo;
use Illuminate\Http\Request;


class ApiController extends Controller
{
   public function store(Request $request){
    $employeeDemo = new Employee_Demo();
    $employeeDemo->empId = $request->input('empID');
    $employeeDemo->firstName = $request->input('firstName');
    $employeeDemo->lastName = $request->input('lastName');
    $employeeDemo->email = $request->input('email');
    $employeeDemo->city = $request->input('city');
    $employeeDemo->save();
    return response()->json($employeeDemo);
   }

   public function show(Request $request){
    $employeeDemo = Employee_Demo::all();
    return response()->json($employeeDemo);

   }

   public function update(Request $request){
    $employeeDemo = Employee_Demo::where($request->empID);
    $employeeDemo->firstName = $request->firstName;
    $result = $employeeDemo ->save();
     if($result){
        return response() ->json(['result'=>"employee details Updated"]);
     }else{
        return response() ->json(['result'=>"employee details cant update"]);
     }
   }
}
