<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }
    public function getUsers(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = User::select('count(*) as allcount')->where('users.email','not like','%ghulam.farid@tuf.edu.pk%')->where('users.role_status','!=',0)->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('users.email','not like','%ghulam.farid@tuf.edu.pk%')->where('users.role_status','!=',0)->where(function ($q) use ($searchValue){
            $q->where('users.name', 'like', '%' .$searchValue . '%')
                ->orWhere('users.email', 'like', '%' .$searchValue . '%');
        })->count();
        // Fetch records
        $records = User::orderBy($columnName,$columnSortOrder)
            ->where('users.email','not like','%ghulam.farid@tuf.edu.pk%')
            ->where('users.role_status','!=',0)
            ->where(function ($q) use ($searchValue){
                $q->where('users.name', 'like', '%' .$searchValue . '%')
                    ->orWhere('users.email', 'like', '%' .$searchValue . '%');
            })
            ->select('users.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $email = $record->email;
            $mobile = $record->mobile;
            $userRole = $record->roles->pluck('name','name')->all();
            $assignRole=[];
            foreach ($userRole as $role){
                array_push($assignRole,$role);
            }
            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "role"=>$assignRole,
                "mobile" => $mobile,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', 'not like', '%developer%')->pluck('name','name')->all();
        return view('admin.user.create',compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'confirmed',
            'roles' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['slug'] = $this->createSlug($input['name']);
        $input['email_verified_at'] = Carbon::now();

        $user = User::create($input);
        $user->assignRole($request->input('roles'));


        return redirect()->route('user.index')->with('message','User created successfully');
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
        $user = User::find($id);
        $roles = Role::where('name', 'not like', '%developer%')->pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.user.edit',compact('user','roles','userRole'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'confirmed',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('user.index')
            ->with('message','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index')
            ->with('success','User deleted successfully');
    }
    //Create Slug
    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return User::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}
