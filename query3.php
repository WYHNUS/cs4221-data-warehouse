<?php
  include('head.html');
  include('navbar.php');
?>

<h2>Query 3</h2>
<p>Create a pricing summary report page that reports the amount of business that was billed, shipped, and returned.</p>

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

      $('#query_id').val('3')
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
