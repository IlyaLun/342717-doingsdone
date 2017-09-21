# добавление категорий
INSERT INTO category (title, user_id) VALUES
  ('Входящие', '1'),
  ('Учеба', '1'),
  ('Работа', '1'),
  ('Домашние дела', '1'),
  ('Авто', '1');

# добавление пользователей
INSERT INTO users (email, name, password, date_registration) VALUES
  ('ignat.v@gmail.com', 'Игнат', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', CURDATE()),
  ('kitty_93@li.ru', 'Леночка', '2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', CURDATE()),
  ('warrior07@mail.ru', 'Руслан', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', CURDATE());

# добавление задач
INSERT INTO task (date_of_creation, date_of_completion, title, deadline, category_id, user_id) VALUES
  (CURDATE(), NULL, 'Собеседование в IT компании', '2018-06-01', '3', '1'),
  (CURDATE(), NULL, 'Выполнить тестовое задание', '2018-05-25', '3', '1'),
  (CURDATE(), CURDATE(), 'Сделать задание первого раздела', '2017-04-21', '2', '1'),
  (CURDATE(), NULL, 'Встреча с другом', '2017-08-30', '1', '1'),
  (CURDATE(), NULL, 'Купить корм для кота', NULL, '4', '1'),
  (CURDATE(), NULL, 'Заказать пиццу', NULL, '4', '1');

# получить список из всех проектов для одного пользователя;
SELECT title, deadline FROM task WHERE user_id = 1 ORDER by deadline;

# получить список из всех задач для одного проекта;
SELECT title, deadline FROM task WHERE category_id = 4 ORDER by deadline;

# пометить задачу как выполненную;
UPDATE task SET date_of_completion = CURDATE() WHERE id = 1;

# получить все задачи для завтрашнего дня;
SELECT title, deadline FROM task WHERE deadline = CURDATE() + INTERVAL 1 DAY;

# обновить название задачи по её идентификатору.
UPDATE task SET title = 'New title' WHERE id = 1;
