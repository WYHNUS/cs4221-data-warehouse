<?php
  include('navbar.php');
  $dbname = getenv('db_name');
  $user = getenv('user_name');
  $pwd = getenv('user_pwd');

  // connect to DB
  $db = pg_connect("host=localhost port=5432 dbname=".$dbname." user=".$user." password=".$pwd);

  $result = pg_query($db, "SELECT * FROM book where book_id = '$_POST[bookid]'");   // Query template
  $row    = pg_fetch_assoc($result);    // To store the result row
  if (isset($_POST['submit'])) {
      echo "<ul><form name='update' action='query1.php' method='POST' >  
    <li>Book ID:</li>  
    <li><input type='text' name='bookid_updated' value='$row[book_id]' /></li>  
    <li>Book Name:</li>  
    <li><input type='text' name='book_name_updated' value='$row[name]' /></li>  
    <li>Price (USD):</li><li><input type='text' name='price_updated' value='$row[price]' /></li>  
    <li>Date of publication:</li>  
    <li><input type='text' name='dop_updated' value='$row[date_of_publication]' /></li>  
    <li><input type='submit' name='new' /></li>  
    </form>  
    </ul>";
  }
  if (isset($_POST['new'])) { // Submit the update SQL command
      $result = pg_query($db, "UPDATE book SET book_id = '$_POST[bookid_updated]',  
  name = '$_POST[book_name_updated]',price = '$_POST[price_updated]',  
  date_of_publication = '$_POST[dop_updated]'");
      if (!$result) {
          echo "Update failed!!";
      } else {
          echo "Update successful!";
      }
  }
?>

<h2>Query 1</h2>
<p>Display the order key, customer name, part name, supplier name, order date and extended price for each selected item.</p>

<ul>
  <form name="display" action="query1.php" method="POST" >
    <li>Filtering:</li>
    <li><input type="text" name="bookid" /></li>
    <li><input type="submit" name="submit" /></li>
  </form>
</ul>