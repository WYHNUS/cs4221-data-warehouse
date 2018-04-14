<?php
  include('head.html');
  include('navbar.php');
?>

<h2>Query 2</h2>
<p>Display the total sum of the extended prices for each existing combination of customer region, customer nation and customer market segment.</p>

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

      $('#query_id').val('2')
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
