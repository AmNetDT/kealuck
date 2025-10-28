$(document).ready(function(){

	$("#loader_httpFeed").hide();
	$('._mc a').click(function (e) {
		
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: $(this).attr('id') + "/index.php",
			data: dataString,
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});
  
 
	
});