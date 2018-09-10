<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal extends CI_Controller {

	private $import_path = '/uploads/imports/personal/';

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('america/Bogota');
	}

	public function index()
	{
		
	}

	public function listado_cargos($idproyecto = NULL)
	{
		$this->load->model('personal_db', 'per');
		$ret =  new stdClass();
		$ret->listado = $this->per->listado_cargos($idproyecto)->result();
		$ret->status = TRUE;
		echo json_encode($ret);
	}

	public function remove($idpersonal)
	{
		$this->load->model('personal_db', 'per');
		$ret =  new stdClass();
		$this->per->start();
		$this->per->remove( array('idpersonal'=>$idpersonal) );
		$this->per->end();
		$ret->status = TRUE;
		echo json_encode($ret);
	}

	# ===================================================================================================
	# Proceso de importar cargos de personal
	public function importar()
	{
		$vw = $this->load->view('personal/importar',NULL, TRUE);
		$this->load->view("inicio/principal", array('html'=>$vw));
	}

	public function import_file()
	{
		$config['file_name'] = 'cargos_personal';
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
		$this->load->model('personal_db', 'per');
		$resultados = array();
		$this->per->start();
		foreach ($reader->getSheetIterator() as $sheet) {
	        $fila=0;
	        foreach ($sheet->getRowIterator() as $row) {
	        	if($fila > 0){
	        		$resultados = $this->import_setCargo($row, $idproyecto, $resultados);
	        	}
	        	$fila++;
	        }
	    }
	    $this->per->end();
	    return $resultados;
	}

	public function import_setCargo($row, $idproyecto, $resultados)
	{
		$q = $this->per->getBy( array('codigo'=>$row[0], 'proyecto_idproyecto'=>$idproyecto ) );
		if($q->num_rows() <= 0){
			if ( isset($row[1]) ) {
				$per = new stdClass();
				$per->codigo = $row[0];
				$per->cargo = $row[1];
				$per->nivel_salarial = $row[2];
				$per->tipo_cargo = $row[3];
				$per->unidad = $row[4];
				$per->costo_unidad = $row[5];
				$per->proyecto_idproyecto = $idproyecto;
				if( is_numeric( $this->per->addCargo($per) ) ){
					$row['resultado'] = 'Agregado';
					array_push($resultados, $row);
				}
			} else {
				$row['resultado'] = 'Cargo no valido.';
				array_push($resultados, $row);
			}
		}else{
			$row['resultado'] = 'Codigo repetido en el proyecto.';
			array_push($resultados, $row);
		}
		return $resultados;
	}

}

/* End of file Personal.php */
/* Location: ./application/controllers/Personal.php */