# Установка и настройка среды разработки (PHPStorm)

## Установка средств разработки

0. Устанавливаем Chocolatey https://chocolatey.org/
1. Запускаем `cmd.exe` с правами администратора
2. Выполняем команду `choco install git php`
3. Устанавливаем PHPStorm 8 и активируем лицензию, которую можно получить на
  сайте JetBrains с помощью студенческой почты (https://www.jetbrains.com/)

## Настройка PHP

PHP должен был установиться в `C:\bin\php`

0. Добавляем PHP в PATH переменную-окружения пользователя: `My Computer` ->
  `System Properties` -> `Change Settings` -> `Advanced` ->
  `Environment Variables` -> `User variables for <your user name>` -> `PATH`
  -> `Edit` -> `Variable value` -> привести строку к виду `...;C:\bin\php;`.
  Если по каким-то причинам путь к `git.exe` не прописан, то дописать и его.
1. Переходим в директорию `C:\bin\php` копируем файл `php.ini-development`
  и вставляем его под именем `php.ini`
2. Открываем файл `php.ini` с помощью любимого текстового редактора (для этих
  целей я предпочитаю Atom Editor, который можно установить с помощью команды
  `choco install atom`)
3. Заменяем строку `;date.timezone =` на `date.timezone = "Europe/Moscow"`
  (точку с запятой необходимо убрать, т.к. является признаком начала
   комментария)
4. В секции `Dynamic Extensions` добавляем следующие строки:
```
extension=ext\php_curl.dll
extension=ext\php_mbstring.dll
extension=ext\php_openssl.dll
extension=ext\php_pdo_mysql.dll
extension=ext\php_pdo_sqlite.dll
```
5. Для проверки работоспособности PHP, необходимо в командной строке выполнить
  команду php. Если не возникло никаких ошибок, то все просто замечательно!

## Клонирование проекта

0. Открываем командную строку под своим пользователем
1. Переходим в директорию, в который вы храните свои проекты (под Windows
  для этих целей я использую директорию `C:\Users\<username>\Documents`, здесь
  и далее я буду подразумевать что вы находитесь и храните проект в ней):
  `C:\Users\<username>>cd Documents`
2. Выполняем `git clone https://github.com/m4Dc00kie/mesi-schedule`

## Настройка PHPStorm, установка Composer и все-все-все

0. Запускаем PHPStorm
1. Активируем лиценизю
2. `Configure` -> `Settings` -> `Code Style` -> `PHP` ->
 Выбираем `Use tab character`
3. `Create new project` -> выбираем директорию где хранится проект:
  `C:/Users/<username>/Documents/mesi-schedule` -> выбираем тип `PHP Empty Project`
  -> получаем предупреждение что директория не пуста, соглашаемся создать
  проект из имеющихся исходников
4. `Run` -> `Edit configurations` -> `Add` -> `PHP Script`
```
Name: Run dev server
Single instance only: yes
File: C:\Users\<username>\Documents\mesi-schedule\artisan
Arguments: serve
```
5. Внизу окна видим ошибку `Error: Interpreter is not specified or invalid`,
  жмем кнопку `Fix` -> `PHP Language Level` => `5.6`, `Interpreter` ->
  жмем кнопку `...` -> `+` -> `C:\bin\php\php.exe` -> `Apply` -> `Ok`
  -> `Interpreter` => `PHP 5.6` -> `Apply` -> `Ok` -> `Apply` -> `Ok`
6. `File` -> `Settings` -> `PHP` -> `Composer` ->
  `Click here to download from composer.org` ->
  `C:\Users\<username>\Documents\mesi-schedule` -> `Ok` -> `Ok`
7. В дереве навигации переходим в `bootstrap`, копируем `start.php.example` и
вставляем его в эту же директорию под именем `start.php`
8. Открываем `start.php`, находим следующий код
```
$env = $app->detectEnvironment(array(
    'local' => array('homestead', 'emdream', 'darkstar'),
));
```
И добавляем свой хостнейм, например так:
```
$env = $app->detectEnvironment(array(
    'local' => array('mylittlepc'),
));
```
9. В командной строке выполняем команду
  `C:\Users\<username>\Documents\mesi-schedule>php composer.phar install` и
  `C:\Users\<username>\Documents\mesi-schedule>php composer.phar update`
10. Установка завершена. Запускаем проект с конфигурацией `Run dev server`:
  `Run` -> `Run 'Run dev server'`. В появившемся окне должно отобразиться
  следующие:
  ```
  Laravel development server started on http://localhost:8000
  ```
  Соответственно, поиграться с проектом вы можете по адресу: http://localhost:8000
