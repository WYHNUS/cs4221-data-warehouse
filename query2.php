<?php
  include('head.html');
  include('navbar.php');
?>

<h2>Query 2</h2>
<p>Display the total sum of the extended prices for each existing combination of customer region, customer nation and customer market segment.</p>

<?php
  include('filter.html');
?>

<table id="query_2_table" class="table" style="margin: 20px; display: none">
  <thead>
    <th>Total Sum of Extended Prices</th>
    <th>Customer Region</th>
    <th>Customer Nation</th>
    <th>Customer Market Segment</th>
  </thead>
  <tbody id="query_2_table_content">
  </tbody>
</table>

<script>
  $(() => {
    $('#filter_form').on('submit', (e) => {
      e.preventDefault()

      if (!formValidation()) {
        return
      }

      $('#query_id').val('2')
      let serializedData = $('#filter_form').serialize()
      $.ajax({
        type: 'post',
        url: 'server.php',
        data: serializedData,
        success: (result) => {
          let content = JSON.parse(result)
          $('#query_2_table').show()

          let tableBody = $('#query_2_table_content')
          tableBody.empty()
          for (let row of content) {
            var tableRow = $('<tr></tr>')
            tableRow.append('<td>' + row.sum + '</td>')
            tableRow.append('<td>' + row.r_name + '</td>')
            tableRow.append('<td>' + row.n_name + '</td>')
            tableRow.append('<td>' + row.c_mktsegment + '</td>')
            tableBody.append(tableRow)
          }
        }
      })
    })
  })
</script>
