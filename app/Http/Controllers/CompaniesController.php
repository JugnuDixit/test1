<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;

class CompaniesController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth:api')
      ->except('index');
  }
  
   public function index()
  {
   $companies = Company::with('users')->get(); 

    return response()->json([
      'data'     =>  $companies
    ], 200);
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'name'    =>  'required',
      'address' =>  'required',
    ]);

    $company = new Company($request->all());
    $company->save();

    return response()->json([
      'data'    =>  $company->toArray()
    ], 201); 
  }

  public function show(Company $company)
  { 
    return response()->json([
      'data' => $company
    ], 200);
  }

  public function update(Request $request, Company $company)
  {
    $request->validate([
      'name'     => 'required',
   
    
    ]);

    $company->update($request->all());
 
    return response()->json([
      'data' => $company
    ],200);
  }

 
}
