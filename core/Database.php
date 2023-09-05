<?php
namespace Core;

use PDO;
use PDOException;

class Database
{   
    /**
     * Initialize database driver
     * 
     * @var PDO $dbDriver
     */
    private $dbDriver = null;

    /**
     * Initialize Database driver   
     */
    public function __construct() {
        $dbConfigVars = (object) require_once(dirname(__DIR__) . '/config/database.php');
           
        $dbConnectionStr = $dbConfigVars->driver
            . ':host=' . $dbConfigVars->host
            . ';dbname=' . $dbConfigVars->database
            . ';charset=' . $dbConfigVars->charset;

        try {
            $pdo = new PDO($dbConnectionStr, $dbConfigVars->username, $dbConfigVars->password);
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage(), $exception->getCode());
        }
        
        $this->dbDriver = $pdo;
    }

    /**
     * Execute or fetch data using sql query and parameters
     * *using prepare statements
     * 
     * @param string $query
     * @param array $params
     * @return bool|array
     */
    public function executeQuery(string $query, array $params = []): bool|array
    {
        try {
            $db = $this->dbDriver;
            
            $prepareStatement = $db->prepare($query);

            $status = $prepareStatement->execute($params);
            // $response = (explode(" ", trim($query)[0] === "SELECT")) ? $prepareStatement->fetchAll() : $status;
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage(), $exception->getCode());
        }
        // $this->dbDriver = null;
        return (explode(" ", trim($query)[0] === "SELECT")) ? $prepareStatement->fetchAll(PDO::FETCH_ASSOC) : $status;
    }

    /**
     * Execute SELECT query
     * *Get data from the database
     * 
     * @param string $table
     * @param array $dataTableColumns
     * @param array $whereClauses
     * @return array
     */
    public function select(string $table, array $dataTableColumns, array $whereClauses = []): array
    {
        $columnsToSelect = implode(',', $dataTableColumns);
        $query = "SELECT $columnsToSelect FROM $table";
        $prepareStatementParams = [];
        
        if (!empty($whereClauses)) {
            $query .= " WHERE ";

            $prepareStatementWhereClauses = array_map(function ($whereClause) {
                
                $whereClause[count($whereClause) - 1] = ':' . $whereClause[0];
                
                return implode('', $whereClause);
            }, $whereClauses);
            $whereClausesStr = implode(' AND ', $prepareStatementWhereClauses);
            
            $query .= $whereClausesStr;
            
            foreach ($whereClauses as $whereClause ) {

                $prepareStatementParams[':' . $whereClause[0]] = $whereClause[count($whereClause) - 1];
                
            }
        }
         
        return $this->executeQuery($query, $prepareStatementParams);
    }

    /**
     * Execute INSERT query
     * *Insert data into the database
     * 
     * @param string $table
     * @param array $values
     * @return array|bool
     */
    public function insert(string $table, array $values)
    {
        $query = "INSERT INTO $table";
        $tableColumns = array_keys($values);
        $prepareStatementColumnsStr = implode(', ', $tableColumns);
        $prepareStatementParams = [];

        $query .= "($prepareStatementColumnsStr) ";

        $prepareStatementValuesStr = implode(', ', array_map(function ($tableColumn) {
                
            return ':' . $tableColumn;
        }, $tableColumns));

        $query .= " VALUES($prepareStatementValuesStr) ";

        foreach ($values as $column => $value) {

            $prepareStatementParams[':' . $column] = $value;
            
        }

        return $this->executeQuery($query, $prepareStatementParams);
    }

    /**
     * Execute UPDATE query
     * *update data from the table
     * 
     * @param string $table
     * @param array $dataToUpdate
     * @param array $whereClauses
     * @return array|bool
     */
    public function update(string $table,  array $dataToUpdate, array $whereClauses)
    {
        // UPDATE `scheduled_events` SET `id`='[value-1]',`event`='[value-2]',`scheduled_at`='[value-3]',`status`='[value-4]',`created_at`='[value-5]',`updated_at`='[value-6]' WHERE 1

        $query = "UPDATE $table ";
        $tableColumns = array_keys($dataToUpdate);
        $prepareStatementParams = [];

        $prepareStatementUpdateSet = array_map(function ($column) {
            return "$column=:update_set_$column";
        }, $tableColumns);
        $prepareStatementUpdateSetStr = implode(', ', $prepareStatementUpdateSet);
        $query .= "SET $prepareStatementUpdateSetStr ";

        $prepareStatementWhereClauses = array_map(function ($whereClause) {
                
            $whereClause[count($whereClause) - 1] = ':where_clause_' . $whereClause[0];
            
            return implode('', $whereClause);
        }, $whereClauses);
        $whereClausesStr = implode(' AND ', $prepareStatementWhereClauses);
        $query .= "WHERE $whereClausesStr";

        foreach ($dataToUpdate as $column => $value) {

            $prepareStatementParams[":update_set_$column"] = $value;
            
        }

        foreach ($whereClauses as $whereClause ) {

            $prepareStatementParams[':where_clause_' . $whereClause[0]] = $whereClause[count($whereClause) - 1];
            
        }
        // var_dump($query, $prepareStatementParams);
        // die;
        return $this->executeQuery($query, $prepareStatementParams);
    }

    /**
     * Execute DELETE query
     * *Delete data from the database
     * 
     * @param string $table
     * @param int $rowId
     * @return array|bool
     */
    public function delete(string $table, int $rowId)
    {
        $query = "DELETE FROM $table WHERE id=:id";
        return $this->executeQuery($query, [':id' => $rowId]);   
    }
}
