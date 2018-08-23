var obj;
var gender;
var i;
var arrayLog;
var td;
var arm_name;
var eng_name;
var album_id;
var this_span;
var hidden_id;
var ids;
var delet = true;
var edit;

// registration 

$('.button_reg').click(function(){
	obj = {};
	$('.form_input_reg').each(function(){
//		$('.form_input_reg').val().length;
		obj[$(this).attr('id')] = $(this).val();
	})
	obj['gender'] = $('.gender_input:checked').val();
	$.ajax ({
		url : 'reg_log.php',
		type : 'post',
		data : {obj : obj},
		dataType : 'json',
		success : function(reg){
			for (i = 0; i <reg.length; i++) {
				$('#'+reg[i]).addClass('error');
				$('.form_main').click(function(){
					$(this).find('.form_input_reg').removeClass('error');
				})
			}
			if  (reg == 0) {
					$('.reg_error').addClass('reg_log_errors');
					$('#formPassword').click(function(){
						$('.reg_error').removeClass('reg_log_errors');
					})
			}
			else if (reg == 1) {
				alert('duq grancvel eq');
				window.location.href = 'index.php';
			}
			else if (reg == 4) {
					$('.reg_length_errors').addClass('reg_log_errors');
					$('.form_main').click(function(){
						$('.reg_length_errors').removeClass('reg_log_errors');
					})
			};
		}
	})
});


// login

$('.button_log').click(function(){
	arrayLog = {};
	$('.form_input_log').each(function(){
		arrayLog[$(this).attr('id')] = $(this).val();
	})
	if ($('.remember').is(':checked')) {
		arrayLog['remember'] = 'checked';
 	}
	$.ajax ({
		url : 'reg_log.php',
		type : 'post',
		data : {arrayLog : arrayLog},
		dataType : "json",
		success : function(log){
			for (i = 0; i <log.length; i++) {
				$('#'+log[i]).addClass('error');
			}
			if (log == 0) {
				$('.log_error').addClass('reg_log_errors');
				$('#formPassword').click(function(){
					$('.log_error').removeClass('reg_log_errors');
				})
				$('#formPassword').val('');
			}
			else if (log == 1) {
				window.location.href = 'home.php';
			}
		}
	})
});



//var fileToUpload = $('#input-file').prop('files');

// edit album


$('.edit').click(function(){
	td = $(this).closest('tr');
	arm_name = td.find('.arm_name').text();
	eng_name = td.find('.eng_name').text();
	hidden_id = $('.edit').find('span').attr('data-album-id');
	$('.edit_arm').val(arm_name);
	$('.edit_eng').val(eng_name);
	$('.hidden_id').val(hidden_id);
	})

$('.remove_album').click(function(){
	this_span = $(this);
	album_id = $(this).attr('data-album-id');
	td = $(this).closest('tr');
	$.ajax({
		url : 'del_album.php',
		type : 'post',
		data : {a_id : album_id},
		success : function(x){
			if (x == 0) {
				alert('chi jnjve')
					

					}
					else if (x == 1) {
						td.fadeOut(500,function(){
							$(this).remove();
						});
				};
		}
	})
}) 

// all checkbox

$("#all_checkbox").click(function () {
        $('.checkbox_album').prop('checked',this.checked);
    });

$('.del').click(function(){
	ids=[];
	$('.checkbox_album:checked').each(function(){
		ids.push($(this).attr('data-album-id'));
	})
	if (ids.length === 0) {
	alert('0 length');
}
else{
	$.post({
		url : 'del_album_all.php',
		data : {ids : ids},
		success : function(res){
			if (res == 1) {
				$('.checkbox_album:checked').parent().parent().fadeOut(500,function(){
					$(this).remove()
				})
			}
			else if (res == 0) {
				alert('chi jnje');
			};
		}
	})
	} 
});

// change img pf bg

$('.change_img').click(function () {
  choose = $(this).attr('id');
  upload = $(this).attr('data-name');
  var modal_header = $(this).text();
  $('.modal-title').text(modal_header);

 
})

$(document).on('click', '.change_img', function(){
	$('.modalImg').remove();
 	$('.upload').remove();
 	$("#profil_img_input").replaceWith($("#profil_img_input").val('').clone(true));
})



