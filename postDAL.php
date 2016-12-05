<?php
include_once("class.mysql.php");
function addQuotes($strs){
	$out ="";
	$i=0;
	foreach($strs as $i=>$str){
		if($i<count($strs)-1){
			$out = $out."'" .$str . "',";
		}
	}
	$out = count($strs)>1 ? ($out . "'" .$strs[count($strs)-1]."'") : ($out."'" .$strs[count($strs)-1]."'");
        return $out;
}
function getPosts(){
        global $mydb;
        $posts = $mydb->get_results("select * from post where deep=1 order by postTime DESC");
	$replies = $mydb->get_results("select * from post where deep>1");
	$results=array("posts"=>$posts,
			"reply"=>$replies);
	return $results;
}
function getPostsByID($id){
	global $mydb;
        return $mydb->get_results("select * from post where id=$id");

}
function getPics($ids=null){
        global $mydb;
        $results = $mydb->get_results("select * from files");
	return $results;
}

function getSiblingRank($groupID){
      global $mydb;
	//$mydb->get_row("Select max(siblingRank) as maxSib from post where  )")
}

function insertPosts($post){
	global $mydb;
	$id =0;
	//if is a new Post, insert the post, get new ID, update the groupID with new ID
	if(!isset($post['name'])){
		$post['name'] ="anonymous";
	}
	if(!isset($post["groupID"])){
		$sql = "insert into post(name,text, sibilingRank,deep) values('" . $post['name'] . "','" . $post['text'] ."',1,1"
			.");";
		//if is a reply
		$mydb->query($sql);
		$id = $mydb->insert_id;
		$mydb->query("update post set groupID=$id where id = $id");
	}
	else {

		$rank = $post["sibilingRank"];
		$groupID = $post['groupID'];
		$mydb->trace =1;
		$sql = "insert into post(name,text, sibilingRank,groupID,deep) values('" . $post['name'] . "','" . $post['text'] 
                        ."',$rank,$groupID,2 ".");";
		$mydb->query($sql);
		$id = $mydb->insert_id;

	}
	//return getPostByID($id);
}

function insertUser($post){
        global $mydb;
       // $mydb->trace =1;
	$arr = array($post['name'], $post['description'], md5($post['password']), $post['email'], $post['firsttime']);
	
	$sql = "insert into User(user_username,description,user_password,user_email,firsttime) values(" . addQuotes($arr) . ");";
	//echo $sql;
//$sql = 'insert into User(user_username,description,user_password,user_email,firsttime)
  //     values("37","43","yy","xx","zz");';
        
        $results = $mydb->query($sql);
}
$test =array("name"=>"1123s5", "description"=>"37", "password"=>md5("43"),"email"=>"123testiasd", "firsttime"=>"qwasde");

//insertUser($test);
	//echo json_encode(getPosts());
//print_r(getPics());
//getPics();

?>

