<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyecto extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('america/Bogota');
	}

	public function index()
	{
		
	}

	public function gestion($value='')
	{
		$vw = $this->load->view('proyecto/gestion',NULL, TRUE);
		$this->load->view("inicio/principal", array('html'=>$vw));
	}

	public function get($idproyecto=NULL)
	{
		$ret = new stdClass();
		$this->load->model(array('proyecto_db'=>'pr', 'version_db'=>'ver'));
		$rows = $this->pr->get($idproyecto);
		$ret->proyectos = $rows->result();
		if(isset($idproyecto) && $rows->num_rows() == 1){
			$ret->proyecto = $rows->row();
			$ret->proyecto->versiones = $this->ver->getBy( array( 'proyecto_idproyecto'=>$idproyecto ) )->result();
		}
		$ret->status = TRUE;
		echo json_encode($ret);
	}

	public function save()
	{
		$pr = json_decode( file_get_contents('php://input'));
		$ret = new stdClass();
		$this->load->model('proyecto_db', 'pr');
		if(isset($pr->idproyecto)){
			$ret->status = $this->mod($pr, $pr->idproyecto);
		}else{
			$rows = $this->pr->getBy(array('nombre_proyecto'=>$pr->nombre_proyecto));
			if($rows->num_rows() <= 0 ){
				$pr->idproyecto = $this->add($pr);
				$ret->proyecto = $pr;
				$ret->status = TRUE;
			}else{
				$ret->proyecto = $pr;
				$ret->status = FALSE;
				$ret->msj = 'Nombre de proyecto ya existente';
			}
		}
		echo json_encode($ret);
	}

	public function add($pr)
	{
		return $this->pr->add($pr);
	}

	public function mod($pr)
	{
		return $this->pr->mod($pr, $pr->idproyecto);
	}

	public function remove($id)
	{
		$this->load->model('proyecto_db', 'pr');
		$ret = new stdClass();
		try {
			$this->pr->start();
			$this->pr->remove($id);
			$ret->status = $this->pr->end();
			if($ret->status){
				$ret->msj = 'Borrado exitoso.';
			}else{
				$ret->msj = 'No se ha podido borrar el proyecto.';
			}
			echo json_encode($ret);
		} catch (Exception $e) {
			$ret->status = FALSE;
			$ret->msj = 'Fallo: '.$e->getMessege();
			echo json_encode($ret);
		}
	}

}

/* End of file Proyecto.php */
/* Location: ./application/controllers/Proyecto.php */