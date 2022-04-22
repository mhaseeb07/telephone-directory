<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\department;
use App\Models\ContactInfo;
use Illuminate\Support\Str;
use Auth;

class ContactInformationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:contact-info-list', ['only' => ['index']]);
        $this->middleware('permission:contact-info-create', ['only' => ['create','store']]);
        $this->middleware('permission:contact-info-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:contact-info-delete', ['only' => ['destroy']]);
        $this->middleware('permission:contact-info-restore', ['only' => ['restore']]);
        $this->middleware('permission:contact-info-softdelete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('admin.contact_info.index');
    }
    public function getContactInfo(Request $request){
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
        
        $totalRecords = ContactInfo::with('Dpt_id')
                ->select('count(*) as allcount')
                ->withTrashed()
                ->leftJoin('department','department.id','=','contact_info.dpt_id')
                ->where(function($q) use($searchValue){
                    $q->where('contact_info.name', 'like', '%' .$searchValue . '%')
                    ->orWhere('contact_info.company', 'like', '%' .$searchValue . '%')
                    ->orWhere('contact_info.designation', 'like', '%' .$searchValue . '%')
                    ->orWhere('contact_info.mobile_no', 'like', '%' .$searchValue . '%')
                    ->orWhere('contact_info.address', 'like', '%' .$searchValue . '%')
                    ->orWhere('department.name', 'like', '%' .$searchValue . '%');
                })
                ->orderBy('id', 'DESC')
                ->count();
        
         
            $totalRecordswithFilter = ContactInfo::with('Dpt_id')
                ->select('count(*) as allcount')
                ->withTrashed()
                ->leftJoin('department','department.id','=','contact_info.dpt_id')
                ->where(function($q) use($searchValue){
                    $q->where('contact_info.name', 'like', '%' .$searchValue . '%')
                    ->orWhere('contact_info.company', 'like', '%' .$searchValue . '%')
                    ->orWhere('contact_info.designation', 'like', '%' .$searchValue . '%')
                    ->orWhere('contact_info.mobile_no', 'like', '%' .$searchValue . '%')
                    ->orWhere('contact_info.address', 'like', '%' .$searchValue . '%')
                    ->orWhere('department.name', 'like', '%' .$searchValue . '%');
                })
                ->orderBy('id', 'DESC')
                ->count();
       
        // Fetch records
        $records = ContactInfo::with('Dpt_id')
            ->orderBy($columnName,$columnSortOrder)
            ->withTrashed()
            ->leftJoin('department','department.id','=','contact_info.dpt_id')
            ->where(function($q) use($searchValue){
                $q->where('contact_info.name', 'like', '%' .$searchValue . '%')
                ->orWhere('contact_info.company', 'like', '%' .$searchValue . '%')
                ->orWhere('contact_info.designation', 'like', '%' .$searchValue . '%')
                ->orWhere('contact_info.mobile_no', 'like', '%' .$searchValue . '%')
                ->orWhere('contact_info.address', 'like', '%' .$searchValue . '%')
                ->orWhere('department.name', 'like', '%' .$searchValue . '%');
            })
            ->select('contact_info.*')
            ->orderBy('id', 'DESC')
            ->skip($start)
            ->take($rowperpage)
            ->get();
      
  
        $data_arr = array();
  
        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $dpt_id  = $record['Dpt_id']['name'];
            $designation = $record->designation;
            $city = $record->city;
            $company = $record->company;
            $business_phone = $record->business_phone;
            $mobile_no = $record->mobile_no;
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
                "dpt_id" => $dpt_id,
                "designation" => $designation,
                "city" => $city,
                "company" => $company,
                "business_phone" => $business_phone,
                "mobile_no" => $mobile_no,
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $g_Department = department::orderBy('name','asc')->get();
        return view('admin.contact_info.create' , compact('g_Department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $C_Contact = $request->all();
        $C_Contact['created_by']=Auth::User()->id;
        $C_Contact['slug'] = $this->createSlug($request->name);
        $this->validate($request, [
          'name' =>  'required',
        ]);
        $Contact_store = ContactInfo::create($C_Contact);
        if($Contact_store){
          return redirect(route('contact-info.index'))->with('message','Congratulations,Record Added Successfully');
        }else{
          return redirect(route('contact-info.index'))->with('message','There is something wrong Please try again.');
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
        $g_Contact = ContactInfo::findOrfail($id);
        $g_Department = department::orderBy('name','asc')->get();
        return view('admin.contact_info.edit' , compact('g_Contact','g_Department'));
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
        $G_Contacts = ContactInfo::findOrFail($id);
        $U_Contact = $request->all();
        $U_Contact['updated_by']=Auth::user()->id;
        $this->validate($request, [
            'name' =>  'required',
        ]);
        $response = $G_Contacts->update($U_Contact);
        if($response){
          return redirect(route('contact-info.create'))->with('message','Congratulations,Record Updated Successfully');
        }else{
          return redirect(route('contact-info.create'))->with('message','There is something wrong Please try again.');
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
        return ContactInfo::select('slug')->where('slug', 'like', $slug.'%')
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
        $g_Contact = ContactInfo::find($id);
        $Contact_delete=$g_Contact->delete();
        if($Contact_delete){
                return redirect(route('contact-info.index'))
                ->with('message','Congratulations,Record Updated Successfully!');  
        }
        else{
            return redirect(route('Contact.index'))
            ->with('message','There is something wrong Please try again.'); 
        }
    }

    public function restore($id){
        $Contact_restore = ContactInfo::onlyTrashed()->find($id);
        if ($Contact_restore->restore()) {
        return redirect(route('contact-info.index'))
                ->with( 'message', 'Congratulations,Record restored Successfully!'); 
        }
        else {
            return redirect(route('contact-info.index'))
            ->with('message', 'There is something wrong Please try again.'); 
        }
    }

    public function delete($id)
    {
        $Contact_delete_per = ContactInfo::onlyTrashed()->find($id);
        if(isset($Contact_delete_per)){
            $Contact_delete_per->forceDelete();
            return redirect()->back()->with('message','Congratulations,Record Deleted Permanently Successfully!');
        }
        else {
            return redirect(route('contact-info.create'))
            ->with('message','There is something wrong Please try again.'); 
        }

    }
}
