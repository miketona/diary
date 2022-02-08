<?php
if (!class_exists('database')) {
    class database extends SQLite3
    {
        function __construct($path)
        {
            $this->open($path);
        }
    }
}
//create a table
function createTable($path, $tableData)
{
    $db = new database($path);
    if (!$db) {
        echo 'ERROR: Database does not exist';
        exit();
    }
    $sql = "CREATE TABLE " .  $tableData . ";";
    $response = $db->exec($sql);
    if ($response == false) {
        echo "Error! Table creation failed";
        die();
    } else {
        echo "Sql : " . $sql . " \n has been run successfully";
    }
}
function insertIntoDatabase($path, $sql)
{
    $db = new database($path);
    if (!$db) {
        echo 'ERROR: Database does not exist';
        exit();
    }
    $response = $db->exec($sql);
    if ($response == false) {
        echo "Error! Insert statement failed";
        die();
    } else {
        echo "Sql : " . $sql . " \n has been run successfully";
    }
}
function deleteFromDatabase($path, $sql)
{
    $db = new database($path);
    if (!$db) {
        echo 'ERROR: Database does not exist';
        exit();
    }
    $response = $db->exec($sql);
    if ($response == false) {
        echo "Error! Delete statement failed";
        die();
    } else {
        echo "Sql : " . $sql . " \n has been run successfully";
    }
}
function selectFromDatabase($path, $sql)
{
    $db = new database($path);
    if (!$db) {
        echo 'ERROR: Database does not exist';
        exit();
    }
    $response = $db->query($sql);
    if ($response == false) {
        echo "Error! Select failed";
        die();
    }
    $data = [];
    while ($row = $response->fetchArray(SQLITE3_ASSOC))
        array_push($data, $row);
    return $data;
}
