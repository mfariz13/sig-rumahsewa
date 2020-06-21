<?php
$setTemplate = false;
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $db->where("username", $username);
  $db->where("password", $password);
  $data = $db->getOne("user");
  if ($db->count > 0) {
    $session->set("logged", true);
    $session->set("username", $data->username);
    $session->set("id_user", $data->id_user);
    redirect(url("admin"));
  } else {
    $session->set("logged", false);
    $session->set("info", '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Username atau Password anda Salah
              </div>');
    redirect(url("login"));
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Form Login</title>
  <?php include 'layouts/head.php' ?>
  <link rel="stylesheet" href="<?= templates() ?>plugins/iCheck/square/blue.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Login</b>WEBGIS</a>
    </div>

    <div class="login-box-body">
      <p class="login-box-msg"></p>
      <?= $session->pull("info") ?>
      <form method="post">
        <label>Username</label>
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="username" placeholder="Username">

        </div>
        <label>Kata Sandi</label>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password">

        </div>
        <div class="row">

          <div class="col-xs-12">
            <button type="submit" name="login" class="btn btn-warning btn-block btn-flat">Sign In</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
<?php
include 'layouts/javascript.php';
?>
</html>