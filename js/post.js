//# sourceURL= post.js
$('[data-toggle="collapse"]').on('click', function() {
    var $this = $(this),
            $parent = typeof $this.data('parent')!== 'undefined' ? $($this.data('parent')) : undefined;
    if($parent === undefined) { /* Just toggle my  */
        $this.find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
        return true;
    }

    /* Open element will be close if parent !== undefined */
    var currentIcon = $this.find('.glyphicon');
    currentIcon.toggleClass('glyphicon-plus glyphicon-minus');
    $parent.find('.glyphicon').not(currentIcon).removeClass('glyphicon-minus').addClass('glyphicon-plus');

});
function makeNewPost(one){
var $media = $('<div class="media" id="post'+one.id +'" data-depth="'+ one.deep +'"></div>');
var heading=' \
        <div class="media-heading" data-group="'+one.groupID + '">';
        +  '<button class="btn btn-default btn-xs">'
        +   '<span class="glyphicon glyphicon-minus"></span></button> '
        +  '<span class="label label-info">Anonymous</span>' + one.postTime 
         + '</div>';
var $heading = $(heading);
var $body = $('<div class="media-body"> </div>');
var $comment = $('<p>'+ one.text + '</p>');
        var marginLeft=((one.deep -1) * 30) + "px"
        $media.css("margin-left",marginLeft);
	return ($media.append($heading,$comment))[0];

}

function makeReplyForm(groupID, sibilingRank=1){
var reply ='<div class="comment-meta" id ="reply'+groupID+'" >\
               <button type="button" class="btn btn-info replyform" onClick="displayForm(this)">Reply</button> \
             <div class="" id="replyCommentT" style="display:none; margin-top:10px">\
                <form onSubmit="return false;">\
                  <div class="form-group">\
                    <textarea name="comment" class="form-control" rows="3"></textarea>\
                  </div>\
                  <button onClick="formSubmit(this);" class="btn btn-default newPost" id="rank'+ sibilingRank + '">Submit</button>\
                </form>\
	      </div>\
              </div>';
var   $reply =$(reply);
	return $reply;

}

function sortData(data){
	//insert into post(userID, name, text, groupID, sibilingRank,deep) values(2,"yong2","test test test2",1,2,2);
	var groups = {};
	data.posts.forEach(function(post){
			//var groups[post.id] =
			  var post1 = post;
                           data.reply.forEach(function(one){
					    if(one.groupID ==post1.id){
							if(!groups[post1.id]){
								groups[post1.id]={};
							}
							groups[post1.id][one.sibilingRank]=one;
						}
			
					});	  
			});
	return groups;
}
function makeChildren(group1,groupID){
	if(group1){
		var keys = Object.keys(group1);
		var group = group1;
                var sibilingRank =0;
		keys.forEach(function(key){ 
				var html = makeNewPost(group[key]);
				if(sibilingRank<group[key].sibilingRank){
		                       sibilingRank = group[key].sibilingRank;			
				}
				groupID = group[key].groupID;
				$("#post"+groupID).append(html);
				});
	}
	$("#post"+groupID).append(makeReplyForm(groupID,sibilingRank));
}
function displayForm(element){
	$(element).next().css("display","block");

}

function makeAllPost(){
//get all post data
    $.ajax
    ({
        url: '/getPosts',
        data: {},
        type: 'GET',
	success: function(result){
	if(result.success){
	var groups = sortData(result.data);
        result.data.posts.forEach(function(post){
			var html = makeNewPost(post);
		        $("#posts").append(html);
			makeChildren(groups[post.id],post.id);
       });
	

	}
	}
    });
}

function formSubmit(element){
	var text = $(element).parent().find("textarea").val();
	if(!text.trim()) { 
		return; 
	}
	var data ={};
	data.text = text;
	var rank = $(element).attr("id");
	if(rank){
		rank = parseInt(rank.substring(4));
		data.sibilingRank = rank+1;
		var groupID = $(element).closest(".media").attr("id");
		groupID = parseInt(groupID.substring(4));
		data.groupID = groupID;
	}
	$.ajax
		({
url: '/postText',
data:data,
type: 'POST',
success: function(result){
if(result.success){
$("#home a").click();
}
}


});
}	
$(document).ready(function(){
     makeAllPost();

//
});

