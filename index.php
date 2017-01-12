<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE); //error handlings
    ini_set('display_errors', 1);
    /*
     * Задание 1
    */
    $name = "Иван"; //создаем переменные
    $age = 21;
    echo 'Мое имя ' . $name . '<br> Мне ' . $age . ' год <br>'; //вывод
    unset($name, $age); //удаление переменных

    /*
     * Задание 2
    */
    const MY_SITY = 'Харьков'; // создает константу
    if(MY_SITY) {
        echo MY_SITY;
    } else {
        echo 'Константы не существует!';
    } //проверка существования переменной

    //Изменения значения констант запрещены. Ошибка.
    //( ! ) Notice: Constant MY_SITY already defined in path\to\lesson.local\index.php on line 17
//    const MY_SITY = 'Днепр';
//    if(MY_SITY) {
//        echo MY_SITY;
//    }

    //Задание 3
    $book = array(
        'title' => 'Автобиография',
        'author' => 'Ричард Брэнсон',
        'pages' => 350
    ); // создание ассоциативного массива

    echo "<br> Недавно я прочитал книгу '" . $book['title'] . "', написанную автором: ". $book['author'] . ", я осилил все " . $book['pages'] ." страниц, мне она очень понравилась <br>"; //вывод массива

    //Задание 4
    $book1 = $book; // копируем массив из прошлого задания
    $book2 = array(
        'title' => 'Совершенный код',
        'author' => 'Стив МакКоннел',
        'pages' => 867
    ); // создаем второй массив для задания

    $books = array($book1, $book2); // объединяем два массива в один индексный массив
    echo "Недавно я прочитал книги: '" . $books[0]['title'] . "' и '". $books[1]['title'] . "', написанные соответственно авторами " . $books[0]['author'] . " и ". $books[1]['author'] . ", я осилил в сумме " . ($books[0]['pages'] + $books[1]['pages']) . " страниц, не ожидал от себя подобного"; // вывод
?>