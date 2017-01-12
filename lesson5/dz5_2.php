<?php
$news='Четыре новосибирские компании вошли в сотню лучших работодателей
    Выставка университетов США: открой новые горизонты
    Оценку «неудовлетворительно» по качеству получает каждая 5-я квартира в новостройке
    Студент-изобретатель раскрыл запутанное преступление
    Хоккей: «Сибирь» выстояла против «Ак Барса» в пятом матче плей-офф
    Здоровое питание: вегетарианская кулинария
    День святого Патрика: угощения, пивной теннис и уличные гуляния с огнем
    «Красный факел» пустит публику на ночные экскурсии за кулисы и по закоулкам столетнего здания
    Звезды телешоу «Голос» Наргиз Закирова и Гела Гуралиа споют в «Маяковском»';
    $news=  explode("\n", $news);

    // Функция вывода всего списка новостей.
    function display_all_news($array_news) {
        print_r($array_news);

        echo '<p><b>Статья не найдена. Просмотрите остальные новости</b></p>'
            . '<h1>Список новостей</h1>'
            . '<ul>';
        foreach ($array_news as $single_news) {
            echo '<li>' . $single_news . '</li>';
        }
        echo '</ul>';
    }

    // Функция вывода конкретной новости.
    function display_single_news($array_news, $id) {
        print_r($array_news);

        echo '<h2>' . $array_news[$id] . '</h2>';
    }

    function display_404_error($array_news) {
        header("HTTP/1.0 404 Not Found");
        echo '<h1>Ошибка 404! Такой новости нет!</h1>' . '<br>';
        echo '<h2>В форму поиска необходимо ввести только целые численные значения! Поле нельзя оставлять пустым</h2>';

        print_r($array_news); // Вывод новостей после отправки заголовков,во избежание вывода об ошибке
    }

    $request = $_POST;
    // Точка входа.
    // проверка на существование $_POST['id'] - необходимого нам параметра
    if (array_key_exists('id', $request)){
        // Если новость присутствует - вывести ее на сайте
        if (array_key_exists($request['id'], $news)){
            $news_id = intval($_POST['id']);
            display_single_news($news, $news_id);
        }
        // Если $_POST['id'] пуст, вывод ошибки 404
        elseif (empty($request['id'])) {
            display_404_error($news);
        }
        // Во всех остальных случаях вывод всех новостей
        else {
            display_all_news($news);
        }
    }

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dz 5_2: $_POST</title>
</head>
<body>
    <form method="post">
        <input type="text" placeholder="Введите ID новости" name="id">
        <button type="submit">Найти новость</button>
    </form>
    <?php echo var_dump($request); ?>
</body>
</html>
