<!DOCTYPE html>

<?php
	require_once("../../php/funzioni_php.php");
	controlla_login_token('../../login/login.php');
?>


<html>
	<head>
		<title>archivio v1.0</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="../../stili_css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Nova+Square" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
		<script src="../../javascript/script.js"></script>
	</head>
	<body class="sfondo">

		<div class="pos-f-t" style="background:#efff00b3;">
			<div class="col-md-6 offset-md-3 col-sm-12">
				<div class="collapse" id="navbarToggleExternalContent" style="text-align:center;">
					<div class="p-4 spazio_utente">
						<div class="row">
							<img src="../../immagini/default_user.png" class="foto_utente" >
						</div>
						<div class="row">
							<h4 style="color:black; width:100%; text-align:center;"><?php echo $_SESSION['username'] ?></h4>
						</div>
						<!--<span class="text-muted">eventuale descrizione</span>-->
					</div>
				</div>
				<nav class="navbar navbar-dark navbar_personalizzata">
					<button class="navbar-toggler bottone_tendina" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation" onclick="ruota(document.getElementById('tendina'));">
						<img class="rotate" id="tendina" src="../../immagini/freccia_basso.png" style="width:30px;" >
					</button>
					<p class="grassetto" style="color:black;">Fascicoli</p>
				</nav>
			</div>
		</div>

		<div class="container-fluid corpo_centrale">

			<div class="col-md-6 offset-md-3 col-sm-12">
				<h2 class="title titolo titolo_selezionato">Tutti i fascicoli</h2>
			</div>

			<div class="card-header	col-md-6 offset-md-3 col-sm-12 form_opzione" id="background_form_ricerca">

					<div class="form-group col-md-8 offset-md-2">
						<label class="label_standard">Nome archivio</label>
						<form id="form_carica_archivi" action='../../php/carica_archivi.php' method='post'>
							<select class="form-control form-control-md input_standard" id="select_carica_archivio" name="_carica_archivio">
								<option>- seleziona archivio -</option>
								<?php
									$conn = connessione_db();
									opzioni_select_archivi($conn);
									chiudi_connessione_db($conn);
								?>
							</select>
						</form>
					</div>

				<div class="form-group col-md-8 offset-md-2 div_bottoni_forms">

					<div class="row" style="height: 35px;">
						<button class="btn btn-primary col-5  col-md-5 col-xl-4 bottone_submit_forms" onclick="document.getElementById('select_carica_archivio').selectedIndex=0; controllo_select_archivi('non controllare');">Carica tutti</button>
						<button type="button"class="btn btn-primary col-5 col-md-6 col-xl-4 offset-2 offset-xl-4 offset-md-1 bottone_submit_forms" onclick="controllo_select_archivi(document.getElementById('select_carica_archivio'));">Carica Archivio</button>
					</div>

				</div>
			</div>


			<div class="col-md-6 offset-md-3 col-sm-12">
				<h2 class="title titolo titolo_selezionato">Cerca</h2>
			</div>

	 		<div class="row">
				<div class="card-header	col-md-6 offset-md-3 col-sm-12 form_opzione" id="background_form_ricerca">
					<form id="la_form" action='../../php/funzioni_post.php' method='post'>

						<div class="form-group col-md-8 offset-md-2">
							<label class="label_standard" >Numero</label>
							<input class="form-control form-control-md input_standard" id="numero" name="_numero" type="text">
						</div>

						<div class="form-group col-md-8 offset-md-2">
							<label class="label_standard" >Anno</label>
							<input class="form-control form-control-md input_standard" id="anno" name="_anno" type="text">
						</div>

						<div class="form-group col-md-8 offset-md-2">
							<label class="label_standard">Modello/Tipo</label>
							<select class="form-control form-control-md input_standard" id="select_modello" name="_select_modello">
								<option>- seleziona modello -</option>
								<option>21/Unico</option>
								<option>44/Ignoti</option>
								<option>45/Atti relativi</option>
								<option>21 bis/Giudice di pace</option>
							</select>
						</div>

						<div class="form-group col-md-8 offset-md-2">
							<label class="label_standard">Nome archivio</label>
							<div class="col-sm-12" style="padding-right:0px">
								<label class="switch"><input type="checkbox" class="checkbox" name="checkboxes" id="abilita_disabilita_archivio" onchange="abilita_disabilita(document.getElementById('select_archivio'));"><span class="slider round"></span></label>
							</div>
							<select class="form-control form-control-md input_standard" id="select_archivio"  name="_select_archivio" disabled>
								<option>- seleziona archivio -</option>

								<?php
									$conn = connessione_db();
									opzioni_select_archivi($conn);
									chiudi_connessione_db($conn);
								?>


							</select>

						</div>

						<input type="hidden" name="_scelta" value="cerca">

					</form>

					<div class="form-group col-md-8 offset-md-2 div_bottoni_forms">

						<div class="row">
							<button type="button"class="btn btn-primary col-5 col-sm-4 bottone_indietro_forms" onclick="window.location.href='../../index.php'">Indietro</button>
							<button class="btn btn-primary col-5 col-sm-4 offset-2 offset-sm-4 bottone_submit_forms"
								onclick="

										if(document.getElementById('abilita_disabilita_archivio').checked)
										{
											controllo_inputs(document.getElementById('numero'),document.getElementById('anno'),document.getElementById('select_modello'),document.getElementById('select_archivio'));

											//problema checkbox non giusta quando si torna indietro

											document.getElementById('abilita_disabilita_archivio').checked=false;
										}
										else
										{
											controllo_inputs(document.getElementById('numero'),document.getElementById('anno'),document.getElementById('select_modello'), 'non controllare');
										}

								">Cerca</button>

						</div>

					</div>

	        	</div>

			</div>
		</div>

		<br/>

	</body>
</html>
