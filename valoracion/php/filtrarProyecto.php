<?php 
	
	extract($_REQUEST);

	include 'conexion.php';

	if ($filtro==0){

		$sql_proyectos = "SELECT * FROM tbl_proyecto LEFT JOIN tbl_profesor ON tbl_profesor.profesor_id = tbl_proyecto.proyecto_tutor  LEFT JOIN tbl_proyectoprofesor ON tbl_proyectoprofesor.pp_proyectoid = tbl_proyecto.proyecto_id WHERE pp_id !='$id' ORDER BY proyecto_fecha ASC";
		$proyectos = mysqli_query($conexion, $sql_proyectos);

		$sql_proyectostribunal = "SELECT * FROM tbl_proyecto LEFT JOIN tbl_profesor ON tbl_profesor.profesor_id = tbl_proyecto.proyecto_tutor  LEFT JOIN tbl_proyectoprofesor ON tbl_proyectoprofesor.pp_proyectoid = tbl_proyecto.proyecto_id WHERE pp_id='$id' ORDER BY proyecto_fecha ASC";
		$proyectostribunal = mysqli_query($conexion, $sql_proyectostribunal);

	}else{

		$next = $filtro+1;

		$sql_proyectos = "SELECT * FROM tbl_proyecto LEFT JOIN tbl_profesor ON tbl_profesor.profesor_id = tbl_proyecto.proyecto_tutor  LEFT JOIN tbl_proyectoprofesor ON tbl_proyectoprofesor.pp_proyectoid = tbl_proyecto.proyecto_id WHERE pp_id !='$id' AND YEAR(proyecto_fecha)>=$filtro AND YEAR(proyecto_fecha)<$next ORDER BY proyecto_nombre ASC";
		$proyectos = mysqli_query($conexion, $sql_proyectos);

		$sql_proyectostribunal = "SELECT * FROM tbl_proyecto LEFT JOIN tbl_profesor ON tbl_profesor.profesor_id = tbl_proyecto.proyecto_tutor  LEFT JOIN tbl_proyectoprofesor ON tbl_proyectoprofesor.pp_proyectoid = tbl_proyecto.proyecto_id WHERE pp_id='$id' AND YEAR(proyecto_fecha)>=$filtro AND YEAR(proyecto_fecha)<$next ORDER BY proyecto_nombre ASC";
		$proyectostribunal = mysqli_query($conexion, $sql_proyectostribunal);

	}

?>
<h3>Projectes a valorar</h3>
<?php

	if (mysqli_num_rows($proyectostribunal)>0){
		while ($proyecto = mysqli_fetch_array($proyectostribunal)) {
			$sql_alumnos = "SELECT * FROM tbl_proyecto INNER JOIN tbl_alumno ON tbl_alumno.alumno_proyectoid = tbl_proyecto.proyecto_id WHERE alumno_proyectoid = '$proyecto[proyecto_id]'";
			$alumnos = mysqli_query($conexion, $sql_alumnos);

			$sql_profesores = "SELECT * FROM tbl_proyecto INNER JOIN tbl_proyectoprofesor ON tbl_proyectoprofesor.pp_proyectoid = tbl_proyecto.proyecto_id INNER JOIN tbl_tribunal ON tbl_tribunal.tribunal_ppid = tbl_proyectoprofesor.pp_id INNER JOIN tbl_profesor ON tbl_profesor.profesor_id = tbl_tribunal.tribunal_profesorid WHERE pp_proyectoid = '$proyecto[proyecto_id]'";
			$profesores = mysqli_query($conexion, $sql_profesores);

			echo "<div class='profesor_proyecto'>";
				echo "<div class='proyecto_nombre'>";
					echo "<h3><b>Projecte:</b> $proyecto[proyecto_nombre]</h3>";
				echo "</div>";
				echo "<div class='project'>";
					echo "<div class='profesor_imagen'>";
						echo "<img src='$proyecto[proyecto_imagen]'/>";
					echo "</div>";
					echo "<div class='proyecto_info'>";
						echo "<b>Membres:</b> ";
						while ($alumno = mysqli_fetch_array($alumnos)) {
							echo "$alumno[alumno_nombre] $alumno[alumno_apellido], ";
						}
							echo "<br/>";
						echo "<b>Tutor:</b> $proyecto[profesor_nombre] $proyecto[profesor_apellido]";
							echo "<br/>";
						echo "<b>Tribunal:</b> ";
						while ($profesor = mysqli_fetch_array($profesores)) {
							echo "$profesor[profesor_nombre] $profesor[profesor_apellido], ";
							$pp_id = $profesor['pp_id'];
						}
							echo "<br/>";
						echo "<b>Dia i hora:</b> $proyecto[proyecto_fecha]";
							echo "<br/>";
						echo "<b>Estat del projecte:</b> ";
							if ($proyecto['proyecto_estado']=='empezar'){
								echo "Per començar";
							} else if ($proyecto['proyecto_estado']=='encurso'){
								echo "En curs";
							} else {
								echo "Finalitzat";
							}
						echo "<div class='valorar'>";
							if ($pp_id == $id){
								echo "<a style='color:green;' href='#'>Valorar</a>";
							} else {
								echo "<span style='color:red'>No pots valorar aquest projecte</span>";
							}
							echo "</div>";

					echo "</div>";

				echo "</div>";

			echo "</div>";

		}


	} else {
		echo "No hi ha cap projecte";
	}

