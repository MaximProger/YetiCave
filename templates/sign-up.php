  <form class="form container <?if(count($arr['errors'])):?>form--invalid<?endif;?>" action="../registration.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item <? if(isset($arr['errors']['email'])): ?>form__item--invalid<? endif; ?>"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="email" name="email" placeholder="Введите e-mail" value="<?=$arr['form']['email']?>" required>
      <span class="form__error"><?=$arr['errors']['email']?></span>
    </div>
    <div class="form__item <? if(isset($arr['errors']['password'])): ?>form__item--invalid<? endif; ?>">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль" value="<?=$arr['form']['password']?>" required>
      <span class="form__error">Введите пароль</span>
    </div>
    <div class="form__item <? if(isset($arr['errors']['name'])): ?>form__item--invalid<? endif; ?>">
      <label for="name">Имя*</label>
      <input id="name" type="text" name="name" placeholder="Введите имя" value="<?=$arr['form']['name']?>" required>
      <span class="form__error">Введите имя</span>
    </div>
    <div class="form__item <? if(isset($arr['errors']['message'])): ?>form__item--invalid<? endif; ?>">
      <label for="message">Контактные данные*</label>
      <textarea id="message" name="message" placeholder="Напишите как с вами связаться" required><?=$arr['form']['message']?></textarea>
      <span class="form__error">Напишите как с вами связаться</span>
    </div>
    <div class="form__item form__item--file form__item--last <? if(isset($arr['errors']['file'])): ?>form__item--invalid<? endif; ?>">
      <label>Аватар</label>
        <?=$arr['errors']['file']?>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="file" name="file" value="" required>
        <label for="file">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="#">Уже есть аккаунт</a>
  </form>
