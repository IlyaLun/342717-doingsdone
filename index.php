<?php
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

require_once 'functions.php';

$page_content = renderTemplate('templates/index.php', ['tasks' => $tasks, 'show_complete_tasks' => $show_complete_tasks, 'current_ts' => $current_ts]);

$layout_content = renderTemplate('templates/layout.php', ['tasks' => $tasks, 'categories' => $categories, 'content' => $page_content, 'title' => 'Дела в порядке!']);

print ($layout_content);

?>


