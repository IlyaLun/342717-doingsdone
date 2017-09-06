<?php

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

?>