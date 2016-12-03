//# sourceURL=photo-gallery.js
function makeGallary(data){
	//       data=[{ image  }]
	var outList ="";
	data.forEach(function(image){
			var one = '<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">'
                        + '<div class="imgcontainer"> <div>'
			+ '<img width:120px; height 120px; class="img-responsive" src="' 
			+      'fileupload/files/' + image.name
			+ '">'
			+"</div> </div>"
			+' </li>';
			outList += one;
			});
         $("#gallaryImage").append(outList);
	setTimeout(init, 200);
}

$(document).ready(function(){        
		$.ajax
		({ 
url: '/getPics',
data: {},
type: 'GET',
success: function(result)
{          
if(result.success){
makeGallary(result.data);		
}
}
});



		});

function init(){
	$('li img').on('click',function(){
		var src = $(this).attr('src');
		var img = '<img src="' + src + '" class="img-responsive"/>';
		
		//start of new code new code
		var index = $(this).parent('li').index();   
		
		var html = '';
		html += img;                
		html += '<div style="height:25px;clear:both;display:block;">';
		html += '<a class="controls next" href="'+ (index+2) + '">next &raquo;</a>';
		html += '<a class="controls previous" href="' + (index) + '">&laquo; prev</a>';
		html += '</div>';
		
		$('#myModal').modal();
		$('#myModal').on('shown.bs.modal', function(){
			$('#myModal .modal-body').html(html);
			//new code
			$('a.controls').trigger('click');
		});
		$('#myModal').on('hidden.bs.modal', function(){
			$('#myModal .modal-body').html('');
		});
   });	
        
         
$(document).on('click', 'a.controls', function(){
	var index = $(this).attr('href');
	var src = $('ul.row li:nth-child('+ index +') img').attr('src');             
	
	$('.modal-body img').attr('src', src);
	
	var newPrevIndex = parseInt(index) - 1; 
	var newNextIndex = parseInt(newPrevIndex) + 2; 
	
	if($(this).hasClass('previous')){               
		$(this).attr('href', newPrevIndex); 
		$('a.next').attr('href', newNextIndex);
	}else{
		$(this).attr('href', newNextIndex); 
		$('a.previous').attr('href', newPrevIndex);
	}
	
	var total = $('ul.row li').length + 1; 
	//hide next button
	if(total === newNextIndex){
		$('a.next').hide();
	}else{
		$('a.next').show()
	}            
	//hide previous button
	if(newPrevIndex === 0){
		$('a.previous').hide();
	}else{
		$('a.previous').show()
	}
	
	
	return false;
});

}
