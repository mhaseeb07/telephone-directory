<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Auth;

class CategoryController extends Controller
{ 
    function __construct()
    {
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
        $this->middleware('permission:category-restore', ['only' => ['restore']]);
        $this->middleware('permission:category-softdelete', ['only' => ['destroy']]);
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
         return view ('admin.category.create');
    }
    public function getCategory(Request $request){
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
        
        $totalRecords = Category::select('count(*) as allcount')
                ->withTrashed()
                ->leftJoin('users','users.id','=','category.created_by')
                ->where(function($q) use($searchValue){
                    $q->where('category.name', 'like', '%' .$searchValue . '%')
                    ->orWhere('category.slug', 'like', '%' .$searchValue . '%')
                    ->orWhere('users.name', 'like', '%' .$searchValue . '%');
                })
                ->orderBy('id', 'DESC')
                ->count();
        
         
            $totalRecordswithFilter = Category::select('count(*) as allcount')
                ->withTrashed()
                ->leftJoin('users','users.id','=','category.created_by')
                ->where(function($q) use($searchValue){
                    $q->where('category.name', 'like', '%' .$searchValue . '%')
                    ->orWhere('category.slug', 'like', '%' .$searchValue . '%')
                    ->orWhere('users.name', 'like', '%' .$searchValue . '%');
                })
                ->orderBy('id', 'DESC')
                ->count();
       
        // Fetch records
        $records = Category::orderBy($columnName,$columnSortOrder)
            ->withTrashed()
            ->leftJoin('users','users.id','=','category.created_by')
            ->where(function($q) use($searchValue){
                $q->where('category.name', 'like', '%' .$searchValue . '%')
                ->orWhere('category.slug', 'like', '%' .$searchValue . '%')
                ->orWhere('users.name', 'like', '%' .$searchValue . '%');
            })
            ->select('category.*')
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
        $C_Category = $request->all();
        $C_Category['created_by']=Auth::User()->id;
        $C_Category['slug'] = $this->createSlug($request->name);
        $this->validate($request, [
          'name' =>  'required',
        ]);
        $Category_store = Category::create($C_Category);
        if($Category_store){
          return redirect(route('category.create'))->with('message','Congratulations,Record Added Successfully');
        }else{
          return redirect(route('category.create'))->with('message','There is something wrong Please try again.');
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
        $g_Category = Category::findOrfail($id);
        return view('admin.category.edit', compact('g_Category'));
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
        $G_Category = Category::findOrFail($id);
        $U_Category = $request->all();
        $U_Category['updated_by']=Auth::user()->id;
        $this->validate($request, [
            'name' =>  'required',
        ]);
        $response = $G_Category->update($U_Category);
        if($response){
          return redirect(route('category.create'))->with('message','Congratulations,Record Updated Successfully');
        }else{
          return redirect(route('category.create'))->with('message','There is something wrong Please try again.');
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
        return Category::select('slug')->where('slug', 'like', $slug.'%')
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
        $g_Category = Category::find($id);
        $Category_delete=$g_Category->delete();
        if($Category_delete){
                return redirect(route('category.create'))
                ->with('message','Congratulations,Record Updated Successfully!');  
        }
        else{
            return redirect(route('category.create'))
            ->with('message','There is something wrong Please try again.'); 
        }
    }

    public function restore($id){
        $Category_restore = Category::onlyTrashed()->find($id);
        if ($Category_restore->restore()) {
        return redirect(route('category.create'))
                ->with( 'message', 'Congratulations,Record restored Successfully!'); 
        }
        else {
            return redirect(route('category.create'))
            ->with('message', 'There is something wrong Please try again.'); 
        }
    }

    public function delete($id)
    {
        $Category_delete_per = Category::onlyTrashed()->find($id);
        if(isset($Category_delete_per)){
            $Category_delete_per->forceDelete();
            return redirect()->back()->with('message','Congratulations,Record Deleted Permanently Successfully!');
        }
        else {
            return redirect(route('departments.create'))
            ->with('message','There is something wrong Please try again.'); 
        }

    }
}
