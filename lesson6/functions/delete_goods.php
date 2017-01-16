<?php
    session_start();

    //проверка есть ли что-то в сессии
    if($_SESSION['post-data']) {
        //обход циклом всех элементов чтобы найти в $_POST соотв. номера ключа в $_SESSION
        foreach ($_SESSION['post-data'] as $key => $value) {
            if (isset($_POST['delete_item' . $key])) {
                // удаление элемента с нужным нам ключем из сессии
                unset($_SESSION['post-data'][$key]);
            }
        }
    }

?>
<!-- Вывод html документа с минималистичной навигацией -->
<p>Элемент списка удален успешно!</p>
<a href="../dz6.php">Домой?</a>