//Окно подтверждения удаления
$(document).ready(function()
{
  $('.delete').click(function()
	 {
		var rel = $(this).attr("rel");
		$.confirm(
		  {
			'title'		:'Підтвердження вилучення',
			'message'	:'Після вилучення відновити дані буде неможливо! Продовжити?',
			'buttons'	:{
				           'Так'	:{
				           'class'	:'blue',
				           'action':function(){
					                            location.href=rel;
					                          }
				                     },
				            'Ні'	:{
				                      'class'	:'gray',
				                      'action':function(){}
				                     }
			             }
		  })
	 })	  


//Добавление и удаление фоток
$('#select-lincks').click(function()
   {$('#list-lincks').slideToggle(200);}
 )
	
	
$('.h3click').click(function()
   {$(this).next().slideToggle(400);}
 )

var count_input=1;
$("#add-input").click(function(){
						count_input++;
						$('<div id="addimage'+count_input+'" class="addimage"><input type="hidden" name="MAX_FILE_SIZE" value="2000000"/><input type="file" name="galleryimg[]"/><a class="delete-input" rel="'+count_input+'">Стерти</a></div>').fadeIn(300).appendTo('#objects');
						})
						
		

$(document).on('click','.delete-input',function(){
    
 var rel = $(this).attr("rel");
  
 $("#addimage"+rel).fadeOut(300,function(){    
    $("#addimage"+rel).remove();      
 });

});﻿
							 
							
})



 