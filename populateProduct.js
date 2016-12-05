
$(document).ready(function() {
 $('#loginbutton').click(function(){

    var fname = $('#fname').val();
	var passwd = $('#passwd').val();

    $.ajax
    ({ 
        url: 'dologin.php',
        data: {"fname": fname,
		        "passwd":passwd
		},
        type: 'POST',
        success: function(result)
        {          
		   $('#loginresponsebox').text(result.reason);
        }
    });
	});
});

function getKnowPat(){
    $.ajax
    ({ 
        url: '/knowpat',
        data: {},
        type: 'get',
        success: function(result)
        {          
		  if(result.success){
			$("#mainpane").empty();
		        makeTable('mainpane', result.data);
		}
        }
    });
}



function makeTable(id, data){
	var thead =["Name", "First time know Pat", "Details", "Email"];
	var names = ["name", "email", "firsttime", "description"];
        names =["user_username", "firsttime", "description","user_email"]
	var table = $('<table></table>').addClass("TFtable");
	var row = $('<tr></tr>').addClass('schoolTableHead');
	var ths = "";
	thead.forEach(function(head){
			ths+= "<td>" + head + "</td>";
			});
	row.append($(ths));
	table.append(row);
	data.forEach(function(one){
			var row = $('<tr></tr>').addClass('school');
			var td = "";
			names.forEach(function(name){
					td+= "<td>" + (one[name]?one[name]  : " ")+ "</td>";
					});
			row.append($(td));
			table.append(row);
			});
	$('#'+id).append(table);
}



 
function populateContent(element){ 
	console.log(element);
	$(".navbar-nav").children('li').removeClass('active');
	$(element).closest('li').addClass('active');
	var id = $(element).closest("li").attr("id");
	if(id=="weknowpat"){
		getKnowPat();
	}
        else if(id=="home"){
	$("#mainpane").load("post.html", function(){             
				});
		
	}
	else if(id =="gallery"){

		$("#mainpane").load("gallery.html", function(){             
				});

	}
	else {
		console.log("in::" + id);
		$("#mainpane").load(id+".html", function(){             
				});
	}
}

