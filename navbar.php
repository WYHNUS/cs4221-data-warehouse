<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">Data Warehouse</a>
    </div>
    <ul class="nav navbar-nav">
      <?php
        // Define each name associated with an URL
        $urls = array(
          'Home' => '/',
          'Query 1' => '/query1',
          'Query 2' => '/query2',
          'Query 3' => '/query3',
          'Query 4' => '/query4'
        );
        $currentPage = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

        foreach ($urls as $name => $url) {
          $class = (($currentPage === $url) ? ' class="nav-item active" ' : ' class="nav-item" ');
          echo '<li '.$class. '><a class="nav-link" href="'.$url.'">'.$name.'</a></li>';
        }
      ?>
    </ul>
  </div>
</nav>