$('.input_img').change(function(){
	$('.modalImg').remove();
 	$('.upload').remove();
// 	$("#profil_img_input").replaceWith($("#profil_img_input").val('').clone(true));
		var input = this;
        var fileData = $('.input_img').prop('files')[0];
        var formData = new FormData();
        formData.append('type',choose);
        formData.append('file', fileData);
        $.ajax({
            type: "POST",
            url: "change_img.php",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data) {
            	if (data == 1) {
            		$('.modal-body').append("<img class='modalImg' src='' height='300px' width='300px'>");
					var reader = new FileReader();
           	 			reader.onload = function (e) {
               	 			$('.modalImg').attr('src', e.target.result);
            			}
            		reader.readAsDataURL(input.files[0]);
            		$('.footer_img').append('<button type="button" class="btn btn-success upload" data-dismiss="modal">upload</button>');
            	}
            	else if (data == 0) {
            		$('.modal-body').append("<span style='color:red'>file invalid</span>");
            	}
            	else if (data == 3) {
            		$('.modal-body').append("<span style='color:red'>file error</span>");
            	}
            	
            }

       	})
})

//upload

$(document).on('click', '.upload', function(){
		var fileData = $('.input_img').prop('files')[0];
        var formData = new FormData();
        formData.append('type',upload);
        formData.append('file', fileData);
        $.ajax({
        	type: "POST",
            url: "change_img.php",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(uploadImg){
            	if (uploadImg) {
            		if (upload == 'profileUpload') {
            			$('.profile_img').attr('src', uploadImg);
            			$('.header_img').attr('src', uploadImg);
            			$('.deleteImgProfile').addClass('addImgDel');
            		}
            		else if (upload == 'coverUpload') {
            			$('.home_bg').attr('src', uploadImg);
            			$('.deleteCover').addClass('addImgDel');
            		}
            	}
            	else if (uploadImg == 4) {
            		$('.modal-body').append("<span style='color:red'>file error</span>");
            	}
     			
            }
        })

})

//delete images

$(document).on('click', '.deleteImg', function(){
	var ids = $(this).attr('id');
	$.ajax({
		type: "POST",
        url: "delete_img.php",
        data: {delet : delet , ids : ids},
        success: function(delet_res){
        	if (ids == 'DelProfileImg') {
        		if (delet_res) {
        				$('.profile_img').attr('src', delet_res);
            			$('.header_img').attr('src', delet_res);
            			$('.deleteImgProfile').removeClass('addImgDel');
   	 	 		}
   	 	 		else if (delet_res == 0) {
   	 	 			alert('no');
   	 	 		}
        	}
        	else if (ids == 'DelCoverImg') {
        				if (delet_res) {
        					$('.home_bg').attr('src', delet_res);
        					$('.deleteCover').removeClass('addImgDel');
		   	 	 		}
        	}
        }
	})
})


//settings

$('.editProfileSettings').click(function(){
	$('#form_edit').click(function(){
			$(this).find('.input_edit').removeClass('error');
	})
	var nameVal = $('#name').val();
	var surnameVal = $('#surname').val();
	$('.top_name').text(nameVal);
	$('.top_surname').text(surnameVal);
//	        console.log($('#form_edit').serialize());
	edit = {};
	edit['gender'] = $('.gender_input:checked').val();
	$('.input_edit').each(function(){
		edit[$(this).attr('id')] = $(this).val();
	})
	$.ajax({
		type: "POST",
        url: "editSettings.php",
        data: { edit : edit},
        dataType : 'json',
        success: function(edit_res){
		 		if (edit_res == 4) {
					$('.reg_length_errors').addClass('reg_log_errors');
					$('#form_edit').click(function(){
						$('.reg_length_errors').removeClass('reg_log_errors');
					})
			}
			else if (edit_res == 1) {
				window.location.href = 'logOut.php';
			}
			else if (edit_res == 2) {
				alert('ok');
			}
			else {
        		for (i = 0; i <edit_res.length; i++) {
					$('#'+edit_res[i]).addClass('error');				
				}
        	}
        }
	})        
});

//search
$(document).click(function(){
 	$('.search_div').fadeOut();
 	$('.searchName').val('');
 	$('.search_div').html('');

 //	$(".searchName").replaceWith($(".searchName").val('').clone(true));
})

$('.searchName').keyup(function(){
	$('.search_div').html('');
	var text = $('.searchName').val();
	$('.search_div').fadeIn();
	if ($('.searchName').val() != '') {
		$.ajax({
			url : 'search.php',
			type : 'post',
			data : {text : text},
			dataType : "json",
			success: function(text_res){
				console.log(text_res);
				for (i = 0; i <text_res.length; i++) {
					$('.search_div').append("<div class='main_div_append'><a href='guest.php?guest_user_id="+text_res[i]['id']+"'><div class='append_div'><img class='mini_img' src='"+text_res[i]['profil_img']+"'></div><div class='user_name_surname'>"+text_res[i]['name']+" "+ text_res[i]['surname']+"</div></a></div>");
				}
			}
		})
	}
	
})


// post 

