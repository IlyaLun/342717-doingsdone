<?php

session_start();

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

$days = rand(-3, 3);

$task_deadline_ts = strtotime("+" . $days . " day midnight"); // метка времени даты выполнения задачи

$current_ts = strtotime('now midnight'); // текущая метка времени

// запишите сюда дату выполнения задачи в формате дд.мм.гггг
$date_deadline = date("d.m.Y", $task_deadline_ts);

// в эту переменную запишите кол-во дней до даты задачи
$days_until_deadline = floor(($task_deadline_ts - $current_ts) / 86400);

// Добавим простой массив проектов
$categories = ["Все", "Входящие", "Учеба", "Работа", "Домашние дела", "Авто"];

// Добавим двумерный массив
$tasks = [
    [
        'task' => 'Собеседование в IT компании',
        'deadline' => '01.06.2018',
        'category' => 'Работа',
        'done' => false
    ],
    [
        'task' => 'Выполнить тестовое задание',
        'deadline' => '25.05.2018',
        'category' => 'Работа',
        'done' => false
    ],
    [
        'task' => 'Сделать задание первого раздела',
        'deadline' => '21.04.2017',
        'category' => 'Учеба',
        'done' => true
    ],
    [
        'task' => 'Встреча с другом',
        'deadline' => '30.08.2017',
        'category' => 'Входящие',
        'done' => false
    ],
    [
        'task' => 'Купить корм для кота',
        'deadline' => 'Нет',
        'category' => 'Домашние дела',
        'done' => false
    ],
    [
        'task' => 'Заказать пиццу',
        'deadline' => 'Нет',
        'category' => 'Домашние дела',
        'done' => false
    ]
];

if (isset($_GET['category']) && !array_key_exists(intval($_GET['category']), $categories)) {
    http_response_code(404);
}

$tasks_list = [];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (!empty($_POST)) {
        $fields = [
            'task',
            'deadline',
            'category'
        ];
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                $errors[] = $field;
            } else {
                if ($field == 'deadline') {
                    if ($_POST[$field] !== date('d.m.Y', strtotime($_POST[$field]))) {
                        $errors[] = $field;
                    }
                }
            }
        }
        if (empty($errors)) {
            if ($_FILES[$preview]['error'] == UPLOAD_ERR_OK) {
                $file_name = $_FILES['preview']['name'];
                $file_path = __DIR__ . '/';
                $file_transfer - move_uploaded_file($_FILES['preview']['tmp_name'], $file_path . $file_name);
            }
            $add_task = [
                'task' => $_POST['task'],
                'deadline' => $_POST['deadline'],
                'category' => $_POST['category'],
                'done' => false
            ];
            array_unshift($tasks, $add_task);
        }
    }
};

require_once 'functions.php';

require_once 'userdata.php';

if (isset($_GET['add']) || !empty($errors)) {
    $form = renderTemplate('templates/form.php', ['categories' => $categories, 'form_error' => $errors]);
} else {
    $form = '';
}

$loginError = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send'])) {
    $fields = [
        'email',
        'password'
    ];
    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $loginError[] = $field;
        } else {
            if ($field == 'email' && !emailValidate($_POST[$field])) {
                $loginError[] = $field;
            }
        }
    }
    if (empty($loginError)) {
        $user = searchUserByEmail($_POST['email'], $users);
        if (!empty($user) && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: /index.php");
        } else {
            $loginError[] = 'password_verify';
        }
    }
};

if (($_GET['login'] == 1) || !empty($loginError)) {
    $guestContent = renderTemplate('templates/guest_form.php', ['form_error' => $loginError]);
} else {
    $guestContent = '';
};

foreach ($tasks as $key => $value) {
    if ($categories[intval($_GET['category'])] == 'Все' || $categories[intval($_GET['category'])] == $value['category']) {
        $tasks_list[] = $value;
    }
}

if ($_SESSION['user']) {
    $page_content = renderTemplate('templates/index.php', ['tasks' => $tasks_list, 'categories' => $categories, 'show_complete_tasks' => $show_complete_tasks, 'current_ts' => $current_ts]);
} else {
    $page_content = renderTemplate('templates/guest.php', ['guestContent' => $guestContent]);
}

$layout_content = renderTemplate('templates/layout.php', ['user' => $user, 'guestContent' => $guestContent, 'form' => $form, 'tasks' => $tasks, 'categories' => $categories, 'content' => $page_content, 'title' => 'Дела в порядке!']);

print ($layout_content);

?>


