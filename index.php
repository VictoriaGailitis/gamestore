<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeyLand</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include ("blocks/user_header.php");?>

<div class="px-4 pt-5 my-5 text-center border-bottom">
    <h1 class="display-4 fw-bold text-body-emphasis">Магазин игровых ключей KeyLand</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">KeyLand - магазин игровых ключей, где каждый геймер найдет самые новые и популярные игры по выгодным ценам, чтобы погрузиться в захватывающие приключения в любой момент.</p>
    </div>
    <div class="overflow-hidden" style="max-height: 30vh;">
    <div class="container px-5">
        <img src="https://i.ytimg.com/vi/n_-ZQYsjbu8/maxresdefault.jpg?7857057827" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
    </div>
    </div>
</div>


<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Наши преимущества</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
    <div class="feature col">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
        <i class="fa-solid fa-list" style="color: #ffffff; margin: 20px;"></i>
        </div>
        <h3 class="fs-2 text-body-emphasis">Широкий ассортимент</h3>
        <p>Магазин игровых ключей KeyLand предлагает обширный ассортимент игр для различных платформ, что позволяет клиентам найти именно то, что им нужно.</p>
    </div>
    <div class="feature col">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
        <i class="fa-solid fa-key" style="color: #ffffff; margin: 20px;"></i>
        </div>
        <h3 class="fs-2 text-body-emphasis">Лицензионные ключи</h3>
        <p>KeyLand гарантирует 100% легальность своих игровых ключей, что позволяет клиентам покупать их с уверенностью и избегать проблем с их активацией.</p>
    </div>
    <div class="feature col">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
        <i class="fa-solid fa-hand-holding-dollar" style="color: #ffffff; margin: 20px;"></i>
        </div>
        <h3 class="fs-2 text-body-emphasis">Выгодные цены</h3>
        <p>KeyLand предлагает игровые ключи по более низким ценам, чем множество других подобных сервисов, что позволяет покупателям получить высококачественные игры по более доступной цене.</p>
    </div>
    </div>
</div>
<?php include ("blocks/user_footer.php");?>
</body>
</html>