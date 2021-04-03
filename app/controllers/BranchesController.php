<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Validator;
use App\Models\QueryBuilder;

class BranchesController {

    public function index() {

        $branches = (new QueryBuilder(App::get('database')))->selectAll('branches');

        return view('branches', ['pagetitle' => 'Branches', 'branches' => $branches]);
    }

    public function store() {

        $queryBuilder = new QueryBuilder(App::get('database'));

        $data = [
            'name' => filter_input(INPUT_POST, 'name'),
            'location' => filter_input(INPUT_POST, 'location')
        ];

        $rules = [
            'name' => ['required', 'maxLen' => 50],
            'location' => ['required', 'maxLen' => 255]
        ];

        $v = new Validator();
        $v->validate($data, $rules);

        if ($v->error()) {
            
            $branches = $queryBuilder->selectAll('branches');

            return view('branches', ['pagetitle' => 'Branches', 'branches' => $branches, 'data' => $data, 'errors' => $v->error()]);
            
        } else {
            
            $queryBuilder->insert('branches', $data);

            redirect('chessable');
            
        }
    }

}
