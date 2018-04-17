<?php
  // helper function
  function build_condition($arr, $keyword) {
    $conditon = '';
    if (empty($arr)) {
      return $conditon;
    }
    foreach ($arr as $key=>$value) {
      $conditon .= ' OR ';
      if (strpos($value, '-')) {
        // range query
        $rangePair = explode('-', $value);
        $conditon .= ' ('.$keyword.' >= '.$rangePair[0].' AND '.$keyword.' <= '.$rangePair[1].') ';
      } else {
        // individual id
        $conditon .= ' '.$keyword.' = '.$value.' ';
      }
    }
    // substring to remove extra AND
    return substr($conditon, 4);
  }

  // helper function
  function build_date_condition($sd, $ed) {
    $condition = '';
    if ($sd) {
      $condition .= " O_ORDERDATE >= TO_DATE('".$sd."', 'MM/DD/YYYY') ";
      if ($ed) {
        $condition .= ' AND ';
      }
    }
    if ($ed) {
      $condition .= " O_ORDERDATE <= TO_DATE('".$ed."', 'MM/DD/YYYY') ";
    }
    return $condition;
  }

  // assume each element in $condition_arr is already valid conditions
  function build_query_conditons($condion_arr) {
    $condion_arr = array_filter($condion_arr);
    if (empty($condion_arr)) {
      return '';
    }
    $query_condition = '';
    foreach ($condion_arr as $key=>$value) {
      $query_condition .= ' AND ('.$value.')';
    }
    // substring to remove extra AND
    return ' WHERE '.substr($query_condition, 5);
  }

  // pre-process post data
  $customer_ids = isset($_POST['customer_ids']) ? array_filter(explode(",", $_POST['customer_ids'])) : [];
  $part_ids = isset($_POST['part_ids']) ? array_filter(explode(",", $_POST['part_ids'])) : [];
  $supplier_ids = isset($_POST['supplier_ids']) ? array_filter(explode(",", $_POST['supplier_ids'])) : [];

  $condition = [
    build_condition($customer_ids, 'O_CUSTKEY'),
    build_condition($part_ids, 'L_PARTKEY'),
    build_condition($supplier_ids, 'L_SUPPKEY'),
    build_date_condition($_POST['start_date'], $_POST['end_date'])
  ];
  $query_condition = build_query_conditons($condition);

  // setup DB connection
  $dbname = getenv('db_name');
  $user = getenv('user_name');
  $pwd = getenv('user_pwd');
  $db = pg_connect("host=localhost port=5432 dbname=".$dbname." user=".$user." password=".$pwd);

  switch ($_POST['query_id']) {
    case '1':
      $query = "SELECT L_ORDERKEY, O_ORDERDATE, L_EXTENDEDPRICE, C_NAME, P_NAME, S_NAME FROM STAR_LINEORDER LEFT JOIN STAR_CUSTOMER ON STAR_LINEORDER.O_CUSTKEY = STAR_CUSTOMER.C_CUSTKEY LEFT JOIN PART ON STAR_LINEORDER.L_PARTKEY = PART.P_PARTKEY LEFT JOIN SUPPLIER ON STAR_LINEORDER.L_SUPPKEY = SUPPLIER.S_SUPPKEY ".$query_condition.";";
      $result = pg_query($db, $query);
      $row = pg_fetch_all($result);
      echo(json_encode($row));
      break;
    case '2':
      $query = "SELECT STAR_CUSTOMER.R_NAME, STAR_CUSTOMER.N_NAME, STAR_CUSTOMER.C_MKTSEGMENT, SUM(L_EXTENDEDPRICE) FROM STAR_LINEORDER LEFT JOIN STAR_CUSTOMER ON STAR_LINEORDER.O_CUSTKEY = STAR_CUSTOMER.C_CUSTKEY LEFT JOIN PART ON STAR_LINEORDER.L_PARTKEY = PART.P_PARTKEY LEFT JOIN SUPPLIER ON STAR_LINEORDER.L_SUPPKEY = SUPPLIER.S_SUPPKEY ".$query_condition." GROUP BY STAR_CUSTOMER.R_NAME, STAR_CUSTOMER.N_NAME, STAR_CUSTOMER.C_MKTSEGMENT;";
      $result = pg_query($db, $query);
      $row = pg_fetch_all($result);
      echo(json_encode($row));
      break;
    case '3':
      $query = "SELECT STAR_DATE.year, STAR_DATE.month, SUM(L_EXTENDEDPRICE) AS PRICE_SUM, SUM(L_EXTENDEDPRICE - L_DISCOUNT) AS DISCOUNTED_PRICE_UM, SUM(L_EXTENDEDPRICE - L_DISCOUNT + L_TAX) AS DISCOUNTED_TAXED_PRICE_SUM, AVG(L_QUANTITY) AS AVERAGE_QTY, AVG(L_EXTENDEDPRICE) AS AVERAGE_PRICE, AVG(L_DISCOUNT) AS AVERAGE_DISCOUNT, count(*) AS LINE_COUNT FROM STAR_LINEORDER LEFT JOIN STAR_CUSTOMER ON STAR_LINEORDER.O_CUSTKEY = STAR_CUSTOMER.C_CUSTKEY LEFT JOIN PART ON STAR_LINEORDER.L_PARTKEY = PART.P_PARTKEY LEFT JOIN SUPPLIER ON STAR_LINEORDER.L_SUPPKEY = SUPPLIER.S_SUPPKEY LEFT JOIN STAR_DATE ON STAR_LINEORDER.O_ORDERDATE = STAR_DATE.datum".$query_condition."GROUP BY STAR_DATE.YEAR, STAR_DATE.MONTH ORDER BY STAR_DATE.YEAR, STAR_DATE.MONTH;";
      $result = pg_query($db, $query);
      $row = pg_fetch_all($result);
      echo(json_encode($row));
      break;
    case '4':
      $modified_condition = empty($query_condition) ? '' : ' AND '.substr($query_condition, 6);
      $query = "SELECT s.O_ORDERPRIORITY, COUNT(*) FROM STAR_LINEORDER s WHERE s.L_RECEIPTDATE > s.L_COMMITDATE ".$modified_condition." GROUP BY s.O_ORDERPRIORITY ORDER BY s.O_ORDERPRIORITY ASC;";
      $result = pg_query($db, $query);
      $row = pg_fetch_all($result);
      echo(json_encode($row));
      break;
    default:
      echo('invalid query id');
      break;
   }
?>