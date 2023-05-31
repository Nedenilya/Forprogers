$('.edit_fors_city').on('click', function(){

	$.ajax({
	    url: 'DB.php',
	    type: 'POST',
	    data: {
	    	getCityById : 'getCityById',
			id : $(this).attr('id')
	    },
	    success: function(response) {
			$('.edit_text_city').val(response.split('|')[1]); 
			$('.edit_text_city_old').val(response.split('|')[1]); 
			$('.edit_text_rangir').val(response.split('|')[2]); 
			$('.edit_id').val(response.split('|')[0]); 
			$('.edit_city_form').css('display', 'block');
	    }
	});

});
$('.edit_close').on('click', function(){
	$('.edit_city_form').css('display', 'none');
});	
$('.sort_city').on('click', function(){
	$('.sort_city_form').css('display', 'block');
});	
$('.close_city_form').on('click', function(){
	$('.sort_city_form').css('display', 'none');
});	


// ======================================================

$('.edit_fors_names').on('click', function(){

	$.ajax({
	    url: 'DB.php',
	    type: 'POST',
	    data: {
	    	getUserById : 'getUserById',
			id : $(this).attr('id')
	    },
	    success: function(response) {
			$('.edit_text_name').val(response.split('|')[1]); 
			$('.edit_text_surname').val(response.split('|')[2]); 
			$('.id_red').val(response.split('|')[0]); 
			$('.edit_selcity').val(response.split('|')[3]); 
			$('.prof_image').attr('src', response.split('|')[4]); 
			$('.hid_img').val(response.split('|')[4]); 

			$('.user_edit_form').css('display', 'block');
			$('.users').css('display', 'none');
	    }
	});

});


$('.add_user_form_open').on('click', function(){
	$('.add_user_form').css('display', 'block');
});	
$('.close_add_user').on('click', function(){
	$('.add_user_form').css('display', 'none');
});	

$('.close_user_edit').on('click', function(){
	$('.user_edit_form').css('display', 'none');
	$('.users').css('display', 'inline-block');
});	

$('.user_sort').on('click', function(){
	$('.user_sort_form').css('display', 'block');
	// $('.users').css('display', 'none');
});	

$('.close_user_sort').on('click', function(){
	$('.user_sort_form').css('display', 'none');
	// $('.users').css('display', 'inline-block');
});	