<div class="modal">
    <button class="modal__close" type="button" name="button">Закрыть</button>

    <h2 class="modal__heading">Добавление задачи</h2>

    <form class="form" action="/../index.php" method="POST" enctype="multipart/form-data">
        <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>
            <span class='error-massage'><?php if (in_array('task', $form_error)): ?>Поле заполнено неверно<?php endif; ?>
                </span>
            <input class="form__input <?php if (in_array('task', $form_error)): ?>form__input--error<?php endif; ?>"
                   type="text" name="task" id="name" value="<?= htmlspecialchars($_POST['task']) ?>"
                   placeholder="Введите название">
        </div>

        <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>
            <span class='error-massage'><span
                        class='form__error'><?php if (in_array('category', $form_error)): ?>Поле заполнено неверно<?php endif; ?>
                    </span>
            <select class="form__input form__input--select <?php if (in_array('category', $form_error)): ?>form__input--error<?php endif; ?>"name="category" id="project">

                <?php foreach ($categories as $key => $value) : ?>
                    <?php if ($value != 'Все') : ?>
                        <option value="<?= $value ?>" <?php if ($_POST['category'] == $value): ?>selected<?php endif; ?>''><?= $value ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>

            </select>
        </div>

        <div class="form__row">
            <label class="form__label" for="date">Дата выполнения <sup>*</sup></label>
            <span  class='error-massage'><?php if (in_array('deadline', $form_error)): ?>Поле заполнено неверно<?php endif; ?></span>
            <input class="form__input form__input--date <?php if (in_array('deadline', $form_error)): ?>form__input--error<?php endif; ?>" type="text" name="deadline" id="date" value="<?=htmlspecialchars($_POST['deadline'])?>" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
        </div>

        <div class="form__row">
            <label class="form__label">Файл</label>

            <div class="form__input-file">
                <input class="visually-hidden" type="file" name="preview" id="preview" value="">

                <label class="button button--transparent" for="preview">
                    <span>Выберите файл</span>
                </label>
            </div>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="send" value="Добавить">
        </div>
    </form>
</div>
