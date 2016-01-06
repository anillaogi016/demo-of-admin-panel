<div class="alert alert-success alert-hover" id="flash_success">
	<button class="close"><span aria-hidden="true">&times;</span></button>
	<i class="fa fa-check"></i> <?php echo $message; ?>
</div>
<script type="text/javascript">
$('#flash_success').addClass('animated fadeInLeft');
$( ".close" ).click(function() {
	$('#flash_success').removeClass('fadeInLeft');
	$('#flash_success').addClass('fadeOutRight');
	setTimeout(
        function() 
        {
            $('#flash_success').hide();
        }, 600);
});
setTimeout(
  function() 
  {
    $('#flash_success').removeClass('fadeInLeft');
	$('#flash_success').addClass('fadeOutRight');
  }, 4000);
setTimeout(
  function() 
  {
   $('#flash_success').hide();
  }, 4600);
</script>
