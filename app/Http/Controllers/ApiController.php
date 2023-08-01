<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee_Demo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

   public function show(){
    $employeeDemo = Employee_Demo::all();
    return response()->json($employeeDemo);

   }
   public function showbyid($empID){
    $employeeDemo = Employee_Demo::find('empID', $empID);
    return response()->json($employeeDemo);

   }
   public function showbyname($firstName){
    $employeeDemo = Employee_Demo::where('firstName',$firstName)->first();
    if(!$employeeDemo){
        return response()->json(['message'=>'Employee details not found']);
    }
    return response()->json($employeeDemo);

   }

//    public function updatebyname(Request $request,$firstName){
//     $employeeDemo = Employee_Demo::where('firstName',$firstName);
//     $employeeDemo->empId = $request->input('empID');
//     $employeeDemo->firstName = $request->input('firstName');
//     $employeeDemo->lastName = $request->input('lastName');
//     $employeeDemo->email = $request->input('email');
//     $employeeDemo->city = $request->input('city');
//     $employeeDemo->save();
//     return response()->json($employeeDemo);
//    }
public function updatebyname(Request $request,$firstName){
   $employeeDemo = Employee_Demo::where('firstName', $firstName)->first();

   if (!$employeeDemo) {
       return response()->json(['message' => 'Employee not found'], 404);
   }

   $employeeDemo->empId = $request->input('empId');
   $employeeDemo->firstName = $request->input('firstName');
   $employeeDemo->lastName = $request->input('lastName');
   $employeeDemo->email = $request->input('email');
   $employeeDemo->city = $request->input('city');
   $employeeDemo->save();

   return response()->json($employeeDemo);
}
public function deletebyname(Request $request,$firstName){
    $employeeDemo = Employee_Demo::where('firstName',$firstName);
    if(!$employeeDemo){
        return response()->json(['Message'=>'Employee not found']);
    }
    $employeeDemo->delete();
    return response()->json(['Message'=>'Employee deleted succssfully']);

}

public function save(Request $request) {
    $rules = [
        'empID' => 'required|integer',
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|email',
        'city' => 'required|string|min:2|max:255',
    ];
    
    $validator = Validator::make($request->all(), $rules);

    
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()]);
    }

    $employeeDemo = new Employee_Demo();
    $employeeDemo->empID = $request->input('empID');
    $employeeDemo->firstName = $request->input('firstName');
    $employeeDemo->lastName = $request->input('lastName');
    $employeeDemo->email = $request->input('email');
    $employeeDemo->city = $request->input('city');
    $employeeDemo->save();

    return response()->json(['message' => 'Employee created successfully']);
}
}
