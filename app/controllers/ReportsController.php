<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\ReportsServices;


class ReportsController {
    
    public function index() {
        
        $amount = 50000;
        
        $reportsService = new ReportsServices(App::get('database'));
        
        return view('reports', [
            
            'amount' => $amount,
            
            'pagetitle' => 'Reports', 
            
            'branchesWithHighestBalance' => $reportsService->branchesWithHighestBalance(),
            
            'branchesWithTwoCustomersMoreThenXAmount' => $reportsService->branchesWithTwoCustomersMoreThenXAmount($amount)
                
        ]);
        
    }
    
    
}
