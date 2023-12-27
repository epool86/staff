<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Application;

class AllApplicationExport implements FromView
{

    protected $applications;

    function __construct($applications){
        $this->applications = $applications;
    }

    public function view(): View
    {
        return view('application.admin.application_excel', [
            'applications' => $this->applications,
        ]);
    }

}
