<?php
require('conexion.php');
session_start();

if(isset($_SESSION['admin'])){
	//echo "Bienvenidos Tribunal  ";
	echo "<a href='cerrar_sesion.proc.php'><i class='fa fa-sign-out fa-2x' aria-hidden='true' title='Logout'></i></a><br/>";
} else {
	header("Location: ../index.html");
}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Class voting</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/main.css" />
		<script src="http://code.jquery.com/jquery.js"></script>
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<!-- Wrapper -->
			<div id="wrapper">
		<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="#intro" class="active">Crear projecte</a></li>
							<li><a href="#first">Modificació de la valoració</a></li>
							<li><a href="#second">Valorar</a></li>
							<li><a href="#cta">Estadístiques</a></li>
						</ul>
					</nav>

					<nav id="nav">
						Valoración del Público
						<table>
						  <tr>
						    <td>Presentación Oral</td>
						  </tr>
						  <tr>
						  	<td>Contenido</td>
						  </tr>
						  <tr>
						    <td></td>
						    <td>Maria Anders</td>
						    <td>Germany</td>
						  </tr>
						  <tr>
						    <td></td>
						    <td>Francisco Chang</td>
						    <td>Mexico</td>
						  </tr>
						  <tr>
						    <td></td>
						    <td>Roland Mendel</td>
						    <td>Austria</td>
						  </tr>
						  <tr>
						    <td></td>
						    <td>Helen Bennett</td>
						    <td>UK</td>
						  </tr>
						  <tr>
						    <td></td>
						    <td>Yoshi Tannamuri</td>
						    <td>Canada</td>
						  </tr>
						  <tr>
						    <td></td>
						    <td>Giovanni Rovelli</td>
						    <td>Italy</td>
						  </tr>
						</table>
					</nav>
			</div>

		<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy;Jesuitas Joan XXIII 2017</a></p>
					</footer>

			

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
		<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
	</body>
</html>