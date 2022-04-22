<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\department;
use Illuminate\Support\Str;
use Auth;

class DepartmentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:department-create', ['only' => ['create','store']]);
        $this->middleware('permission:department-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:department-delete', ['only' => ['destroy']]);
        $this->middleware('permission:department-restore', ['only' => ['restore']]);
        $this->middleware('permission:department-softdelete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.department.create');
    }

    public function getDepartment(Request $request){
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
        
        $totalRecords = department::select('count(*) as allcount')
                ->withTrashed()
                ->leftJoin('users','users.id','=','department.created_by')
                ->where(function($q) use($searchValue){
                    $q->where('department.name', 'like', '%' .$searchValue . '%')
                    ->orWhere('department.slug', 'like', '%' .$searchValue . '%')
                    ->orWhere('users.name', 'like', '%' .$searchValue . '%');
                })
                ->orderBy('id', 'DESC')
                ->count();
        
         
            $totalRecordswithFilter = department::select('count(*) as allcount')
                ->withTrashed()
                ->leftJoin('users','users.id','=','department.created_by')
                ->where(function($q) use($searchValue){
                    $q->where('department.name', 'like', '%' .$searchValue . '%')
                    ->orWhere('department.slug', 'like', '%' .$searchValue . '%')
                    ->orWhere('users.name', 'like', '%' .$searchValue . '%');
                })
                ->orderBy('id', 'DESC')
                ->count();
       
        // Fetch records
        $records = department::orderBy($columnName,$columnSortOrder)
            ->withTrashed()
            ->leftJoin('users','users.id','=','department.created_by')
            ->where(function($q) use($searchValue){
                $q->where('department.name', 'like', '%' .$searchValue . '%')
                ->orWhere('department.slug', 'like', '%' .$searchValue . '%')
                ->orWhere('users.name', 'like', '%' .$searchValue . '%');
            })
            ->select('department.*')
            ->orderBy('id', 'DESC')
            ->skip($start)
            ->take($rowperpage)
            ->get();
      
  
        $data_arr = array();
  
        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $slug = $record->slug;
            $createdBy = User::where('id', $record->created_by)->pluck('name','name')->first();
            $updatedBy = User::where('id', $record->updated_by)->pluck('name','name')->first();
            $deleted_at = $record->deleted_at;
            if($record->deleted_at == Null){
                $deleted_at = '0';
            }
            if($record->deleted_at != Null){
                $deleted_at = '1';
            }
  
            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "slug" => $slug,
                "created_by"=> $createdBy,
                "updated_by"=> $updatedBy,
                "deleted_at" => $deleted_at, 
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $C_Department = $request->all();
        $C_Department['created_by']=Auth::User()->id;
        $C_Department['slug'] = $this->createSlug($request->name);
        $this->validate($request, [
          'name' =>  'required',
        ]);
        $Department_store = department::create($C_Department);
        if($Department_store){
          return redirect(route('department.create'))->with('message','Congratulations,Record Added Successfully');
        }else{
          return redirect(route('department.create'))->with('message','There is something wrong Please try again.');
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
        $g_Department = department::findOrfail($id);
        return view('admin.department.edit', compact('g_Department'));
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
        $G_Departments = department::findOrFail($id);
        $U_department = $request->all();
        $U_department['updated_by']=Auth::user()->id;
        $this->validate($request, [
            'name' =>  'required',
        ]);
        $response = $G_Departments->update($U_department);
        if($response){
          return redirect(route('department.create'))->with('message','Congratulations,Record Updated Successfully');
        }else{
          return redirect(route('department.create'))->with('message','There is something wrong Please try again.');
        }
    }

    
    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 100000000; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return department::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $g_department = department::find($id);
        $Departmrnt_delete=$g_department->delete();
        if($Departmrnt_delete){
                return redirect(route('department.create'))
                ->with('message','Congratulations,Record Updated Successfully!');  
        }
        else{
            return redirect(route('department.create'))
            ->with('message','There is something wrong Please try again.'); 
        }
    }

    public function restore($id){
        $Department_restore = department::onlyTrashed()->find($id);
        if ($Department_restore->restore()) {
        return redirect(route('department.create'))
                ->with( 'message', 'Congratulations,Record restored Successfully!'); 
        }
        else {
            return redirect(route('department.create'))
            ->with('message', 'There is something wrong Please try again.'); 
        }
    }

    public function delete($id)
    {
        $Department_delete_per = department::onlyTrashed()->find($id);
        if(isset($Department_delete_per)){
            $Department_delete_per->forceDelete();
            return redirect()->back()->with('message','Congratulations,Record Deleted Permanently Successfully!');
        }
        else {
            return redirect(route('departments.create'))
            ->with('message','There is something wrong Please try again.'); 
        }

    }
}
