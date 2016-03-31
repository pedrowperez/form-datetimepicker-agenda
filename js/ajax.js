$('.xdsoft_time_variant').change(function(){
$.ajax({
    url : 'index.html',
    type : 'post',
    dataType: 'html',    
    success: function(retorno){
	$('.xdsoft_time').html(retorno);
      $('.xdsoft_time').css( "background-color", "black");
    }       
  })

});