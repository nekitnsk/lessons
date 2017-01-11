<?php
    //подключение логики
    require_once('functions.php');
    //вызов всех нужных нам функций
    calc_discount($products, $price, $discount, $lot);
    check_storage($lot, $storage_lot);
    the_summary_price($price_with_discount, $final_list);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dz4</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Ваша корзина</h1>
    <table class="basket">
        <tr>
            <th width="125px">Превью</th>
            <th width="130px">Наименование товара</th>
            <th width="100px">Заказано</th>
            <th width="75px">Цена</th>
            <th width="75px">Скидки*</th>
            <th width="75px">Цена со скидкой</th>
            <th width="75px">Остаток на складе</th>
            <th width="125px">Уведомления</th>
            <th width="150px">Итого (сумма заказа по данной категории)</th>
        </tr>
        <tr>
            <?php
                //вывод ячеек таблицы в цикле
                for ($i = 0; $i < count($products); $i++) {
                    //заполнение первого столбца картинками из массива $img_path
                    switch ($products[$i]) {
                        case 'игрушка мягкая мишка белый':
                            echo '<td><img src=' . $img_path['img_teddy_bear'] . '></td>';
                            break;
                        case 'одежда детская куртка синяя синтепон':
                            echo '<td><img src=' . $img_path['img_jacket'] . '></td>';
                            break;
                        case 'игрушка детская велосипед':
                            echo '<td><img src=' . $img_path['img_toy_bicycle'] . '></td>';
                            break;
                        default:
                            break;
                    }

                    //заполнение каждой ячейки нужным нам значением
                    echo '<td>' . $products[$i] . '</td>'
                        . '<td>' . $lot[$i] . '</td>'
                        . '<td>' . $price[$i] . '</td>'
                        . '<td>' . $discount[$i] . '</td>'
                        . '<td>' . $price_with_discount[$i] . '</td>'
                        . '<td>' . $storage_lot[$i] . '</td>'
                        . '<td>' . $messages[$i] . '</td>'
                        . '<td>' . $summary_price[$i] . '</td>'
                        . '</tr>';
                }
            ?>
        </tr>
    </table>
    <div class="footer">
        <div class="footer-1" style="float: left; width: 60%;">
            <h2>Итого:</h2>
            <p>Заказанные товары (наименования):</p>
            <ul>
                <?php for ($i = 0; $i < count($products); $i++) {
                    echo '<li>' . $products[$i] . '</li>';
                } ?>
            </ul>
            <p>Всего заказано товаров (с корректировкой наличия товара на складе): <?php echo $lots_count; ?></p>
            <p>Общая сумма покупки: <?php echo array_sum($summary_price); ?></p>
        </div>
        <div class="footer-2" style="float: left;">
            <h2>Скидки</h2>
            <ul>
                <li>diskont0 - Вам не предоставлена скидка</li>
                <li>diskont1 - скидка на категорию товара в 10%!</li>
                <li>diskont2 - скидка на категорию товара в 20%!</li>
            </ul>
            <p>При заказе игрушек-велосипедов ОТ 3 ШТ. дается уникальная скидка в 30%.</p>
        </div>
    </div>
</body>
</html>