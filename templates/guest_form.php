<div class="modal">
    <button class="modal__close" type="button" name="button">Закрыть</button>

    <h2 class="modal__heading">Вход на сайт</h2>

    <form class="form" class="" action="/../index.php" method="POST" enctype="application/x-www-form-urlencoded">
        <div class="form__row">
            <label class="form__label" for="email">E-mail <sup>*</sup></label>
            <span class='error-massage'><?php if (in_array('email', $form_error)): ?>Поле заполнено неверно<?php endif; ?></span>
            <input class="form__input <?php if (in_array('email', $form_error)): ?>form__input--error<?php endif; ?>"
                   type="text"
                   name="email" id="email" value="<?= htmlspecialchars($_POST['email']) ?>"
                   placeholder="Введите e-mail">

        </div>

        <div class="form__row">
            <label class="form__label" for="password">Пароль <sup>*</sup></label>
            <span class='error-massage'><?php if (in_array('password', $form_error)): ?>Поле заполнено неверно<?php endif; ?></span>
            <input class="form__input <?php if (in_array('password', $form_error)): ?>form__input--error<?php endif; ?>"
                   type="password"
                   name="password" id="password" value="<?= htmlspecialchars($_POST['password']) ?>"
                   placeholder="Введите пароль">

            <p class="form__message"><?php if (in_array('password_verify', $form_error)): ?>Неверный пароль<?php endif; ?></p>
        </div>

        <div class="form__row">
            <label class="checkbox">
                <input class="checkbox__input visually-hidden" type="checkbox" checked>
                <span class="checkbox__text">Запомнить меня</span>
            </label>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="send" value="Войти">
        </div>
    </form>
</div>