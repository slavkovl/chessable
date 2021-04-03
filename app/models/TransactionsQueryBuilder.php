<?php

namespace App\Models;

class TransactionsQueryBuilder extends QueryBuilder {
    
    public function __construct($pdo) {
        parent::__construct($pdo);
    }
    
    public function selectAll($table) {

        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }
    
    public function makeTransfer($from, $to, $amount) {
        
        try {  
            $this->pdo->beginTransaction();
            $this->pdo->exec("UPDATE users SET balance=(balance - {$amount}) WHERE id={$from};");
            $this->pdo->exec("UPDATE users SET balance=(balance + {$amount}) WHERE id={$to};");
            $this->pdo->commit();
            
            return ['success' => true];
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            
            return ['success' => false, 'message' => $e->getMessage()];
        }
        
        
    } 
    
}