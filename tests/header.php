<?php

use Haikara\Typewriter\ViewInterface;

/**
 * @var ViewInterface $this
 * @var string $title
 * @var string $token
 */

?>

<header>
    <span>
        <!-- View::includeの引数に取った変数の出力 & エスケープ -->
        <?= $this->esc($title) ?>
    </span>
</header>

<!-- 共有変数の出力 -->
<p><?= $this->esc($token) ?></p>

<!-- スコープが違うのでassign変数は利用できない。View::includeの引数に渡すこと。 -->
<p><?= $this->esc($message ?? '変数$messageは登録されていません。') ?></p>

<?= $this->include('brand.php') ?>