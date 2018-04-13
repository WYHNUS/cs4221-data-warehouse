<ul class="nav navbar-nav navbar-right">
  <?php
    // Define each name associated with an URL
    $urls = array(
      'Home' => '/',
      'Query 1' => '/query1',
      'Query 2' => '/query2',
      'Query 3' => '/query3',
      'Query 4' => '/query4'
    );

    foreach ($urls as $name => $url) {
      $class = (($currentPage === $name) ? ' class="active" ' : '');
      echo '<li '.$class. '><a href="'.$url.'">'.$name.'</a></li>';
    }
  ?>
</ul>