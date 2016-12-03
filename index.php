<?php
require_once("route.php");
$routes = getRequest();

if(!empty($routes[1])){
	handleRequest($routes);
	return;
}
else {

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Tribute Patricia Postman</title>

    <link href="http://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet" type="text/css"/>
	<!-- <link href="stylecss.css" rel="stylesheet"/> -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src = "populateProduct.js"></script>
    <script src = "js/all.js"></script>

	<!-- <script src = "js/jquery.min.js"></script>  -->


    <!-- Custom styles for this template (imports bootstrap from LESS) -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

	    <script>
        $(document).ready(function(){
             populateContent(".active");
         }
        );
    </script>
	<style>
html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
  background:#FFFFCC;
}
footer {
  position: absolute;
  bottom: 0;
  width:100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #f5f5f5;
}
  </style>
<script>

</script>
    </head>
    <body>
   <div class="container" style="-moz-border-radius: 20px;
    -khtml-border-radius: 20px;
    -webkit-border-radius: 20px;
    border-radius: 20px;
    overflow:hidden;
    background:#F6E7B9;
    -webkit-box-shadow:0 0 4em rgb(4,6,5);
    -moz-box-shadow:0 0 3em rgb(6,7,8);
    box-shadow:0 0 1em rgb(5,9,2);
    border-left:20px solid skyblue;border-right:20px solid skyblue;">
   <header>
   <div class="row">
	<div class="col-md-4 col-sm-12">
               <div style="margin: 10px 0 0 15px;">
                   <img src="pat.jpg" height="60" width="70" style="background-color:#F6E7B9" />
                </div>
	</div> <!-- col-md-4 -->
       <div class="col-md-8 col-sm-12">
        <span class="title_main">In Remembrance of POSTMAN, Patricia</span><br />
          <span class="title_main_2">1945-2016<br />
            Lethbridge, AB, Canada</span><br /><br />
	</div> <!-- col-md-8 -->
      </div> <!-- row -->
  </header>
    <!-- Static navbar -->
    <nav class="navbar navbar-default" style="background-color:#f1eaea;margin-top:0px">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
				<li id="home" class="active"><a onclick="populateContent(this);">Home</a></li>
				<li id="gallery"><a onclick="populateContent(this);">Gallery</a></li>
				<li id="postad"><a onclick="populateContent(this);">Post</a></li>
				<li id="weknowpat"><a onclick="populateContent(this);">We know Pat</a></li>
				<li id="register"><a onclick="populateContent(this);">Register</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
	    <form class="navbar-form">
	      <div class="form-group">
		<input type="text" class="form-control" placeholder="Search..."/>
	      </div>
	      <button type="" class="btn btn-default">Search</button>
	    </form>
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>
    <section id="" class="" style="height:400px;">
        <div class="row">
	    <div id="mainpane"> </div>
	</div>
     </section>
	 </br></br></br>
	  	  
</div>  <!-- end of container -->

<footer>
                <p>Copyright &copy; 2016 - <a href="#">Terms</a> &middot; <a href="#">Privacy</a></p>
</footer>
	   </br>
	  
  </body>  

</html>

<?php
}
?>
