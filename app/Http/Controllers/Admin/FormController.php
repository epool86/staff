<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function viewForm(){

        return view('application.admin.form');
        
    }

    public function submitForm(Request $request){

        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'nullable|email',
            'gender' => 'required|in:male,female',
        ],[
            'name.required' => 'Ruangan nama adalah wajib',
            'name.min' => 'Nama tak boleh pendek',
            'email.email' => 'Email tidak sah',
        ]);

    }
}
