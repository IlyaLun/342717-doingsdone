<?php

require_once 'userdata.php';

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

;

?>