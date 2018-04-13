<?php
  include('head.html');
  include('navbar.php');
  $dbname = getenv('db_name');
  $user = getenv('user_name');
  $pwd = getenv('user_pwd');

  // connect to DB
  $db = pg_connect("host=localhost port=5432 dbname=".$dbname." user=".$user." password=".$pwd);

  if (isset($_POST['filter'])) {
    echo($_POST[start_date]);
    echo($_POST[end_date]);
  }
?>

<h2>Query 1</h2>
<p>Display the order key, customer name, part name, supplier name, order date and extended price for each selected item.</p>

<form name="filter" action="query1.php" method="POST">
  Start Order Date: <input id="start_datepicker" name="start_date" width="276" /> <br>
  End Order Date: <input id="end_datepicker" name="end_date" width="276" /> <br>
  <input type="submit" name="filter" value="Submit">
</form>

<script>
  $('#start_datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    value: '01/01/2018'
  })

  $('#end_datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    value: '01/01/2018'
  })
</script>
