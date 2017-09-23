<?php

require_once 'userdata.php';

$show_complete_tasks = $_COOKIE['show_completed'];

function getCountTask($list, $category)
{
    $result = 0;
    if ($category == 'Все') {
        $result = count($list);
    } else {
        foreach ($list as $key => $value) {
            if ($value['category'] == $category) {
                $result++;
            }
        }

    }
    return $result;
}

;

function renderTemplate($templateDir, $templateData)
{
    if (!file_exists($templateDir)) {
        return ('');
    } else {
        ob_start();
        extract($templateData);
        require_once $templateDir;
        return ob_get_clean();

    }
}

function emailValidate($value)
{
    return filter_var($value, FILTER_VALIDATE_EMAIL);
}

;

function searchUserByEmail($email, $users)
{
    $result = null;
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            $result = $user;
            break;
        }
    }
    return $result;
}

function selectData($connect, $sql, $data = []) {
    $result = [];
    $stmt = db_get_prepare_stmt($connect, $sql, $data);
    if ($stmt && mysqli_stmt_execute($stmt)) {
        $result = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    }
    return $result;
}

function insertData($connect, $table, $data) {
    $result = false;
    $columns = array_keys($data);
    $values = array_values($data);
    $placeholders = array_fill(0, count($values), '?');
    $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $columns) .') VALUES (' . implode(', ', $placeholders) .')';
    $stmt = db_get_prepare_stmt($connect, $sql, $values);
    if ($stmt && mysqli_stmt_execute($stmt)) {
        $result = mysqli_insert_id($connect);
    }
    return $result;
}

function execQuery($connect, $sql, $data = []) {
    $stmt = db_get_prepare_stmt($connect, $sql, $data);
    return ($stmt && mysqli_stmt_execute($stmt));
}

;

?>
