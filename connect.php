<?php
	$host = 'localhost';
	$user = 'root';
	$db = 'game_store';
	$password = 'root';
	
	$link = mysqli_connect($host, $user, $password, $db);
	if (!$link) {
		echo "Ошибка: Невозможно установить соединение с с базой данных game_store.";
		echo '<br>';
		echo "Код ошибки errno: " . mysqli_connect_errno(); echo '<br>';
		echo "Текст ошибки error: " . mysqli_connect_error();
        exit;
	}
?> 