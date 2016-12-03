
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
	else if(id != "gallery"){
		console.log("in::" + id);
		$("#mainpane").load(id+".html", function(){             
				});
	}
	else {
		$("#mainpane").load("demo.html", function(){             
				});

/*		console.log(id);
		id = "products";
		$.ajax({
url: id+".json",
dataType: "json",
success: function(response) {
showGallery(response);
$(".contactowner").hide();
}

});
*/
}
}

function showGallery(response){
           $("#mainpane").empty();    		   
           var gallerypics ='<div id="gallerypics"><h2>Gallery</h2></div>'
                     +'<br><br><br>';
    var gallerypics2 ='<div id="gallerypics2"></div>';
           $("#mainpane").append($(gallerypics));
           addOneRow("gallerypics", response.splice(0,3),3);
    
            $("#mainpane").append($(gallerypics2));
    
           addOneRow("gallerypics2", response, 3);

}

function populateProduct(element){
    $(".sidebar-nav").children('li').removeClass('active');   
    $("topbar").children('li').removeClass('active');
	$(element).closest('li').addClass('active');	
	var id = $(element).closest("li").attr("id");
    if(id=="building"){
         id = "building";
    }
    else if(id=="doll"){
         id= "doll";
    }
	else if(id=="puzzle"){
         id= "puzzle";
    }
	else if(id=="vehicle"){
		id = "vehicle";
	}
	else {id="products"}
    $.ajax({
        url: id+".json",
        dataType: "json",
        success: function(response) {
           showData(response);
        }
    });
}


function showData(data){
  
    addTwoRow();
    addOneRow("swap", data, 3);
    addOneRow("free", data,3);
}
function addTwoRow(){
            $("#mainpane").empty();     
           var swap ='<div id="swap"><h2>Swapping</h2></div>'
                     +'<br><br><br>'
                    +'<div id="free"><h2>Free<h2></div>';
            $("#mainpane").append($(swap));
}
 function addOneRow(id, swapdata,ncell){
     //swapdata  is an array of object;
     var first4 = swapdata.splice(0, ncell);
      $("#"+id).append('<div class="row">');
      var row = $("#"+id+ ">.row");
      for(var i=0; i<first4.length; i++){        
           row.append(addOneProduct(first4[i])); 
     }
 }
 function addOneProduct(one){
      var div = '<div class="col-md-4 col-sm-12" style="text-align: center;" productid="'+one.id+'"></div>';
      var image = '<img src="'+one.image.small + '" height="130" "/>' 
	  +'<a title="Contact Owner" alt="Contact Owner"  target="_blank" href="#">'
	  + '<p  class="contactowner">Contact Owner</p>'
       +'</a>' ;
      var cell = $(div).append($(image));
     return cell;
  }

function makeJsonProduct(){
    var json = [];
    for(var i=0; i<10;i++){
        var one ={};
        one.id=i+1;
        one.image={};
        one.image.small = "assets/images2/image"+one.id+".jpg";
        json.push(one);
    }   
    JSON.stringify(json);
}




     /*
       {
    "id": 1,
    "name": "Sony Xperia Z3",
    "price": 899,
    "specs": {
      "manufacturer": "Sony",
      "storage": 16,
      "os": "Android",
      "camera": 15
    },
    "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tristique ipsum in efficitur pharetra. Maecenas luctus ante in neque maximus, sed viverra sem posuere. Vestibulum lectus nisi, laoreet vel suscipit nec, feugiat at odio. Etiam eget tellus arcu.",
    "rating": 4,
    "image": {
      "small": "assets/images/sony-xperia-z3.jpg",
      "large": "assets/images/sony-xperia-z3-large.jpg"
    }
  }
  */
