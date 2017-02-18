$(document).ready(function(){
	
	var user_href, user_href_splitted, user_id;
	var image_src, image_href_splitted, image_name;

	$(".photo-sm").click(function(){
		$("#set_user_image").prop("disabled", false);

		user_href = $(".user-id").prop("href");
		user_href_splitted = user_href.split("=");
		user_id = user_href_splitted[user_href_splitted.length - 1];
		
		image_src = $(this).prop("src");
		image_href_splitted = image_src.split("/");
		image_name = image_href_splitted[image_href_splitted.length - 1];

	});

	$("#set_user_image").click(function(){
		$.ajax({
			url: "ajax_code.php",
			data: {image_name: image_name, user_id: user_id},
			type: "POST",
			success: function(data){
				alert("It worked!");
			}
		});
	});

});