<!DOCTYPE html>
<html lang="es">
<head>
    <title>Notifications</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="./css/bootstrap.css"/>
    <link rel="stylesheet" href="./css/styleforMMularyMain.css"/>
    <link rel="stylesheet" href="./css/toggle-switch.css"/>
    <link rel="stylesheet" href="./css/styleNotifications.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.carousel').carousel( {
          interval: 20000
        });
        
      });
    </script>
    <script>
        function show_requests_new_users(){
        $.ajax({
              //type: "POST",
              url: "show_requests_new_users.php",
              //data: {},
              success: function(sol){
				  //alert(sol);
                jQuery('#users_table_div').html(sol);
              }
          });
        //alert("hola");
      }

	function accept_request(user){  
        /*var tmp;
        var user_id;
        var user_name;
        var ischecked;*/
		$.ajax({
                type: "POST",
                url: "send_email.php",
                data: {"nick":user, "accept":1},
                success: function(sol){
                  alert(sol);
                  //jQuery('#users_table_div').html(sol);
                }
              });   
    }
	
	function reject_request(user){  
        /*var tmp;
        var user_id;
        var user_name;
        var ischecked;*/
		$.ajax({
                type: "POST",
                url: "send_email.php",
                data: {"nick":user, "accept":0},
                success: function(sol){
                  alert(sol);
                  //jQuery('#users_table_div').html(sol);
                }
              });  
		$.ajax({
                type: "POST",
                url: "delete_user.php",
                data: {"nick":user},
                success: function(sol){
					location.reload(true)
                  //alert(sol);
                  //jQuery('#users_table_div').html(sol);
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
            //alert(sol);
            jQuery('#users_table_div').html("");
            jQuery('#drug_table_div').html(sol);

          }
      });
  }
      </script>
</head>
<body onload="show_requests_new_users()">
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

            <li>
              <!--<a href="./notifications.php">
                <span class="glyphicon glyphicon-flag"></span>
                Notifications
              </a>-->
              <div class="dropdown"> <button class="dropbtn "><span class="glyphicon glyphicon-flag"></span>Notifications</button>  <div class="dropdown-content">    <a href="./notifications.php">Registration Requests</a>    <a href="#">Files pending review</a> </div></div>

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
      </div>
      <!-- <div class="switch-toggle well">
  <input id="week" name="view" type="radio" checked>
  <label for="week" onclick="">Week</label>

  <input id="month" name="view" type="radio">
  <label for="month" onclick="">Month</label>

  <a class="btn btn-primary"></a>
</div> -->

<div class ="table-users" id="users_table_div">
      <!-- <table id="users_table_div" class="table table-hover"> -->

      <!-- </table> -->
  </div>
  <div class ="table_drugs" id="drug_table_div">
  </div>
  
  </div>
</body>

</html>