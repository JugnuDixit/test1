<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RolesController extends Controller
{
 public function index(Request $request)
  {
    
    $roles = Role::all();
    
    return response()->json([
      'data'  =>  $roles
    ], 200);
  }

  /*
   * To store a new role
   *
   *@
   */
  public function store(Request $request)
  {
    $request->validate([
      'name'  =>  'required'
    ]);

    $role = new Role(request()->all());
    $role->save();

    return response()->json([
      'data'  =>  $role
    ], 201); 
  }

  /*
   * To view a single role
   *
   *@
   */
  public function show(Role $role)
  {
    return response()->json([
      'data'  =>  $role
    ], 200);   
  }

  /*
   * To update a role
   *
   *@
   */
  public function update(Request $request, Role $role)
  {
    $request->validate([
      'name'  =>  'required',
    ]);

    $role->update($request->all());
      
    return response()->json([
      'data'  =>  $role
    ], 200);
  }
}
