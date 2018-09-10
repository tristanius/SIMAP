<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Equipo extends CI_Controller {

	private $import_path = '/uploads/imports/equipo/';
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('america/Bogota');
	}

	public function index()
	{
		
	}

	public function listado_equipos($idproyecto = NULL)
	{
		$this->load->model('equipo_db', 'eq');
		$ret =  new stdClass();
		$ret->listado = $this->eq->listado_items($idproyecto)->result();
		$ret->status = TRUE;
		echo json_encode($ret);
	}

	public function remove($idequipo)
	{
		$this->load->model('equipo_db', 'eq');
		$ret =  new stdClass();
		$this->eq->start();
		$this->eq->remove( array('idequipo'=>$idequipo) );
		$this->eq->end();
		$ret->status = TRUE;
		echo json_encode($ret);
	}

	# ===================================================================================================
	# Proceso de importar cargos de personal
	public function importar()
	{
		$vw = $this->load->view('equipo/importar',NULL, TRUE);
		$this->load->view("inicio/principal", array('html'=>$vw));
	}

	public function import_file()
	{
		$config['file_name'] = 'items_equipos';
		$config['allowed_types']= 'xlsx|xls';
		$config['upload_path']  = '.'.$this->import_path;
		$this->load->library('upload', $config);
		$idproyecto = $this->input->post('idproyecto');
		$ret = new stdClass();
		if ( ! $this->upload->do_upload('file')){
			$ret->msj = $this->upload->display_errors();
			$ret->status = FALSE;
		}else{
			$data = $this->upload->data();
			$ret->msj = 'Archivo cargado correctamente';
			$ret->file = $this->import_path.$data['file_name'];
			$ret->status = TRUE;
			$ret->resultados = $this->import_data( $this->import_path.$data['file_name'], $idproyecto );
		}
		echo json_encode($ret);
	}

	private function import_data($path, $idproyecto)
	{
		$this->load->helper('xlsx');
		$reader = getReader();
		$reader->open(FCPATH.$path);
		$this->load->model('equipo_db', 'eq');
		$resultados = array();
		$this->eq->start();
		foreach ($reader->getSheetIterator() as $sheet) {
	        $fila=0;
	        foreach ($sheet->getRowIterator() as $row) {
	        	if($fila > 0){
	        		$resultados = $this->import_setItem($row, $idproyecto, $resultados);
	        	}
	        	$fila++;
	        }
	    }
	    $this->eq->end();
	    return $resultados;
	}

	public function import_setItem($row, $idproyecto, $resultados)
	{
		$q = $this->eq->getBy( array('codigo'=>$row[0], 'proyecto_idproyecto'=>$idproyecto) );
		if($q->num_rows() <= 0){
			if ( isset($row[1]) ) {
				$equipo = new stdClass();
				$equipo->codigo = $row[0];
				$equipo->descripcion_equipo = $row[1];
				$equipo->unidad = $row[2];
				$equipo->costo_unidad = $row[3];
				$equipo->proyecto_idproyecto = $idproyecto;
				if( is_numeric( $this->eq->addItem($equipo) ) ){
					$row['resultado'] = 'Agregado';
					array_push($resultados, $row);
				}
			} else {
				$row['resultado'] = 'Descripcion no valida.';
				array_push($resultados, $row);
			}
			
		}else{
			$row['resultado'] = 'Codigo repetido en el proyecto';
			array_push($resultados, $row);
		}
		return $resultados;
	}

}

/* End of file Equipo.php */
/* Location: ./application/controllers/Equipo.php */