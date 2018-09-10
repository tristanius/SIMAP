<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apu extends CI_Controller {

	private $import_path = '/uploads/imports/apu/';

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		
	}
	public function gestion()	{
		$vw = $this->load->view('APU/gestion',NULL, TRUE);
		$this->load->view("inicio/principal", array('html'=>$vw));
	}

	public function listadoby($idproyecto)	{
		$this->load->model(array('apu_db'=>'apu', 'material_db'=>'mat', 'personal_db'=>'per', 'equipo_db'=>'eq'));
		$data = array('apu.proyecto_idproyecto'=>$idproyecto);		
		$ret = new stdClass();
		$ret->listado = $this->apu->getBy($data)->result();
		$ret->materiales = $this->mat->getBy( array('proyecto_idproyecto'=>$idproyecto) )->result();
		$ret->personal = $this->per->getBy( array('proyecto_idproyecto'=>$idproyecto) )->result();
		$ret->equipos = $this->eq->getBy( array('proyecto_idproyecto'=>$idproyecto) )->result();
		$ret->status = TRUE;
		echo json_encode($ret);
	}

	public function subtotales_proyecto()
	{
		$post = json_decode( file_get_contents('php://input') );
		$this->load->model('apu_db', 'apu');
		$rows = $this->apu->getSubtotalProyecto( $post->idproyecto, $post->idversion );
		$ret = new stdClass();
		if($rows->num_rows() > 0){
			$ret->subtotales = $rows->result();
			$ret->sql = $this->db->last_query();
			$ret->subtotales_grupo = $this->apu->getSubtotalProyecto( $post->idproyecto, $post->idversion, TRUE )->result();
			# Cantidades por tipo de recursos del item para APU
			$ret->cantidades_tipo = new stdClass();
			$ret->cantidades_tipo->material = $this->apu->getCantidadesTipo( $post->idproyecto, $post->idversion, 'material')->result();
			$ret->cantidades_tipo->equipo = $this->apu->getCantidadesTipo( $post->idproyecto, $post->idversion, 'equipo')->result();
			$ret->cantidades_tipo->personal = $this->apu->getCantidadesTipo( $post->idproyecto, $post->idversion, 'personal')->result();
			$ret->status = TRUE;
		}else{
			$ret->status = FALSE;
		}
		echo json_encode($ret);
	}

	# =============================================================================
	# guardado de APU y sus elementos
	public function save()	{
		$post = json_decode( file_get_contents('php://input') );
		$item = $post->item;
		$this->load->model('apu_db', 'apu');
		$idproyecto = $post->idproyecto;
		$ret = new stdClass();
		
		$this->apu->start();
		if(isset($item->idapu)){
			$this->mod($item);
			$ret->status = TRUE;
		}else{
			$apus_similares = $this->apu->getBy(array('item'=>$item->item, 'proyecto_idproyecto'=>$idproyecto));
			if($apus_similares->num_rows() > 0){
				$ret->status = FALSE;
				$ret->msj = 'El item ya existe';
			}else{
				$item->idapu = $this->add($item, $idproyecto);
				$ret->status = TRUE;
			}
		}
		$ret->item = $item;
		$ret->db_status= $this->apu->end();
		echo json_encode($ret);
	}
	private function add($item, $idproyecto)	{
		$id = $this->apu->add($item, $idproyecto);
		$item->idapu = $id;
		if(isset($item->materiales))
			$this->save_recursos($item->materiales, $id, 'material');
		if(isset($item->personal))
			$this->save_recursos($item->personal, $id, 'personal');
		if(isset($item->equipos))
			$this->save_recursos($item->equipos, $id, 'equipos');
		return $id;
	}

	private function mod($item)	{
		
		if(isset($item->materiales))
			$this->save_recursos($item->materiales, $item->idapu, 'material');
		if(isset($item->personal))
			$this->save_recursos($item->personal, $item->idapu, 'personal');
		if(isset($item->equipos))
			$this->save_recursos($item->equipos, $item->idapu, 'equipos');
		return $this->apu->mod($item);
	}

	public function save_recursos($recursos, $idapu, $tipo)	{
		foreach ($recursos as $key => $rec) {
			switch ($tipo) {
				case 'material':
					$this->saveMaterial($rec, $idapu);
					break;
				case 'personal':
					$this->savePersona($rec, $idapu);
					break;
				case 'equipos':
					$this->saveEquipo($rec, $idapu);
					break;
				case 'actividades':
					$this->saveActividad($rec, $idapu);
					break;				
				default:
					# code...
					break;
			}
		}
	}

	private function saveMaterial($rec, $idapu=NULL)	{
		if( isset($rec->idapu_has_material) ){
			$this->apu->modMaterial($rec);
		}else{
			$rec->idapu_has_material = $this->apu->addMaterial($rec, $idapu);
		}
	}

	private function savePersona($rec, $idapu=NULL)	{
		if( isset($rec->idapu_has_personal) ){
			$this->apu->modPersona($rec);
		}else{
			$rec->idapu_has_personal = $this->apu->addPersona($rec, $idapu);
		}
	}

	private function saveEquipo($rec, $idapu=NULL)	{
		if( isset($rec->idapu_has_equipo) ){
			$this->apu->modEquipo($rec);
		}else{
			$rec->idapu_has_equipo = $this->apu->addEquipo($rec, $idapu);
		}
	}	

	# consulta de elementos de un Item APU
	public function get($id)	{
		$this->load->model('apu_db','apu');
		$ret = new stdClass();
		$rows = $this->apu->getBy(array('idapu'=>$id));
		if($rows->num_rows() > 0){
			$ret->apu = $rows->row();
			$ret->apu->materiales = $this->apu->getMaterialBy( 
							array('apu.idapu'=>$id) 
						)->result();
			$ret->apu->personal = $this->apu->getPersonalBy( 
							array('apu.idapu'=>$id) 
						)->result();
			$ret->apu->equipos = $this->apu->getEquiposBy( 
							array('apu.idapu'=>$id) 
						)->result();
			$ret->status = TRUE;
		}else{
			$ret->status = FALSE;
		}
		echo json_encode($ret);
	}

	public function remove_recurso()
	{
		$post = json_decode( file_get_contents('php://input') );
		$this->load->model('apu_db');
		$ret = new stdClass();
		try {			
			switch ($post->tipo) {
				case 'personal':
					if(isset($post->recurso->idapu_has_personal)){
						$this->apu_db->start();
						$this->apu_db->delPersona($post->recurso->idapu_has_personal);
						$ret->status = ($this->apu_db->end() === FALSE)?FALSE:TRUE;
					}else{
						$ret->status = TRUE;
					}
					break;

				case 'materiales':
					if(isset($post->recurso->idapu_has_material)){
						$this->apu_db->start();
						$this->apu_db->delMaterial($post->recurso->idapu_has_material);
						$ret->status = ($this->apu_db->end() === FALSE)?FALSE:TRUE;
					}else{
						$ret->status = TRUE;
					}
					break;

				case 'equipos':
					if(isset($post->recurso->idapu_has_equipo)){
						$this->apu_db->start();
						$this->apu_db->delEquipo($post->recurso->idapu_has_equipo);
						$ret->status = ($this->apu_db->end() === FALSE)?FALSE:TRUE;
					}else{
						$ret->status = TRUE;
					}
					break;
				
				default:
					$ret->status = FALSE;
					break;
			}
		} catch (Exception $e) {
			$ret->status = FALSE;
		}
		echo json_encode($ret);
	}

	# =====================================================================================

	# Importar APUs

	public function import_apu($value='')	{
		$config['file_name'] = 'listado_items';
		$config['allowed_types']= 'xlsx|xls';
		$config['upload_path']  = '.'.$this->import_path;

		$this->load->library('upload', $config);
		$idproyecto = $this->input->post('idproyecto');
		$idversion = $this->input->post('idversion');

		$ret = new stdClass();
		if ( ! $this->upload->do_upload('file')){
			$ret->msj = $this->upload->display_errors();
			$ret->status = FALSE;
			$ret->resultados = array();
		}else{
			$data = $this->upload->data();
			$ret->msj = 'Archivo cargado correctamente';
			$ret->file = $this->import_path.$data['file_name'];
			$ret->status = TRUE;
			try {
				$ret->resultados = $this->import_data( $this->import_path.$data['file_name'], $idproyecto );	
			} catch (Exception $e) {
				$this->apu->rollback();
				$ret->msj = 'fallo no esperado, no se han cargado items';
				$ret->status = TRUE;
			}			
		}
		$this->recalcularAPUS($idproyecto, $idversion);
		echo json_encode($ret);
	}

	public function import_data($path='/uploads/lic01/c2.xlsx', $idproyecto=1, $idversion=NULL)	{
		$this->load->helper('xlsx');
		$reader = getReader();
		$reader->open(FCPATH.$path);

		$this->load->model('apu_db', 'apu');
		$this->apu->start();

		$hoja = 0;
		$resultados = array();
		$resultados['items'] = array();
		$resultados['apu'] = array();
		foreach ($reader->getSheetIterator() as $sheet) {

			if($hoja == 0){
				$fila=0;
				foreach ( $sheet->getRowIterator() as $row ){
					if($fila > 0){
						$resultado = $this->setItem($row, $idproyecto, $idversion );
						array_push($resultados['items'] , $resultado);
			        }			        
					$fila++;
				}
			}

			if($hoja==1){
				$fila=0;
				foreach ( $sheet->getRowIterator() as $row ){
					if($fila > 0){
						$resultado = $this->setAPU($row, $idproyecto);
						array_push($resultados['apu'], $resultado);
					}
					$fila++;
				}
			}
			$hoja++;
		}
		$resultados['hojas'] = $hoja;
		$this->apu->end();
	    return $resultados;
	}

	private function setItem($fila, $idproyecto, $idversion=NULL)	{
		$items = $this->apu->getBy( array('apu.item'=>$fila[1], 'apu.proyecto_idproyecto'=>$idproyecto) );
		if($items->num_rows() <= 0){
			$obj = new stdClass();
			$obj->item = $fila[1];
			$obj->descripcion = $fila[2];
			$obj->unidad = $fila[3];
			$obj->tipo = $fila[4];
			$obj->grupo = isset($fila[6])?$fila[6]:'';
			$obj->clasificacion = isset($fila[7])?$fila[7]:'';
			$obj->composicion = 'simple';
			$obj->cantidad = $fila[5];
			$obj->valor_und = 0;			
			$obj->version_idversion = isset($idversion)?$idversion:$this->getVersionID($idproyecto);

			if( is_numeric( $this->apu->add($obj, $idproyecto) ) ){
				$fila['resultado'] = 'Agregado';
			}
		}else{
			$fila['resultado'] = 'Item repetido en el proyecto';
		}
		return $fila;
	}

	private function getVersionID($idproyecto){

		$this->load->model('version_db', 'ver');
		$versiones = $this->ver->getBy( array('pr.idproyecto'=>$idproyecto) );
		if($versiones->num_rows() > 0){
			$vr =  $versiones->row();
			return $vr->idversion;
		}
		return NULL;
	}

	# Construcción de recurso generico APU
	private function setAPU($fila, $idproyecto ){
		$items = $this->apu->getBy( array('apu.item'=>$fila[1], 'apu.proyecto_idproyecto'=>$idproyecto) );
		# Si existe el item proceder
		if($items->num_rows() > 0){
			$item = $items->row();			
			# Verificar si existe recurso para APU			
			$obj = new stdClass();
			$obj->codigo = $fila[3]; # para buscar el recurso
			$obj->tipo = $fila[2];
			$cant = str_replace(',', '.', $fila[4] );
			$obj->cantidad = is_numeric( $cant )? $cant :0;
			$rend = str_replace(',', '.', $fila[5] );
			$obj->rendimiento = is_numeric( $rend )? $rend :0;
			$obj->idapu = $item->idapu; # asignamos el ID de APU
			$fila = $this->setByTipo( $fila, $obj, $idproyecto);
		}else{
			$fila['resultado'] = 'Item no encontrado para el cargue';
		}
		return $fila;
	}

	# Validación de recurso APU para insertar
	private function setByTipo($fila, $obj, $idproyecto){
		$this->load->helper('recurso_apu');
		switch ( strtolower($obj->tipo) ) {
			case 'personal':
				$this->load->model('personal_db', 'per');
				$personal = $this->per->getBy( array('codigo'=>$obj->codigo, 'proyecto_idproyecto'=>$idproyecto ) );
				if($personal->num_rows() > 0){
					$per = $personal->row();
					$obj->idpersonal = $per->idpersonal;
					$obj->costo_unidad = $per->costo_unidad;

					calcularSubtotales($obj, 'personal');

					$this->apu->addPersona($obj, $obj->idapu);
					$fila['resultado'] = 'Agregado';
				}else{
					$fila['resultado'] = 'codigo de recurso no encontrado';
				}
				break;
			case 'equipo':
				$this->load->model('equipo_db', 'eq');
				$equipos = $this->eq->getBy( array('codigo'=>$obj->codigo, 'proyecto_idproyecto'=>$idproyecto ) );
				if($equipos->num_rows() > 0){
					$eq = $equipos->row();
					$obj->idequipo = $eq->idequipo;
					$obj->costo_unidad = $eq->costo_unidad;

					calcularSubtotales($obj, 'equipo');

					$this->apu->addEquipo($obj, $obj->idapu);
					$fila['resultado'] = 'Agregado';
				}else{
					$fila['resultado'] = 'codigo de recurso no encontrado';
				}
				break;
			case 'material':
				$this->load->model('material_db', 'mat');
				$materiales = $this->mat->getBy( array('codigo'=>$obj->codigo, 'proyecto_idproyecto'=>$idproyecto ) );
				if($materiales->num_rows() > 0){
					$mat = $materiales->row();
					$obj->idmaterial = $mat->idmaterial;					
					$obj->costo_unidad = $mat->costo_unidad;

					calcularSubtotales($obj, 'material');
					
					$this->apu->addMaterial($obj, $obj->idapu);
					$fila['resultado'] = 'Agregado';
				}else{
					$fila['resultado'] = 'codigo de recurso no encontrado';
				}
				break;
			default:
				$fila['resultado'] = 'Tipo no encontrado en los tipos validos por la app.';
				break;
		}
		return $fila;
	}

	# Calcular APUS's
	public function recalcularAPUS($idproyecto, $idversion=NULL)
	{
		$where = array();
		$where['apu.proyecto_idproyecto'] = $idproyecto;
		if( isset($idversion) ) { 
			$where['version.idversion'] = $idversion;
		}
		$this->load->helper('recurso_apu');
		$this->load->model('apu_db', 'apu');
		$i = 0;

		$items = $this->apu->getBy( $where );
		foreach ($items->result() as $key => $item) {
			$item->materiales = $this->apu->getMaterialBy( array('apu.idapu'=>$item->idapu) )->result();
			$item->personal = $this->apu->getPersonalBy( array('apu.idapu'=>$item->idapu) )->result();
			$item->equipos = $this->apu->getEquiposBy( array('apu.idapu'=>$item->idapu) )->result();

			$item = calcular_apu( $item );

			$this->apu->mod( $item );
		}
	}

	# =======================================================================
}

/* End of file  */
/* Location: ./application/controllers/ */