<!DOCTYPE html>
<html lang="es">
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	  <link rel="stylesheet" href="css/styleRegister.css">
	  <link rel="stylesheet" href="css/bootstrap.css">
	  <!-- Activamos el código Javascript de Bootstrap y de jQuery -->
	  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  <script src="js/bootstrap.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</head>

	<script>
	  function validate(){
	    var user=document.getElementById('username').value;
	    var pass=document.getElementById('password').value;
	    var conf_pass=document.getElementById('conf_password').value;
	    var email=document.getElementById('email').value;
	    var first_name=document.getElementById('first_name').value;
	    var last_name=document.getElementById('last_name').value;
	    var profession=document.getElementById('profession').value;
	    var country=document.getElementById('country').value;

	    $.ajax({
	      type: "POST",
	      url: "check_register.php",
	      data: {"username":user, "password":pass, "conf_pasword":conf_pass, "email":email, "first_name": first_name, "last_name": last_name, "prof": profession, "country": country},
	      success: function(sol){   
	      //alert(sol);  
	      	$("#message_error").html(sol);	 
	      	if(sol=="")
	      		$("#message_register").modal("show");
	      }
	    });
	  }

	  function insert_user_db(){
	    var user=document.getElementById('username').value;
	    var pass=document.getElementById('password').value;
	    var conf_pass=document.getElementById('conf_password').value;
	    var email=document.getElementById('email').value;
	    var first_name=document.getElementById('first_name').value;
	    var last_name=document.getElementById('last_name').value;
	    var profession=document.getElementById('profession').value;
	    var country=document.getElementById('country').value;

	    $.ajax({
	      type: "POST",
	      url: "insert_user_db.php",
	      data: {"username":user, "password":pass, "conf_pasword":conf_pass, "email":email, "first_name": first_name, "last_name": last_name, "prof": profession, "country": country},
	      success: function(sol){   
	      //alert(sol);  
	      	// $("#message_error").html(sol);	 
	      	// if(sol=="")
	      	// 	$("#message_register").modal("show");
	      }
	    });
	  }
	
	</script>
	<body>
	
	
		<div class="container">
			<div class="row">
			<div class="col-md-7 col-md-offset-3">
			<h1> Marine Mammals Formulary</h1>
			</div>
			</div>  
			<div class="row">
				<div class="col-xs-8 col-xs-offset-2 col-md-7 col-md-offset-3" > 
					<div class="form form-horizontal">
						<div class="form-group">
							<label class="col-xs-3 col-md-2 col-md-offset-2">First name</label>	
							<div class="col-md-6 col-xs-9 input-group">
								<input id="first_name" type="text" class="form-control">
							</div>
						</div>	
						<div class="form-group">
							<label class="col-xs-3 col-md-2 col-md-offset-2">Last name</label>	
							<div class="col-md-6 col-xs-9 input-group">
								<input id="last_name" type="text" class="form-control">
							</div>
						</div>	

						<div class="form-group">
							<label class="col-xs-3 col-md-2 col-md-offset-2">Profession</label>	
							
								<div class=" col-md-6 col-xs-9 input-group">
								<!-- <div class=" col-md-6 col-xs-9"> -->
	  								<select id="profession" class="form-control">
	    								<option>Veterinarian (private practice)</option>
	    								<option>Academia (veterinary, biomed or anim. sci.)</option>
	    								<option>Student - Veterinary Medicine</option>
	    								<option>Veterinarian (retired)</option>
	    								<option>Veterinary Technician, Nurse or Assistant</option>
	    								<option>Student - Veterinary Technician or Nurse</option>
	    								<option>Animal Health Industry (vet. service, biomed, research)</option>
	    								<option>Animal Health Industry (admin., commercial services)</option>
	    								<option>Government</option>
	    								<option>Veterinary Institution (admin., services)</option>
	    								<option>Librarian (veterinary or biomedical)</option>
	    								<option>Pharmacist</option>
	  								</select>
	  							</div>
							
						</div>	

						<div class="form-group">
							<label class="col-xs-3 col-md-2 col-md-offset-2">Country</label>
							<div class="col-md-6 col-xs-9 input-group">	
								<select id="country" class="form-control">
									<option value="AF">Afganistán</option>
									<option value="AL">Albania</option>
									<option value="DE">Alemania</option>
									<option value="AD">Andorra</option>
									<option value="AO">Angola</option>
									<option value="AI">Anguila</option>
									<option value="AG">Antigua y Barbuda</option>
									<option value="AN">Antillas Neerlandesas</option>
									<option value="AQ">Antártida</option>
									<option value="SA">Arabia Saudí</option>
									<option value="DZ">Argelia</option>
									<option value="AR">Argentina</option>
									<option value="AM">Armenia</option>
									<option value="AW">Aruba</option>
									<option value="AU">Australia</option>
									<option value="AT">Austria</option>
									<option value="AZ">Azerbaiyán</option>
									<option value="BS">Bahamas</option>
									<option value="BH">Bahréin</option>
									<option value="BD">Bangladesh</option>
									<option value="BB">Barbados</option>
									<option value="BZ">Belice</option>
									<option value="BJ">Benín</option>
									<option value="BM">Bermudas</option>
									<option value="BY">Bielorrusia</option>
									<option value="BO">Bolivia</option>
									<option value="BA">Bosnia-Herzegovina</option>
									<option value="BW">Botsuana</option>
									<option value="BR">Brasil</option>
									<option value="BN">Brunéi</option>
									<option value="BG">Bulgaria</option>
									<option value="BF">Burkina Faso</option>
									<option value="BI">Burundi</option>
									<option value="BT">Bután</option>
									<option value="BE">Bélgica</option>
									<option value="CV">Cabo Verde</option>
									<option value="KH">Camboya</option>
									<option value="CM">Camerún</option>
									<option value="CA">Canadá</option>
									<option value="TD">Chad</option>
									<option value="CL">Chile</option>
									<option value="CN">China</option>
									<option value="CY">Chipre</option>
									<option value="VA">Ciudad del Vaticano</option>
									<option value="CO">Colombia</option>
									<option value="KM">Comoras</option>
									<option value="CG">Congo</option>
									<option value="KP">Corea del Norte</option>
									<option value="KR">Corea del Sur</option>
									<option value="CR">Costa Rica</option>
									<option value="CI">Costa de Marfil</option>
									<option value="HR">Croacia</option>
									<option value="CU">Cuba</option>
									<option value="DK">Dinamarca</option>
									<option value="DM">Dominica</option>
									<option value="EC">Ecuador</option>
									<option value="EG">Egipto</option>
									<option value="SV">El Salvador</option>
									<option value="AE">Emiratos Árabes Unidos</option>
									<option value="ER">Eritrea</option>
									<option value="SK">Eslovaquia</option>
									<option value="SI">Eslovenia</option>
									<option>España</option>
									<option value="US">Estados Unidos</option>
									<option value="EE">Estonia</option>
									<option value="ET">Etiopía</option>
									<option value="PH">Filipinas</option>
									<option value="FI">Finlandia</option>
									<option value="FJ">Fiyi</option>
									<option value="FR">Francia</option>
									<option value="GA">Gabón</option>
									<option value="GM">Gambia</option>
									<option value="GE">Georgia</option>
									<option value="GH">Ghana</option>
									<option value="GI">Gibraltar</option>
									<option value="GD">Granada</option>
									<option value="GR">Grecia</option>
									<option value="GL">Groenlandia</option>
									<option value="GP">Guadalupe</option>
									<option value="GU">Guam</option>
									<option value="GT">Guatemala</option>
									<option value="GF">Guayana Francesa</option>
									<option value="GG">Guernsey</option>
									<option value="GN">Guinea</option>
									<option value="GQ">Guinea Ecuatorial</option>
									<option value="GW">Guinea-Bissau</option>
									<option value="GY">Guyana</option>
									<option value="HT">Haití</option>
									<option value="HN">Honduras</option>
									<option value="HU">Hungría</option>
									<option value="IN">India</option>
									<option value="ID">Indonesia</option>
									<option value="IQ">Iraq</option>
									<option value="IE">Irlanda</option>
									<option value="IR">Irán</option>
									<option value="BV">Isla Bouvet</option>
									<option value="CX">Isla Christmas</option>
									<option value="NU">Isla Niue</option>
									<option value="NF">Isla Norfolk</option>
									<option value="IM">Isla de Man</option>
									<option value="IS">Islandia</option>
									<option value="KY">Islas Caimán</option>
									<option value="CC">Islas Cocos</option>
									<option value="CK">Islas Cook</option>
									<option value="FO">Islas Feroe</option>
									<option value="GS">Islas Georgia del Sur y Sandwich del Sur</option>
									<option value="HM">Islas Heard y McDonald</option>
									<option value="FK">Islas Malvinas</option>
									<option value="MP">Islas Marianas del Norte</option>
									<option value="MH">Islas Marshall</option>
									<option value="SB">Islas Salomón</option>
									<option value="TC">Islas Turcas y Caicos</option>
									<option value="VG">Islas Vírgenes Británicas</option>
									<option value="VI">Islas Vírgenes de los Estados Unidos</option>
									<option value="AX">Islas Åland</option>
									<option value="IL">Israel</option>
									<option value="IT">Italia</option>
									<option value="JM">Jamaica</option>
									<option value="JP">Japón</option>
									<option value="JE">Jersey</option>
									<option value="JO">Jordania</option>
									<option value="KZ">Kazajistán</option>
									<option value="KE">Kenia</option>
									<option value="KG">Kirguistán</option>
									<option value="KI">Kiribati</option>
									<option value="KW">Kuwait</option>
									<option value="LA">Laos</option>
									<option value="LS">Lesoto</option>
									<option value="LV">Letonia</option>
									<option value="LR">Liberia</option>
									<option value="LY">Libia</option>
									<option value="LI">Liechtenstein</option>
									<option value="LT">Lituania</option>
									<option value="LU">Luxemburgo</option>
									<option value="LB">Líbano</option>
									<option value="MK">Macedonia</option>
									<option value="MG">Madagascar</option>
									<option value="MY">Malasia</option>
									<option value="MW">Malaui</option>
									<option value="MV">Maldivas</option>
									<option value="ML">Mali</option>
									<option value="MT">Malta</option>
									<option value="MA">Marruecos</option>
									<option value="MQ">Martinica</option>
									<option value="MU">Mauricio</option>
									<option value="MR">Mauritania</option>
									<option value="YT">Mayotte</option>
									<option value="FM">Micronesia</option>
									<option value="MD">Moldavia</option>
									<option value="MN">Mongolia</option>
									<option value="ME">Montenegro</option>
									<option value="MS">Montserrat</option>
									<option value="MZ">Mozambique</option>
									<option value="MM">Myanmar</option>
									<option value="MX">México</option>
									<option value="MC">Mónaco</option>
									<option value="NA">Namibia</option>
									<option value="NR">Nauru</option>
									<option value="NP">Nepal</option>
									<option value="NI">Nicaragua</option>
									<option value="NG">Nigeria</option>
									<option value="NO">Noruega</option>
									<option value="NC">Nueva Caledonia</option>
									<option value="NZ">Nueva Zelanda</option>
									<option value="NE">Níger</option>
									<option value="OM">Omán</option>
									<option value="PK">Pakistán</option>
									<option value="PW">Palau</option>
									<option value="PS">Palestina</option>
									<option value="PA">Panamá</option>
									<option value="PG">Papúa Nueva Guinea</option>
									<option value="PY">Paraguay</option>
									<option value="NL">Países Bajos</option>
									<option value="PE">Perú</option>
									<option value="PN">Pitcairn</option>
									<option value="PF">Polinesia Francesa</option>
									<option value="PL">Polonia</option>
									<option value="PT">Portugal</option>
									<option value="PR">Puerto Rico</option>
									<option value="QA">Qatar</option>
									<option value="CF">República Centroafricana</option>
									<option value="CZ">República Checa</option>
									<option value="CD">República Democrática del Congo</option>
									<option value="DO">República Dominicana</option>
									<option value="RE">Reunión</option>
									<option value="RW">Ruanda</option>
									<option value="RO">Rumanía</option>
									<option value="RU">Rusia</option>
									<option value="WS">Samoa</option>
									<option value="AS">Samoa Americana</option>
									<option value="BL">San Bartolomé</option>
									<option value="KN">San Cristóbal y Nieves</option>
									<option value="SM">San Marino</option>
									<option value="MF">San Martín</option>
									<option value="PM">San Pedro y Miquelón</option>
									<option value="VC">San Vicente y las Granadinas</option>
									<option value="SH">Santa Elena</option>
									<option value="LC">Santa Lucía</option>
									<option value="ST">Santo Tomé y Príncipe</option>
									<option value="SN">Senegal</option>
									<option value="RS">Serbia</option>
									<option value="CS">Serbia y Montenegro</option>
									<option value="SC">Seychelles</option>
									<option value="SL">Sierra Leona</option>
									<option value="SG">Singapur</option>
									<option value="SY">Siria</option>
									<option value="SO">Somalia</option>
									<option value="LK">Sri Lanka</option>
									<option value="SZ">Suazilandia</option>
									<option value="ZA">Sudáfrica</option>
									<option value="SD">Sudán</option>
									<option value="SE">Suecia</option>
									<option value="CH">Suiza</option>
									<option value="SR">Surinam</option>
									<option value="SJ">Svalbard y Jan Mayen</option>
									<option value="EH">Sáhara Occidental</option>
									<option value="TH">Tailandia</option>
									<option value="TW">Taiwán</option>
									<option value="TZ">Tanzania</option>
									<option value="TJ">Tayikistán</option>
									<option value="IO">Territorio Británico del Océano Índico</option>
									<option value="TF">Territorios Australes Franceses</option>
									<option value="TL">Timor Oriental</option>
									<option value="TG">Togo</option>
									<option value="TK">Tokelau</option>
									<option value="TO">Tonga</option>
									<option value="TT">Trinidad y Tobago</option>
									<option value="TM">Turkmenistán</option>
									<option value="TR">Turquía</option>
									<option value="TV">Tuvalu</option>
									<option value="TN">Túnez</option>
									<option value="UA">Ucrania</option>
									<option value="UG">Uganda</option>
									<option value="UY">Uruguay</option>
									<option value="UZ">Uzbekistán</option>
									<option value="VU">Vanuatu</option>
									<option value="VE">Venezuela</option>
									<option value="VN">Vietnam</option>
									<option value="WF">Wallis y Futuna</option>
									<option value="YE">Yemen</option>
									<option value="DJ">Yibuti</option>
									<option value="ZM">Zambia</option>
									<option value="ZW">Zimbabue</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 col-md-2 col-md-offset-2">User name</label>	
							<div class="col-md-6 col-xs-9 input-group">
								<input id="username" type="text" class="form-control">
							</div>
						</div>	
						<div class="form-group">
							<label class="col-xs-3 col-md-2 col-md-offset-2">Email</label>	
							<div class="col-md-6 col-xs-9 input-group">
								<input id="email" type="email" class="form-control">
							</div>
						</div>	
						<div class="form-group">
							<label class="col-xs-3 col-md-2 col-md-offset-2">Password</label>
							<div class="col-md-6 col-xs-9 input-group">	
								<input id="password" type="password" class="form-control">
							</div>
						</div>	
						<div class="form-group">
							<label class="col-xs-3 col-md-3 col-md-offset-1">Confirm password</label>
							<div class="col-md-6 col-xs-9 input-group">
								<input id="conf_password"type="password" class="form-control">
							</div>
						</div>	
						<!-- <a href="#message_register" data-toggle="modal"> -->
						<a>
							<button onclick ="javascript:validate()" type="submit" class="btn btn-primary col-xs-3 col-xs-offset-9 col-md-3 col-md-offset-9">Register</button>
							<!-- <button class="btn btn-primary col-xs-3 col-xs-offset-9 col-md-3 col-md-offset-9" >Register</button> -->
						</a>					
					</div>	
				</div>
			</div>
			<div class="modal fade" id="message_register">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title" align="center"><strong> Marine Mammals Formulary</strong></h2>
                      </div>
                      <div class="modal-body">
                        <p>You request has been sent. You will soon receive a confirmation email </p>
                      </div>
					 <div class="modal-footer">
        				<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="javascript:insert_user_db()" >OK</button>
        				
        			</div>
        

                    </div>
                  </div>
            </div>
            <div id="message_error"></div>
		</div>
		<!-- <footer>		
		</footer>		 -->
	</body>
</html>
