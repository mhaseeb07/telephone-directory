<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permission-list', ['only' => ['index']]);
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::select('permissions.id as p_id','permissions.name as p_name', 'permission_groups.name as g_name')
            ->leftJoin('permission_groups','permission_groups.id','=','permissions.group_id')->orderBy('permissions.id','desc')->get();
        return view('admin.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = PermissionGroup::orderby('id','desc')->get();
        return view('admin.permission.create',compact('groups'));
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
            'name' => 'required|unique:permissions,name',
            'group_id' => 'required',
        ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->group_id = $request->group_id;
        $save = $permission->save();
        if ($save){
            return redirect(route('permission.index'))->with('message','Permission Added Successfully');
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
        $permission = Permission::find($id);
        $groups = PermissionGroup::orderby('id','desc')->get();
        return view('admin.permission.edit',compact('permission','groups'));
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
            'name' => 'required|unique:permissions,name,'.$id,
            'group_id' => 'required',
        ]);
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->group_id = $request->group_id;
        $save = $permission->save();
        if ($save){
            return redirect(route('permission.index'))->with('message','Permission Updated Successfully');
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
