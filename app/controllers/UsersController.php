<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Validator;
use App\Models\QueryBuilder;

class UsersController {

    private $allUsersQuery = [
        
        ['users.*', 'branches.name as branch_name'],
        
        'users',
        
        ['branches' => 'users.branch_id=branches.id']
    ];

    public function index() {

        $queryBuilder = new QueryBuilder(App::get('database'));

        $users = $queryBuilder->selectAndLeftJoin(...$this->allUsersQuery);

        $branches = $queryBuilder->selectAll('branches');

        return view('users', ['pagetitle' => 'Users', 'users' => $users, 'branches' => $branches]);
    }

    public function store() {

        $queryBuilder = new QueryBuilder(App::get('database'));

        $branches = $queryBuilder->selectAll('branches');

        $data = [
            'branch_id' => filter_input(INPUT_POST, 'branch_id'),
            'firstname' => filter_input(INPUT_POST, 'firstname'),
            'lastname' => filter_input(INPUT_POST, 'lastname'),
            'balance' => filter_input(INPUT_POST, 'balance')
        ];

        $rules = [
            'branch_id' => ['in' => array_map(function ($o) {
                    return $o->id;
                }, (array) $branches)],
            'firstname' => ['required', 'maxLen' => 50],
            'lastname' => ['required', 'maxLen' => 50],
            'balance' => ['amount']
        ];

        $v = (new Validator());
        $v->validate($data, $rules);

        if ($v->error()) {
            $users = $queryBuilder->selectAndLeftJoin(...$this->allUsersQuery);
            
            return view('users', ['pagetitle' => 'Users', 'users' => $users, 'branches' => $branches, 'data' => $data, 'errors' => $v->error()]);
        } else {
            $queryBuilder->insert('users', $data);

            redirect('chessable/users');
        }
    }

}
