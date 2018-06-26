<?php
session_start();
include "configuration.php";
include "sql.php";
include "class.profile.php";

$profile = new profile;
if(($profile->id)){
}else{
	include "login.php";
	exit();
}
include "class.users.php";

if(!empty($_POST)){
	include "post.php";
}
?><!DOCTYPE html>
<html lang="en">
<style>
body {
  background-attachment:fixed;
  background-image:url(img/wallpaper3.jpg);
  background-size:cover;
  color:white;
}
#container-fluid {
  background-attachment:fixed;
  background-image:url(img/wallpaper3.jpg);
  background-size:cover;
  color:white;
  font-size:20px;
}
</style>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Users</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="/"><?php echo $profile->login ?></a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
        <?php if($profile->type=='admin'){ ?>
          <li class="nav-item active">
            <a class="nav-link" href="/users.php">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/cats.php">Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/lessons.php">Exercises</a>
          </li>
        <?php } ?>
          <li class="nav-item">
            <a class="nav-link" href="/exit.php">Sign out</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav id="container-fluid" class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link">Manage the test</a>
            </li>
          </ul>
        </nav>

        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h2>Users</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>id</th>
                  <th colspan="2">Login</th>
                  <th colspan="2">Type</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
<?php
$users=users::get();
foreach($users as $user){
?>
                <tr>
                  <td><?php echo $user["id"] ?></td>
                  <td colspan="2"><?php echo $user["login"] ?></td>
                  <td colspan="2"><?php echo $user["type"] ?></td>
                  <td><form action="" method="post"><button type="submit" value="<?php echo $user["id"] ?>" name="deluser" class="btn btn-primary">Удалить</button></form></td>
                </tr>
<?php
}
?>
              </tbody>
              <tfoot>
              	<form action="" method="post">
                  <th colspan="2"><input type="text" class="form-control" name="login" placeholder="логин"></th>
                  <th colspan="2"><input type="text" class="form-control" name="pass" placeholder="пароль"></th>
                  <th>
                  <select class="form-control" name="type">
                  	<option value="student">student lyudskoy</option>
                    <option value="admin">admin orochiy</option>
                  </select>
                  </th>
                  <th><button type="submit" value="add" name="adduser" class="btn btn-primary">Add new</button></th>
                </form>
              </tfoot>
            </table>
          </div>
        </main>
      </div>
    </div>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>

