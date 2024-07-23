<!DOCTYPE html>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<main>
    <div class="py-5 text-center">
    <i class="fa-solid fa-address-card" style="color: #2267dd; font-size: xxx-large;"></i>
    <h2>Регистрация</h2>
    </div>
    <div class="d-flex flex-column mb-3 align-items-center">
        <form method="post" action="registred.php">
        <div class="row g-3">
            <div class="col-sm-6">
            <label for="username" class="form-label">Имя пользователя</label>
            <input type="text" class="form-control" id="username" name="user_name" placeholder="Имя пользователя">
            </div>

            <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="user_email" placeholder="Email">
            </div>

            <div class="col-12">
            <label for="card" class="form-label">Банковская карта</label>
            <input type="text" class="form-control" id="card" name="user_card" placeholder="Банковская карта">
            </div>

            <div class="col-12">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
            </div>
        </div>

        <hr class="my-4">
        <button class="w-100 btn btn-primary btn-lg" type="submit">Зарегестрироваться</button>
        </form>
    </div>
</main>
</div>
</body>
</html>