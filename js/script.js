$(document).ready(function () {
	$("#gogo").click(function () {
		var start = $("input[name=start]").val();
		var end = $("input[name=end]").val();
		var sd = Date.parse(start);
		var ed = Date.parse(end);
		if (ed < sd) {
			$("input[name=end]").val(start);
		}
		
		$.ajax({  
				type: "POST",  
				url: "../ajax-info.php",  
				data: {
					start:start,
					end:end
				},
				success: function(html){  
						$("#all-quan").html(html); 								
				}  
		});			
	});

})