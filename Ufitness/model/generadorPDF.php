<?php
require_once("../resources/pdf/fpdf.php");
require_once("../model/EntrenamientoMapper.php");
require_once("../model/EjercicioMapper.php");
require_once("../controller/controlador_Entrenamiento.php");

class generadorPDF extends FPDF {
	
	public function extractPDF(Entrenamiento $datosEntrenamiento,Ejercicio $datosEjercicios, $listaEjercicios){
		$entcontroller = new controlador_Entrenamiento();
		$pdf=new FPDF();
		$pdf->AddPage();
		$pdf->Image('../view/img/logo.png', 80 ,22, 50 , 38,'PNG');
		$pdf->ln(75);
		$pdf->SetFont('Helvetica','BU',32);
		$pdf->Cell(0,10,"Entrenamiento: ".$datosEntrenamiento->getNombre(),0,1,'L'); 
		$pdf->ln(5);
		$pdf->SetFont('Arial','',16);
		$pdf->Cell(0,10,"Duracion: ".$datosEntrenamiento->getDuracion(),0,1,'L'); 
		$pdf->Cell(0,10,"Nivel: ".$datosEntrenamiento->getNivel(),0,1,'L');
		$pdf->ln(8);
		
		for($i = 0; $i < count($listaEjercicios) ; $i++ ){
			$ejercicio = $entcontroller->getEjercicioFromEntrenamiento($datosEntrenamiento->getId(),$listaEjercicios[$i]->getIdEjercicio());
			$pdf->SetFont('Helvetica','BU',24);
			$pdf->Cell(0,10,"Ejercicio: ".$ejercicio->getNombre(),0,1,'L');
			$pdf->ln(5);
			$pdf->SetFont('Arial','',16);
			$pdf->MultiCell(175,10,"Descripcion: ".$ejercicio->getDescripcion(),0,'L',0);
			$pdf->Cell(0,10,"Maquina: ".$ejercicio->getMaquina(),0,1,'L');
			$pdf->Cell(0,10,"Tipo: ".$ejercicio->getTipoEjercicio(),0,1,'L');
			$pdf->Cell(0,10,"GrupoMuscular: ".$ejercicio->getGrupoMuscular(),0,1,'L');
			$pdf->Cell(0,10,"SeriesXRepeticion: ".$listaEjercicios[$i]->getSxR(),0,1,'L');
			$pdf->Cell(0,10,"Carga: ".$listaEjercicios[$i]->getCarga(),0,1,'L');
			//$pdf->Image('../../imagenesSubidas/'.$ejercicio->getImagen(), 80 ,22, 50 , 38,'PNG');
			$pdf->ln(5);
			
		}
		
		$pdf->Output("","Entrenamiento","");
	}

}


?>
