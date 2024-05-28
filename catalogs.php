<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталоги библиотеки</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Основные стили */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 10px;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #008080;
        }
        /* Стили для формы поиска */
        form {
            display: flex;
            flex-direction: column; /* изменено на вертикальную ориентацию */
            align-items: center;
            margin-bottom: 30px;
        }
        form input[type="text"],
        form input[type="number"] {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 5px 0;
        }
        form button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #008080;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            margin-left: auto; /* кнопка выравнивается по правому краю */
}

        form button:hover {
            background-color: #005757;
        }
        /* Стили для результатов поиска */
        .book {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            
        }
        .book h2 {
            margin-top: 0;
            color: #008080;
        }
        .book p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="img/logo2.png" alt="Логотип УдГУ">
            </div>
            <nav>
                <ul>
                    <li><a href="index.html#home">Главное</a></li>
                    <li class="dropdown">
                        <a href="index.html#infoResource">Информационные ресурсы</a>
                        <ul class="dropdown-content">
                            <li><a href="index.html#resource1">Электронный каталог</a></li>
                            <li><a href="index.html#resource2">Ресурсы интернета</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="index.html#personal">Личный кабинет</a>
                        <ul class="dropdown-content">
                            <li><a href="index.html#personal1">Мои книги</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="index.html#elibrary">"Электронная библиотека"</a>
                        <ul class="dropdown-content">
                            <li><a href="index.html#elibrary1">УдНОЭБ</a></li>
                            <li><a href="index.html#elibrary2">Президентская библиотека им. Б.Н. Ельцина</a></li>
                            <li><a href="index.html#elibrary3">Электронные библиотечные системы</a></li>
                            <li><a href="index.html#elibrary4">Электронная библиотека диссертаций РГБ</a></li>
                            <li><a href="index.html#elibrary5">Доступ к Базам данных научной информации</a></li>
                            <li><a href="index.html#elibrary6">Электронные газеты и журналы</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="index.html#about">О библиотеке</a>
                        <ul class="dropdown-content">
                            <li><a href="index.html#about1">Общие сведения</a></li>
                            <li><a href="index.html#about2">Структура библиотеки и график работы</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>Каталоги библиотеки</h1>
        <form action="catalogs.php" method="GET">
            <input type="text" name="title" placeholder="Название книги">
            <input type="text" name="author" placeholder="Автор">
            <input type="number" name="year" placeholder="Год издания">
            <input type="text" name="subject" placeholder="Тематика">
            <button type="submit">Поиск</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Проверка существования ключей в массиве $_GET
            $title = isset($_GET['title']) ? $_GET['title'] : '';
            $author = isset($_GET['author']) ? $_GET['author'] : '';
            $year = isset($_GET['year']) ? $_GET['year'] : '';
            $subject = isset($_GET['subject']) ? $_GET['subject'] : '';

            // Подключение к базе данных
            $conn = new mysqli("localhost", "root", "mysql", "library");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Выполнение поиска
            $sql = "SELECT * FROM books WHERE 1=1";
            if (!empty($title)) $sql .= " AND title LIKE '%$title%'";
            if (!empty($author)) $sql .= " AND author LIKE '%$author%'";
            if (!empty($year)) $sql .= " AND year = $year";
            if (!empty($subject)) $sql .= " AND subject LIKE '%$subject%'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Вывод результатов
                while($row = $result->fetch_assoc()) {
                    echo "<div class='book'>";
                    echo "<h2>" . $row["title"] . "</h2>";
                    echo "<p><strong>Автор:</strong> " . $row["author"] . "</p>";
                    echo "<p><strong>Год:</strong> " . $row["year"] . "</p>";
                    echo "<p><strong>Тематика:</strong> " . $row["subject"] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>Результатов не найдено.</p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>

