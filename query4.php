<?php
  include('head.html');
  include('navbar.php');
?>

<div class="main">
  <h2>Query 4</h2>
  <p>Determines how well the order priority system is working and gives an assessment of customer satisfaction.</p>

  <?php
    include('filter.html');
  ?>

  <table id="query_4_table" class="table" style="margin: 20px; display: none">
    <thead>
      <th>Order Priority</th>
      <th>Count for orders with at least one item having receiptdate > commitdate</th>
    </thead>
    <tbody id="query_4_table_content">
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

      $('#query_id').val('4')
      let serializedData = $('#filter_form').serialize()
      $.ajax({
        type: 'post',
        url: 'server.php',
        data: serializedData,
        success: (result) => {
          let content = JSON.parse(result)
          $('#query_4_table').show()

          let tableBody = $('#query_4_table_content')
          tableBody.empty()
          for (let row of content) {
            var tableRow = $('<tr></tr>')
            tableRow.append('<td>' + row.o_orderpriority + '</td>')
            tableRow.append('<td>' + row.count + '</td>')
            tableBody.append(tableRow)
          }
        }
      })
    })
  })
</script>
