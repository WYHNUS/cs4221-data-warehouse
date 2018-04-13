<?php
  include('navbar.php');
  $dbname = getenv('db_name');
  $user = getenv('user_name');
  $pwd = getenv('user_pwd');

  // connect to DB
  $db = pg_connect("host=localhost port=5432 dbname=".$dbname." user=".$user." password=".$pwd); 
?>

<h2>Query 4</h2>
<p>Determines how well the order priority system is working and gives an assessment of customer satisfaction.</p>
