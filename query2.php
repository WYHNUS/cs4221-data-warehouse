<?php
  include('head.html');
  include('navbar.php');
  $dbname = getenv('db_name');
  $user = getenv('user_name');
  $pwd = getenv('user_pwd');
  
  // connect to DB
  $db = pg_connect("host=localhost port=5432 dbname=".$dbname." user=".$user." password=".$pwd); 
?>

<h2>Query 2</h2>
<p>Display the total sum of the extended prices for each existing combination of customer region, customer nation and customer market segment.</p>
