<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\Application;
use App\Models\Leave;
use App\Models\User;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        //$applications = Application::where('user_id', $user->id)->get();
        $applications = $user->applications;
        return view('application.staff.application_index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $application = new Application;
        $leaves = Leave::where('status', 1)->get();
        return view('application.staff.application_form', compact('application','leaves'));
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
            "leave_id" => "required|exists:leaves,id",
            "date_from" => "required|date_format:Y-m-d",
            "date_to" => "required|date_format:Y-m-d",
            "remark" => "nullable",
        ]);

        $user = Auth::user();
        $application = new Application;

        $application->user_id = $user->id;
        $application->leave_id = $request['leave_id'];
        $application->date_from = $request['date_from'];
        $application->date_to = $request['date_to'];
        $application->remark = $request['remark'];
        $application->save();

        Session()->flash('success-msg', 'Leave has been succesffully saved');

        return redirect()->route('staff.application.index');
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
        //
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
        //
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
