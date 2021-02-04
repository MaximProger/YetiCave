<div class="container">
    <section class="lots">
        <h2>Результаты поиска по запросу «<span><?=$arr['search']?></span>»</h2>
        <ul class="lots__list">
            <? if (count($arr['ads'])) : ?>

            <? foreach ($arr['ads'] as $key => $ad) : ?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src="<?=$ad['img']?>" width="350" height="260" alt="Сноуборд">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?=$ad['category']?></span>
                        <h3 class="lot__title"><a class="text-link" href="../lot.php?id=<?=$ad['id'] - 1?>"><?=$ad['title']?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?=$ad['price_start']?><b class="rub">р</b></span>
                            </div>
                            <div class="lot__timer timer">
                                <?=$arr['date']?>
                            </div>
                        </div>
                    </div>
                </li>
            <? endforeach; ?>

            <? else : ?>
            <p class="error">Ничего не найдено по вашему запросу.</p>
            <? endif; ?>

        </ul>
    </section>
    <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
    </ul>
</div>
