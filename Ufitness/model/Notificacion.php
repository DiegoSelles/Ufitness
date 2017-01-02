<?php

class Notificacion
{
	public $id;
	public $emisor;
	public $receptor;
	public $titulo;
	public $descripcion;
	public $visto;

	function __construct($titulo,$descripcion,$emisor,$receptor,$visto=NULL,$id=NULL){
		$this ->id = $id;
		$this ->emisor = $emisor;
		$this ->receptor = $receptor;
		$this ->titulo = $titulo;
		$this ->descripcion = $descripcion;
		$this ->visto = $visto;
	}


	public function getId (){
		return $this ->id;
	}

	public function getEmisor (){
		return $this ->emisor;
	}

	public function getReceptor (){
		return $this ->receptor;
	}

	public function getTitulo (){
		return $this ->titulo;
	}

	public function getDescripcion(){
		return $this ->descripcion;
	}

	public function getVisto (){
		return $this ->visto;
	}

}

?>