$('.input_post_img').change(function(){
	$('.modalPost').remove();
 	$('.post_submit').remove(); 	
// 	$("#profil_img_input").replaceWith($("#profil_img_input").val('').clone(true));
		var input = this;
        var fileData = $('.input_post_img').prop('files')[0];
        var formData = new FormData();
        formData.append('post_img','post');
        formData.append('file', fileData);
        $.ajax({
            type: "POST",
            url: "addPost.php",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(post_res) {
            	if (post_res == 1) {
            		$('.modal-body_post').append("<img class='modalPost' src='' height='300px' width='300px'>");
					var reader = new FileReader();
           	 			reader.onload = function (e) {
               	 			$('.modalPost').attr('src', e.target.result);
            			}
            		reader.readAsDataURL(input.files[0]);
            		$('.post_footer').append('<button type="submit" class="btn btn-success post_submit">add post</button>');
            	}
            	else if (post_res == 0) {
            		$('.modal-body_post').append("<span style='color:red'>file invalid</span>");
            	}
            	else if (post_res == 3) {
            		$('.modal-body_post').append("<span style='color:red'>file error</span>");
            	}
            	
            }

       })
})


$(document).on('click', '.post_submit', function(){
		var fileData = $('.input_post_img').prop('files')[0];
        var formData = new FormData();
        var text = $('#Pname').val();
        formData.append('post_img','post_submit');
        formData.append('file', fileData);
        formData.append('text_val', text);
        $.ajax({
        	type: "POST",
            url: "addPost.php",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(post_submit_res){
            	if (post_submit_res == 1) {
            		alert('ok')
//            		$('.post_data').append("<div class='append_post'></div>")
 //           		$('.append_post_img').attr('src', post_submit_res);
            	}
            	else if (post_submit_res == 4) {
            		$('.modal-body_post').append("<span style='color:red'>file error</span>");
            	}
     			
            }
        })

})

//post delete

$(document).on('click', '.remove_post', function(){
	var post_id = $(this).attr('data-post-id');
		$.ajax({
		url : 'delPost.php',
		type : 'post',
		data : {post_id : post_id},
		success: function(delete_post){
			if (delete_post == 1) {
				window.location.href = 'home.php';
			}
			else if (delete_post == 0) {
				alert('o_o');
			};
		}	
	})
})

// friend

$('.addFriend').click(function(){
	$('.addFriend').toggleClass('btn-success');
	var fr_id = $('.addFriend').attr('data-guest-id');
	$.ajax({
		url : 'addFriends.php',
		type : 'post',
		data : {fr_id : fr_id},
		success: function(friends){
			if (friends == 1) {
				alert('ok');
			}
		}
	})	
})

// friend div

$('.notice_button').click(function(){
	$('.friend_notice').toggleClass('friend_notice_block');
})

// comment 

$('.comment_btn').click(function(){
	var text_com = $('.comment_inp').val();
	var post_id = $('.post_id').val();
	$.ajax({
		url : 'comments.php',
		type : 'post',
		data : {text_com : text_com , post_id : post_id},
		success: function(comment){
			if (comment == 1) {
				alert('ok');
			}
		}
	})	
})

// message 

$('.message_button').click(function(){
	$('.message_sms_main').fadeIn();
})

$('.close_message').click(function(){
	$('.message_sms_main').fadeOut();
})

$('.send_sms').click(function(){
	var guest_id = $('.guest_id').val();
	var sms = $('.message_sms').val();
	$.ajax({
		url : 'message.php',
		type : 'post',
		data : {guest_id : guest_id , sms : sms},
		success: function(sms_res){
			if (sms_res == 1) {
			}
		}
	})	
})















/*






searchName
$('.searchName').remove();
	$('.search_div').fadeOut();
// cover img
$('.input_img').change(function(){
		var input = this;
        var fileData = $('.input_img').prop('files')[0];
        var formData = new FormData();
        formData.append('type',choose);
        formData.append('file', fileData);
        $.ajax({
            type: "POST",
            url: "change_img.php",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(dataBg) {
            	if (dataBg == 1) {
            		$('.modal-body').append("<img class='modalImg' src='' height='300px' width='300px'>");
					var reader = new FileReader();
           	 			reader.onload = function (e) {
               	 			$('.modalImg').attr('src', e.target.result);
            			}
            		reader.readAsDataURL(input.files[0]);
            		$('.modal-footer').append('<button type="button" class="btn btn-success upload" data-dismiss="modal">upload</button>');
            	}
            		
            }

       })
})


change_background_img
modal-footer
<img class='modalImg' src="">
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            console.log('2');
            reader.onload = function (e) {
                $('.modalImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


$('#upload').on('click', function() {
    var file_data = $('#sortpicture').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    alert(form_data);                             
    $.ajax({
                url: 'upload.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                    alert(php_script_response); // display response from the PHP script, if any
                }
     });
});

*/





