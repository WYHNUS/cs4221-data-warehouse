<?php
  $dbname = getenv('db_name');
  $user = getenv('user_name');
  $pwd = getenv('user_pwd');

  // connect to DB
  $db = pg_connect("host=localhost port=5432 dbname=".$dbname." user=".$user." password=".$pwd);

  switch ($_POST['query_id']) {
    case '1':
      // echo($_POST[start_date]);
      // echo($_POST[end_date]);
      echo("1");
      break;
    case '2':
      # todo...
      echo("2");
      break;
    case '3':
      # todo...
      echo("3");
      break;
    case '4':
      # todo...
      echo("4");
      break;
    default:
      echo('invalid query id');
      break;
   }
?>