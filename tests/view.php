<?php

/** @var View $this */

use Haikara\Typewriter\View;

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <!-- 別ファイルに切り出したコンポーネントの呼び出し -->
    <?php /** @var string $token */ ?>
    <?= $this->include('header.php', [
        'title' => 'これはヘッダーです。',
        'message' => '引数に渡したメッセージです。',
        'token' => $token
    ]) ?>

    <!-- assignした変数の出力 & エスケープ -->
    <?php /** @var string $message */ ?>
    <p><?= $this->esc($message) ?></p>

    <!-- addShareした変数の出力 & エスケープ -->
    <p><?= $this->esc($token) ?></p>

    <select name="">
        <option value="">選択</option>
        <?php /** @var array<int,string> $categories */ ?>
        <?php foreach ($categories as $id => $category) : ?>
            <option value="<?= $this->esc($id) ?>" <?= $id === $user_input['category_id'] ? 'selected' : '' ?>>
                <?= $this->esc($category) ?>
            </option>
        <?php endforeach ?>
    </select>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>品名</th>
            </tr>
        </thead>
        <tbody>
            <!-- ループ -->

            <?php /** @var array{id:int,item_name:string} $items */ ?>
            <?php foreach ($items ?? [] as $item) : ?>
                <tr>
                    <td><?= $this->esc($item['id']) ?></td>
                    <td><?= $this->esc($item['item_name']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <p><?= $this->filter('<script>alert("XSS")</script>', 'strtoupper', [$this, 'esc']) ?></p>
    <p><?= $this->esc(strtoupper('<script>alert("XSS")</script>')) ?></p>

    <?php /** @var object $login_user */ ?>
    <?php if ($login_user->isAdmin()) : ?>
        <p>管理者ユーザーでログイン</p>
    <?php elseif ($login_user->isCommon()) : ?>
        <p>一般ユーザーでログイン</p>
    <?php endif ?>

    <p><?= $getAge($birthday) . '歳' ?></p>

    <p><?= $this->filter(1000, $jpyPriceFormat) ?></p>
</body>

</html>