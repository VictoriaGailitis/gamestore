<?php 
$exit = $_POST['exit'];
    if (!empty($exit)) {
        session_unset();
        session_destroy(); 
        header('Location: ../index.php');
}
?>

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                <i class="fa-solid fa-gamepad fa-bounce" style="color: #2267dd; font-size:xx-large; margin-right: 10px;"></i>
                <h4>KeyLand</h4>
            </a>
        </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="../admin/panel.php" class="nav-link px-2 link-secondary">Главная</a></li>
        <li><a href="../admin/genres.php" class="nav-link px-2">Жанры</a></li>
        <li><a href="../admin/publishers.php" class="nav-link px-2">Издатели</a></li>
        <li><a href="../admin/developers.php" class="nav-link px-2">Разработчики</a></li>
        <li><a href="../admin/games.php" class="nav-link px-2">Игры</a></li>
        <li><a href="../admin/products.php" class="nav-link px-2">Товары</a></li>
        <li><a href="../admin/users.php" class="nav-link px-2">Пользователи</a></li>
        <li><a href="../admin/orders.php" class="nav-link px-2">Заказы</a></li>
        <li><a href="../admin/feedback.php" class="nav-link px-2">Отзывы</a></li>
        <form method="post">
            <input type="submit" value="Выйти" name="exit" class="btn btn-outline-primary me-2">
        </form>
    </ul>
    </header>
</div>