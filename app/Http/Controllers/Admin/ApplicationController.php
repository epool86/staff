<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Excel;

use App\Models\Application;
use App\Models\Leave;
use App\Exports\AllApplicationExport;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $month = isset($_GET['month']) ? $_GET['month'] : 'ALL';
        $year = isset($_GET['year']) ? $_GET['year'] : 'ALL';
        $status = isset($_GET['status']) ? $_GET['status'] : 'ALL';

        $applications = Application::query();

        if($search){

            $applications = $applications->where(function($q) use ($search){

                $q->where('remark', 'LIKE', '%'.$search.'%');

                $q->orWhereHas('user', function($q) use ($search){
                        $q->where('name', 'LIKE', '%'.$search.'%');
                        $q->orWhere('email', 'LIKE', '%'.$search.'%');
                });

            });
        }

        if($month != 'ALL'){
            $applications = $applications->whereMonth('date_from', $month);
        }
        
        if($year != 'ALL'){
            $applications = $applications->whereYear('date_from', $year);
        }

        if($status != 'ALL'){
            $applications = $applications->where('status', $status);
        }

        $applications = $applications->paginate(10);
        $total_result = $applications->count();

        //dd([
        //    $applications->toSql(), 
        //    $applications->getBindings()
        //]);

        return view('application.admin.application_index', compact('applications','search','month','year','status','total_result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    public function exportExcel(){

        $status = isset($_GET['status']) ? $_GET['status'] : 'ALL';

        if($status != 'ALL'){
            $applications = Application::where('status', $status)->get();
        } else {
            $applications = Application::all();
        }

        return Excel::download(new AllApplicationExport($applications), 'all_applications.xlsx');

    }
}
