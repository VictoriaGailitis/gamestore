<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != "admin") {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $game_id = $_POST['game_id'];
        $product_platform = $_POST['product_platform'];
        $product_key = $_POST['product_key'];
        $product_price = $_POST['product_price'];
        $sql_insert = "INSERT INTO products (product_id, game_id, product_platform, product_key, product_price) 
        VALUES ('$product_id', '$game_id', '$product_platform', '$product_key', '$product_price')";
        $result = mysqli_query($link, $sql_insert);
    }
?>
<!DOCTYPE html>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<main>
    <div class="py-5 text-center">
    <?php
    if (isset($_POST['product_id'])) {
        if($result) {
            echo '<i class="fa-solid fa-check" style="color: #2267dd; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Успешно!</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Запись добавлена!
            </p>
            <a class="btn btn-primary px-5 mb-5" href="products.php" role="button">
            Вернуться к таблице
            </a>';
        }
        else {
            echo '<i class="fa-solid fa-x" style="color: #d72323; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Произошла ошибка</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Ошибка при добавлении </p>';
        }
    }
    else {
        echo '<i class="fa-solid fa-user-plus" style="color: #2267dd; font-size: xxx-large;"></i>
        <h2>Добавление записи</h2>
        </div>
        <div class="d-flex flex-column mb-3 align-items-center">
            <form method="post">
            <div class="row g-3">
            <div class="col-sm-12">
            <label for="product_id" class="form-label">ID товара</label>
            <input type="number" class="form-control" id="product_id" name="product_id">
            </div>
    
            <div class="col-sm-12">
            <label for="game_id" class="form-label">Игра</label>
                <select class="form-select" name="game_id" aria-label="Default select example">';
                $sql_select = "SELECT game_id, game_name FROM games";
                $result_select = mysqli_query($link, $sql_select);
                while ($row = mysqli_fetch_array($result_select))
                {
                    echo "<option value = ' ".$row['game_id']."'>".$row['game_name']."</option>";
                }
                echo '</select>
            </div>

            <div class="col-sm-12">
            <label for="product_platform" class="form-label">Платформа</label>
            <input type="text" class="form-control" id="product_platform" name="product_platform">
            </div>
            
            <div class="col-sm-12">
            <label for="product_key" class="form-label">Ключ</label>
            <input type="text" class="form-control" id="product_key" name="product_key">
            </div>

            <div class="col-sm-12">
            <label for="product_price" class="form-label">Цена</label>
            <input type="number" class="form-control" id="product_price" name="product_price">
            </div>

            </div>
            </div>
    
            <hr class="my-4">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Добавить</button>
            </form>';
    }
?>
</div>
</div>
</body>
</html>