<?php

namespace App\Http\Controllers\vendor\Chatify;

use App\Http\Controllers\Controller;
use App\Models\ChMessage;
use Illuminate\Http\Request;
use DataTables;
use DB;

class MessagesListController extends Controller
{
    /**AGENCY MODULE */
    // show the all agency messages list
    public function index()
    {
     return view('admin.agency.agencyAllMessagesList');
    }

    //agency display- getting data from ajax
    public function agencyDisplay(Request $request)
    {
        //    dd($request->all());
        if ($request->ajax()) {
            $GLOBALS['count'] = 0;
        
            $data=DB::table('ch_messages')->join('users', 'users.id', '=', 'ch_messages.from_id')->where('type','company')->groupBy('ch_messages.from_id')->get();
            // dd($data);
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('message', function($row){
                $id = $row->id;
                $chatlink =route('chatify') . '/' . $id;
                $btn = "<div class='d-flex justify-content-around'>
                <a href='$chatlink' data-id='$id' data-bs-toggle='tooltip' data-bs-placement='top'
                 title='Open Chat' class='btn limegreen btn-primary  edit'>Open Chat &nbsp;<i class='fas fa-edit'></i></a>
                </div>";
                return $btn;
            })->rawColumns(['id','message'])
            ->make(true);
        }
    }

    /**INSPECTOR MODULE */
    // show the all agency messages list
    public function inspectorView()
    {
     return view('admin.inspector.inspectorAllMessagesList');
    }

      //agency display- getting data from ajax
      public function inspectorDisplay(Request $request)
      {
            //  dd($request->all());
          if ($request->ajax()) {
              $GLOBALS['count'] = 0;
     
            
            $data=DB::table('ch_messages')->join('users', 'users.id', '=', 'ch_messages.from_id')->where('type','inspector')->groupBy('ch_messages.from_id')->get();
             
              return Datatables::of($data)->addIndexColumn()
              ->addColumn('message', function($row){
                  $id = $row->id;
                  $chatlink =route('chatify') . '/' . $id;
                  $btn = "<div class='d-flex justify-content-around'>
                  <a href='$chatlink' data-id='$id' data-bs-toggle='tooltip' data-bs-placement='top'
                   title='Open Chat' class='btn limegreen btn-primary  edit'>Open Chat &nbsp;<i class='fas fa-edit'></i></a>
                  </div>";
                  return $btn;
              })->rawColumns(['id','message'])
              ->make(true);
          }
      }
}
