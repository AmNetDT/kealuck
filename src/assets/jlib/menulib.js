// JavaScript Document
//staff Registration toogle.

$(document).ready(function(){
	$('a[lang="af"]').click(function(e) {
		
		var items = $(this).attr('id');
		
		if(items === 'd1'){
		  $('a[lang="af"]').attr('class','noneactives');
		  $(this).attr('class','actives');
		   $(".dialog").hide();
		   $("#d11").show();
		   $("#contentbar_inner").scrollTop(0);
		}
		
		if(items === 'd2'){
			 $('a[lang="af"]').attr('class','noneactives');
		  $(this).attr('class','actives');
		  $(".dialog").hide();
		  $("#d13").show();
		 $("#contentbar_inner").scrollTop(0);
		  
		}
		
		if(items === 'd3'){
			 $('a[lang="af"]').attr('class','noneactives');
		  $(this).attr('class','actives');
	      $(".dialog").hide();
		  $("#d12").show();
		  $("#contentbar_inner").scrollTop(0);
		}
	})
	
	$("#close").click(function(){
		 $("#body_general").remove();
	})
	
	
})