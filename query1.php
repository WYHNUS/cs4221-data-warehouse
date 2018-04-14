<?php
  include('head.html');
  include('navbar.php');
?>

<h2>Query 1</h2>
<p>Display the order key, customer name, part name, supplier name, order date and extended price for each selected item.</p>

<?php
  include('filter.html');
?>

<table id="query_1_table" class="table" style="margin: 20px; display: none">
  <thead>
    <th>Order Key</th>
    <th>Customer Name</th>
    <th>Part Name</th>
    <th>Supplier Name</th>
    <th>Order Date</th>
    <th>Extended Price</th>
  </thead>
  <tbody id="query_1_table_content">
  </tbody>
</table>

<script>
  $(() => {
    $('#filter_form').on('submit', (e) => {
      e.preventDefault()

      if (!formValidation()) {
        return
      }

      $('#query_id').val('1')
      let serializedData = $('#filter_form').serialize()
      $.ajax({
        type: 'post',
        url: 'server.php',
        data: serializedData,
        success: (result) => {
          let content = JSON.parse(result)
          $('#query_1_table').show()

          let tableBody = $('#query_1_table_content')
          tableBody.empty()
          for (let row of content) {
            var tableRow = $('<tr></tr>')
            tableRow.append('<td>' + row.l_orderkey + '</td>')
            tableRow.append('<td>' + row.c_name + '</td>')
            tableRow.append('<td>' + row.p_name + '</td>')
            tableRow.append('<td>' + row.s_name + '</td>')
            tableRow.append('<td>' + row.o_orderdate + '</td>')
            tableRow.append('<td>' + row.l_extendedprice + '</td>')
            tableBody.append(tableRow)
          }
        }
      })
    })
  })
</script>
