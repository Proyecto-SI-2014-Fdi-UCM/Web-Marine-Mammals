<?php
session_start();
$username=$_SESSION['username'];
$password=$_SESSION['password'];
//Descomentar esto para conectar con el servidor
          $con = mysqli_connect ("localhost","ForMMulary","wfGr42&7","marinemammalformulary_",3306);
          //$con = mysqli_connect ("localhost","root","","marinemammalformulary_");
            if (mysqli_connect_errno ($con)){
            echo "No se pudo conectar a MySQL: " . mysqli_connect_error ();
          }
?>
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
    var codes_number = 1;
    var firstTime = true;
    
    function validate() {
      var element = document.getElementById("drug_name");
      if (element == null || element.length == 0 ) {
        alert('[ERROR] The Drug (INN) field can not be empty');
        return false;
      }
      
      element = document.getElementById("anatomic");
      if (element == null || element == 0 ) {
        alert('[ERROR] Anatomic Target field, you must choose an option');
        return false;
      }
      
      element = document.getElementById("therapeutic");
      if (element == null || element.length == 0 ) {
        alert('[ERROR] The Therapeutic Target field can not be empty');
        return false;
      }
      
      element = document.getElementById("code");
      if (element == null || element.length == 0 ) {
        alert('[ERROR] The Code field can not be empty');
        return false;
      }
      
      showTabs();
      return true;
    }

    function add_code (index) {

      var codes = parseInt(index);
      if (firstTime) {
        codes = index + 1;
        firstTime = false;
      }
      else {
        codes = codes_number+1;
      }

      var panel = document.getElementById('panelCode');
      var divPanel = document.createElement('div');
      divPanel.setAttribute('class', "panel panel-default");
      divPanel.id = codes;

      var divPanelB = document.createElement('div');
      divPanelB.setAttribute('class', "panel-body");

      var delete_link = document.createElement("a");
        delete_link.href = "#";
        delete_link.onclick = function() {
        var element = document.getElementById(codes.toString());
        var parent = element.parentNode;
        parent.removeChild(element);
        parent.removeChild(this);
     };

     

      var button = createElement('button');
     button.setAttribute('type', "button");
     button.setAttribute('class', "close");
     button.setAttribute('data-dismiss', "modal");
     button.setAttribute('aria-hidden', "true");
     var titleX = document.createTextNode("&times;");

     button.appendChild(titleX);

     delete_link.appendChild(button);

      var formgroupA = document.createElement('div');
      formgroupA.setAttribute('class', "form-group");

      var labelA = document.createElement("div");
      labelA.setAttribute('class', "col-xs-8 col-md-7 required-label");


      var inputgroupA = document.createElement('div');
      inputgroupA.setAttribute('class', "input-group general");

      var anatomic = document.createElement('select');
      anatomic.setAttribute('class', "form-control");
      var item = document.createElement('option');
      item.text = "Anatomic Target (1st level ATCvet)";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QA Alimentary tract and metabolism";
      anatomic.appendChild(item);      
      var item = document.createElement('option');
      item.text = "QB Blood and blood forming organs";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QC Cardiovascular system";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QD Dermatologicals";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QG Genito urinary system and sex hormones";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QH Systemic hormonal preparations, excl. sex hormones and insulins";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QI Inmunologicals";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QJ Antiinfectives for systemic use";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QL Antineoplastic and immunomodulating agents";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QM Musculo-skeletal system";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QN Nervous system";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QP Antiparasitic products, insecticides and repellents";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QR Respiratory system";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QS Sensory organs";
      anatomic.appendChild(item);
      var item = document.createElement('option');
      item.text = "QV Various";
      anatomic.appendChild(item);

      inputgroupA.appendChild(anatomic);

      var spanbtnA = document.createElement('span');
      spanbtnA.setAttribute('class', "input-group-btn");

      var help_linkA = document.createElement("a");
      help_linkA.href = "#anatomic_window";
      help_linkA.setAttribute('data-toggle','modal');

      var help_spanA = document.createElement("span");
      help_spanA.setAttribute('class','glyphicon glyphicon-question-sign');
      help_linkA.appendChild(help_spanA);

      spanbtnA.appendChild(help_linkA);
      inputgroupA.appendChild(spanbtnA);

      var asteriskA = document.createElement("label");
      asteriskA.setAttribute('class',"col-xs-1 asterisk");

      labelA.appendChild(inputgroupA);
      formgroupA.appendChild(labelA);
      formgroupA.appendChild(asteriskA);



      var formgroupT = document.createElement('div');
      formgroupT.setAttribute('class', "form-group");

      var labelT = document.createElement("div");
      labelT.setAttribute('class', "col-xs-8 col-md-7 required-label");

      var inputgroupT = document.createElement('div');
      inputgroupT.setAttribute('class', "input-group");

      var inputText = createElement('input');
      inputText.setAttribute('class', "form-control");

      var spanbtnT = document.createElement('span');
      spanbtnT.setAttribute('class', "input-group-btn");

      var help_linkT = document.createElement("a");
      help_linkT.href = "#therapeutic_window";
      help_linkT.setAttribute('data-toggle','modal');

      var help_spanT = document.createElement("span");
      help_spanT.setAttribute('class','glyphicon glyphicon-question-sign');
      help_linkT.appendChild(help_spanT);

      spanbtnT.appendChild(help_linkT);

      inputgroupT.appendChild(inputText);
      inputgroupT.appendChild(spanbtnT);

      var asteriskT = document.createElement("label");
      asteriskT.setAttribute('class',"col-xs-1 asterisk");

      labelT.appendChild(inputgroupT);
      formgroupT.appendChild(labelT);
      formgroupT.appendChild(asteriskT);



      var formgroupC = document.createElement('div');
      formgroupC.setAttribute('class', "form-group");

      var labelC = document.createElement("label");
      labelC.setAttribute('class', "control-label col-xs-2");

      var title = document.createTextNode("ATCvet Code");

      var fontAsterisk = document.createElement('font');
      fontAsterisk.setAttribute('color', "red");
      fontAsterisk.setAttribute('size', "4%");

      labelC.appendChild(title);
      labelC.appendChild(fontAsterisk);

      var inputgroupC = document.createElement('div');
      inputgroupC.setAttribute('class', "input-group");

      var inputTextC = createElement('input');
      inputTextC.setAttribute('class', "form-control");

      var spanbtnC = document.createElement('span');
      spanbtnC.setAttribute('class', "input-group-btn");

      var help_linkC = document.createElement("a");
      help_linkC.href = "#code_window";
      help_linkC.setAttribute('data-toggle','modal');

      var help_spanC = document.createElement("span");
      help_spanC.setAttribute('class','glyphicon glyphicon-question-sign');
      help_linkC.appendChild(help_spanC);

      spanbtnC.appendChild(help_linkC);

      inputgroupC.appendChild(inputTextC);
      inputgroupC.appendChild(spanbtnC);

      var divC = document.createElement('div');
      divC.setAttribute('class', "col-xs-3");
      divC.appendChild(inputgroupC);
      
      formgroupC.appendChild(labelC);
      formgroupC.appendChild(divC);

      divPanelB.appendChild(delete_link);
      divPanelB.appendChild(formgroupA);
      divPanelB.appendChild(formgroupT);
      divPanelB.appendChild(formgroupC); 
      divPanel.appendChild(divPanelB);

      panel.appendChild(divPanel);

      codes_number = codes;
    }
	
	function update_info(number, old_drug) {
	  //alert(number);
	  var element = document.getElementById("drug_name");
	  //alert(element.value);
      if (element == null || element.length == 0 ) {
        alert('[ERROR] The Drug (INN) field can not be empty');
        return false;
      }
	  var anatomic_groups = new Array();
	  var therapeutic_groups = new Array();
	  var codes = new Array();
	  for (var i=0;i<number;i++) {
		var index = i+1;
		var id = index.toString();
		element = document.getElementById("indexAnatomic" + id);
        if (element == null || element == 0 ) {
			alert('[ERROR] Anatomic Target field, you must choose an option');
			return false;
        }
      
        element = document.getElementById("indexTherapeutic" + id);
        if (element == null || element.length == 0 ) {
			alert('[ERROR] The Therapeutic Target field can not be empty');
			return false;
		}
      
		element = document.getElementById("indexCode" + id);
		if (element == null || element.length == 0 ) {
			alert('[ERROR] The Code field can not be empty');
			return false;
		}
		anatomic_groups.push(document.getElementById("indexAnatomic" + id).value);
		therapeutic_groups.push(document.getElementById("indexTherapeutic" + id).value);
		codes.push(document.getElementById("indexCode" + id).value);
	  }
	  if (document.getElementById("anatomic").value != "Anatomic Target (1st level ATCvet)" && document.getElementById("therapeutic").value != "" && document.getElementById("new_code").value != "") {
		anatomic_groups.push(document.getElementById("anatomic").value);
		therapeutic_groups.push(document.getElementById("therapeutic").value);
		codes.push(document.getElementById("new_code").value);
	  }
	  //alert(anatomic_groups);
	  //alert(therapeutic_groups);
	  //alert(codes);
	  var available="";
	  if (document.getElementById("availableYes").checked) {
		  available = "Yes";
	  }
	  else {
		  available = "Nd";
	  }
	  //alert(available);
	  var license_AEMPS="";
	  if (document.getElementById("chk_AEMPS").checked) {
		  license_AEMPS = "Yes";
	  }
	  else {
		  license_AEMPS = "Nd";
	  }
	  var license_EMA="";
	  if (document.getElementById("chk_EMA").checked) {
		  license_EMA = "Yes";
	  }
	  else {
		  license_EMA = "Nd";
	  }
	  var license_FDA="";
	  if (document.getElementById("chk_FDA").checked) {
		  license_FDA = "Yes";
	  }
	  else {
		  license_FDA = "Nd";
	  }
	  $.ajax({
		type: "POST",
		url: "update_general_info.php",
		data: {"old_drug" : old_drug, "drug_name" : document.getElementById("drug_name").value, "description" : document.getElementById("description").value, "available": available, "license_AEMPS" : license_AEMPS,
		"license_EMA" : license_EMA, "license_FDA" : license_FDA, "anatomic_groups" : anatomic_groups, "therapeutic_groups" : therapeutic_groups, "codes" : codes},
		success: function(sol) {
			//alert(sol);
			location.href = sol;
		}
	  });      
      //showTabs();
	}
  
