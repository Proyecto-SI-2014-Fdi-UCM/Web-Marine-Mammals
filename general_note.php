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
      $(document).ready(function() {
        $('.carousel').carousel( {
          interval: 20000
        });
		
      });
	  var notes_number = 1;
	  var firstTime = true;
	  function add_note(number,addFirstTime) {
		var notes = parseInt(notes_number);
		var number = parseInt(number);
		var add = parseInt(addFirstTime);
		var note_div = document.getElementById("show_notes");
		if (firstTime && add == 1) {
			var delete_link = document.createElement("a");
			delete_link.href = "#";
			delete_link.id = "delete";
			delete_link.onclick = function() {
				var element = document.getElementById(number.toString());
				var parent = element.parentNode;
				parent.removeChild(element);
				var element = document.getElementById("delete");
				var parent = element.parentNode;
				parent.removeChild(element);
			};
			var image = document.createElement("span");
			image.setAttribute('class','glyphicon glyphicon-remove pull-right');
			delete_link.appendChild(image);
			note_div.appendChild(delete_link);
		}
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
		textarea.cols = 80;
		textarea.placeholder = "Contraindications and cautions, interactions, adverse reactions and toxic reactions (250 characters maximum)";
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
		image.setAttribute('class','glyphicon glyphicon-remove pull-right');
		delete_link.appendChild(image);
		note_div.appendChild(delete_link);
		notes_number = notes;
	  }
	
	  function update(number,drug_name,group_name) {
		var notes = new Array();
		
		var limit = false;
		var stop;
		if (firstTime) {
			stop = number;
		}
		else {
			stop = notes_number;
		}
		for (var i=0;i<stop;i++) {
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
			$.ajax({
				type: "POST",
				url: "update_general_note.php",
				data: { "general_notes" : notes, "drug_name" : drug_name, "group_name" : group_name},
				success: function(sol) {
					location.href = sol;
				}
			});
		}
	  }
	 
	  function delete_general_note(id,drug_name,group_name) {
		var general_note = document.getElementById(id).value;
		
		$.ajax({
			type: "POST",
			url: "delete_general_note.php",
			data: { "general_note" : general_note, "drug_name" : drug_name, "group_name" : group_name },
			success: function(sol) {
				location.href = sol;
			}
		});
		
	  }
	  
	  function insert_note(drug_name,group_name) {
		var notes = new Array();
		
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
			$.ajax({
				type: "POST",
				url: "insert_general_note.php",
				data: { "general_notes" : notes, "drug_name" : drug_name, "group_name" : group_name},
				success: function(sol) {
					location.href = sol;
				}
			});
		}
	  }
	  
	  function show_search_results(drug_name){
	  	window.location='show_search_results.php?drug='+drug_name;
	  }
  
	  /*function generate_navbar_admin(){
	  	$("#navbar_admin").html("<a href=\"./notifications.php\"><span class=\"glyphicon glyphicon-flag\"></span> Notifications</a>");
	  }*/
	  function generate_navbar_admin() {
    $("#navbar_admin").html("<div class=\"dropdown \"> <button class=\"dropbtn \"><span class=\"glyphicon glyphicon-flag\"></span>Notifications</button>  <div class=\"dropdown-content\">    <a href=\"./notifications.php\">Registration Requests</a>    <a href=\"./notifications_drugs_review.php\">Files pending review</a> <a href=\"./notifications_suggestions.php\">Suggestions</a> </div></div>");
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
                <a href="./contact.php">
                  <span class="glyphicon glyphicon-earphone"></span>
                  Contact
                </a>
              </li>
            </ul>
            <a class="logout navbar-right" href="#">
              <span class="glyphicon glyphicon-log-out"></span>
            </a>
            <form class="navbar-form navbar-right form-search form-inline" role="search" onsubmit="javascript:show_search_results(document.getElementById('drugName').value); return false">
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
      </div>
    </div>
    <div class="row">
      <div class="tab col-md-12 col-lg-10 col-lg-offset-1">
          <ul class="nav nav-tabs nav-justified">
            <?php
			if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) {?>
				<li class="not_current"><a href="./general.php?option=Edit&&drug_name=<?php echo $_GET['drug_name']; ?>">General</a></li>
			<?php
			}
			else { ?>
				<li class="not_current"><a href="./general.php">General</a></li>
			<?php }
			if (isset($_GET['group'])) {
				switch($_GET['group']) {
					case "Cetaceans":
						if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
							<li class="current"><a href="./general_note.php?option=Edit&&group=Cetaceans&&drug_name=<?php echo $_GET['drug_name']; ?>">Cetaceans</a></li>
						<?php } else { ?>
							<li class="current"><a href="./general_note.php?group=Cetaceans">Cetaceans</a></li>
						<?php
						}
						if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
							<li class="not_current"><a href="./general_note.php?option=Edit&&group=Pinnipeds&&drug_name=<?php echo $_GET['drug_name']; ?>">Pinnipeds</a></li>
						<?php } else { ?>
							<li class="not_current"><a href="./general_note.php?group=Pinnipeds">Pinnipeds</a></li>
						<?php
						}
						if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
							<li class="not_current"><a href="./general_note.php?option=Edit&&group=Other MM&&drug_name=<?php echo $_GET['drug_name']; ?>">OtherMM</a></li>
						<?php } else { ?>
							<li class="not_current"><a href="./general_note.php?group=Other MM">OtherMM</a></li>
						<?php
						}
						break;
					case "Pinnipeds":
						if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
							<li class="not_current"><a href="./general_note.php?option=Edit&&group=Cetaceans&&drug_name=<?php echo $_GET['drug_name']; ?>">Cetaceans</a></li>
						<?php } else { ?>
							<li class="not_current"><a href="./general_note.php?group=Cetaceans">Cetaceans</a></li>
						<?php
						}
						if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
							<li class="current"><a href="./general_note.php?option=Edit&&group=Pinnipeds&&drug_name=<?php echo $_GET['drug_name']; ?>">Pinnipeds</a></li>
						<?php } else { ?>
							<li class="current"><a href="./general_note.php?group=Pinnipeds">Pinnipeds</a></li>
						<?php
						}
						if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
							<li class="not_current"><a href="./general_note.php?option=Edit&&group=Other MM&&drug_name=<?php echo $_GET['drug_name']; ?>">OtherMM</a></li>
						<?php } else { ?>
							<li class="not_current"><a href="./general_note.php?group=Other MM">OtherMM</a></li>
						<?php
						}
						break;
					case "Other MM":
						if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
							<li class="not_current"><a href="./general_note.php?option=Edit&&group=Cetaceans&&drug_name=<?php echo $_GET['drug_name']; ?>">Cetaceans</a></li>
						<?php } else { ?>
							<li class="not_current"><a href="./general_note.php?group=Cetaceans">Cetaceans</a></li>
						<?php
						}
						if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
							<li class="not_current"><a href="./general_note.php?option=Edit&&group=Pinnipeds&&drug_name=<?php echo $_GET['drug_name']; ?>">Pinnipeds</a></li>
						<?php } else { ?>
							<li class="not_current"><a href="./general_note.php?group=Pinnipeds">Pinnipeds</a></li>
						<?php
						}
						if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
							<li class="current"><a href="./general_note.php?option=Edit&&group=Other MM&&drug_name=<?php echo $_GET['drug_name']; ?>">OtherMM</a></li>
						<?php } else { ?>
							<li class="current"><a href="./general_note.php?group=Other MM">OtherMM</a></li>
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
						<li class="current"><a href="./general_note.php?option=Edit&&group=<?php echo $_GET['group']; ?>&&drug_name=<?php echo $_GET['drug_name']; ?>">General note</a></li>
					<?php } else { ?>
						<li class="current"><a href="./general_note.php?group=<?php echo $_GET['group']; ?>">General note</a></li>
					<?php } 
					if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) { ?>
						<li class="not_current"><a href="./dose.php?option=Edit&&group=<?php echo $_GET['group']; ?>&&drug_name=<?php echo $_GET['drug_name']; ?>">Dose</a></li>
					<?php } else { ?>
						<li class="not_current"><a href="./dose.php?group=<?php echo $_GET['group']; ?>">Dose</a></li>
					<?php } ?>
				<?php } ?>
              </ul>
            </div>
            <div class="col-md-8 col-xs-6">
			<form id="insert_form" action="./insert_general_note.php" method="POST" role="form">
              <div class="panel panel-default general_note">
				<div class="panel-body add-dosis">
                  <div class="form-group">
                    <label for="general_note">General comments about drug  <a href="#note_window" data-toggle="modal"><span class="glyphicon glyphicon-question-sign">
                    </span></a></label>
                    <?php if (isset($_GET['group']) && isset($_GET['drug_name'])) {
						  $drug_name = $_GET['drug_name'];
						  $group_name = $_GET['group'];
						  if (isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) {
							  
							  //Descomentar esto para conectar con localhost
							  /*$con = mysql_connect ("127.0.0.1","root");
							  if (!$con){die ("ERROR AL CONECTAR CON LA BASE DE DATOS ".mysql_error());}

							  $db = mysql_select_db("mydb",$con);
							  if (!$db) {die ("ERROR AL SELECCIONAR DB ".mysql_error());} ?>
							 <div id="show_notes">
							 <?php
							  $sql = "SELECT general_note FROM drug_aplicated_to_group WHERE drug_name = '$drug_name' AND group_name = '$group_name'";

							  $result = mysql_query($sql,$con);
							  
							  $i = 1;
							  while ($row = mysql_fetch_row($result)) {
							  ?>
								  <textarea id="<?php echo $i;?>" name="general_note" rows="4" cols="80"><?php echo $row[0]; ?></textarea>
								  <a href="#security_window<?php echo $i;?>" data-toggle="modal"><span class="glyphicon glyphicon-remove pull-right"></span></a>
								  <a href="#" onclick="update('<?php echo $i;?>','<?php echo $drug_name;?>','<?php echo $group_name;?>','<?php echo $row[0];?>')"><span class="glyphicon glyphicon-floppy-save pull-right"></span></a>
								  <div class="modal fade" id="security_window<?php echo $i;?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h2 class="modal-title"><strong>Are you sure?</strong></h2>
											</div>
											<div class="modal-body">
												<a href="#" class="btn btn-primary col-xs-offset-3" data-dismiss="modal" aria-hidden="true">No</a>
												<a href="#" class="btn btn-primary col-xs-offset-4" data-dismiss="modal" aria-hidden="true" onclick="delete_general_note('<?php echo $i;?>','<?php echo $drug_name;?>','<?php echo $group_name;?>')">Yes</a>
											</div>
										</div>
									</div>
								  </div>
							  <?php
								  $i++;
							  } ?>*/
							  
							  //Descomentar esto para conectar con el servidor
							  $con = mysqli_connect ("localhost","ForMMulary","wfGr42&7","marinemammalformulary_",3306);
							  if (mysqli_connect_errno ($con)){
								echo "No se pudo conectar a MySQL: " . mysqli_connect_error ();
							  } ?>
							  <div id="show_notes">
							 <?php
							  $sql = "SELECT general_note FROM DRUG_aplicated_to_GROUP WHERE drug_name = '$drug_name' AND group_name = '$group_name'";
							  $result = mysqli_query($con, $sql);
							  $number = mysqli_num_rows($result);
							  $addFirstTime = 0;
							  
							  if ($number > 0) {
							  $i = 1;
							  while ($row = mysqli_fetch_row($result)) {
							  ?>
								  <textarea id="<?php echo $i;?>" name="general_note" rows="4" cols="80"><?php echo $row[0]; ?></textarea>
								  <a href="#security_window<?php echo $i;?>" data-toggle="modal"><span class="glyphicon glyphicon-remove pull-right"></span></a>
								  <a href="#" onclick="update('<?php echo $i;?>','<?php echo $drug_name;?>','<?php echo $group_name;?>','<?php echo $row[0];?>')"><span class="glyphicon glyphicon-floppy-save pull-right"></span></a>
								  <div class="modal fade" id="security_window<?php echo $i;?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h2 class="modal-title"><strong>Are you sure?</strong></h2>
											</div>
											<div class="modal-body">
												<a href="#" class="btn btn-primary right-button col-xs-offset-3" data-dismiss="modal" aria-hidden="true">No</a>
												<a href="#" class="btn btn-primary right-button col-xs-offset-4" data-dismiss="modal" aria-hidden="true" onclick="delete_general_note('<?php echo $i;?>','<?php echo $drug_name;?>','<?php echo $group_name;?>')">Yes</a>
											</div>
										</div>
									</div>
								  </div>
							  <?php
								  $i++;
							  } ?>
							  
							  <input type="hidden" name="option" value="Edit"/>
							  </div>
							 </div>
							 <div class="row">
							 <div class="col-xs-12">
							 <button type="button" style="margin-top:2%;" class="btn btn-primary right-button pull-right" onclick="add_note('<?php echo $number;?>','<?php echo $addFirstTime;?>')">
								Add note
								<span class="glyphicon glyphicon-plus"></span>
							 </button>
							 </div>
							 </div>
							 </div>
							 </div>
							 <button type="button" class="btn btn-primary right-button pull-right" onclick="update('<?php echo $number;?>','<?php echo $drug_name;?>','<?php echo $group_name;?>')">
								Save
								<span class="glyphicon glyphicon-floppy-save"></span>
							 </button>
							<?php
							}
							else {
								$number = 1;
								$addFirstTime = 1; ?>
								<div id="show_notes">
									<textarea id="1" name="add_general_note" rows="4" cols="80" placeholder="Contraindications and cautions, interactions, adverse reactions and toxic reactions (250 characters maximum)"></textarea> 
								</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<button type="button" style="margin-top:3%;" class="btn btn-primary right-button pull-right" onclick="add_note('<?php echo $number;?>','<?php echo $addFirstTime;?>')">
											Add note
											<span class="glyphicon glyphicon-plus"></span>
										</button>
									</div>
								</div>
								</div>
								</div>
								<button type="button" style="margin-top:3%;" class="btn btn-primary right-button pull-right" onclick="insert_note('<?php echo $drug_name;?>','<?php echo $group_name;?>')">
									Save
									<span class="glyphicon glyphicon-floppy-save"></span>
								</button>
							<?php
							}
						  }
						   else {
							$drug_name = $_GET['drug_name'];
							$group_name = $_GET['group'];
							$number = 1;
							$addFirstTime = 1;
					?>
					  <div id="show_notes">
					  <textarea id="1" name="add_general_note" rows="4" cols="80" placeholder="Contraindications and cautions, interactions, adverse reactions and toxic reactions (250 characters maximum)"></textarea> 
					  </div>
					  </div>
					  <div class="row">
						<div class="col-xs-12">
							<button type="button" class="btn btn-primary right-button pull-right" onclick="add_note('<?php echo $number;?>','<?php echo $addFirstTime;?>')">
								Add note
								<span class="glyphicon glyphicon-plus"></span>
							</button>
						</div>
					  </div>
					  </div>
					  </div>
					  <button type="button" class="btn btn-primary right-button pull-right" onclick="insert_note('<?php echo $drug_name;?>','<?php echo $group_name;?>')">
						Save
						<span class="glyphicon glyphicon-floppy-save"></span>
					  </button>
					  <?php
						   }
						} 
						?>
					  <div class="modal fade" id="note_window">
						<div class="modal-dialog">
						  <div class="modal-content">
							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							  <h2 class="modal-title"><strong>General comments about drug</strong></h2>
							</div>
							<div class="modal-body">
							  <p>Precautions, interactions, relevant secondary effects...</p>
							</div>
						  </div>
						</div>
					  </div>
                  <input type="hidden" name="drug_name" value="<?php echo $drug_name; ?>"/>
                  <input type="hidden" name="group_name" value="<?php echo $group_name; ?>"/>
				  
				  <a id="words_link" href="#words_window" data-toggle="modal"></a>
				  <div class="modal fade" id="words_window">
						<div class="modal-dialog">
						  <div class="modal-content">
							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							  <h2 class="modal-title"><strong>Error</strong></h2>
							</div>
							<div class="modal-body">
							  <p>The maximum of characters to enter is 250</p>
							</div>
						  </div>
						</div>
				   </div>
                </form>
          </div>
        </div>
      </div>
  </div>
</body>
</html>