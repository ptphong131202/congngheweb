<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

$builder = new CaptchaBuilder();
$builder->build();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_SESSION['phrase']) &&
        PhraseBuilder::comparePhrases(
            $_SESSION['phrase'],
            $_POST['captcha']
        )
    ) {
        exit("<h1>Welcome {$_POST['username']}</h1>");
    } else {
        echo '<h1>Wrong captcha</h1>';
    }
}


$_SESSION['phrase'] = $builder->getPhrase();
?>
<h2>Đăng nhập</h2>
<form method="post">
    <div>
        Username: <input type="text" name="username">
    </div>

    <div>
        Password: <input type="password" name="password">
    </div>

    <div>
        <img src="<?=$builder->inline()?>" alt="Captcha">
        <br>
        Captcha: <input type="text" name="captcha">
    </div>

    <div>
        <input type="submit" name="submit" value="Login">
    </div>

</form>