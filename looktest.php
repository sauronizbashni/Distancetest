<?php
session_start();
include "configuration.php";
include "sql.php";
include "class.profile.php";
$profile = new profile;
include "class.lessons.php";
include "class.answ.php";
include "class.cats.php";
include "class.qws.php";
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Dashboard</title>

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
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
<?php
cats::printlinklist(0,'<ul class="nav nav-pills flex-column" style="padding-left:10px;">','</ul>');
$test=lessons::get1($_GET["id"])
?>
        </nav>

        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
<form action="" method="post">
<?php
?>
          <h2><?php echo $test["name"] ?></h2>
          <div class="table-responsive">
<?php
$qws=qws::get($test["id"]);
$res["error"]=0;
$res["succes"]=0;
foreach($qws as $qw){
?>
<h5><?php echo $qw['name']; ?></h5>
<?php
	$answs=answ::get($qw["id"]);
	foreach($answs as $answ){
		if($_POST["answ".$answ['id']]){
			if($answ['stat']=='1') $res["succes"]++;
			else $res["error"]++;
		}else{
			if($answ['stat']=='1') $res["error"]++;
		}
?>
<label><input type="checkbox" name="answ<?php echo $answ['id']; ?>" value="<?php echo $answ['id']; ?>"> <?php echo $answ['name']; ?> </label><br>
<?php
	}
}
?>
<hr>
<?php
if(!$_POST['anstest']){ 
?>
<input type="submit" class="btn btn-primary" value="Готово" name="anstest">
<?php
}else echo 'результат: '.round($res["succes"]/($res["succes"]+$res["error"])*100).'%';
?>
          </div>
</form>
        </main>
      </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Result</h4>
      </div>
      <div class="modal-body">
<center>
	<font color="#0033FF" size="24px">
<?php
if(!$_POST['anstest']){ 
?>
<input type="submit" class="btn btn-primary" value="Готово" name="anstest">
<?php
}else echo 'результат: '.round($res["succes"]/($res["succes"]+$res["error"])*100).'%';
?>
	</font>
</center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script>
$('.lookpost').click(function(e) {
	$.post('/ajax.php',{
		id:$(this).attr('data-id'),
	},function(data){
		res=jQuery.parseJSON(data);
		$('#myModal .modal-body').html(res.html);
		$('#myModalLabel').html(res.title);
		$('#myModal').modal();
	}).fail(function(data){
		console.log(data);
	});
});
<?php
if(!$_POST['anstest']){ 
}else{
?>
$('#myModal').modal();
<?php
}
?>
</script>
  </body>
</html>

