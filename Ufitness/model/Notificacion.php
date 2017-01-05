<?php

class Notificacion
{
	public $id;
	public $emisor;
	public $titulo;
	public $descripcion;

	function __construct($titulo,$descripcion,$emisor,$id=NULL){
		$this ->id = $id;
		$this ->emisor = $emisor;
		$this ->titulo = $titulo;
		$this ->descripcion = $descripcion;
	}


	public function getId (){
		return $this ->id;
	}

	public function getEmisor (){
		return $this ->emisor;
	}

	public function getTitulo (){
		return $this ->titulo;
	}

	public function getDescripcion(){
		return $this ->descripcion;
	}

}

?>
