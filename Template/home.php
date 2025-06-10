<?php

if (!empty($_SESSION['alert'])) {
  $alertMessage = $_SESSION['alert'];
  echo "<script>alert('$alertMessage');</script>";
  unset($_SESSION['alert']);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="shortcut icon" type="image/png" href="<?= siteUri("./assets/imgs/icon.png") ?>" />

  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href=<?= siteUri("./assets/css/style.css?v=") . rand(99, 999999999) ?> />
  <title>Bankist</title>
</head>

<body>
  <!-- TOP NAVIGATION -->
  <nav>
    <p class="welcome">
      <?= isset($_SESSION["login"]) ? "Welcome back, {$_SESSION['login']['name']}" : "Log in to get started" ?>
    </p>

    <img src="./assets/imgs/logo.png" alt="Logo" class="logo" />
    <form class="login" method="POST" action="<?= siteUri("./process/auth.php?action=login") ?>">
      <input type="text" name="username" placeholder="user" class="login__input login__input--user" />
      <input type="text" name="password" placeholder="PIN" maxlength="4" class="login__input login__input--pin" />
      <button type="submit" class="login__btn">&rarr;</button>
    </form>
  </nav>

  <main class="app" style="opacity:<?= isset($_SESSION["login"]) ? 1 : 0 ?>;">
    <!-- BALANCE -->
    <div class="balance">
      <div>
        <p class="balance__label">Current balance</p>

        <p class="balance__date">
          As of <span class="date"></span>
        </p>

      </div>
      <p class="balance__value"><?= $accDetails->getBalance() ?? 0 ?></p>
    </div>

    <!-- MOVEMENTS -->
    <div class="movements">
      <?php foreach ($movements as $key => $mov): ?>
        <div class="movements__row">
          <div class="movements__type movements__type--<?= $mov["type"] === "deposit" ? "deposit" : "withdrawal" ?>">
            <?= count($movements) - $key ?> deposit
          </div>
          <div class="movements__date"><?= $mov["created_at"] ?></div>
          <div class="movements__value">
            <?= htmlspecialchars($accDetails->formatCurrency($mov["amount"], $accDetails->getCurrency()))  ?>
          </div>
        </div>
      <?php endforeach ?>

    </div>

    <!-- SUMMARY -->
    <div class="summary">
      <p class="summary__label">In</p>
      <p class="summary__value summary__value--in"><?= $accDetails->getIn() ?? 0 ?></p>
      <p class="summary__label">Out</p>
      <p class="summary__value summary__value--out"><?= $accDetails->getOut() ?? 0 ?></p>
      <p class="summary__label">Interest</p>
      <p class="summary__value summary__value--interest"><?= $accDetails->getInterest() ?? 0 ?></p>
      <button class="btn--sort">&downarrow; SORT</button>
    </div>

    <!-- OPERATION: TRANSFERS -->
    <div class="operation operation--transfer">
      <h2>Transfer money</h2>
      <form class="form form--transfer">
        <input type="text" class="form__input form__input--to" />
        <input type="number" class="form__input form__input--amount" />
        <button class="form__btn form__btn--transfer">&rarr;</button>
        <label class="form__label">Transfer to</label>
        <label class="form__label">Amount</label>
      </form>
    </div>

    <!-- OPERATION: LOAN -->
    <div class="operation operation--loan">
      <h2>Request loan</h2>
      <form method="post" class="form form--loan" action="<?= siteUri("./process/transactions.php?action=loan") ?>">
        <input type="number" class="form__input form__input--loan-amount" name="amount" />
        <button class="form__btn form__btn--loan">&rarr;</button>
        <label class="form__label form__label--loan">Amount</label>
      </form>
    </div>

    <!-- OPERATION: CLOSE -->
    <div class="operation operation--close">
      <h2>Close account</h2>
      <form class="form form--close">
        <input type="text" class="form__input form__input--user" />
        <input type="password" maxlength="6" class="form__input form__input--pin" />
        <button class="form__btn form__btn--close">&rarr;</button>
        <label class="form__label">Confirm user</label>
        <label class="form__label">Confirm PIN</label>
      </form>
    </div>
    <!-- LOGOUT TIMER -->
    <p class="logout-timer">
      You will be logged out in <span class="timer">05:00</span>
    </p>
  </main>
  <script src=<?= siteUri("./assets/scripts/script.js?v=") . rand(99, 999999999) ?>></script>
</body>

</html>