<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SendInvoice;
use App\Models\Inspectiontype;
use App\Models\User;
use App\Models\RequestModel;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:request-list|request-create|request-edit|request-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:request-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:request-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:request-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = Inspectiontype::where("status", "active")->pluck("name", "id");
        $invoicedata = SendInvoice::where("status", "active")->pluck("name", "id");
        if (Auth::user()->hasRole("admin")) {
            session()->forget('taskid');
            session()->forget('count');
            $companydetails = User::role('company')->where(["status" => "active"])->pluck("company_name", "id");
            return view('common.createrequest')->with(["data" => $data, "invoicedata" => $invoicedata, "companydetails" => $companydetails]);
        } else {
            session()->forget('taskid');
            session()->forget('count');
            return view('common.createrequest')->with(["data" => $data, "invoicedata" => $invoicedata]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                "agency" => "required",
                "inspectiontype" => "required",
                "applicantname" => "required",
                "applicantemail" => "required",
                "applicantmobile" => "required",
                "address" => "required",
                "city" => "required",
                "state" => "required",
                "zipcode" => "required",
                "sendinvoice" => "required",
                "comments" => "required",
            ],
            [
                "required" => "Field is required.",
            ]
        );
        if (!isset($request['id'])) {
            RequestModel::create([
                "company_id" => decrypt($request['agency']),
                "inspectiontype" => $request['inspectiontype'],
                "applicantname" => $request['applicantname'],
                "applicantemail" => $request['applicantemail'],
                "applicantmobile" => $request['applicantmobile'],
                "address" => $request['address'],
                "city" => $request['city'],
                "state" => $request['state'],
                "zipcode" => $request['zipcode'],
                "sendinvoice" => $request['sendinvoice'],
                "comments" => $request['comments'],
            ]);
        } else {
            RequestModel::where("id", decrypt($request['id']))->update([
                "company_id" => decrypt($request['agency']),
                "inspectiontype" => $request['inspectiontype'],
                "applicantname" => $request['applicantname'],
                "applicantemail" => $request['applicantemail'],
                "applicantmobile" => $request['applicantmobile'],
                "address" => $request['address'],
                "city" => $request['city'],
                "state" => $request['state'],
                "zipcode" => $request['zipcode'],
                "sendinvoice" => $request['sendinvoice'],
                "comments" => $request['comments'],
            ]);
            session()->forget('taskid');
        }
        $msg = "Details Saved Successfully";
        return response()->json(array("msg" => $msg), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('admin.request.allrequest');
    }

    public function assign(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => 'required',
            "reqid" => 'required',
        ]);
        if ($validator->fails()) {
            $msg = "OOps! Something Went Wrong";
            return response()->json(array("msg" => $msg), 422);
        } else {
            $current_date_time = Carbon::now()->toDateTimeString();
            RequestModel::where(["id" => decrypt($request['reqid'])])->update([
                "assigned_ins" => decrypt($request['id']),
                "assigned_at" => $current_date_time,
                "status" => "scheduled",
            ]);
            $msg = "Inspector Assigned Successfully";
            return response()->json(array("msg" => $msg), 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                "id" => "required",
                "inspectiontype" => "required",
                "applicantname" => "required",
                "applicantemail" => "required",
                "applicantmobile" => "required",
                "address" => "required",
                "city" => "required",
                "state" => "required",
                "zipcode" => "required",
                "sendinvoice" => "required",
                "comments" => "required",
            ],
            [
                "required" => "Field is required.",
            ]
        );
        RequestModel::where("id", decrypt($request['id']))->update([
            "company_id" => decrypt($request['id']),
            "inspectiontype" => $request['inspectiontype'],
            "applicantname" => $request['applicantname'],
            "applicantemail" => $request['applicantemail'],
            "applicantmobile" => $request['applicantmobile'],
            "address" => $request['address'],
            "city" => $request['city'],
            "state" => $request['state'],
            "zipcode" => $request['zipcode'],
            "sendinvoice" => $request['sendinvoice'],
            "comments" => $request['comments'],
        ]);
        return redirect()->route()->with('msg','Request Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate(
            [
                "id" => 'required',
            ]
        );
        RequestModel::where('id', decrypt($request['id']))->delete();
        $msg = "Deleted Successfully";
        return response()->json(array("msg" => $msg), 200); 
    }


    public function display(Request $request)
    {
        if ($request->ajax()) {
            $GLOBALS['count'] = 0;
            $data = RequestModel::latest()->get(["id", "company_id", "applicantname", "address", "inspectiontype", "created_at", "status", "assigned_ins"]);
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('company_id', function ($row) {
                    $company_name = User::role('company')->where(["id" => $row->company_id])->first("company_name");
                    return (!empty($company_name['company_name'])) ? $company_name['company_name'] : "";
                })
                ->addColumn('inspectiontype', function ($row) {
                    $returnvalue = "";
                    foreach ($row->inspectiontype as $value) {
                        $inspectiontype = Inspectiontype::where(["id" => $value])->first("name");
                        $returnvalue = $returnvalue . $inspectiontype['name'] . "<br>";
                    }
                    return $returnvalue;
                })
                ->addColumn('action', function ($row) {
                    $id = encrypt($row->id);
                    $editlink = route('requestcheck', ['id' => $id]);
                    $btn = "<div class='d-flex justify-content-around'><a href='$editlink' data-id='$id' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit' class='btn limegreen btn-primary  edit'>View</a><a href='javascript:void(0)' data-id='$id' class='ml-2 delete btn red-btn btn-warning'  data-bs-toggle='tooltip' data-bs-placement='top' title='Delete'>Cancel</a><a href='javascript:void(0)' data-id='$id' class='ml-2 delete btn red-btn btn-danger'  data-bs-toggle='tooltip' data-bs-placement='top' title='Delete'>Delete</a></div>";
                    return $btn;
                })
                ->addColumn('assigned_inspector', function ($row) {
                    $returnvalue = "<select class='form-control inspectorlist' name='inspector' id='inspector'><option value=''></option>";
                    $inspectors = User::role('inspector')->pluck("name", "id");
                    foreach ($inspectors as $key => $value) {
                        $select = ((!empty($row->assigned_ins)) && $row->assigned_ins == $key) ? "selected" : "";
                        $returnvalue = $returnvalue . "<option value='" . encrypt($key) . "' data-req-id='" . encrypt($row->id) . "' $select>" . $value . "</option>";
                    }
                    $returnvalue = $returnvalue . "</select>";
                    return $returnvalue;
                })
                ->addColumn('created_at', function ($row) {
                    return date('d-m-Y h:i a', strtotime($row->created_at));
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == "pending") {
                        $class = "btn btn-warning ms-2 status";
                    } elseif ($row->status == "scheduled") {
                        $class = "btn btn-danger ms-2 status";
                    } elseif ($row->status == "completed") {
                        $class = "btn btn-success ms-2 status";
                    }
                    $btntext = ucfirst($row->status);
                    $id = encrypt($row->id);
                    $statusBtn = "<div class='d-flex justify-content-center'><a href='javascript:void(0)' data-id='$id' data-bs-toggle='tooltip' data-bs-placement='top' title='Task $btntext' class='$class'>$btntext</a></div>";
                    return $statusBtn;
                })
                ->rawColumns(['company_id', 'inspectiontype', 'created_at', 'action', 'status', 'assigned_inspector'])
                ->make(true);
        }
    }

    public function upload(Request $request)
    {
            
            if ($request->file('file')) {
            $i = session()->has('count') ? $request->session()->get('count') : 0;
            $i++;
            session(["count" => $i]);
            if($i > 1)
            {
                if (session()->has('taskid')) {
                    $id = $request->session()->get('taskid');
                    $i = 0;
                    $newfilearray = array();
                    $filearray = ($request['type'] == "agencyfiles") ? RequestModel::where('id', $id)->pluck("agency_related_files") : RequestModel::where('id', $id)->pluck("reports_related_files");
                    if (!empty($filearray)) {
                        $files = (is_array($filearray[0])) ? $filearray[0] : (array)$filearray[0];
                        foreach ($files as $newvalue) {
                            array_push($newfilearray, $newvalue);
                        }
                        $rand = rand(10, 5000);
                        $name = $request->file('file')->getClientOriginalName();
                        $fileName = time() . $rand . '.' . $request->file('file')->getClientOriginalExtension();
                        $request->file('file')->move(public_path('taskfiles'), $fileName);
                        array_push($newfilearray, $fileName);
                        ($request['type'] == "agencyfiles") ? RequestModel::where('id', $id)->update(["agency_related_files" => $newfilearray]) : RequestModel::where('id', $id)->update(["reports_related_files" => $newfilearray]);
                        return response()->json(array("msg" => "Added Successfully", "i" => $i), 200);
                    }
                } 
            }
            else if($i == 1) {
                $rand = rand(10, 5000);
                $name = $request->file('file')->getClientOriginalName();
                $filearray = array();
                $fileName = time() . $rand . '.' . $request->file('file')->getClientOriginalExtension();
                $request->file('file')->move(public_path('taskfiles'), $fileName);
                $filearray = $fileName;
                $id = ($request['type'] == "agencyfiles") ? RequestModel::create(["agency_related_files" => $filearray]) : RequestModel::create(["reports_related_files" => $filearray]);
                $request->session()->put('taskid', $id['id']);
                return response()->json(array("id" => encrypt($id['id']), "i" => $i), 200);
            }
        }
    }
    public function requestcheck(Request $request)
    {
        $company = RequestModel::where("id", decrypt($request->id))->first('company_id');
        $companydetails = User::where("id", $company['company_id'])->first();
        $requestdetails = RequestModel::where("id",decrypt($request->id))->first();
        $agencyfiles = RequestModel::where("id", decrypt($request->id))->first("agency_related_files");
        $reportfiles = RequestModel::where("id", decrypt($request->id))->first("reports_related_files");
        $data = Inspectiontype::where("status", "active")->pluck("name", "id");
        $invoicedata = SendInvoice::where("status", "active")->pluck("name", "id");
        return view('admin.request.requeststatus')->with(
            [
                "companydetails" => $companydetails,
                "requestdetails" => $requestdetails,
                "agencyfiles" => $agencyfiles['agency_related_files'],
                "reportfiles" => $reportfiles['reports_related_files'],
                "invoicedata" => $invoicedata,
                "data" => $data 
            ]
        );
    }
}
