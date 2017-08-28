<!DOCTYPE html>
<html lang="es">
<head>
    <title>forMMulary</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="./css/bootstrap.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="./css/styleGroupInformation.css"/>
    <link rel="stylesheet" href="./css/styleforMMularyMain.css"/>
	<script type="text/javascript">
	  var notes_number = 1;
	  var firstTime = true;
      $(document).ready(function() {
        $('.carousel').carousel( {
          interval: 20000
        });
      });

      function show_search_results(drug_name){
        window.location='show_search_results.php?drug='+drug_name;
      }

      /*function generate_navbar_admin(){
         $("#navbar_admin").html("<a href=\"./notifications.php\"><span class=\"glyphicon glyphicon-flag\"></span> Notifications</a>");        
      }*/
      function generate_navbar_admin() {
    $("#navbar_admin").html("<div class=\"dropdown \"> <button class=\"dropbtn \"><span class=\"glyphicon glyphicon-flag\"></span>Notifications</button>  <div class=\"dropdown-content\">    <a href=\"./notifications.php\">Registration Requests</a>    <a href=\"./notifications_drugs_review.php\">Files pending review</a> <a href=\"./notifications_suggestions.php\">Suggestions</a></div></div>");
  }
  
	  function add_note(number) {
		if (number == 0 && firstTime) {
			var div1 = document.createElement("div");
			div1.setAttribute('class','form-group');
			var div2 = document.createElement("div");
			div2.setAttribute('class','panel panel-default');
			var panel_div = document.createElement("div");
			panel_div.setAttribute('class','panel-body add-dosis');
			var row = document.createElement("div");
			row.setAttribute('class','row');
			var label = document.createElement("label");
			label.id = "first-label";
			var title = document.createTextNode("Specific note ");
			label.appendChild(title);
			var help_link = document.createElement("a");
			help_link.href = "#note_window";
			help_link.setAttribute('data-toggle','modal');
			var help_span = document.createElement("span");
			help_span.setAttribute('class','glyphicon glyphicon-question-sign');
			help_link.appendChild(help_span);
			label.appendChild(help_link);
			row.appendChild(label);
			panel_div.appendChild(row);
			var add_div = document.createElement("div");
			add_div.id = "add_note";
			panel_div.appendChild(add_div);
			var general_div = document.getElementById("show_notes");
			div2.appendChild(panel_div);
			div1.appendChild(div2);
			general_div.appendChild(div1);
			
		}
		var notes = parseInt(notes_number);
		var number = parseInt(number);
		if (firstTime) {
			notes = notes + number;
			firstTime = false;
		}
		else {
			notes++;
		}
		var textarea = document.createElement("textarea");
		textarea.id = notes;
		textarea.rows = 4;
		textarea.placeholder = "Enter a specific note (250 characters maximum)";
		textarea.setAttribute('class','specific-note');
		var note_div = document.getElementById("add_note");
		note_div.appendChild(textarea);
		var delete_link = document.createElement("a");
		delete_link.href = "#";
		delete_link.onclick = function() {
			var element = document.getElementById(notes.toString());
			var parent = element.parentNode;
			parent.removeChild(element);
			parent.removeChild(this);
		};
		var image = document.createElement("span");
		image.setAttribute('class','glyphicon glyphicon-remove pull-right remove_note');
		delete_link.appendChild(image);
		note_div.appendChild(delete_link);
		notes_number = notes;
	  }
	  
	  function delete_dose(drug_name,group_name,animal_name,family,category_name,article_reference,reference,posology,route,dose) {
		$.ajax({
			type: "POST",
			url: "delete_dose.php",
			data: { "drug_name" : drug_name, "group_name" : group_name, "animal_name" : animal_name, "family" : family, "category_name" : category_name, "article_reference" : article_reference,
			"reference" : reference, "posology" : posology, "route" : route, "dose" : dose },
			success: function(sol) {
				location.href = sol;
			}
		});
	  }
	  
	  function insert_dose(drug_name,group_name) {
		var notes = new Array();
		
		if (document.getElementById('amount').value == "" || (document.getElementById('article_reference').value == "" && document.getElementById('reference').value == "")) {
			document.getElementById('require_link').click();
		}
		else {
			var limit = false;
			for (var i=0;i<notes_number;i++) {
				var index = i+1;
				var id = index.toString();
				if (document.getElementById(id) != null) {
					if (document.getElementById(id).value.length > 250) {
						limit = true;
					}
					notes.push(document.getElementById(id).value);
				}
			}
			if (limit) {
				document.getElementById('words_link').click();
			}
			else {
				var family;
				if (!group_name.localeCompare("Pinnipeds")) {
					family = document.getElementById('family').value;
				}
				else {
					family = "";
				}
				$.ajax({
					type: "POST",
					url: "insert_dose.php",
					data: { "specific_notes" : notes, "drug_name" : drug_name, "group_name" : group_name, "animal_name" : document.getElementById('animal').value, "category_name" : document.getElementById('category').value, "family" : family,
					"amount" : document.getElementById('amount').value, "posology" : document.getElementById('posology').value, "route" : document.getElementById('route').value, "article_reference" : document.getElementById('article_reference').value,
					"book_reference" : document.getElementById('reference').value },
					success: function(sol) {
						location.href = sol;
					}
				});
			}
		}
	  }
    </script>
    
