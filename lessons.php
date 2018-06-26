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
include "class.cats.php";
include "class.lessons.php";

if(!empty($_POST)){
	include "post.php";
}
?><!DOCTYPE html>
<html lang="en">
<style>
body {
  background-attachment:fixed;
  background-image:url(img/wallpaper13.jpg);
  background-size:cover;
  color:white;
}
#container-fluid {
  background-attachment:fixed;
  background-image:url(img/wallpaper13.jpg);
  background-size:cover;
}
</style>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Exercises</title>

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
          <li class="nav-item">
            <a class="nav-link" href="/users.php">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/cats.php">Category</a>
          </li>
          <li class="nav-item active">
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
<?php
if(!empty($_GET["action"])){
	if($_GET["action"]=='add'){
?>
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h2>Add the test</h2>
          
          <div class="panel">
          	<form class="panel-body" action="" method="post" enctype="multipart/form-data">
            	<div class="row">
                	<div class="col-sm-12">
            			<label>Name</label>
                	</div>
                </div>
            	<div style="color:yellow;" class="row">
                	<div class="col-sm-12">
                    	<input type="text" class="form-control" name="name">
                	</div>
                </div>
            	<div class="row">
                	<div class="col-sm-12">
            			<label>Category</label>
                	</div>
                </div>
            	<div class="row">
                	<div class="col-sm-12">
                    	<select class="form-control" name="cat">
<?php cats::printoptlist() ?>
                        </select>
                	</div>
                </div>
            	<div class="row">
                	<div class="col-sm-12">
            			<label>Type</label>
                	</div>
                </div>
            	<div class="row">
                	<div class="col-sm-12">
                        <label>
                            <input type="radio" name="type" value="text" checked>
                            Text
                        </label>
                        <label>
                            <input type="radio" name="type" value="file">
                            File
                        </label>
                        <label>
                            <input type="radio" name="type" value="test">
                            Test
                        </label>
                	</div>
                </div>
            	<div class="row block-file">
                	<div class="col-sm-12">
		                <input type="file" name="file">
                	</div>
                </div>
            	<div class="row block-text">
                	<div class="col-sm-12">
						<textarea name="text" style="width: 100%;"></textarea>
                	</div>
                </div>
            	<div class="row block-test">
                	<div class="col-sm-12">
                		Zapolnyaetsa pri redaktirovanii testa.
                    </div>
                </div>
                <div class="row">
                	<div class="col-sm-12">
                		<hr>
                    </div>
                	<div class="col-sm-12">
                		<input type="submit" class="btn btn-secondary" name="addlesson" value="Добавить">
                    </div>
                </div>
          	</form>
          </div>
        </main>
<?php
	}
}else{
?>
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h2>Exercises <a class="btn btn-success" href="/lessons.php?action=add">Add</a></h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Type</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
<?php
$lessons=lessons::get();
foreach($lessons as $lesson){
?>
                <tr>
                  <td><?php echo $lesson["id"] ?></td>
                  <td><?php echo $lesson["name"] ?></td>
                  <td><?php echo cats::catname($lesson["cat"]) ?></td>
                  <td><?php echo $lesson["type"] ?></td>
                  <td><form action="" method="post"><button type="submit" value="<?php echo $lesson["id"] ?>" name="dellesson" class="btn btn-primary">Удалить</button></form></td>
                  <td><?php if($lesson["type"]=='test'){ ?><a href="/qw.php?id=<?php echo $lesson["id"] ?>" class="btn btn-info">Вопросы</a><?php } ?></td>
                </tr>
<?php
}
?>
              </tbody>
            </table>
          </div>
        </main>
<?php } ?>
      </div>
    </div>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script type="text/javascript" src="/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
		$('.block-file').hide();
		$('.block-test').hide();
	$('input[name="type"]').change(function(e) {
		$('.block-file').hide();
		$('.block-text').hide();
		$('.block-test').hide();
        $('.block-'+$(this).val()).show();
    });
</script>
  </body>
</html>

