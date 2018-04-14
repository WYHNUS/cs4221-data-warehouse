<?php
  include('head.html');
  include('navbar.php');
?>

<h2>Query 1</h2>
<p>Display the order key, customer name, part name, supplier name, order date and extended price for each selected item.</p>

<?php
  include('filter.html');
?>

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
          console.log(result)
        }
      })
    })
  })
</script>