?>
<h3>Altres projectes:</h3>
<?php 

	if (mysqli_num_rows($proyectos)>0){
		while ($proyecto = mysqli_fetch_array($proyectos)) {
			$sql_alumnos = "SELECT * FROM tbl_proyecto INNER JOIN tbl_alumno ON tbl_alumno.alumno_proyectoid = tbl_proyecto.proyecto_id WHERE alumno_proyectoid = '$proyecto[proyecto_id]'";
			$alumnos = mysqli_query($conexion, $sql_alumnos);

			$sql_profesores = "SELECT * FROM tbl_proyecto INNER JOIN tbl_proyectoprofesor ON tbl_proyectoprofesor.pp_proyectoid = tbl_proyecto.proyecto_id INNER JOIN tbl_tribunal ON tbl_tribunal.tribunal_ppid = tbl_proyectoprofesor.pp_id INNER JOIN tbl_profesor ON tbl_profesor.profesor_id = tbl_tribunal.tribunal_profesorid WHERE pp_proyectoid = '$proyecto[proyecto_id]'";
			$profesores = mysqli_query($conexion, $sql_profesores);

			echo "<div class='profesor_proyecto'>";
				echo "<div class='proyecto_nombre'>";
					echo "<h3><b>Projecte:</b> $proyecto[proyecto_nombre]</h3>";
				echo "</div>";
				echo "<div class='project'>";
					echo "<div class='profesor_imagen'>";
						echo "<img src='$proyecto[proyecto_imagen]'/>";
					echo "</div>";
					echo "<div class='proyecto_info'>";
						echo "<b>Membres:</b> ";
						while ($alumno = mysqli_fetch_array($alumnos)) {
							echo "$alumno[alumno_nombre] $alumno[alumno_apellido], ";
						}
							echo "<br/>";
						echo "<b>Tutor:</b> $proyecto[profesor_nombre] $proyecto[profesor_apellido]";
							echo "<br/>";
						echo "<b>Tribunal:</b> ";
						while ($profesor = mysqli_fetch_array($profesores)) {
							echo "$profesor[profesor_nombre] $profesor[profesor_apellido], ";
							$pp_id = $profesor['pp_id'];
						}
							echo "<br/>";
						echo "<b>Dia i hora:</b> $proyecto[proyecto_fecha]";
							echo "<br/>";
						echo "<b>Estat del projecte:</b> ";
							if ($proyecto['proyecto_estado']=='empezar'){
								echo "Per començar";
							} else if ($proyecto['proyecto_estado']=='encurso'){
								echo "En curs";
							} else {
								echo "Finalitzat";
							}
						echo "<div class='valorar'>";
							if ($pp_id == $id){
								echo "<a style='color:green;' href='#'>Valorar</a>";
							} else {
								echo "<span style='color:red'>No pots valorar aquest projecte</span>";
							}
							echo "</div>";

					echo "</div>";

				echo "</div>";

			echo "</div>";

		}


	} else {
		echo "No hi ha cap projecte";
	}