<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Material extends CI_Controller {

	private $import_path = '/uploads/imports/material/';
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}

	public function listado_material($idproyecto = NULL)
	{
		$this->load->model('material_db', 'mat');
		$ret =  new stdClass();
		$ret->listado = $this->mat->listado_items($idproyecto)->result();
		$ret->status = TRUE;
		echo json_encode($ret);
	}

	public function remove($idmaterial)
	{
		$this->load->model('material_db', 'mat');
		$ret =  new stdClass();
		$this->mat->start();
		$this->mat->remove( array('idmaterial'=>$idmaterial) );
		$this->mat->end();
		$ret->status = TRUE;
		echo json_encode($ret);
	}


	# ===================================================================================================
	# Proceso de importar cargos de personal
	public function importar()
	{
		$vw = $this->load->view('material/importar',NULL, TRUE);
		$this->load->view("inicio/principal", array('html'=>$vw));
	}

	public function import_file()
	{
		$config['file_name'] = 'items_material';
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
		$this->load->model('material_db', 'mat');
		$resultados = array();
		$this->mat->start();
		foreach ($reader->getSheetIterator() as $sheet) {
	        $fila=0;
	        foreach ($sheet->getRowIterator() as $row) {
	        	if($fila > 0){
	        		$resultados = $this->import_setItem($row, $idproyecto, $resultados);
	        	}
	        	$fila++;
	        }
	    }
	    $this->mat->end();
	    return $resultados;
	}

	private function import_setItem($row, $idproyecto, $resultados)
	{
		$q = $this->mat->getBy( array('codigo'=>$row[0], 'proyecto_idproyecto'=>$idproyecto) );
		if($q->num_rows() <= 0){
			if ( isset($row[1]) && $row[1] != '' ) {
				$material = new stdClass();
				$material->codigo = $row[0];
				$material->descripcion_material = $row[1];
				$material->unidad = $row[2];
				$material->costo_unidad = $row[3];
				$material->proyecto_idproyecto = $idproyecto;
				if( is_numeric( $this->mat->addItem($material) ) ){
					$row['resultado'] = 'Agregado';
					array_push($resultados, $row);
				}
			}else{
				$row['resultado'] = 'Descripción invalida.';
				array_push($resultados, $row);
			}			
		}else{
			$row['resultado'] = 'Codigo repetido en el proyecto';
			array_push($resultados, $row);
		}
		return $resultados;
	}

}

/* End of file Material.php */
/* Location: ./application/controllers/Material.php */