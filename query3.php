<?php
  include('head.html');
  include('navbar.php');
  $dbname = getenv('db_name');
  $user = getenv('user_name');
  $pwd = getenv('user_pwd');

  // connect to DB
  $db = pg_connect("host=localhost port=5432 dbname=".$dbname." user=".$user." password=".$pwd); 
?>

<h2>Query 3</h2>
<p>Create a pricing summary report page that reports the amount of business that was billed, shipped, and returned.</p>
