<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Companies;
use App\Events;
use DataTables;

class UserController extends Controller
{
    public function index(){
        //controller to call dasboard
        $title = "dasboard";
        return view('main', compact('title'));
    }
    public function data(){
        //get data for datatables
        $users = user::latest()->get();
        return Datatables::of($users)
        ->addColumn('name', function ($users) {
            $update = $users->first_name." ".$users->last_name;
            return $update;
        })
        ->addColumn('action', function ($users) {
            return '<a href="user/edit/'.$users->user_id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })
        ->addColumn('companies', function ($users) {
            $update = $users->companies->name;
            return $update;
        })
        ->editColumn('id', 'user_id: {{$user_id}}')
        ->rawColumns(['companies','name', 'action'])
        ->make(true);
    }
    public function add_form(){
        //controller to call form add
        $title = "Add";
        return view('add', compact('title'));
    }
    public function add_process(Request $request){
        //validation add user
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'companies' => 'required',
            'events' => 'required'
        ]);
        
        //prosess insert users
        $users = new user;
        $users->first_name = $request->first_name;
        $users->last_name = $request->last_name;
        $users->id_companies = $request->companies;
        $users->save();
        $data=$users->user_id;
        
        //prosess update event with user_id
        foreach ($request->events as $event) {
            $event = events::find($event);
            $event->user_id = $users->user_id;
            $event->save();
        }

        //return to dashboard
        return redirect('/')->with('status','User Created!!');
    }
    public function loadDataCompanies(Request $request)
    {
        //get data for dropdown ajax companies
        if ($request->has('q')) {
            $cari = $request->q;
            $data = companies::Where('name', 'like', '%'.$cari.'%')->get();
            return response()->json($data);
        }
    }
    public function loadDataEvents(Request $request)
    {
        //get data for dropdown ajax companies
        if ($request->has('q')) {
            $cari = $request->q;
            $data = events::Where('name', 'like', '%'.$cari.'%')->Where('user_id',0)->get();
            return response()->json($data);
        }
    }
    public function edit(Request $request){
        //controller to call form edit

        //find user data for form edit
        $users = user::where('user_id',$request->id)->first();

        //find event data for form edit
        $event = events::latest()->get();

        //find companiess for form edit
        $companies = companies::latest()->get();

        $title = "Edit";

        //return to view with data
        return view('edit', compact(array('users', 'event', 'companies','title')));
        
    }
    public function edit_process(Request $request){
        
        //validation update user
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'companies' => 'required',
            'events' => 'required'
        ]);

         //update data user
        $users = user::find($request->id);
        $users->first_name = $request->first_name;
        $users->last_name = $request->last_name;
        $users->id_companies = $request->companies;
        $users->save();
        
        //clear data event with user_id for refresh
        events::where('user_id',$request->id)
        ->update([
            'user_id' => 0
        ]);
        
        //update new data event with users
        foreach ($request->events as $event) {
            $event = events::find($event);
            $event->user_id = $request->id;
            $event->save();
        }

        //return to dashboard
        return redirect('/')->with('status','User Updated!!');;
    }
}
