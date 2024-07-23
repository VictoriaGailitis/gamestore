<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != "user") {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_GET['ord_id'])) 
    {
        $sql_get_max_id = "SELECT feedback_id FROM feedback ORDER BY feedback_id DESC LIMIT 1";
        $result_get_max_id = mysqli_query($link, $sql_get_max_id);
        $row_max_id = mysqli_fetch_array($result_get_max_id);
        $feedback_id = $row_max_id['feedback_id'] + 1;
        $order_id = $_GET['ord_id'];
        $posted_date = date('Y-m-d');
        if (isset($_POST['rating'])) {
            $rating = $_POST['rating'];
            $text = $_POST['text'];
            $sql_insert = "INSERT INTO feedback (feedback_id, posted_date, order_id, rating,
            text) VALUES ('$feedback_id', '$posted_date', '$order_id', '$rating', '$text')";
            $result = mysqli_query($link, $sql_insert);
        }
    }
?>
<!DOCTYPE html>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзыв</title>

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
    if (isset($_POST['rating'])) {
        if($result) {
            echo '<i class="fa-solid fa-check" style="color: #2267dd; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Успешно!</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Отзыв зарегестрирован!
            </p>
            <a class="btn btn-primary px-5 mb-5" href="user_orders.php" role="button">
            Вернуться к заказам
            </a>';
        }
        else {
            '<i class="fa-solid fa-x" style="color: #d72323; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Произошла ошибка</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Ошибка при регистрации отзыва </p>';
        }
    }
    else {
        echo '<i class="fa-solid fa-comment" style="color: #2267dd; font-size: xxx-large;"></i>
        <h2>Оставьте отзыв</h2>
        </div>
        <div class="d-flex flex-column mb-3 align-items-center">
            <form method="post">
            <div class="row g-3">
                <div class="col-sm-6">
                <label for="rating" class="form-label">Оценка</label>
                <select class="form-select" name="rating" aria-label="Default select example">
                    <option value="1">⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="5">⭐⭐⭐⭐⭐</option>
                </select>
                </div>
    
                <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Текст отзыва" id="floatingTextarea2" name="text" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Текст отзыва</label>
                </div>
                </div>
            </div>
    
            <hr class="my-4">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Оставить отзыв</button>
            </form>';
    }
?>
</div>
</div>
</body>
</html>