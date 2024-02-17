<?php

declare(strict_types=1);

ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

$typewriter = new Haikara\Typewriter\Typewriter();
$typewriter->setBasePath(__DIR__);

$typewriter->assign('items', [
    ['id' => 1, 'item_name' => '商品1'],
    ['id' => 2, 'item_name' => '商品2'],
    ['id' => 3, 'item_name' => '商品3'],
    ['id' => 4, 'item_name' => '商品4'],
    ['id' => 5, 'item_name' => '商品5']
]);

$typewriter->assign('categories', [
    1 => 'カテゴリ1',
    2 => 'カテゴリ2',
    3 => 'カテゴリ3',
    4 => 'カテゴリ4',
    5 => 'カテゴリ5',
]);

$typewriter->assign('user_input', [
    'category_id' => 1
]);

$typewriter->assign('message', 'メッセージ');

$typewriter->assign('token', 'abdefghijklmn');

$typewriter->assign('birthday', new DateTimeImmutable('1994-03-21'));

$typewriter->assign('getAge', function (DateTimeInterface $birthday) {
    $now = new DateTimeImmutable();
    return $now->diff($birthday)->y;
});

$typewriter->assign('jpyPriceFormat', function (int $amount): string {
    return number_format($amount) . '円';
});

$typewriter->assign('login_user', new class
{
    public function isAdmin()
    {
        return true;
    }
});

echo $typewriter->render('view.php');
