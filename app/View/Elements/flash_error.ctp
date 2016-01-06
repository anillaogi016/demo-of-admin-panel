<div id="flash_error" class="alert alert-danger alert-hover">
<button class="close"><span aria-hidden="true">&times;</span></button>
<i class="fa fa-exclamation-triangle"></i><?php echo $message; ?>
</div>
<script type="text/javascript">
$('#flash_error').addClass('animated fadeInLeft');
$( ".close" ).click(function() {
	$('#flash_error').removeClass('fadeInLeft');
	$('#flash_error').addClass('fadeOutRight');
	setTimeout(
        function() 
        {
            $('#flash_error').hide();
        }, 600);
});
setTimeout(
  function() 
  {
    $('#flash_error').removeClass('fadeInLeft');
	$('#flash_error').addClass('fadeOutRight');
  }, 4000);
setTimeout(
  function() 
  {
   $('#flash_error').hide();
  }, 4600);
</script>