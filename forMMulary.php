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
include('config_db.php');
//$perfil=$_GET['perfil'];
session_start();
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
	      	//data: { "letter" : letter, "perfil":"<?php //echo $perfil;?>"},
          data: { "letter" : letter},
	        success: function(sol){
	        	//alert(sol);
	        	jQuery('#drug_table_div').html(sol);

	      	}
  		});
	}

  /*function generate_navbar_admin(){
    $("#navbar_admin").html("<a href=\"./notifications.php\"><span class=\"glyphicon glyphicon-flag\"></span> Notifications</a>");
  }*/
  function generate_navbar_admin() {
    $("#navbar_admin").html("<div class=\"dropdown \"> <button class=\"dropbtn \"><span class=\"glyphicon glyphicon-flag\"></span>Notifications</button>  <div class=\"dropdown-content\">    <a href=\"./notifications.php\">Registration Requests</a>    <a href=\"./notifications_drugs_review.php\">Files pending review</a> </div></div>");
  }
  /*function generate_navbar_admin(argument) {
    $("#navbar_admin").html("<div class=\"dropdown\">  <a href=\"./notifications.php\"><span class=\"glyphicon glyphicon-flag\"></span> Notifications</a>  <div class=\"dropdown-content\">    <a href=\"#\">Link 1</a>    <a href=\"#\">Link 2</a>    <a href=\"#\">Link 3</a>  </div></div>");
  }*/

  function show_search_results(drug_name){
  	window.location='show_search_results.php?drug='+drug_name;
  }

  function update_state_drug(pos,state) {
    aux1=document.getElementsByTagName("td");
    drugname=aux1[pos].innerHTML;
    
    $.ajax({
          type: "POST",
          url: "update_state_drug.php",
          data: {"drugname":drugname, "state" : state},
          success: function(sol){
            alert(sol);
            //Se obtiene las letras del nombre del medicamento
            var res = drugname.split("");
            //Se pasa como parámetro la primera letra para refrescar la página
            showDrugFirstLetters(res[0]);
            
            
          }
      });
    }
  
    

</script>
<body onload="showDrugFirstLetters('A')"> 
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
          <form class="navbar-form navbar-right form-search form-inline" role="search" onsubmit="javascript:show_search_results(document.getElementById('drugName').value); return false">
           <div class="input-group">
              <input id="drugName" type="text" class="form-control search-query" placeholder="Search drug" />
              <span class="input-group-btn">
              <!-- <a href="show_search_results.php"> -->
                <button class="btn btn-primary">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
                <!-- </a> -->
              </span>
            </div>
          </form>
        </div>
      </nav>
      <a class="btn btn-primary pull-right add" href="./general.php">
        Add <span class="glyphicon glyphicon-plus"></span>
      </a>
      <ul class="pages">
        <li>
          <a class="separate" href="#" onclick="showDrugFirstLetters('A')">A</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('B')">B</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('C')">C</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('D')">D</a> 
          <a class="separate" href="#" onclick="showDrugFirstLetters('E')">E</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('F')">F</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('G')">G</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('H')">H</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('I')">I</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('J')">J</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('K')">K</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('L')">L</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('M')">M</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('N')">N</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('Ñ')">Ñ</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('O')">O</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('P')">P</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('Q')">Q</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('R')">R</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('S')">S</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('T')">T</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('U')">U</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('V')">V</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('W')">W</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('X')">X</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('Y')">Y</a>
          <a class="separate" href="#" onclick="showDrugFirstLetters('Z')">Z</a>
		  <a class="separate" href="#" onclick="showDrugFirstLetters('ALL')">ALL</a>
        </li>
      </ul>
      
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