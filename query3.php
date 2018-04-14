<?php
  include('head.html');
  include('navbar.php');
?>

<div class="main">
  <h2>Query 3</h2>
  <p>Create a pricing summary report page that reports the amount of business that was billed, shipped, and returned.</p>

  <?php
    include('filter.html');
  ?>

  <table id="query_3_table" class="table" style="margin: 20px; display: none">
    <thead>
      <th>Total Extended Prices</th>
      <th>Discounted Extended Prices</th>
      <th>Discounted Extended Prices plus Tax</th>
      <th>Average quantity</th>
      <th>Average Extended Prices</th>
      <th>Average Discount</th>
      <th>Year</th>
      <th>Month</th>
      <th>Lineitems Count</th>
    </thead>
    <tbody id="query_3_table_content">
    </tbody>
  </table>
</div>

<script>
  $(() => {
    $('#filter_form').on('submit', (e) => {
      e.preventDefault()

      if (!formValidation()) {
        return
      }

      $('#query_id').val('3')
      let serializedData = $('#filter_form').serialize()
      $.ajax({
        type: 'post',
        url: 'server.php',
        data: serializedData,
        success: (result) => {
          let content = JSON.parse(result)
          $('#query_3_table').show()

          let tableBody = $('#query_3_table_content')
          tableBody.empty()
          for (let row of content) {
            var tableRow = $('<tr></tr>')
            tableRow.append('<td>' + row.price_sum + '</td>')
            tableRow.append('<td>' + row.discounted_price_um + '</td>')
            tableRow.append('<td>' + row.discounted_taxed_price_sum + '</td>')
            tableRow.append('<td>' + row.average_qty + '</td>')
            tableRow.append('<td>' + row.average_price + '</td>')
            tableRow.append('<td>' + row.average_discount + '</td>')
            tableRow.append('<td>' + row.year + '</td>')
            tableRow.append('<td>' + row.month + '</td>')
            tableRow.append('<td>' + row.line_count + '</td>')
            tableBody.append(tableRow)
          }
        }
      })
    })
  })
</script>
