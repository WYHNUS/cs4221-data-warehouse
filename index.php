<!DOCTYPE html>
<head>
  <title>Data Warehouse</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
  <?php
    $currentPage = '';
    $homePage = 'home';
    $queryPage1 = 'query1';
    $queryPage2 = 'query2';
    $queryPage3 = 'query3';
    $queryPage4 = 'query4';

    // Routing
    $request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
    switch ($request_uri[0]) {
      case '/':
        if ($currentPage != $homePage) {
          $currentPage = $homePage;
          require $currentPage.'.php';
        }
        break;
      case '/query1':
        if ($currentPage != $queryPage1) {
          $currentPage = $queryPage1;
          require $currentPage.'.php';
        }
        break;
      case '/query2':
        if ($currentPage != $queryPage2) {
          $currentPage = $queryPage2;
          require $currentPage.'.php';
        }
        break;
      case '/query3':
        if ($currentPage != $queryPage3) {
          $currentPage = $queryPage3;
          require $currentPage.'.php';
        }
        break;
      case '/query4':
        if ($currentPage != $queryPage4) {
          $currentPage = $queryPage4;
          require $currentPage.'.php';
        }
        break;
      default:
        echo "Page not found. :(";
        break;
    }
  ?> 
</body>
</html>
