<?php
require_once 'functions.php';
?>

<section class="lots">
    <h2>История просмотров</h2>
    <ul class="lots__list">

        <?php

        $visited_value_list = array_unique(str_split($arr['visited']));

        foreach ($visited_value_list as $visit_item) {

            $currAd = $arr['ads'][$visit_item];
            ?>

            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=$currAd['img']?>" width="350" height="260" alt="Сноуборд">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=$currAd['category']?></span>
                    <h3 class="lot__title"><a class="text-link" href="../lot?id=<?=$visit_item?>.php"><?=$currAd['title']?></a>
                    </h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=sumFormat($currAd['price'])?></span>
                        </div>
                        <div class="lot__timer timer">
                            <?=$arr['date'];?>
                        </div>
                    </div>
                </div>
            </li>
        <? } ?>

    </ul>
</section>
