<?php

require_once __DIR__ . '/function/user.php';

session_start();

if (isset($_POST['submit-button'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $birth = "$year-$month-$day";
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];

    $user = [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'birth' => $birth,
        'telephone' => $telephone,
        'address' => $address,
    ];

    $user = saveUser($user);

    $_SESSION['id'] = $user['id'];

    header('Location: ./my-page.php');
    exit();

}
?>
<html>
    <body>
        <h1>会員登録</h1>
        <form action="./register.php" method="post">
            <div>
                お名前<br>
                <input type="text" name="name">
            </div>
            <div>
                メールアドレス<br>
                <input type="email" name="email">
            </div>
            <div>
                パスワード<br>
                <input type="password" name="password">
            </div>
            <div>
                生年月日<br>
                <select name="year" id="year" require>
                    <?php
                    for ($i= 1960; $i <= 2024; $i++) {
                        echo "<option value='$i'>$i 年</option>";
                    }
                    ?>
                </select>
                <select name="month" id="month" require>
                    <?php
                    for ($i= 1; $i <= 12; $i++) {
                        echo "<option value='$i'>$i 月</option>";
                    }
                    ?>
                </select>
                <select name="day" id="day" require>
                    <?php
                    for ($i= 1; $i <= 31; $i++) {
                        echo "<option value='$i'>$i 日</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                電話番号<br>
                <input type="telephone" name="telephone">
            </div>
            <div>
                ご住所<br>
                <input type="address" name="address">
            </div>
            <div>
                <input type="submit" value="登録" name="submit-button">
            </div>
        </form>
    </body>
</html>
