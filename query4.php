<?php
  include('head.html');
  include('navbar.php');
?>

<h2>Query 4</h2>
<p>Determines how well the order priority system is working and gives an assessment of customer satisfaction.</p>

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

      $('#query_id').val('4')
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
