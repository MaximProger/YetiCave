  <form class="form container <?if(count($arr['errors'])):?>form--invalid<?endif;?>" action="../login.php" method="post"> <!-- form--invalid -->
    <h2>Вход</h2>
    <div class="form__item <? if(isset($arr['errors']['email'])): ?>form__item--invalid<? endif; ?>"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $arr['user_data']['email']?>" required>
      <span class="form__error"><?=$arr['errors']['email']?></span>
    </div>
    <div class="form__item form__item--last <? if(isset($arr['errors']['password'])): ?>form__item--invalid<? endif; ?>">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль" value="<?= $arr['user_data']['password']?>" required>
      <span class="form__error"><?=$arr['errors']['password']?></span>
    </div>
    <button type="submit" class="button">Войти</button>
  </form>
