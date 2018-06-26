<?php
include "class.answ.php";
include "class.cats.php";
include "class.lessons.php";
include "class.qws.php";
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
  font-size:20px;
}
</style>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Main</title>

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
        <nav id="container-fluid" class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
<?php
cats::printlinklist(0,'<ul class="nav nav-pills flex-column" style="padding-left:10px;">','</ul>');
?>
        </nav>

        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h2><?php echo cats::catname($_GET["cat"])  ?></h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
<?php
$lessons=lessons::getbycat($_GET["cat"]);
foreach($lessons as $lesson){
?>
<tr>
	<td><?php echo $lesson["name"] ?></td>
	<td><?php
if($lesson["type"]=='text') echo 'Статья';
if($lesson["type"]=='test') echo 'Тест';
if($lesson["type"]=='file') echo 'Файл';
?></td>
	<td><?php
if($lesson["type"]=='text') echo '<a href="#" class="lookpost" data-id="'.$lesson["id"].'">Читать</a>';
if($lesson["type"]=='test') echo '<a href="/looktest.php?id='.$lesson["id"].'" class="looktest">Пройти тест</a>';
if($lesson["type"]=='file') echo '<a download href="/download/'.$lesson["text"].'">Скачать</a>';
?></td>
</tr>
<?php
}
?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
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
</script>
  </body>
</html>

