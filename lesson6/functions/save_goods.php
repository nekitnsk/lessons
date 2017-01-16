<?php
    session_start();

    //обход циклом всех элементов чтобы найти в $_POST соотв. номера ключа в $_SESSION
    foreach ($_SESSION['post-data'] as $key => $value) {
        if (isset($_POST['save_form_submit' . $key])) {
            //перезапись элемента
            $clicked_item = $_POST;
            $_SESSION['post-data'][$key] = $clicked_item;
        }
    }
?>
<!-- Вывод html документа с минималистичной навигацией -->
<p>Элемент списка перезаписан успешно!</p>
<a href="../dz6.php">Домой?</a>
