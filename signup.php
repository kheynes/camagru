<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="styles/index.css">
    <meta charset="UTF-8">
    <title>SIGNUP</title>
  </header>
  <body>
    <?php include('header.php') ?>
    <?php include('footer.php') ?>
    <div id="login">
      <div class="title">SIGNUP</div>
        <form method="post" style="position: relative;" action="signup.php">
          <label>Email: </label>
          <input id="mail" name="email" placeholder="email" type="mail">
          <label>Username: </label>
          <input id="name" name="username" placeholder="username" type="text">
          <label>Password: </label>
          <input id="password" name="password" placeholder="password" type="password">
          <input name="submit" type="submit" value=" SEND ">
        </form>
    </div>
  </body>
</HTML>