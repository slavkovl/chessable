<?php

namespace App\Models;

class QueryBuilder {

    protected $pdo;

    public function __construct($pdo) {

        $this->pdo = $pdo;
    }

    public function selectAll($table) {

        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    public function insert($table, $parameters) {

        $sql = sprintf(
                'insert into %s (%s) values (%s)',
                $table,
                implode(', ', array_keys($parameters)),
                ':' . implode(', :', array_keys($parameters))
        );

        try {

            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (\Exception $e) {

            die('Something went wrong: ' . $e->getMessage());
        }
    }
    
    public function selectAndLeftJoin($select, $fromTable, $joinTables) {

        try {
            $statement = $this->pdo->prepare("select "
                    . implode(',', $select)
                    . " from {$fromTable}"
                    . implode(' ', array_map(function($table, $on) {
                        return " left join {$table} on ({$on})";
                    }, array_keys($joinTables), $joinTables))
            );

            $statement->execute();
            
        } catch (\Exception $e) {
            
            die('Something went wrong: ' . $e->getMessage());
        }
        
        return $statement->fetchAll(\PDO::FETCH_CLASS);

    }

}