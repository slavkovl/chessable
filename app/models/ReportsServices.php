<?php

namespace App\Models;

class ReportsServices {
    
    private $pdo;
    
    public function __construct($pdo) {
        
        $this->pdo = $pdo;
        
    }
    
    //Show all branches along with the highest balance at each branch. A branch with no customers should show 0 as the highest balance.
    public function branchesWithHighestBalance() {
        
        $statement = $this->pdo->prepare("select b.*, (select MAX(balance) from users where b.id = users.branch_id) as max_balance from branches as b");

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS);
        
    }
    
    //List just those branches that have more than two customers with a balance over $amount.
    public function branchesWithTwoCustomersMoreThenXAmount($amount) {
        
        $statement = $this->pdo->prepare("select b.* from branches as b where (select count(balance) from users where balance > {$amount} and b.id = users.branch_id) >= 2");

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS);
        
    }
    
}