function insert_code(){
      var entry_drug_name=document.getElementById("entry_drug_name").value;
      var position=document.getElementById("entry_anatomic_group").options.selectedIndex;
      var entry_anatomic_group = document.getElementById("entry_anatomic_group").options[position].text;
      var entry_therapeutic_group=document.getElementById("entry_therapeutic_group").value;
      var entry_code=document.getElementById("entry_code").value;
      var entry_description=document.getElementById("entry_description").value;
      var entry_available="Nd";
      if (document.getElementById("Yes").checked) {
        entry_available = "Yes";
      }

      var entry_chk_aemps="Nd";
      var entry_chk_fda="Nd";
      var entry_chk_ema="Nd";
      if (document.getElementById("entry_chk_aemps").checked) {
        entry_chk_aemps="Yes";

      }
      if (document.getElementById("entry_chk_fda").checked) {
        entry_chk_fda="Yes";
      }
      if (document.getElementById("entry_chk_ema").checked) {
        entry_chk_ema="Yes";
      }
      
      $.ajax({
        type: "POST",
        url:"insert_general_information.php",
        data:{"drug_name":entry_drug_name,"anatomic_group":entry_anatomic_group,"therapeutic_group":entry_therapeutic_group,"code":entry_code,"description":entry_description, "available":entry_available,"license_AEMPS":entry_chk_aemps,"license_EMA":entry_chk_ema,"license_FDA":entry_chk_fda, "username":"<?php echo $username;?>"},
        success:function(sol){
          //alert(sol);
          location.href = sol;
        }
      });
}
      function delete_code(index, drug_name) {
      var code_number = document.getElementById("indexCode" + index).value;
      $.ajax({
        type: "POST",
        url: "delete_code.php",
        data: { "code_number" : code_number, "drug_name" : drug_name },
        success: function(sol) {
        location.href = sol;
      }
    });
    }
    function show_search_results(drug_name){
      window.location='show_search_results.php?drug='+drug_name;
      }

