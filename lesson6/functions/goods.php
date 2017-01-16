<?php
    session_start(); //старт сессии

    var_dump($_POST);
    // функция добавления из формы в сессию товаров
    // можно реализовать в ней валидацию данных, но мне в лень + такого в ТЗ не увидел :)
    function add_goods() {
        $goods = $_POST;
        $_SESSION['post-data'][] = $goods;
    }

    if(isset($_POST['main_form_submit'])) {
        add_goods();
    }

    // функция для вывода списка форм всех товаров в сессии
    function show_list() {
        // проверка на существование данных post-data в сессии
        if($_SESSION['post-data']) {
            // в цикле foreach выводим все необходимые нам элементы
            echo '<table>';
            foreach ($_SESSION['post-data'] as $key => $value) {
                echo '<tr>' .
                        '<td><label>ID: ' . $key . '</label>' . ' | </td>' .
                        '<td><form method="post">' .
                            '<button type="submit" name="title'. $key .'">Название объявления: ' . $value['title'] . '</button>' . ' | ' .
                        '</form></td>' .
                        '<td><label>Цена: ' . $value['price'] . '</label>' . ' | </td>' .
                        '<td><label>Имя продавца: ' . $value['seller_name'] . '</label>' . ' | </td>' .
                        '<td><form method="post" action="functions/delete_goods.php">' .
                            '<button type="submit" name="delete_item'. $key .'">Удалить</button>' .
                        '</form></td>' .
                    '</tr>';
            }
            echo '</table>';
        }
    }

    // функция показа формы
    function show_form() {
        // проверка на существование чего-либо в сессии
        if ($_SESSION['post-data']) {
            // перебираем в цикле элементы массива сессии
            foreach ($_SESSION['post-data'] as $key => $value) {
                $clicked_item = $_SESSION['post-data'][$key]; // переменная содержащая в себе нужный нам элемент, для удобства вывода данных
                // если в массиве $_POST ключ вывода элемента для его редактирования
                if(isset($_POST['title' . $key])) {
                    // включаем в документ форму редактирования
                    include_once '/templates/completed_form.php';
                    // при нахождении ХОТЯ БЫ одного совпадения, создается флаг
                    $flag = true;
                }
            }

            // если флаг существует или он равен false то мы выводим пустую форму,
            // чтоб цикл не выводил пустую форму и форму редактирования в одном документе.
            // ИЛИ - ИЛИ, иначе это неверно!
            if(!isset($flag) || !$flag) {
                require_once '/templates/empty_form.php';
            }
        } else {
            require_once '/templates/empty_form.php';
        }
    }
?>