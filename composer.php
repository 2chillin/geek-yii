<?php

use Composer\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\StreamOutput;

//Уберём лимиты, чтоб скрипт не отвалился раньше времени
ini_set("memory_limit", -1);
ini_set("max_execution_time", 0);

//Корень проекта
$root = __DIR__ . "/../";

//Папка для разархивирования
$dir = "{$root}/var";

//Смотрим если Phar архив еще не распакован, то распакуем его
if (file_exists("{$dir}/vendor/autoload.php") === false) {
	$composerPhar = new Phar("{$root}/composer.phar");
	$composerPhar->extractTo($dir);
}

//Подключим автолоадер для использования классов композера
require_once("{$dir}/vendor/autoload.php" . '');

//Обьявим переменную окружения чтоб обозначить где хранится сам композер
putenv("COMPOSER_HOME={$dir}/bin/composer");

//Изменим папку на корень чтоб vendor хранился на том же уровне что и WebRoot
chdir($root);

//Подготавливаем комманду установки
$input = new ArrayInput(['command' => 'install']);

//Создаем вывод в стрим
$stream = fopen('php://temp', 'w+');
$output = new StreamOutput($stream);

//Запускаем "консольное" приложение
$application = new Application();
$application->setAutoExit(false);
$application->run($input, $output);

//А тут должен быть вывод
echo stream_get_contents($stream);