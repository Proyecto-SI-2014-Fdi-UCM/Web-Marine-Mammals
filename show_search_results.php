<!DOCTYPE html>
<html lang="es">
<head>
    <title>forMMulary</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="./css/bootstrap.css"/>
    <link rel="stylesheet" href="./css/styleforMMularyMain.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.carousel').carousel( {
          interval: 20000
        });
        
      });
    </script>
</head>
<?php
session_start();
include('config_db.php');
?>

<script>
	var selected;
	function deleteDrug(pos){
		//drug=document.getElementById("drug_name").innerHTML;
		aux1=document.getElementsByTagName("td");
		drug=aux1[pos].innerHTML;
  		$.ajax({
	      	type: "POST",
	      	url: "deleteDrug.php",
	      	data: { "name" : drug},
	        success: function(){
		        //alert(pos);
		        //$("#drug_table_div").load("forMMulary.php #drug_table_div");
		        $("#drug_table_div").load("showDrugFirstLetters.php",{letter: selected}, "#drug_table_div");
	      	}
  		});
	}

	function showDrugFirstLetters(letter){

		selected=letter;
		$.ajax({
	      	type: "POST",
	      	url: "showDrugFirstLetters.php",
	      	data: { "letter" : letter},
	        success: function(sol){
	        	//alert(letter);
	        	jQuery('#drug_table_div').html(sol);

	      	}
  		});
	}

  /*function generate_navbar_admin(){
    //<a href="./forMMulary.php">
    $("#navbar_admin").html("<a href=\"./notifications.php\"><span class=\"glyphicon glyphicon-flag\"></span> Notifications</a>");
    //$("#navbar_admin").html("<a href=\"#\" onclick=\"javascript:show_requests_new_users()\"><span class=\"glyphicon glyphicon-flag\"></span> Notifications</a>");
  }*/
  function generate_navbar_admin() {
    $("#navbar_admin").html("<div class=\"dropdown \"> <button class=\"dropbtn \"><span class=\"glyphicon glyphicon-flag\"></span>Notifications</button>  <div class=\"dropdown-content\">    <a href=\"./notifications.php\">Registration Requests</a>    <a href=\"./notifications_drugs_review.php\">Files pending review</a> </div></div>");
  }
  
</script>
<body onload="showDrugFirstLetters('<?php echo $_GET['drug']; ?>')"> 
<!-- <body onload="generate_navbar_admin()">  -->
<!-- <body> -->
  <div class="container">
    <div class="col-md-12 col-xs-12">
      <div id="myCarousel" class="carousel slide" data-ride="carousel" >
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="./images/three_dolphins.jpg" width="100%"/>
          </div>
          <div class="item">
            <img src="./images/dolphin_food.jpg" width="100%"/>
            <div class="carousel-caption">
            </div>
          </div>
          <div class="item">
            <img src="./images/dolphins.jpg" width="100%"/>
            <div class="carousel-caption">
            </div>
          </div>
          <div class="item">
            <img src="./images/small_seals.jpg" width="100%"/>
            <div class="carousel-caption">
            </div>
          </div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <nav class="navbar navbar-inverse">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse"
                  data-target=".navbar-ex1-collapse">
            <span class="sr-only">Desplegar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <ul class="nav navbar-nav">
            <li class="active">
              <a href="./forMMulary.php">
                <span class="glyphicon glyphicon-home"></span>
                Home
              </a>
            </li>
          </ul>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li>
              <a href="./generate_pdf.php">
                <span class="glyphicon glyphicon-download-alt"></span> 
                Drug pdf
              </a>
            </li>
            
            <li id="navbar_admin">
              
            </li>
            <li>
              <a href="#">
                <span class="glyphicon glyphicon-info-sign"></span>
                About
              </a>
            </li>
            <li>
              <a href="./contact.php">
                <span class="glyphicon glyphicon-earphone"></span>
                Contact
              </a>
            </li>
          </ul>
          <a class="logout navbar-right" href="./logout.php">
            <span class="glyphicon glyphicon-log-out"></span>
          </a>
          <form class="navbar-form navbar-right form-search form-inline" role="search" onsubmit="javascript:showDrugFirstLetters(document.getElementById('drugName').value); return false">
            <div class="input-group">
              <input id="drugName" type="text" class="form-control search-query" placeholder="Search drug"/>
              <span class="input-group-btn">
                <button type="submit" class="btn btn-primary">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
            </div>
          </form>
        </div>
      </nav>
      <a class="btn btn-primary pull-right add" href="./general.php">
        Add <span class="glyphicon glyphicon-plus"></span>
      </a>
      
      <div id="drug_table_div">
      	<!-- <table class="table table-hover">
	        <thead>
	          <tr>
	            <td class="drug_name">Name</td>
	            <td class="drug_description">Description</td>
	            <td class="icons">Actions</td>
	          </tr>
	        </thead>

	        <tbody id="drug_table_div">
            
	        </tbody>
     	</table> -->
	</div>
  
    </div>
  </div>
</body>
</html>