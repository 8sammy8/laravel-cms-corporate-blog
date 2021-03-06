<?php
/*
 * Настройки пакета laravel-statistics
 * https://github.com/klisl/laravel-statistics
 */
return [
    'name_route' => ['home', 'prices', 'blog', 'blogCat', 'blogPost'], //названия маршрутов по которым будет собираться статистика. Например ['posts','contact']
    'days_default' => 3, //кол-во дней для вывода статистики по-умолчанию (сегодня/вчера)
    'password' => false, //пароль для входа на страницу статистики. Если false (без кавычек) - вход без пароля
    'authentication' => true, //если true, то статистика доступна только аутентифицированным пользователям
    'auth_route' => 'login', //название маршрута для страницы аутентификации (по-умолчанию 'login')
];