</head>
<?php
session_start();
if($_SESSION['username']=='administrator'){?>
  <body onload="generate_navbar_admin()">
<?php }else{ ?>
  <body>
<?php } ?>

<?php

include './config_db.php';

class animal_dosage {
	var $name;
	var $drug;
	var $family;
	var $group;
	var $category;
	var $amount;
	var $posology;
	var $route;
	var $book;
	var $article;
}

function times_number($links,$name) {
	$number = 0;
	for ($i=0;$i<count($links);$i++) {
		if (!strcmp($links[$i],$name)) {
			$number++;
		}
	}
	return $number;
}

?>
<div class="container">
    <div class="row">
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
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-xs-12">
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
              <li>
                <a href="#">
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
                <input disabled id="drugName" type="text" class="form-control search-query" placeholder="Search drug"/>
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search"></span>
                  </button>
                </span>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  <div class="tab col-md-12 col-lg-10 col-lg-offset-1">
    <ul class="nav nav-tabs nav-justified">
      <?php
      if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) {?>
        <li class="not_current"><a href="./general_read_mode.php?option=Edit&&drug_name=<?php echo $_GET['drug_name']; ?>">General</a></li>
      <?php
      }
      else { ?>
        <li class="not_current"><a href="./general_read_mode.php">General</a></li>
      <?php }
      if (isset($_GET['group'])) {
        switch($_GET['group']) {
          case "Cetaceans":
            if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
              <li class="current"><a href="./general_note_read_mode.php?option=Edit&&group=Cetaceans&&drug_name=<?php echo $_GET['drug_name']; ?>">Cetaceans</a></li>
            <?php } else { ?>
              <li class="current"><a href="./general_note_read_mode.php?group=Cetaceans">Cetaceans</a></li>
            <?php
            }
            if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
              <li class="not_current"><a href="./general_note_read_mode.php?option=Edit&&group=Pinnipeds&&drug_name=<?php echo $_GET['drug_name']; ?>">Pinnipeds</a></li>
            <?php } else { ?>
              <li class="not_current"><a href="./general_note_read_mode.php?group=Pinnipeds">Pinnipeds</a></li>
            <?php
            }
            if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
              <li class="not_current"><a href="./general_note_read_mode.php?option=Edit&&group=Other MM&&drug_name=<?php echo $_GET['drug_name']; ?>">OtherMM</a></li>
            <?php } else { ?>
              <li class="not_current"><a href="./general_note_read_mode.php?group=Other MM">OtherMM</a></li>
            <?php
            }
            break;
          case "Pinnipeds":
            if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
              <li class="not_current"><a href="./general_note_read_mode.php?option=Edit&&group=Cetaceans&&drug_name=<?php echo $_GET['drug_name']; ?>">Cetaceans</a></li>
            <?php } else { ?>
              <li class="not_current"><a href="./general_note_read_mode.php?group=Cetaceans">Cetaceans</a></li>
            <?php
            }
            if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
              <li class="current"><a href="./general_note_read_mode.php?option=Edit&&group=Pinnipeds&&drug_name=<?php echo $_GET['drug_name']; ?>">Pinnipeds</a></li>
            <?php } else { ?>
              <li class="current"><a href="./general_note_read_mode.php?group=Pinnipeds">Pinnipeds</a></li>
            <?php
            }
            if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
              <li class="not_current"><a href="./general_note_read_mode.php?option=Edit&&group=Other MM&&drug_name=<?php echo $_GET['drug_name']; ?>">OtherMM</a></li>
            <?php } else { ?>
              <li class="not_current"><a href="./general_note_read_mode.php?group=Other MM">OtherMM</a></li>
            <?php
            }
            break;
          case "Other MM":
            if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
              <li class="not_current"><a href="./general_note_read_mode.php?option=Edit&&group=Cetaceans&&drug_name=<?php echo $_GET['drug_name']; ?>">Cetaceans</a></li>
            <?php } else { ?>
              <li class="not_current"><a href="./general_note_read_mode.php?group=Cetaceans">Cetaceans</a></li>
            <?php
            }
            if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
              <li class="not_current"><a href="./general_note_read_mode.php?option=Edit&&group=Pinnipeds&&drug_name=<?php echo $_GET['drug_name']; ?>">Pinnipeds</a></li>
            <?php } else { ?>
              <li class="not_current"><a href="./general_note_read_mode.php?group=Pinnipeds">Pinnipeds</a></li>
            <?php
            }
            if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
              <li class="current"><a href="./general_note_read_mode.php?option=Edit&&group=Other MM&&drug_name=<?php echo $_GET['drug_name']; ?>">OtherMM</a></li>
            <?php } else { ?>
              <li class="current"><a href="./general_note_read_mode.php?group=Other MM">OtherMM</a></li>
            <?php
            }
            break;
        }
      } ?>
    </ul>
    <div class="row">
      <div class="col-xs-3">
        <ul class="nav nav-pills nav-stacked col-xs-offset-2">
          <?php if (isset($_GET['group'])) {
          if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
            <li class="not_current"><a href="./general_note_read_mode.php?option=Edit&&group=<?php echo $_GET['group']; ?>&&drug_name=<?php echo $_GET['drug_name']; ?>">General note</a></li>
          <?php } else { ?>
            <li class="not_current"><a href="./general_note_read_mode.php?group=<?php echo $_GET['group']; ?>">General note</a></li>
          <?php } 
          if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
            <li class="current"><a href="./dose_read_mode.php?option=Edit&&group=<?php echo $_GET['group']; ?>&&drug_name=<?php echo $_GET['drug_name']; ?>">Dose</a></li>
          <?php } else { ?>
            <li class="current"><a href="./dose_read_mode.php?group=<?php echo $_GET['group']; ?>">Dose</a></li>
          <?php } ?>
        <?php } ?>
        </ul>
      </div>
	  <form id="insert_form" action="#" method="POST" role="form">
	  <?php if (isset($_GET['group']) && isset($_GET['drug_name']) && isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) {
			$drug_name = $_GET['drug_name'];
			$group_name = $_GET['group'];
				
			//Descomentar esto para conectar con localhost
			/*$con = mysql_connect ("127.0.0.1","root");
			if (!$con){die ("ERROR AL CONECTAR CON LA BASE DE DATOS ".mysql_error());}
			
			$db = mysql_select_db("mydb",$con);
			if (!$db) {die ("ERROR AL SELECCIONAR DB ".mysql_error());}
			
			$dose_num = "SELECT COUNT(*) FROM animal_has_category WHERE drug_name = '$drug_name' AND group_name = '$group_name'";
			$result_dose_num = mysql_query($dose_num,$con);
			$num_row = mysql_fetch_row($result_dose_num); ?>
			
			<div class="col-xs-9">
			<?php
			if ($num_row[0] > 0) { ?>
			
				<h4 class="dose_list_title">List of existing dose</h4>
				<div class="panel panel-default">
				<div class="panel-body add-dosis">
				<div id="showDose">
					<table class="table table-hover">
					<tbody>
					<?php
						$sql = "SELECT DISTINCT animal_name, drug_name, family, group_name, category_name, book_reference, article_reference, posology, route, dose FROM animal_has_category WHERE drug_name = '$drug_name' AND group_name = '$group_name'";

						$result = mysql_query($sql,$con);
						  
						$i = 0;
						$links[0] = "";
						while ($row = mysql_fetch_row($result)) { */
						
			//Descomentar esto para conectar con el servidor
			/*$con = mysqli_connect ("localhost","ForMMulary","wfGr42&7","marinemammalformulary_",3306);
			if (mysqli_connect_errno ($con)){
				echo "No se pudo conectar a MySQL: " . mysqli_connect_error ();
			}*/
			$dose_num = "SELECT COUNT(*) FROM ANIMAL_has_CATEGORY WHERE drug_name = '$drug_name' AND group_name = '$group_name'";
			$result_dose_num = mysqli_query($con,$dose_num);
			$row_num = mysqli_fetch_row($result_dose_num);?>
			<div class="col-xs-9">
			<?php
			
			if ($row_num[0] > 0) { ?>
			<h4 class="dose_list_title">List of existing dose</h4>
				<div class="panel panel-default">
				<div class="panel-body add-dosis">
				<div id="show_dose">
					<table class="table table-hover">
					<tbody>
					<?php
						$sql = "SELECT DISTINCT animal_name, drug_name, family, group_name, category_name, book_reference, article_reference, posology, route, dose FROM ANIMAL_has_CATEGORY WHERE drug_name = '$drug_name' AND group_name = '$group_name' ORDER BY animal_name,family,category_name";

						$result = mysqli_query($con,$sql);
						if (!strcmp($group_name,"Pinnipeds")) {
							$generalIndex=0;
							$otariidsIndex=0;
							$phocidsIndex=0;
							$odobenidsIndex=0;
							while ($row = mysqli_fetch_row($result)) {
								$information = new animal_dosage;
								$information->name=$row[0];
								$information->drug=$row[1];
								$information->family=$row[2];
								$information->group=$row[3];
								$information->category=$row[4];
								$information->amount=$row[9];
								$information->posology=$row[7];
								$information->route=$row[8];
								$information->book=$row[5];
								$information->article=$row[6];
								switch ($row[2]) {
									case "Otariids":
										$otariids[$otariidsIndex] = $information;
										$otariidsIndex++;
										break;
									case "Phocids":
										$phocids[$phocidsIndex] = $information;
										$phocidsIndex++;
										break;
									case "Odobenids":
										$odobenids[$odobenidsIndex] = $information;
										$odobenidsIndex++;
										break;
									default:
										$general[$generalIndex] = $information;
										$generalIndex++;
										break;
								}
							}
							$element=0;
							for ($i=0;$i<count($general);$i++) {
								$dose[$element] = $general[$i];
								$element++;
							}
							for ($i=0;$i<count($otariids);$i++) {
								$dose[$element] = $otariids[$i];
								$element++;
							}
							for ($i=0;$i<count($phocids);$i++) {
								$dose[$element] = $phocids[$i];
								$element++;
							}
							for ($i=0;$i<count($odobenids);$i++) {
								$dose[$element] = $odobenids[$i];
								$element++;
							}
						}
						else {
							$i=0;
							while ($row = mysqli_fetch_row($result)) {
								$information = new animal_dosage;
								$information->name=$row[0];
								$information->drug=$row[1];
								$information->family=$row[2];
								$information->group=$row[3];
								$information->category=$row[4];
								$information->amount=$row[9];
								$information->posology=$row[7];
								$information->route=$row[8];
								$information->book=$row[5];
								$information->article=$row[6];
								$dose[$i] = $information;
								$i++;
							}
						}
						  
						$links[0] = "";
						for ($j=0;$j<count($dose);$j++) {
							$link = $dose[$j];
							if (strcmp($link->name,"")) {
								$link_name = $link->name;
							}
							else {
								$link_name = $link->family;
							}
							if (strcmp($link->family,"") && strcmp($link->name,"")) {
								$link_name = $link_name . "/" . $link->family;
							}
							if ((strcmp($link->name,"") && strcmp($link->category,"")) || (strcmp($link->family,"") && strcmp($link->category,""))) {
								$link_name = $link_name . "/" . $link->category;
							}
							else if (strcmp($link->category,"")) {
								$link_name = $link->category;
							}
							if (!strcmp($link_name,"")) {
								$link_name = "General";
							}
							$links[$j] = $link_name;
							$index = times_number($links,$link_name);
							$link_name = $link_name . "/Dose " . $index;
							?>
							<tr>
							<td>
							<p><?php echo $link_name;?></p></td>
							<!--<td><a href="./showDose.php?animal_name=<?php echo $link->name;?>&&drug_name=<?php echo $link->drug;?>&&family=<?php echo $link->family;?>&&group=<?php echo $link->group;?>&&category_name=<?php echo $link->category;?>&&book_reference=<?php echo $link->book;?>
							&&article_reference=<?php echo $link->article;?>&&posology=<?php echo $link->posology;?>&&route=<?php echo $link->route;?>&&dose=<?php echo $link->amount;?>&&option=Edit&&link_name=<?php echo $link_name;?>""><span class="glyphicon glyphicon-edit"></span></a>
							<a href="#delete_window<?php echo $j;?>" data-toggle="modal"><span class="glyphicon glyphicon-remove remove_link"></span></a></td>-->
							<div class="modal fade" id="delete_window<?php echo $j;?>">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h2 class="modal-title"><strong>Are you sure?</strong></h2>
										</div>
										<div class="modal-body">
											<a href="#" class="btn btn-primary right-button col-xs-offset-3" data-dismiss="modal" aria-hidden="true">No</a>
											<a href="#" class="btn btn-primary right-button col-xs-offset-4" data-dismiss="modal" aria-hidden="true" onclick="delete_dose('<?php echo $link->drug;?>','<?php echo $link->group;?>','<?php echo $link->name;?>','<?php echo $link->family;?>','<?php echo $link->category;?>','<?php echo $link->article;?>',
											'<?php echo $link->book;?>','<?php echo $link->posology;?>','<?php echo $link->route;?>','<?php echo $link->amount;?>')">Yes</a>
										</div>
									</div>
								</div>
							</div>
							</tr>
						<?php 
						} ?>
						</tbody>
					</table>
				</div>
				</div>
				</div>
				
			<?php
			}
			if ((isset($_GET['add']) && !strcmp($_GET['add'],"Dose")) || $row_num[0] <= 0) {
			?>
			
				<div class="dose">
				  <div class="panel panel-default">
					<div class="panel-body add-dosis">

						<div class="row">
						  <div class="form-group">

							<label for="animal_name" id="first-label">Classification</label>

							<div class="inner-panel">

							  <div class="col-md-8">
								<div class="input-group">
								  <input disabled="" type="text" class="form-control" name="animal" id="animal" placeholder="Animal"/>
								  <span class="input-group-btn">
									<a href="#animal_window" class="btn btn-primary" data-toggle="modal">
									  <span class="glyphicon glyphicon-question-sign"></span>
									</a>
								  </span>
								</div>
							  </div>

							  <div class="modal fade" id="animal_window">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									  <h2 class="modal-title"><strong>Optional field</strong></h2>
									</div>
									<div class="modal-body">
									  <p>Use common names (e.g. Dolphins, Sea otters, Sirenians, Manatees, etc)</p>
									</div>
								  </div>
								</div>
							  </div>

							  <?php
							  if (isset($_GET['group']) && !strcmp($_GET['group'],"Pinnipeds")) { ?>

							  <div class="col-md-4">
								<div class="input-group">

								  <select class="form-control" name="family" id="family">
									<option>Family</option>
									<option>Otariids</option>
									<option>Phocids</option>
									<option>Odobenids</option>
								  </select>
								  <span class="input-group-btn">
									<a href="#family_window" class="btn btn-primary" data-toggle="modal">
									  <span class="glyphicon glyphicon-question-sign"></span>
									</a>
								  </span>

								  <div class="modal fade" id="family_window">
									<div class="modal-dialog">
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h2 class="modal-title"><strong>Optional field</strong></h2>
										</div>
										<div class="modal-body">
										  <p>Choose a taxonomy</p>
										</div>
									  </div>
									</div>
								  </div>

								</div>
							  </div>

							  <?php
							  }
							  ?>
							  
							</div>

						  </div>
						</div>

						<div class="row">
						  <div class="form-group">

							<div class="input-snd">

							  <div class="col-md-8">
								<div class="input-group">
								  <input disabled type="text" class="form-control" name="category" id="category" placeholder="Category"/>
								  <span class="input-group-btn">
									<a href="#category_window" class="btn btn-primary" data-toggle="modal">
									  <span class="glyphicon glyphicon-question-sign"></span>
									</a>
								  </span>                                               
								</div>
							  </div>

							  <div class="modal fade" id="category_window">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									  <h2 class="modal-title"><strong>Optional field</strong></h2>
									</div>
									<div class="modal-body">
									  <p>If you have additional data such as small odontocetes, young animals, stranded animals...</p>
									</div>
								  </div>
								</div>
							  </div>

							</div>
						  </div>
						</div>
						
						<div class="row">
						  <div class="form-group">                  
							<label for="dose_amount">Dosage<font color="red" size="4%">*</font></label>
							<div class="inner-panel">

							  <div class="col-md-4">
								<div class="input-group">

								  <input disabled type="text" class="form-control" name="amount" id="amount" placeholder="Amount (mg/kg)"/>
								  <span class="input-group-btn">
									<a href="#amount_window" class="btn btn-primary" data-toggle="modal">
									  <span class="glyphicon glyphicon-question-sign"></span>
									</a>
								  </span>

								  <div class="modal fade" id="amount_window">
									<div class="modal-dialog">
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h2 class="modal-title"><strong>Amount (alphanumeric field value and units)</strong></h2>
										</div>
										<div class="modal-body">
										  <p>For example: 10 mg/kg (in mg/kg whenever you can)</p>
										</div>
									  </div>
									</div>
								  </div>
								</div>
							  </div>

							  <div class="col-md-4">
								<div class="input-group">

								  <input disabled type="text" class="form-control" name="posology" id="posology" placeholder="SID, BID, TID"/>
								  <span class="input-group-btn">
									<a href="#posology_window" class="btn btn-primary" data-toggle="modal">
									  <span class="glyphicon glyphicon-question-sign"></span>
									</a>
								  </span>

								  <div class="modal fade" id="posology_window">
									<div class="modal-dialog">
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h2 class="modal-title"><strong>Optional field</strong></h2>
										</div>
										<div class="modal-body">
										  <p>Reference <a href="http://en.wikipedia.org/wiki/List_of_abbreviations_used_in_medical_prescriptions" target="blank">http://en.wikipedia.org/wiki/List_of_abbreviations_used_in_medical_prescriptions</a></p>
										</div>
									  </div>
									</div>
								  </div>

								</div>
							  </div>

							  <div class="col-md-4">
								<div class="input-group">
								  <input disabled type="text" class="form-control" name="route" id="route" placeholder="PO, IM, IV"/>
								  <span class="input-group-btn">
									<a href="#route_window" class="btn btn-primary" data-toggle="modal">
									  <span class="glyphicon glyphicon-question-sign"></span>
									</a>
								  </span>                                            

								  <div class="modal fade" id="route_window">
									<div class="modal-dialog">
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h2 class="modal-title"><strong>Optional field</strong></h2>
										</div>
										<div class="modal-body">
										  <p>Reference <a href="http://en.wikipedia.org/wiki/List_of_abbreviations_used_in_medical_prescriptions" target="blank">http://en.wikipedia.org/wiki/List_of_abbreviations_used_in_medical_prescriptions</a></p>
										</div>
									  </div>
									</div>
								  </div>
								</div>                        
							  </div>
							</div>
						  </div>
						</div>
						
						<div class="row">                        
						  <div class="form-group">
							<label for="dose_reference">References<font color="red" size="4%">*</font></label><a class="references" href="#references_window" data-toggle="modal"><span class="glyphicon glyphicon-question-sign"></span>
							</a>
							<div class="modal fade" id="references_window">
									<div class="modal-dialog">
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h2 class="modal-title"><strong>References</strong></h2>
										</div>
										<div class="modal-body">
										  <p>Article reference or book reference</p>
										</div>
									  </div>
									</div>
							</div>
							<div class="inner-panel">
							
							  <div class="col-md-4">
								<div class="input-group">
								  <input disabled type="text" class="form-control" name="reference" id="reference" placeholder="Book"/>
								  <span class="input-group-btn">
									<a href="#reference_window" class="btn btn-primary" data-toggle="modal">
									  <span class="glyphicon glyphicon-question-sign"></span>
									</a>
								  </span>                          

								  <div class="modal fade" id="reference_window">
									<div class="modal-dialog">
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h2 class="modal-title"><strong>Books</strong></h2>
										</div>
										<div class="modal-body">
										  <p>Use three-character code as follow reference books codes:</p>
										  <ul>
											<li>CRC</li>
											<li>FWX (X edition number)</li>
											<li>SRM</li>
										  </ul>
										</div>
									  </div>
									</div>
								  </div>
								</div>
							  </div>

							  <div class="col-md-8">
								<div class="input-group">

								  <input disabled type="text" class="form-control" name="article-reference" id="article_reference" placeholder="Article"/>
								  <span class="input-group-btn">
									<a href="#article_window" class="btn btn-primary" data-toggle="modal">
									  <span class="glyphicon glyphicon-question-sign"></span>
									</a>
								  </span>

								  <div class="modal fade" id="article_window">
									<div class="modal-dialog">
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										  <h2 class="modal-title"><strong>Articles</strong></h2>
										</div>
										<div class="modal-body">
										  <p>Reference form at according Vancouver style if possible.
										  Example:
										  Mastri AR. Neuropathy of diabetic neurogenic bladder. Ann Intern Med. 1980;92(2 pt 2):316-8</p>
										</div>
									  </div>
									</div>
								  </div>
								</div>
							  </div>
							</div>
						  </div>
						</div>
						<div id="show_notes">
						
						</div>

							  <div class="modal fade" id="note_window">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									  <h2 class="modal-title"><strong>Optional field</strong></h2>
									</div>
									<div class="modal-body">
									  <p>Some particular data or considerations and specific comments for this drug in this animal group</p>
									</div>
								  </div>
								</div>
							  </div>

						<?php
						$number = 0;
						?>
			  
					</div>
				  </div>
				  
				</form> 
				<a id="require_link" href="#require_window" data-toggle="modal"></a>
				<div class="modal fade" id="require_window">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h2 class="modal-title"><strong>Error</strong></h2>
							</div>
							<div class="modal-body">
								<p>To add dose you have to fill all required fields</p>
							</div>
						</div>
					</div>
				</div>
				<a id="words_link" href="#words_window" data-toggle="modal"></a>
				<div class="modal fade" id="words_window">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h2 class="modal-title"><strong>Error</strong></h2>
							</div>
							<div class="modal-body">
								<p>The maximum of characters to enter is 250 for specific note</p>
							</div>
						</div>
					</div>
				</div>
				</div>
			<?php 
			}
			?>
			<input disabled type="hidden" name="option" value="Edit"/>
			<input disabled type="hidden" name="group" value="<?php echo $group_name;?>"/>
			<input disabled type="hidden" name="drug_name" value="<?php echo $drug_name;?>"/>
		<?php
		} 
		else {
			$drug_name = "Furosemide";
			$group_name = $_GET['group'];
		?>

		<input disabled type="hidden" name="group" value="<?php echo $group_name;?>"/>
		<input disabled type="hidden" name="drug_name" value="<?php echo $drug_name;?>"/>
		
      <div class="col-xs-9">

        <div class="dose">
          <div class="panel panel-default new_drug">
            <div class="panel-body add-dosis">

                <div class="row">
                  <div class="form-group">

                    <label for="animal_name" id="first-label">Classification</label>

                    <div class="inner-panel">

                      <div class="col-md-8">
                        <div class="input-group">
                          <input disabled type="text" class="form-control" name="animal" id="animal" placeholder="Animal"/>
                          <span class="input-group-btn">
                            <a href="#animal_window" class="btn btn-primary" data-toggle="modal">
                              <span class="glyphicon glyphicon-question-sign"></span>
                            </a>
                          </span>
                        </div>
                      </div>

                      <div class="modal fade" id="animal_window">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h2 class="modal-title"><strong>Optional field</strong></h2>
                            </div>
                            <div class="modal-body">
                              <p>Use common names (e.g. Dolphins, Sea otters, Sirenians, Manatees, etc)</p>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php
                      if (isset($_GET['group']) && !strcmp($_GET['group'],"Pinnipeds")) { ?>

                      <div class="col-md-4">
                        <div class="input-group">

                          <select class="form-control" name="family" id="family">
                            <option>Family</option>
                            <option>Otariids</option>
                            <option>Phocids</option>
                            <option>Odobenids</option>
                          </select>
                          <span class="input-group-btn">
                            <a href="#family_window" class="btn btn-primary" data-toggle="modal">
                              <span class="glyphicon glyphicon-question-sign"></span>
                            </a>
                          </span>

                          <div class="modal fade" id="family_window">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h2 class="modal-title"><strong>Optional field</strong></h2>
                                </div>
                                <div class="modal-body">
                                  <p>Choose a taxonomy</p>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>

                      <?php
                      }
                      ?>
                      
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="form-group">

                    <div class="input-snd">

                      <div class="col-md-8">
                        <div class="input-group">
                          <input disabled type="text" class="form-control" name="category" id="category" placeholder="Category"/>
                          <span class="input-group-btn">
                            <a href="#category_window" class="btn btn-primary" data-toggle="modal">
                              <span class="glyphicon glyphicon-question-sign"></span>
                            </a>
                          </span>                                               
                        </div>
                      </div>

                      <div class="modal fade" id="category_window">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h2 class="modal-title"><strong>Optional field</strong></h2>
                            </div>
                            <div class="modal-body">
                              <p>If you have additional data such as small odontocetes, young animals, stranded animals...</p>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="form-group">                  
                    <label for="dose_amount">Dosage<font color="red" size="4%">*</font></label>
                    <div class="inner-panel">

                      <div class="col-md-4">
                        <div class="input-group">

                          <input disabled type="text" class="form-control" name="amount" id="amount" placeholder="Amount (mg/kg)"/>
                          <span class="input-group-btn">
                            <a href="#amount_window" class="btn btn-primary" data-toggle="modal">
                              <span class="glyphicon glyphicon-question-sign"></span>
                            </a>
                          </span>

                          <div class="modal fade" id="amount_window">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h2 class="modal-title"><strong>Amount (alphanumeric field value and units)</strong></h2>
                                </div>
                                <div class="modal-body">
                                  <p>For example: 10 mg/kg (in mg/kg whenever you can)</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="input-group">

                          <input disabled type="text" class="form-control" name="posology" id="posology" placeholder="SID, BID, TID"/>
                          <span class="input-group-btn">
                            <a href="#posology_window" class="btn btn-primary" data-toggle="modal">
                              <span class="glyphicon glyphicon-question-sign"></span>
                            </a>
                          </span>

                          <div class="modal fade" id="posology_window">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h2 class="modal-title"><strong>Optional field</strong></h2>
                                </div>
                                <div class="modal-body">
                                  <p>Reference <a href="http://en.wikipedia.org/wiki/List_of_abbreviations_used_in_medical_prescriptions" target="blank">http://en.wikipedia.org/wiki/List_of_abbreviations_used_in_medical_prescriptions</a></p>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="input-group">
                          <input disabled type="text" class="form-control" name="route" id="route" placeholder="PO, IM, IV"/>
                          <span class="input-group-btn">
                            <a href="#route_window" class="btn btn-primary" data-toggle="modal">
                              <span class="glyphicon glyphicon-question-sign"></span>
                            </a>
                          </span>                                            

                          <div class="modal fade" id="route_window">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h2 class="modal-title"><strong>Optional field</strong></h2>
                                </div>
                                <div class="modal-body">
                                  <p>Reference <a href="http://en.wikipedia.org/wiki/List_of_abbreviations_used_in_medical_prescriptions" target="blank">http://en.wikipedia.org/wiki/List_of_abbreviations_used_in_medical_prescriptions</a></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>                        
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row">                        
                  <div class="form-group">
                    <label for="dose_reference">References<font color="red" size="4%">*</font></label><a class="references" href="#references_window" data-toggle="modal"><span class="glyphicon glyphicon-question-sign"></span>
                    </a>
					<div class="modal fade" id="references_window">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h2 class="modal-title"><strong>References</strong></h2>
                                </div>
                                <div class="modal-body">
                                  <p>Article reference or book reference</p>
                                </div>
                              </div>
                            </div>
                    </div>
                    <div class="inner-panel">
					
					  <div class="col-md-4">
                        <div class="input-group">
                          <input disabled type="text" class="form-control" name="reference" id="reference" placeholder="Book"/>
                          <span class="input-group-btn">
                            <a href="#reference_window" class="btn btn-primary" data-toggle="modal">
                              <span class="glyphicon glyphicon-question-sign"></span>
                            </a>
                          </span>                          

                          <div class="modal fade" id="reference_window">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h2 class="modal-title"><strong>Books</strong></h2>
                                </div>
                                <div class="modal-body">
                                  <p>Use three-character code as follow reference books codes:</p>
                                  <ul>
                                    <li>CRC</li>
                                    <li>FWX (X edition number)</li>
                                    <li>SRM</li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-8">
                        <div class="input-group">

                          <input disabled type="text" class="form-control" name="article-reference" id="article_reference" placeholder="Article"/>
                          <span class="input-group-btn">
                            <a href="#article_window" class="btn btn-primary" data-toggle="modal">
                              <span class="glyphicon glyphicon-question-sign"></span>
                            </a>
                          </span>

                          <div class="modal fade" id="article_window">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h2 class="modal-title"><strong>Articles</strong></h2>
                                </div>
                                <div class="modal-body">
                                  <p>Reference form at according Vancouver style if possible.
								  Example:
								  Mastri AR. Neuropathy of diabetic neurogenic bladder. Ann Intern Med. 1980;92(2 pt 2):316-8</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
					  
					  <div id="show_notes">
					  
					  </div>

                      <div class="modal fade" id="note_window">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h2 class="modal-title"><strong>Optional field</strong></h2>
                            </div>
                            <div class="modal-body">
                              <p>Some particular data or considerations and specific comments for this drug in this animal group</p>
                            </div>
                          </div>
                        </div>
                      </div>

				<?php
				$number = 0;
				?>
                  <button type="button" style="margin-top:2%;" class="btn btn-primary pull-right right-button" onclick="add_note('<?php echo $number;?>')">
                    Add note
                    <span class="glyphicon glyphicon-plus"></span>
                  </button>
				  
            </div>
          </div>
          <button type="button" class="btn btn-primary pull-right right-button" onclick="insert_dose('<?php echo $drug_name; ?>','<?php echo $group_name; ?>')">
            Save
            <span class="glyphicon glyphicon-floppy-save"></span>
          </button>
        </form> 
		<a id="require_link" href="#require_window" data-toggle="modal"></a>
		<div class="modal fade" id="require_window">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title"><strong>Error</strong></h2>
                    </div>
                    <div class="modal-body">
                        <p>To add dose you have to fill all required fields</p>
                    </div>
                </div>
            </div>
        </div>
		<a id="words_link" href="#words_window" data-toggle="modal"></a>
		<div class="modal fade" id="words_window">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h2 class="modal-title"><strong>Error</strong></h2>
					</div>
					<div class="modal-body">
						<p>The maximum of characters to enter is 250 for specific note</p>
					</div>
				</div>
			</div>
		</div>
        </div>
      </div>
	  <?php
	  }
	  ?>
    </div>
  </div>
</div>
</body>
</html>