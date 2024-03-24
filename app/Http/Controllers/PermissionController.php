<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $permissions = Permission::when(request()->search,function($search){
            $search = $search->where('name','like','%'.request()->search.'%');    
        })
        ->latest('created_at')
        ->paginate(5);
        return view('pages.permission.index',compact('permissions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $permission = Permission::create([
            'name'     => $request->name, 
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Has Been Created!',
            'data'    => $permission  
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Permission',
            'data'    => $permission  
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Permission $permission)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,'.$permission->id,
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $permission->update([
            'name'     => $request->name, 
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Has Been Updated!',
            'data'    => $permission  
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete by ID
        Permission::where('id', $id)->delete();
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Has Been Deleted!.',
        ]); 
    }
}
