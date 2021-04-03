<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Validator;
use App\Models\TransactionsQueryBuilder;

class TransactionsController {

    private $allTransactionsQuery = [
        [
            'transactions.*',
            'DATE_FORMAT(`date`,\'%d/%m/%y %H:%i\') AS `f_date`',
            'user_from.firstname as ufrom_firstname',
            'user_from.lastname as ufrom_lastname',
            'user_to.firstname as uto_firstname',
            'user_to.firstname as uto_lastname'
        ],
        'transactions',
        [
            'users as user_from' => 'transactions.from_user=user_from.id',
            'users as user_to' => 'transactions.to_user=user_to.id'
        ]
    ];

    public function index() {

        $queryBuilder = new TransactionsQueryBuilder(App::get('database'));

        $transactions = $queryBuilder->selectAndLeftJoin(...$this->allTransactionsQuery);

        $users = $queryBuilder->selectAll('users');

        return view('transactions', ['pagetitle' => 'Transactions', 'transactions' => $transactions, 'users' => $users]);
    }

    public function store() {

        $queryBuilder = new TransactionsQueryBuilder(App::get('database'));

        $users = $queryBuilder->selectAll('users');

        $data = [
            'from_user' => filter_input(INPUT_POST, 'from_user'),
            'to_user' => filter_input(INPUT_POST, 'to_user'),
            'amount' => filter_input(INPUT_POST, 'amount')
        ];

        $rules = [
            'from_user' => ['in' => array_map(function ($o) {
                    return $o->id;
                }, (array) $users),
                'notequal' => $data['to_user']],
            'to_user' => ['in' => array_map(function ($o) {
                    return $o->id;
                }, (array) $users)],
            'amount' => ['amount', 'min' => 0.01]
        ];

        $v = new Validator();
        $v->validate($data, $rules);

        if ($v->error()) {
            
            return view('transactions', [
                'pagetitle' => 'Transactions',
                'users' => $users,
                'transactions' => $queryBuilder->selectAndLeftJoin(...$this->allTransactionsQuery),
                'data' => $data,
                'errors' => $v->error()
            ]);
            
        } else {

            $transferRes = $queryBuilder->makeTransfer($data['from_user'], $data['to_user'], $data['amount']);

            if ($transferRes['success']) {
                
                $queryBuilder->insert('transactions', $data);
                redirect('chessable/transactions');
                
            } else {
                
                return view('transactions',
                        [
                            'pagetitle' => 'Transactions',
                            'users' => $users,
                            'transactions' => $queryBuilder->selectAndLeftJoin(...$this->allTransactionsQuery),
                            'data' => $data,
                            'errors' => ["error" => ['Amount is out of the range']]
                        ]
                );
                
            }
        }
    }

}
