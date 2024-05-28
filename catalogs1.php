<!-- <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталоги библиотеки - Научная библиотека УдГУ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="img/logo2.png" alt="Логотип УдГУ">
            </div>
            <nav>
                <ul>
                    <li><a href="index.html">Главное</a></li>
                    <li><a href="index.html#infoResource">Информационные ресурсы</a></li>
                    <li><a href="index.html#personal">Личный кабинет</a></li>
                    <li><a href="index.html#elibrary">"Электронная библиотека"</a></li>
                    <li><a href="index.html#about">О библиотеке</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <h1>Каталоги библиотеки</h1>
    <div class="catalog-container">
        <form action="search_results.html" method="GET" class="catalog-search-form">
            <div class="form-group">
                <label for="title">Название:</label>
                <input type="text" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="author">Автор:</label>
                <input type="text" id="author" name="author">
            </div>
            <div class="form-group">
                <label for="year">Год издания:</label>
                <input type="number" id="year" name="year">
            </div>
            <div class="form-group">
                <label for="subject">Тематика:</label>
                <input type="text" id="subject" name="subject">
            </div>
            <button type="submit">Искать</button>
        </form>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 Научная библиотека УдГУ. Все права защищены.</p>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>
</html> -->

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталоги библиотеки</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        .book {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .book h2 {
            margin: 0 0 10px;
        }
    </style>
</head>
<body>
    <h1>Каталоги библиотеки</h1>

    <form action="catalogs.php" method="GET">
        <input type="text" name="query" placeholder="Поиск по названию книги или автору">
        <button type="submit">Поиск</button>
    </form>

    <?php
    if (isset($_GET['query'])) {
        $query = $_GET['query'];

        // Подключение к базе данных
        $conn = new mysqli("localhost", "root", "", "library");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Выполнение поиска
        $sql = "SELECT * FROM books WHERE title LIKE '%$query%' OR author LIKE '%$query%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Вывод результатов
            while($row = $result->fetch_assoc()) {
                echo "<div class='book'>";
                echo "<h2>" . $row["title"] . "</h2>";
                echo "<p>Автор: " . $row["author"] . "</p>";
                echo "<p>Год: " . $row["year"] . "</p>";
                echo "<p>Тематика: " . $row["subject"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "Результатов не найдено.";
        }

        $conn->close();
    }
    ?>
</body>
</html>
