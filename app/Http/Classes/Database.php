<?php
namespace App\Http\Classes;
use Illuminate\Support\Facades\DB;
use Exception;
class Database {
  public function __construct(private string $table) {
    
  }


  public function select($field, $value) {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value';

    $values = [
        'value' => $value
    ];

    $select = DB::select($query, $values);
    return $select;
  }

  public function selectColsFrom(array $values, $field, $token) {
    $query = 'SELECT ';
    foreach ($values as $key => $value) {
      
      $query .= $value . ', ';
      
    }
    $query = rtrim($query, ', ');
    
    $query .= ' FROM ' . $this->table . ' WHERE ' . $field . ' = :value';
    $params = [
      'value' => $token
    ];
    $selectColsFrom = DB::select($query, $params);

    return $selectColsFrom;
  }

  private function insert(array $values) {
    /* dymanic query but have to pass NULL at the beginning and end to handle auto incrementing primay key column and timestamp - currently can't get them to work without having to pass nulls - found that when writing queries like this doesn't work with Laravel in terms of the positioning of the placeholders, so we'll have to use the Laravel facade for querying here */
    /*try {
      $query = 'INSERT INTO ' . $this->table . ' VALUES (NULL, ';
      foreach ($values as $key => $value) {
        $query .= ':' . $key . ', ';
      }

      $query .= 'NULL, NULL)';
      
      $insert = DB::insert($query, $values);
      return $insert;
    } catch (Exception $e) {
        return 0;
    }*/



    /* Laravel style */
   

    try { 
      $insert = DB::table($this->table)->insert($values);
      return $insert;
    } catch (Exception $e) {
      return 0;
    }
  }

  public function update(array $values, string $field, $value) {
    $query = 'UPDATE ' . $this->table . ' SET ';
    foreach ($values as $key => $value) {
      $query .= $key . ' = ' . $value . ', ';
    }

    $query = rtrim($query, ', ');
    $query .= ' WHERE ' . $field . ' = ' . $value;
    $update = DB::update($query);
    return $update;
  }

  public function save(array $values, $type = NULL) {
    switch ($type) {
      case 'delete':
        return $this->delete($values);
      case 'insert':
        return $this->insert($values);
      default:
        return false;
    }
  }

  /* new function to use here, so that we can use transactional queries to rollback if any errors are detected during adding the sheets data  */
  private function processTransactionalQuery(array $queries) {
    try {
      DB::transaction(function($q) use ($queries) {   
        foreach($queries as $key => $val) {
          /* passing the "type" doesn't seem to work so have to hardcode the query as "insert" */
          DB::table($val['table'])->insert($val['values']);
        }
      });
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  public function saveTransactionalQuery(array $queries) {
    return $this->processTransactionalQuery($queries);
  }

  private function delete($values) {
    $query = 'DELETE FROM ' . $this->table . ' WHERE ';
    foreach ($values as $key => $val) {
      $query .= $key . ' = ' . '"' . $val . '"';
    }
    $delete = DB::delete($query);
  }

  public function selectAll() {
    $query = 'SELECT * FROM ' . $this->table;
    $selectAll = DB::select($query);
    return $selectAll;
  }

  public function showColsExclude(array $values) {
    $query = 'SHOW COLUMNS FROM ' . $this->table . ' WHERE Field NOT IN (';
    foreach ($values as $key => $val) {
      $query .= '"' . $val . '"' . ', ';
    } 
    $query = rtrim($query, ', ');
    $query .= ')';
    $showCols = DB::select($query);
    return $showCols;
  }

  public function tableExists() {
    $query = 'SHOW TABLES LIKE "' .  $this->table . '"';
    $tableExists = DB::select($query);
    if (!empty($tableExists)) {
      return $tableExists;
    }
  }
  
}