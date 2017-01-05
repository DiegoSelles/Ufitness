<?php

class NotificacionHasDeportista{

	public $idNotificacion;
	public $receptor;
	public $visto;

	function __construct($idNotificacion, $receptor, $visto=NULL){
		$this ->idNotificacion = $idNotificacion;
		$this ->receptor = $receptor;
		$this ->visto = $visto;
	}


	public function getId (){
		return $this ->idNotificacion;
	}

	public function getReceptor (){
		return $this ->receptor;
	}

	public function getVisto (){
		return $this ->visto;
	}

}

?>
