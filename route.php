<?php
// require_once("dataIO.php");
require_once("postDAL.php");
require_once("dataIO.php");
require_once("login.php");
  //http://blogs.shephertz.com/2014/05/21/how-to-implement-url-routing-in-php/
/*
	The following function will strip the script name from URL i.e.  http://www.something.com/search/book/fitzgerald will become /search/book/fitzgerald
	*/
function getCurrentUri()
{
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath)); 
        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
        $uri = '/' . trim($uri, '/');
	if(!isset($_SESSION)){
		//session_start();
	}
        return $uri;
}

function getRequest(){ 
	$base_url = getCurrentUri();
	$routes = array();
	$routes = explode('/', $base_url);
	return $routes;
	foreach($routes as $route)
	{
		if(trim($route) != '')
			array_push($routes, $route);
	}

	return $routes;

	if($routes[0] == “search”)
	{
		if($routes[1] == “book”)
		{
			//searchBooksBy($routes[2]);
		}
	}
	else {
		echo "test xxxxxx";
	}
}

function handleRequest($routes){
	$request = $routes[1];
	header('Content-type: application/json');
	$data=[];
	if($request == "knowpat"){
		$data["success"]=true;
		$data['data']= getKnowPat();
	}
	else if($request=="getPosts"){
		$result = getPosts();
		$data["success"]=true;
		$data['data']= $result;
	}
	else if($request=="postLogin"){
		$data["success"]=login($_POST);
	}
	else if($request=="getPics"){
		$result = getPics();
		$data["success"]=true;
		$data['data']= $result;
	}
	if(checkLoginByCookie()){
		if($request =="postText"){
			insertPosts($_POST);
			$data["success"]=true;
		}
		if($request == "postRegister"){
			insertUser($_POST);	
			$data["success"]=true;
			$data['data']= $_POST;
		}
	}
	echo json_encode( $data);
}

//handleRequest()


?>