/*function generate_navbar_admin() {
    $("#navbar_admin").html("<div class=\"dropdown \"> <button class=\"dropbtn \"><span class=\"glyphicon glyphicon-flag\"></span>Notifications</button>  <div class=\"dropdown-content\">    <a href=\"./notifications.php\">Registration Requests</a>    <a href=\"#\">Files pending review</a> </div></div>");
  }*/
  
      /*function generate_navbar_admin(){
         $("#navbar_admin").html("<a href=\"./notifications.php\"><span class=\"glyphicon glyphicon-flag\"></span> Notifications</a>");        
      }*/
      function generate_navbar_admin(){
         $("#navbar_admin").html("<div class=\"dropdown \"> <button class=\"dropbtn \"><span class=\"glyphicon glyphicon-flag\"></span>Notifications</button>  <div class=\"dropdown-content\">    <a href=\"./notifications.php\">Registration Requests</a>    <a href=\"./notifications_drugs_review.php\">Files pending review</a> <a href=\"./notifications_suggestions.php\">Suggestions</a> </div></div>");
      }
  </script>
    
</head>
<?php
$sql1 = "SELECT profile FROM User WHERE user_name='$username' and password='$password' and checked=1";
  $result1=mysqli_query($con,$sql1);
  $profile=mysqli_fetch_row($result1);
  if(!strcmp($profile[0], "A")) {?>

<!--if($_SESSION['username']=='administrator'){?>-->
  <body onload="generate_navbar_admin()">
<?php }else{ ?>
  <body>
<?php } ?>

<!-- <body onload="generate_navbar_admin()"> -->
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
      </div>
    </div>
  <div class="tab col-md-12 col-lg-10 col-lg-offset-1">
    <ul class="nav nav-tabs nav-justified">
      <?php
      if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name']))  { ?>
          <li class="current"><a href="./general.php?option=Edit&&drug_name=<?php echo $_GET['drug_name']; ?>">General</a></li>
          <li class="not_current"><a href="./general_note.php?option=Edit&&group=Cetaceans&&drug_name=<?php echo $_GET['drug_name']; ?>">Cetaceans</a></li>
          <li class="not_current"><a href="./general_note.php?option=Edit&&group=Pinnipeds&&drug_name=<?php echo $_GET['drug_name']; ?>">Pinnipeds</a></li>
          <li class="not_current"><a href="./general_note.php?option=Edit&&group=Other MM&&drug_name=<?php echo $_GET['drug_name']; ?>">OtherMM</a></li>
      <?php
      } else { ?>
          <li class="current"><a href="./general.php">General</a></li>
          <li class="not_current disabled"><a href="./general.php" >Cetaceans</a></li>
          <li class="not_current disabled"><a href="./general.php">Pinnipeds</a></li>
          <li class="not_current disabled"><a href="./general.php">OtherMM</a></li>
      <?php 
      } ?>
    </ul>

    <div class="row">
      <div class="col-xs-12">
        <form class="form-horizontal" action="#" method="POST">
        <?php 
          if ((isset($_GET['option']) && !strcmp($_GET['option'], "Edit")) && isset($_GET['drug_name'])) {
            //echo $_GET['drug_name']; 
            $drug_name = $_GET['drug_name'];

          //Descomentar esto para conectar con el servidor
          //$con = mysqli_connect ("localhost","ForMMulary","wfGr42&7","marinemammalformulary_",3306);
          //  $con = mysqli_connect ("localhost","root","","marinemammalformulary_");
          //  if (mysqli_connect_errno ($con)){
          //  echo "No se pudo conectar a MySQL: " . mysqli_connect_error ();
          //}

          $query = "SELECT description, available, license_AEMPS, license_EMA, license_FDA FROM DRUG WHERE drug_name = '$drug_name'";
          $result = mysqli_query($con,$query);   
          $row = mysqli_fetch_row($result);
          $description = $row[0];
          $available = $row[1];
          $license_AEMPS = $row[2];
          $license_EMA = $row[3];
          $license_FDA = $row[4];

          /*$con = mysql_connect ("127.0.0.1","root");
          if (!$con){die ("ERROR AL CONECTAR CON LA BASE DE DATOS ".mysql_error());}
      
          $db = mysql_select_db("mydb",$con);
          if (!$db) {die ("ERROR AL SELECCIONAR DB ".mysql_error());}

          $query = "SELECT description, available, license_AEMPS, license_EMA, license_FDA FROM Drug WHERE drug_name = '$drug_name'";
          $result = mysql_query($query,$con);   
          $row = mysql_fetch_row($result);
          $description = $row[0];
          $available = $row[1];
          $license_AEMPS = $row[2];
          $license_EMA = $row[3];
          $license_FDA = $row[4]; */
        ?>

          <div class="panel panel-default">
            <div class="panel-body">

              <div class="form-group">
                <label for="drug" id="drug" class="text-left col-xs-2 control-label">Drug (INN)<font color="red" size="4%">*</font></label>
                <div class="col-xs-10 col-md-5 col-xs-offset-1">
                  <input title="a drug name is required" class="form-control" id="drug_name" type="text" value="<?php echo $drug_name;?>"> 
                </div>
              </div>

              <div class="form-group">
                <label type="text-left" for="description" class="col-xs-2 control-label">Description</label>
                <div class="col-xs-10 col-md-9 col-xs-offset-1">
                  <textarea type="text" maxlength="140" class="form-control" rows="2" id="description"><?php echo $description; ?></textarea>
                </div>
              </div>
    
              <div class="form-group">
                <label for="available" class="col-xs-3 control-label">Available as generic drug</label>

                  <?php 
                    if ($available == "Yes") { ?>
                      <div class="radio col-xs-2 col-xs-offset-1">                  
                        <input type="radio" name="available" value="Yes" id="availableYes" checked = "checked"><label for="yes">Yes</label>  
                      </div>
                      <div class="radio col-xs-2">
                        <input type="radio" name="available" id="availableNo"><label for="nd">Nd</label>
                      </div>
                  <?php }
                    else { ?>     
                      <div class="radio col-xs-2 col-xs-offset-1">                  
                        <input type="radio" name="available" id="availableYes"><label for="yes">Yes</label>  
                      </div>
                      <div class="radio col-xs-2">
                        <input type="radio" name="available" value="Nd" id="availableNo" checked = "checked"><label for="nd">Nd</label>
                      </div>  
                  <?php } ?>

              </div>

              <div class="license">
                <div class="form-group">   

                  <label for="license" class="license col-xs-3 control-label">Licensed for vet use</label>
                  <div class="col-xs-offset-1">
                    <div class="col-xs-3">
                      <img class="logo" src="./images/logo_ema.jpg" class="img-responsive" alt="">
                    </div>
                    <div class="col-xs-3">
                      <img class="fda" src="./images/logo_fda.jpg" class="img-responsive" alt="">
                    </div>
                    <div class="col-xs-3">
                      <img class="logo" src="./images/logo_aemps.jpg" class="img-responsive" alt="">
                    </div>  
                  </div>                     
                </div>

                <div class="form-group">
                  
                  <div class="chk_ema checkbox col-xs-1 col-xs-offset-4">
                    <?php if ($license_EMA == "Yes") { ?>                      
                        <input type="checkbox" value="Yes" id="chk_EMA" checked = "checked">                      
                    <?php } else { ?>      
                        <input type="checkbox" value="Nd" id="chk_EMA">
                    <?php } ?>
                  </div>

                  <div class="checkbox col-xs-1 col-xs-offset-2">
                    <?php if ($license_FDA == "Yes") { ?>
                        <input type="checkbox" value="Yes" id="chk_FDA" checked = "checked">
                     <?php } else { ?>      
                        <input type="checkbox" value="Nd" id="chk_FDA">
                     <?php } ?>
                  </div>  

                  <div class="checkbox col-xs-1 col-xs-offset-2">
                    <?php if ($license_AEMPS == "Yes") { ?>
                      <input type="checkbox" value="Yes" id="chk_AEMPS" checked = "checked">
                     <?php } else { ?>
                      <input type="checkbox" value="Nd" id="chk_AEMPS">
                     <?php } ?>
                  </div>

                </div>                 
              </div> 

            </div>
          </div>

          <?php
            $query = "SELECT code_number, anatomic_group_name, therapeutic_group_name FROM CODE WHERE drug_name = '$drug_name'";
            $result = mysqli_query($con,$query);
            $index = 0;
            while ($row = mysqli_fetch_row($result)) { 
              $code = $row[0];
              $anatomic = $row[1];
              $therapeutic = $row[2];
              $index += 1;

            /*$query = "SELECT code_number, anatomic_group_name, therapeutic_group_name FROM Code WHERE drug_name = '$drug_name'";
            $result = mysql_query($query,$con);
            $index = 0;
            while ($row = mysql_fetch_row($result)) { 
              $code = $row[0];
              $anatomic = $row[1];
              $therapeutic = $row[2];
              $index += 1;*/
          ?>

          <div class="panel panel-default">
            <div class="panel-body">

            <div class="col-xs-12">
                <a href="#delete_window<?php echo $index; ?>" data-toggle="modal">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="remove">&times;</button>  
                </a>

                <div class="modal fade" id="delete_window<?php echo $index; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title"><strong>Remove code</strong></h2>
                        <p>Are you sure?</p>
                      </div>                          
                      <div class="modal-body">
                        <a href="#" class="btn btn-primary right-button col-xs-offset-3" data-dismiss="modal" aria-hidden="true">No</a>
                        <a href="#" class="btn btn-primary right-button col-xs-offset-4" data-dismiss="modal" aria-hidden="true" onclick="delete_code('<?php echo $index;?>','<?php echo $drug_name;?>')">Yes</a>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

              <div class="form-group">                      
                <div class="col-xs-8 col-md-7 required-label">
                  <div class="input-group general">
                    
                    <select class="form-control" id="indexAnatomic<?php echo $index ?>">
                        <option>Anatomic Target (1st level ATCvet)</option>

                      <?php if ($anatomic == "QA Alimentary tract and metabolism") { ?>
                        <option selected>QA Alimentary tract and metabolism</option>
                      <?php } else { ?>
                        <option>QA Alimentary tract and metabolism</option>
                      <?php } ?>

                      <?php if ($anatomic == "QB Blood and blood forming organs") { ?>
                        <option selected>QB Blood and blood forming organs</option>
                      <?php } else { ?>
                        <option>QB Blood and blood forming organs</option>
                      <?php } ?>
                      
                      <?php if ($anatomic == "QC Cardiovascular system") { ?>
                        <option selected>QC Cardiovascular system</option>
                      <?php } else { ?>
                        <option>QC Cardiovascular system</option>
                      <?php } ?>
                      
                      <?php if ($anatomic == "QD Dermatologicals") { ?>
                        <option selected>QD Dermatologicals</option>
                      <?php } else { ?>
                        <option>QD Dermatologicals</option>
                      <?php } ?>
                      
                      <?php if ($anatomic == "QG Genito urinary system and sex hormones") { ?>
                        <option selected>QG Genito urinary system and sex hormones</option>
                      <?php } else { ?>
                        <option>QG Genito urinary system and sex hormones</option>
                      <?php } ?>
                      
                      <?php if ($anatomic == "QH Systemic hormonal preparations, excl. sex hormones and insulins") { ?>
                        <option selected>QH Systemic hormonal preparations, excl. sex hormones and insulins</option>
                      <?php } else { ?>
                        <option>QH Systemic hormonal preparations, excl. sex hormones and insulins</option>
                      <?php } ?>
                      
                      <?php if ($anatomic == "QI Inmunologicals") { ?>
                        <option selected>QI Inmunologicals</option>
                      <?php } else { ?>
                        <option>QI Inmunologicals</option>
                      <?php } ?>
                      
                      <?php if ($anatomic == "QJ Antiinfectives for systemic use") { ?>
                        <option selected>QJ Antiinfectives for systemic use</option>
                      <?php } else { ?>
                        <option>QJ Antiinfectives for systemic use</option>
                      <?php } ?>
                      
                      <?php if ($anatomic == "QL Antineoplastic and immunomodulating agents") { ?>
                        <option selected>QL Antineoplastic and immunomodulating agents</option>
                      <?php } else { ?>
                        <option>QL Antineoplastic and immunomodulating agents</option>
                      <?php } ?>
                      
                      <?php if ($anatomic == "QM Musculo-skeletal system") { ?>
                        <option selected>QM Musculo-skeletal system</option>
                      <?php } else { ?>
                        <option>QM Musculo-skeletal system</option>
                      <?php } ?>
                      
                      <?php if ($anatomic == "QN Nervous system") { ?>
                        <option selected>QN Nervous system</option>
                      <?php } else { ?>
                        <option>QN Nervous system</option>
                      <?php } ?>
                      
                      <?php if ($anatomic == "QP Antiparasitic products, insecticides and repellents") { ?>
                        <option selected>QP Antiparasitic products, insecticides and repellents</option>
                      <?php } else { ?>
                        <option>QP Antiparasitic products, insecticides and repellents</option>
                      <?php } ?>
                      
                      <?php if ($anatomic == "QR Respiratory system") { ?>
                        <option selected>QR Respiratory system</option>
                      <?php } else { ?>
                        <option>QR Respiratory system</option>
                      <?php } ?>
                      
                      <?php if ($anatomic == "QS Sensory organs") { ?>
                        <option selected>QS Sensory organs</option>
                      <?php } else { ?>
                        <option>QS Sensory organs</option>
                      <?php } ?>
                      
                      <?php if ($anatomic == "QV Various") { ?>
                        <option selected>QV Various</option>
                      <?php } else { ?>
                        <option>QV Various</option>
                      <?php } ?>
                    
                    </select>
                    <span class="input-group-btn">
                      <a href="#anatomic_window" class="btn btn-primary" data-toggle="modal">
                        <span class="glyphicon glyphicon-question-sign"></span>
                      </a>
                    </span>
                  </div>
                </div>

                <div class="col-xs-1 asterisk">
                  <label><font color="red" size="4%"><strong>*</strong></font></label>
                </div>
                

                <div class="modal fade" id="anatomic_window">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title"><strong>Anatomic target</strong></h2>
                      </div>
                      <div class="modal-body">
                        <p>...</p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <div class="form-group">
                <div class="col-xs-8 col-md-7 required-label">
                  <div class="input-group">
                    <input title="therapeutic target required" type="text" class="form-control" id="indexTherapeutic<?php echo $index ?>" type="text" value="<?php echo $therapeutic; ?>">                    
                    <span class="input-group-btn">
                      <a href="#therapeutic_window" class="btn btn-primary" data-toggle="modal">
                        <span class="glyphicon glyphicon-question-sign"></span>
                      </a>
                    </span>
                  </div>
                </div>

                <div class="col-xs-1 asterisk">
                  <label><font color="red" size="4%"><strong>*</strong></font></label>
                </div>
                
                <div class="col-xs-3">
                  <button type="button" class="btn btn-link">
                    <a href="http://www.whocc.no/atcvet/atcvet_index/" target="blank">ATCvet Index</a>
                  </button>
                </div>

                <div class="modal fade" id="therapeutic_window">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title"><strong>Therapeutic target</strong></h2>
                      </div>
                      <div class="modal-body">
                        <p>...</p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>             
                
              
              <div class="form-group">
                <label for="code" class="control-label col-xs-2">ATCvet Code<font color="red" size="4%">*</font></label>
                <div class="col-xs-3">
                  <div class="input-group">
                    <input title="an ATCvet code is required" type="text" class="form-control" type="text" value="<?php echo $code; ?>"  id="indexCode<?php echo $index ?>">                    
                    <span class="input-group-btn">
                      <a href="#code_window" class="btn btn-primary" data-toggle="modal">
                        <span class="glyphicon glyphicon-question-sign"></span>
                      </a>
                    </span>
                  </div>
                </div>

                <div class="modal fade" id="code_window">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title"><strong>ATCvet Code</strong></h2>
                      </div>
                      <div class="modal-body">
                        <p>...</p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              
            </div>
          </div>
		   <?php
			}?>

          <div class="panel panel-default" id="nodeCode2">
            <div class="panel-body">

            <div class="col-xs-12">
                <a href="#delete_window" data-toggle="modal">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="remove">&times;</button>  
                </a>

                <div class="modal fade" id="delete_window">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title"><strong>Remove code</strong></h2>
                        <p>Are you sure?</p>
                      </div>                          
                      <div class="modal-body">
                        <button type="submit" class="btn btn-primary col-xs-offset-3">Yes</button>
                        <button type="submit" class="btn btn-primary col-xs-offset-3">No</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">                      
                <div class="col-xs-8 col-md-7 required-label">
                  <div class="input-group general">
                    <select class="form-control" id="anatomic">
                      <option>Anatomic Target (1st level ATCvet)</option>
                      <option>QA Alimentary tract and metabolism</option>
                      <option>QB Blood and blood forming organs</option>
                      <option>QC Cardiovascular system</option>
                      <option>QD Dermatologicals</option>
                      <option>QG Genito urinary system and sex hormones</option>
                      <option>QH Systemic hormonal preparations, excl. sex hormones and insulins</option>
                      <option>QI Inmunologicals</option>
                      <option>QJ Antiinfectives for systemic use</option>
                      <option>QL Antineoplastic and immunomodulating agents</option>
                      <option>QM Musculo-skeletal system</option>
                      <option>QN Nervous system</option>
                      <option>QP Antiparasitic products, insecticides and repellents</option>
                      <option>QR Respiratory system</option>
                      <option>QS Sensory organs</option>
                      <option>QV Various</option>
                    </select>
                    <span class="input-group-btn">
                      <a href="#anatomic_window" class="btn btn-primary" data-toggle="modal">
                        <span class="glyphicon glyphicon-question-sign"></span>
                      </a>
                    </span>
                  </div>
                </div>

                <div class="col-xs-1 asterisk">
                  <label><font color="red" size="4%"><strong>*</strong></font></label>
                </div>
                

                <div class="modal fade" id="anatomic_window">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title"><strong>Anatomic target</strong></h2>
                      </div>
                      <div class="modal-body">
                        <p>...</p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <div class="form-group">
                <div class="col-xs-8 col-md-7 required-label">
                  <div class="input-group">
                    <input title="therapeutic target required" type="text" class="form-control" id="therapeutic" type="text" placeholder="Therapeutic Target (2nd level ATCvet)" required>
                    <span class="input-group-btn">
                      <a href="#therapeutic_window" class="btn btn-primary" data-toggle="modal">
                        <span class="glyphicon glyphicon-question-sign"></span>
                      </a>
                    </span>
                  </div>
                </div>

                <div class="col-xs-1 asterisk">
                  <label><font color="red" size="4%"><strong>*</strong></font></label>
                </div>
                
                <div class="col-xs-3">
                  <button type="button" class="btn btn-link">
                    <a href="http://www.whocc.no/atcvet/atcvet_index/" target="blank">ATCvet Index</a>
                  </button>
                </div>

                <div class="modal fade" id="therapeutic_window">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title"><strong>Therapeutic target</strong></h2>
                      </div>
                      <div class="modal-body">
                        <p>...</p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>             
                
              
              <div class="form-group">
                <label for="code" class="control-label col-xs-2">ATCvet Code<font color="red" size="4%">*</font></label>
                <div class="col-xs-3">
                  <div class="input-group">
                    <input title="an ATCvet code is required" type="text" class="form-control" id="new_code" type="text" placeholder="Code" required>
                    <span class="input-group-btn">
                      <a href="#code_window" class="btn btn-primary" data-toggle="modal">
                        <span class="glyphicon glyphicon-question-sign"></span>
                      </a>
                    </span>
                  </div>
                </div>

                <div class="modal fade" id="code_window">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title"><strong>ATCvet Code</strong></h2>
                      </div>
                      <div class="modal-body">
                        <p>...</p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

            </div>
          </div>
         <div class="row">
            <button type="button" class="btn btn-primary center-block" onclick="update_info('<?php echo $index;?>', '<?php echo $_GET['drug_name'];?>')">Save
                <span class="glyphicon glyphicon-floppy-save"></span>
            </button>
       </div>
      <div id="panelCode"></div>
  <?php }
    else {
  ?>
      <div class="panel panel-default">
            <div class="panel-body">

              <div class="form-group">
                <label for="drug" class="text-left col-xs-2 control-label">Drug (INN)<font color="red" size="4%">*</font></label>
                <div class="col-xs-10 col-md-5 col-xs-offset-1">
                  <input title="a drug name is required" type="text" class="form-control" id="entry_drug_name" type="text" placeholder="Drug name (INN)" required> 
                </div>
              </div>
        

              <div class="form-group">
                <label type="text-left" for="description" class="col-xs-2 control-label">Description</label>
                <div class="col-xs-10 col-md-9 col-xs-offset-1">
                  <textarea type="text" maxlength="140" class="form-control" rows="2" id="entry_description" placeholder="Brief description (maximum 140 characters)"></textarea>
                </div>
              </div>
    
              <div class="form-group">
                <label for="available" class="col-xs-3 control-label">Available as generic drug</label>
                <div class="radio col-xs-2 col-xs-offset-1">
                   <input type="radio" name="entry_description" id="Yes" value="Yes"><label for="yes">Yes</label>         
                </div>
                <div class="radio col-xs-2">
                  <input type="radio" name="entry_description" id="Nd" value="Nd"><label for="nd">Nd</label>
                </div>
              </div>

              <div class="license">
                <div class="form-group">              
                  <label for="license" class="license col-xs-3 control-label">Licensed for vet use</label>
                  <div class="col-xs-offset-1">
                    <div class="col-xs-3">
                      <img class="logo" src="./images/logo_ema.jpg" class="img-responsive" alt="">
                    </div>
                    <div class="col-xs-3">
                      <img class="fda" src="./images/logo_fda.jpg" class="img-responsive" alt="">
                    </div>
                    <div class="col-xs-3">
                      <img class="logo" src="./images/logo_aemps.jpg" class="img-responsive" alt="">
                    </div>  
                  </div>                     
                </div>

                <div class="form-group">
                  <div class="chk_ema checkbox col-xs-1 col-xs-offset-4">
                    <input type="checkbox" id="entry_chk_ema">
                  </div>
                  <div class="checkbox col-xs-1 col-xs-offset-2">
                    <input type="checkbox" id="entry_chk_fda">
                  </div>              
                  <div class="checkbox col-xs-1 col-xs-offset-2">
                    <input type="checkbox" id="entry_chk_aemps">
                  </div>
                </div>                 
              </div> 

            </div>
        </div>

        <div id="codeSet2">
          <div class="panel panel-default" id="nodeCode2">
            <div class="panel-body">

            <div class="col-xs-12">
                <a href="#delete_window" data-toggle="modal">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="remove">&times;</button>  
                </a>
              </div>

              <div class="form-group">                      
                <div class="col-xs-8 col-md-7 required-label">
                  <div class="input-group general">
                    <select id="entry_anatomic_group" class="form-control">
                      <option>Anatomic Target (1st level ATCvet)</option>
                      <option>QA Alimentary tract and metabolism</option>
                      <option>QB Blood and blood forming organs</option>
                      <option>QC Cardiovascular system</option>
                      <option>QD Dermatologicals</option>
                      <option>QG Genito urinary system and sex hormones</option>
                      <option>QH Systemic hormonal preparations, excl. sex hormones and insulins</option>
                      <option>QI Inmunologicals</option>
                      <option>QJ Antiinfectives for systemic use</option>
                      <option>QL Antineoplastic and immunomodulating agents</option>
                      <option>QM Musculo-skeletal system</option>
                      <option>QN Nervous system</option>
                      <option>QP Antiparasitic products, insecticides and repellents</option>
                      <option>QR Respiratory system</option>
                      <option>QS Sensory organs</option>
                      <option>QV Various</option>
                    </select>
                    <span class="input-group-btn">
                      <a href="#anatomic_window" class="btn btn-primary" data-toggle="modal">
                        <span class="glyphicon glyphicon-question-sign"></span>
                      </a>
                    </span>
                  </div>
                </div>

                <div class="col-xs-1 asterisk">
                  <label><font color="red" size="4%"><strong>*</strong></font></label>
                </div>
                

                <div class="modal fade" id="anatomic_window">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title"><strong>Anatomic target</strong></h2>
                      </div>
                      <div class="modal-body">
                        <p>...</p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <div class="form-group">
                <div class="col-xs-8 col-md-7 required-label">
                  <div class="input-group">
                    <input title="therapeutic target required" type="text" class="form-control" id="entry_therapeutic_group" type="text" placeholder="Therapeutic Target (2nd level ATCvet)" required>
                    <span class="input-group-btn">
                      <a href="#therapeutic_window" class="btn btn-primary" data-toggle="modal">
                        <span class="glyphicon glyphicon-question-sign"></span>
                      </a>
                    </span>
                  </div>
                </div>

                <div class="col-xs-1 asterisk">
                  <label><font color="red" size="4%"><strong>*</strong></font></label>
                </div>
                
                <div class="col-xs-3">
                  <button type="button" class="btn btn-link">
                    <a href="http://www.whocc.no/atcvet/atcvet_index/" target="blank">ATCvet Index</a>
                  </button>
                </div>

                <div class="modal fade" id="therapeutic_window">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title"><strong>Therapeutic target</strong></h2>
                      </div>
                      <div class="modal-body">
                        <p>...</p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>             
                
              
              <div class="form-group">
                <label for="code" class="control-label col-xs-2">ATCvet Code<font color="red" size="4%">*</font></label>
                <div class="col-xs-3">
                  <div class="input-group">
                    <input title="an ATCvet code is required" type="text" class="form-control" id="entry_code" type="text" placeholder="Code" required>
                    <span class="input-group-btn">
                      <a href="#code_window" class="btn btn-primary" data-toggle="modal">
                        <span class="glyphicon glyphicon-question-sign"></span>
                      </a>
                    </span>
                  </div>
                </div>

                <div class="modal fade" id="code_window">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title"><strong>ATCvet Code</strong></h2>
                      </div>
                      <div class="modal-body">
                        <p>...</p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
      <div class="row">
            <button type="button" class="btn btn-primary center-block" onclick="insert_code()" id="save">Save
              <span class="glyphicon glyphicon-floppy-save"></span>
            </button>
      </div>
  <?php
    }
  ?>
          
        </form>
      </div>
    </div>
    </div>
  </div>
</body>
</html>
