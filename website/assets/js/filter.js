
$(document).ready(function() {

	$('select').change(function() {
		var value=$(this).val();
		var industry=$('#industry').val();
		var tag=$('#tag').val();
		if ($(this).attr('id')=="industry" ){
			var industry = value;
			$('table tbody tr ').each(function(index) {
					console.log($(this).children().eq(1).text()+" : "+ "ind: "+ $(this).attr('industry')+"  "+value+"   tag: "+$(this).attr('tag')+"  "+tag);

					if (($(this).attr('industry')!=value && value!=0) || (($(this).attr('tag')!=tag && tag!=0) )) {
							console.log($(this).children().eq(1).text()+" rm");
						$(this).css('display', 'none');
						$(this).fadeTo('slow', '0', function() {
							$(this).hide();
						});	
						
					} 
					else if (($(this).attr('industry')==value || value==0)  && ($(this).attr('tag')==tag || tag == 0)){
						console.log($(this).children().eq(1).text()+"pas  "+  $(this).attr('tag'));
							console.log($(this).children().eq(1).text()+" show");
							$(this).removeAttr('style');
						
					} 
				});
		} else {
			var tag = value;
			$('table tbody tr ').each(function(index) {
				//console.log($(this).children().eq(1).text()+" : "+ "ind: "+ $(this).attr('industry')+"  tag: "+$(this).attr('tag'));

				console.log("tag:asdasd");
				if(($(this).attr('tag')!=value && value!=0) || ($(this).attr('industry')!=industry && (industry!=0))    ) {
					console.log("hihhiihi");
					$(this).css('display', 'none');
					$(this).fadeTo('slow', '0', function() {
						$(this).hide();
					});
				} 
				else if ((($(this).attr('tag')==value) || value ==0 ) && ($(this).attr('industry')==industry || industry==0 )){
						$(this).removeAttr('style');
					} 

			});

			}


	
	});


});