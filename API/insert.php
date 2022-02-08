<?php
header('Access-Control-ALlow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: *");

require_once('./database/database.php');
$tableName = 'diaryEntries';
$path = './database.db';

if ($_POST['entry']) {
    $entry = $_POST['entry'];
    insertIntoDatabase(
        $path,
        '
    INSERT INTO ' . $tableName . '(entry) VALUES("' . $entry . '");'
    );
}
