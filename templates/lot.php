<?php
$currLot = $arr['lot'];
$rates = $arr['rates'];
?>

<? if (isset($currLot)) : ?>
    <section class="lot-item container">
        <h2><?= $currLot['title'] ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="<?= $currLot['img'] ?>" width="730" height="548" alt="Сноуборд">
                </div>
                <p class="lot-item__category">Категория: <span><?= $currLot['category'] ?></span></p>
                <p class="lot-item__description">Легкий маневренный сноуборд, готовый дать жару в любом парке,
                    растопив
                    снег
                    мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет
                    этот
                    снаряд
                    отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
                    кэмбер
                    позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не
                    останется,
                    просто
                    посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
                    равнодушным.</p>
            </div>
            <div class="lot-item__right">
                <? if (isset($_SESSION['user'])) : ?>
                    <div class="lot-item__state">
                        <div class="lot-item__timer timer">
                            <?=$arr['date']?>
                        </div>
                        <div class="lot-item__cost-state">
                            <div class="lot-item__rate">
                                <span class="lot-item__amount">Текущая цена</span>
                                <span class="lot-item__cost"><?= sumFormat($currLot['price_start']); ?></span>
                            </div>
                            <div class="lot-item__min-cost">
                                Мин. ставка <span>12 000 р</span>
                            </div>
                        </div>
                        <form class="lot-item__form" action="../lot.php?id=<?=$_GET['id']?>" method="post">
                            <p class="lot-item__form-item">
                                <label for="cost">Ваша ставка</label>
                                <input id="cost" type="number" name="cost" placeholder="12 000">
                            </p>
                            <button type="submit" class="button">Сделать ставку</button>
                        </form>
                    </div>
                <? endif; ?>

                <? if (count($rates)) : ?>
                <div class="history">
                    <h3>История ставок (<span><?=count($rates)?></span>)</h3>
                    <table class="history__list">
                        <? foreach ($rates as $rate) : ?>
                        <tr class="history__item">
                            <td class="history__name"><?=$rate['name']?></td>
                            <td class="history__price"><?=$rate['price']?> р</td>
                            <td class="history__time"><?=$rate['rates_date']?></td>
                        </tr>
                        <? endforeach; ?>
                    </table>
                </div>
                <? endif; ?>

            </div>
        </div>
    </section>
<? else: ?>
    <p class="container">Такого лота не существует!</p>
<? endif; ?>
