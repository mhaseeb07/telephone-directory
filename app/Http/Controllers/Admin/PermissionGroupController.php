<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;

class PermissionGroupController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permission-group-list', ['only' => ['index']]);
        $this->middleware('permission:permission-group-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-group-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission-group-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = PermissionGroup::orderBy('id','desc')->get();
        return view('admin.permission_group.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission_group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permission_groups,name',
        ]);
        $group = new PermissionGroup();
        $group->name = $request->name;
        $save = $group->save();
        if ($save){
            return redirect(route('permission_group.index'))->with('message','Group Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = PermissionGroup::find($id);
        return view('admin.permission_group.edit',compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:permission_groups,name,'.$id,
        ]);
        $group = PermissionGroup::find($id);
        $group->name = $request->name;
        $save = $group->save();
        if ($save){
            return redirect(route('permission_group.index'))->with('message','Group Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
