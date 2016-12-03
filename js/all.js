$('#postSubmit').click(function(){
	console.log("uuasd");
    var name = $('#name').val();
    var description = $('#description').val();
    $.ajax
    ({ 
        url: '/postText',
        data: {"name": name,
	       "description":description
		},
        type: 'POST',
        success: function(result)
        {          
		
        }
    });
});
