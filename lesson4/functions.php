<?php
    require_once('database.php');

    /*
     * Задание 1
     * - Вы проектируете интернет магазин. Посетитель на вашем сайте создал следующий заказ
     * (цена, количество в заказе и остаток на складе генерируются автоматически):
     * - Вам нужно вывести корзину для покупателя, где указать:
     * 1) Перечень заказанных товаров, их цену, кол-во и остаток на складе
     * 2) В секции ИТОГО должно быть указано: сколько всего наименовний было заказано,
     * каково общее количество товара, какова общая сумма заказа
     * - Вам нужно сделать секцию "Уведомления", где необходимо извещать покупателя о том,
     * что нужного количества товара не оказалось на складе
     * - Вам нужно сделать секцию "Скидки", где известить покупателя о том,
     * что если он заказал "игрушка детская велосипед" в количестве >=3 штук, то на эту позицию ему
     * автоматически дается скидка 30% (соответственно цены в корзине пересчитываются тоже автоматически)
     * 3) у каждого товара есть автоматически генерируемый скидочный купон diskont,
     * используйте переменную функцию, чтобы делать скидку на итоговую цену в корзине
     * diskont0 = скидок нет, diskont1 = 10%, diskont2 = 20%
     *
     * В коде должно быть использовано:
     * - не менее одной функции
     * - не менее одного параметра для функции
     * операторы if, else, switch
     * статические и глобальные переменные в теле функции
     */

    //ассоциативный массив, где каждому товару соотв. свой путь картинки
    $img_path = array(
        'img_jacket' => './img/blue-jacket-child.jpg',
        'img_teddy_bear' => './img/teddy-bear-white.jpg',
        'img_toy_bicycle' => './img/toy-bicycle.jpg'
    );

    //создание массивов, заполняемых из БД
    foreach ($bd as $product => $value) {
        $products[] = $product;
        $lot[] = $value['количество заказано'];
        $price[] = $value['цена'];
        $discount[] = $value['diskont'];
        $storage_lot[] = $value['осталось на складе'];
    }

    //подсчет цен со скидками с учетом специальной скидки на велосипеды, при заказе от 3 шт.
    function calc_discount($products_list, $price_list, $discount_list, $lot_list) {
        global $price_with_discount; //создание глобального массива, куда записываются цены со скидками
        static $special_product_index;
        $spec_product_index = array_search('игрушка детская велосипед', $products_list); //вычисляет позицию в БД товара "игрушка велосипед" и записывает в переменную

        //цикл обхода всех массивов
        for ($i = 0; $i < count($price_list); $i++) {
            //вычисление коэфициента для подсчета скидки
            switch ($discount_list[$i]) {
                case 'diskont0':
                    $discount_list[$i] = 0;
                    break;
                case 'diskont1':
                    $discount_list[$i] = 0.1;
                    break;
                case 'diskont2':
                    $discount_list[$i] = 0.2;
                    break;
                default:
                    break;
            }

            //условный оператор, который проверяет сколько заказали велосипедов и исходя из этого формирует массив $price_with_discount (цена_со_скидкой)
            if($lot_list[$spec_product_index] >= 3) {
                $price_with_discount[$i] = $price_list[$i] - $price_list[$i] * $discount_list[$i];
                $price_with_discount[$spec_product_index] = $price_list[$spec_product_index] - $price_list[$spec_product_index] * 0.3;
            } else {
                $price_with_discount[$i] = $price_list[$i] - $price_list[$i] * $discount_list[$i];
            }

        }
    }

    //проверка наличия на складе товара и формирования суммы заказанных товаров, с учетом изменений
    function check_storage($lot_list, $storage_list) {
        global $messages; //глобальный массив, в который записываются сообщения о доступности товара на складе для каждой позиции товара
        global $lots_count; //переменная - сумма всех заказанных товаров с учетом доступности товара на складе
        global $final_list; //глобальный массив, в который записывается сколько товаров В ИТОГЕ было заказано, с учетом доступности товара на складе

        //в цикле обходим наши товарные позиции (заказы, наличие на складе)
        for ($i = 0; $i < count($storage_list); $i++) {
            //проверка на наличие на складе товаров и формирование переменных $lots_count && $final_list
            if ($storage_list[$i] < $lot_list[$i]) {
                $messages[$i] = 'Нужного количества товара не оказалось на складе. Изменено количество товаров с '
                    . $lot_list[$i] . ' на ' . $storage_list[$i];
                $lots_count += $storage_list[$i];
                $final_list[$i] = $storage_list[$i];
            } else {
                $messages[$i] = 'Нужный товар есть на складе';
                $lots_count += $lot_list[$i];
                $final_list[$i] = $lot_list[$i];
            }
        }
    }

    //подсчет итоговой цены, как на отдельную категорию товара, так и на все товары в целом
    function the_summary_price($final_price, $final_lots) {
        global $summary_price;
        for($i = 0; $i < count($final_lots); $i++) {
            $summary_price[$i] = intval($final_lots[$i]) * $final_price[$i];
        }
        return array_sum($summary_price);
    }

?>