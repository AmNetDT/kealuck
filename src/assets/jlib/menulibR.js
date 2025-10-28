// JavaScript Document
//staff Registration toogle.

$(document).ready(function(){
	$('a[lang="as"]').click(function(e) {
		
		var items = $(this).attr('id');
		
		if(items === 'd1'){
		   $('a[lang="as"]').attr('class','noneactives');
		   $(this).attr('class','actives');
		   $("#r1").show();
		   $("#r2").hide();
		   $("#contentbar_inner").scrollTop(0);
		}
		
		if(items === 'd2'){
		  $('a[lang="as"]').attr('class','noneactives');
		  $(this).attr('class','actives');
		  $("#r2").show();
		  $("#r1").hide();
		  $("#contentbar_inner").scrollTop(0);
		}
	})
	
	$("#close").click(function(){
		 $("#body_general").remove();
	})
})