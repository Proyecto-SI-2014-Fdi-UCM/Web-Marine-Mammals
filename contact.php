<!DOCTYPE html>
<html lang="es">
<head>
    <title>forMMulary</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="./css/bootstrap.css"/>
    <link rel="stylesheet" href="./css/styleContact.css"/>
	<link rel="stylesheet" href="./css/jquery-ui-1.8.2.custom.css" type="text/css" media="all"/>
  <link rel="stylesheet" href="./css/styleforMMularyMain.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="./js/jquery-ui-1.8.2.custom.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.carousel').carousel( {
          interval: 20000
        });
	  });
		  
		//Al escribir dentro del input con id="searchDrug"
        /*$('#drugName').keypress(function(){
            //Obtenemos el value del input
            var drug = $('#drugName').val(); 
			var animales = ["Ardilla roja", "Gato", "Gorila occidental",  
      				"León", "Oso pardo", "Perro", "Tigre de Bengala"];
			$("#drugName").autocomplete({  
      			source: animales
    		});

            //Le pasamos el valor del input al ajax
            $.ajax({
                type: "POST",
                url: "./autocompleteDrug.php",
                data: drug,
                success: function(data) {
                    //Escribimos las sugerencias que nos manda la consulta
                    $('#suggestions').fadeIn(1000).html(data);
                    //Al hacer click en alguna de las sugerencias
                    $('.suggest-element').live('click', function() {
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#drugName').val($('#'+id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#suggestions').fadeOut(1000);
                    });
					var animales = ["Ardilla roja", "Gato", "Gorila occidental",  
      				"León", "Oso pardo", "Perro", "Tigre de Bengala"];
					$("#drugName").autocomplete({  
      					source: animales
    				});
                }
            });
        });*/             
        
      });
		
	  $(function() {  
    		var animales = ["Ardilla roja", "Gato", "Gorila occidental",  
      	"León", "Oso pardo", "Perro", "Tigre de Bengala"];  
      
    		$("#drugName").autocomplete({  
      			source: animales  
    		});  
	 });  
    </script>
</head>

<script>

  /*function generate_navbar_admin(){
    //<a href="./forMMulary.php">
    $("#navbar_admin").html("<a href=\"./notifications.php\"><span class=\"glyphicon glyphicon-flag\"></span> Notifications</a>");
    //$("#navbar_admin").html("<a href=\"#\" onclick=\"javascript:show_requests_new_users()\"><span class=\"glyphicon glyphicon-flag\"></span> Notifications</a>");
  }*/
  function generate_navbar_admin() {
    $("#navbar_admin").html("<div class=\"dropdown \"> <button class=\"dropbtn \"><span class=\"glyphicon glyphicon-flag\"></span>Notifications</button>  <div class=\"dropdown-content\">    <a href=\"./notifications.php\">Registration Requests</a>    <a href=\"#\">Files pending review</a> </div></div>");
  }
  

  function show_search_results(drug_name){
  	window.location='show_search_results.php?drug='+drug_name;
  } 

</script>
<?php
session_start();
if(!strcmp($_SESSION['username'], 'administrator')) {
?>
<body onload="generate_navbar_admin()">
<?php
}
else {
?>
<body>
<?php
}
?>
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
            <li>
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
            <li class="active">
              <a href="./contact.php">
                <span class="glyphicon glyphicon-earphone"></span>
                Contact
              </a>
            </li>
          </ul>
          <a class="logout navbar-right" href="./logout.php">
            <span class="glyphicon glyphicon-log-out"></span>
          </a>
          <form class="navbar-form navbar-right form-search form-inline" role="search" onsubmit="javascript:show_search_results(document.getElementById('drugName').value); return false">
           <div class="input-group">
              <input id="drugName" type="text" class="form-control search-query" placeholder="Search drug" />
              <span class="input-group-btn">
              <!-- <a href="show_search_results.php"> -->
                <button class="btn btn-primary">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
                <!-- </a> -->
				<!--<div id="suggestions"></div>-->
              </span>
            </div>
          </form>
        </div>
      </nav>
      <img class="contact_photo" src="./images/faculty_of_veterinary.jpg" width="30%"/>
      <div class="contact_information">
      <p>Dr. Juan A. Gilabert</p>
      <p>Dpt of Toxicology and Pharmacology</p>
      <p>Faculty of Veterinary Medicine</p>
      <p>Complutense University of Madrid</p>
      <p>Avda. Puerta de Hierro 4</p>
      <p>28040 Madrid (Spain)</p>
      <a href="mailto:info@marinemammalformulary.com">info@marinemammalformulary.com</a>
      </div>
    </div>
  </div>
</body>
</html>