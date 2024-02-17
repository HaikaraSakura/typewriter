# typewriter

出力バッファリングを利用したテンプレートエンジン。

+ View変数を設定できる。
+ 別のテンプレートファイルをincludeできる。

## 使用方法

セットアップとView変数の登録。

```PHP
// 引数にディレクトリを指定してインスタンス化する
$view = new Haikara\Typewriter\Typewriter('./', BASE_ROUTE, DOCUMENT_ROOT);

// View-Assign変数の登録。
$view->assign('message', 'こんにちは世界！');
$view->assign('username', 'User1');

// 配列も同様に登録する。
$view->assign('clientside_langs', [
    'HTML', 'CSS', 'JavaScript'
]);

// テンプレートファイルを指定。echoで出力する。
echo $view->render('./view.php');
```

登録したView変数をテンプレート内で呼び出す。

```HTML
<!-- View-Assign変数の出力。以下２つの記述は等価。 -->
<p><? echo $message ?></p>
<p><?= $message ?></p>

<!-- エスケープして出力。-->
<p><?= self::esc($message) ?></p>

<!-- foreachで配列を回して出力。 -->
<ul>
    <?php foreach ($clientside_langs as $lang) : ?>
        <li><?= self::esc($lang) ?></li>
    <?php endforeach ?>
</ul>

<!-- 別ファイルの読み込み -->
<?php $this->include('./component.php', [
    'message2' => 'includeの引数です。',
    'username' => $username
]) ?>

<!-- ブラウザキャッシュ対策 -->
<!-- パラメータとしてファイルの更新日時を付加したパスを取得する。 -->
<link rel="stylesheet" href="<?= $this->disCache('style.css') ?>">

```

## Filter機能

値に対して複数の処理を順次適用するメソッドチェーン的なショートハンド。  

```HTML
<!-- 第一引数にとった値に対し、第二引数以降にとったCallableを適用する。 -->
<!-- 以下の記述はすべて等価である。 -->
<?= self::filter(
    '<script>alert("XSS!!")</script>',
    'strtoupper',
    [self, 'esc']
) ?>

<?= self::filter(
    '<script>alert("XSS!!")</script>',
    strtoupper(...),
    self::esc(...)
) ?>

<?= self::filter('<script>alert("XSS!!")</script>', ...[
    strtoupper(...), self::esc(...)
]) ?>
```

## ユーザー定義のヘルパー関数

callableな値をView変数に登録することで、ヘルパー関数として扱うことができる。  

```PHP
// DateTimeを受け取り、現在の年齢をint型で返す
$view->assign('getAge', function (\DateTimeInterface $birthday): int {
    $diff = (new DateTime())->diff($birthday);
    return $diff->y;
});

// DateTimeImmutable（誕生日）をView-Assign変数として登録
$view->assign('birthday', new \DateTimeImmutable('1994-03-21'));

// 消費税を加える。
$view->assign('taxInclude', fn (int $price): int => (int)floor($price * 1.1));

// 金額をカンマ区切りでフォーマットし、頭に¥マークを付けて返す。
$view->assign('jpyPriceFormat', fn (int $price): string => '¥' . number_format($price));
```

```HTML
<p><?= $getAge($birthday) . '歳' ?></p>

<!-- 複数のヘルパー関数を、Filter機能で順次適用する。 -->
<p><?= self::filter(1000, ...[
    $taxInclude(...), $jpyPriceFormat(...)
]) ?></p>
```
