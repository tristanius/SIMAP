<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apu_db extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function add($item, $idproyecto)
	{
		$cant = isset($item->cantidad)?$item->cantidad:0;
		$valor_und = isset($item->valor_und)? $item->valor_und:0;

		$data = array();
		$data['item'] = $item->item;
		$data['descripcion'] = $item->descripcion;
		$data['unidad'] = $item->unidad;
		$data['tipo'] = $item->tipo;
		$data['grupo'] = $item->grupo?$item->grupo:NULL;
		$data['clasificacion'] = $item->clasificacion?$item->clasificacion:NULL;
		$data['composicion'] = $item->composicion?$item->composicion:NULL;
		$data['cantidad'] = $cant;
		$data['valor_und'] = $valor_und;
		$data['subtotal_material'] = isset($item->subtotal_material)? $item->subtotal_material:0;
		$data['subtotal_equipos'] = isset($item->subtotal_equipos)? $item->subtotal_equipos:0;
		$data['subtotal_personal'] = isset($item->subtotal_personal)? $item->subtotal_personal:0;
		$data['total_directo'] = $valor_und * $cant;
		$data['proyecto_idproyecto'] = $idproyecto;
		$data['version_idversion'] = $item->version_idversion;
		$this->load->database();
		$this->db->insert('apu', $data);
		return $this->db->insert_id();
	}

	public function mod($item)
	{
		$cant = isset($item->cantidad)?$item->cantidad:0;
		$valor_und = isset($item->valor_und)? $item->valor_und:0;
		
		$data = array();
		$data['item'] = $item->item;
		$data['descripcion'] = $item->descripcion;
		$data['unidad'] = $item->unidad;
		$data['tipo'] = $item->tipo;
		$data['grupo'] = $item->grupo;
		$data['clasificacion'] = $item->clasificacion;
		$data['composicion'] = $item->composicion;
		$data['cantidad'] = $cant;
		$data['valor_und'] = $valor_und;
		$data['subtotal_material'] = isset($item->subtotal_material)? $item->subtotal_material:0;
		$data['subtotal_equipos'] = isset($item->subtotal_equipos)? $item->subtotal_equipos:0;
		$data['subtotal_personal'] = isset($item->subtotal_personal)? $item->subtotal_personal:0;
		$data['total_directo'] = $valor_und * $cant;
		#$data['idproyecto'] = $idproyecto;
		$this->load->database();
		$this->db->update('apu', $data, 'idapu = '.$item->idapu);
	}

	public function getBy($data)
	{
		$this->load->database();
		return $this->db->from('apu')->join('version','apu.version_idversion = version.idversion')->where($data)->get();
	}

	public function getSubtotalProyecto($idproyecto, $idversion = NULL, $grupo = NULL)
	{
		$this->load->database();
		//$this->db->select('SUM(apu.subtotal_personal * apu.cantidad) AS subtotal_personal, SUM(apu.subtotal_equipos * apu.cantidad) AS subtotal_equipo, ');
		$this->db->select('SUM(apu.subtotal_personal * apu.cantidad) AS subtotal_personal, ');
		$this->db->select('SUM(apu.subtotal_material * apu.cantidad) AS subtotal_material, ');
		$this->db->select('SUM(apu.subtotal_equipos * apu.cantidad) AS subtotal_equipo, ');
		$this->db->select('SUM(apu.total_directo) AS total_directo, ');
		$this->db->select('vr.no_version');
		#$this->db->select('fields');
		if ( isset($grupo) ) {
			$this->db->select('apu.grupo, apu.tipo, apu.clasificacion');
			$this->db->group_by('apu.grupo, apu.tipo, apu.clasificacion');
		}
		return $this->db->from('proyecto AS pr')
				->join('version AS vr', 'pr.idproyecto = vr.proyecto_idproyecto')
				->join('apu', 'apu.proyecto_idproyecto = pr.idproyecto AND apu.version_idversion = vr.idversion')
				->where('pr.idproyecto', $idproyecto)
				->where('vr.idversion', $idversion)
				->group_by('pr.idproyecto')
				->group_by('vr.idversion')
				->get();
	}

	public function getCantidadesTipo($idproyecto, $idversion = NULL, $tipo=NULL)
	{
		$this->load->database();
		# iniciamos la estructura de la consulta
		$this->db->select('vr.no_version, SUM(apu_tipo.cantidad) AS cantidad_tipo, tipo.unidad, "'.$tipo.'" AS tipo_recurso');
		$this->db->from('proyecto AS pr')
				->join('version AS vr', 'pr.idproyecto = vr.proyecto_idproyecto')
				->join('apu', 'apu.proyecto_idproyecto = pr.idproyecto AND apu.version_idversion = vr.idversion')
				->where('pr.idproyecto', $idproyecto);

		if ( isset($idversion) ) {
			$this->db->where('vr.idversion', $idversion);
		}
		# Obtenemos información de la consulta según el tipo
		switch ($tipo) {
			case 'equipo':
				$this->db->select('tipo.descripcion_equipo AS descripcion');
				$this->db->join('apu_has_equipo AS apu_tipo', 'apu_tipo.apu_idapu = apu.idapu','LEFT');
				$this->db->join('equipo AS tipo', 'apu_tipo.equipo_idequipo = tipo.idequipo');
				$this->db->group_by('tipo.idequipo');
				break;
			case 'personal':
				$this->db->select('tipo.cargo AS descripcion');
				$this->db->join('apu_has_personal AS apu_tipo', 'apu_tipo.apu_idapu = apu.idapu','LEFT');
				$this->db->join('personal AS tipo', 'apu_tipo.personal_idpersonal = tipo.idpersonal');
				$this->db->group_by('tipo.idpersonal');
				break;
			case 'material':
			$this->db->select('tipo.descripcion_material AS descripcion');
				$this->db->join('apu_has_material AS apu_tipo', 'apu_tipo.apu_idapu = apu.idapu','LEFT');
				$this->db->join('material AS tipo', 'apu_tipo.material_idmaterial = tipo.idmaterial');
				$this->db->group_by('tipo.idmaterial');
				break;			
			default:
				# code...
				break;
		}		
		return $this->db->get();
	}

	# ----------------------------------------------------------------------------------------------
	# Recursos  de APU

	#material
	public function addMaterial($item, $idapu)
	{
		$this->load->database();
		$data = array();
		$data['apu_idapu'] = $idapu;
		$data['material_idmaterial'] = $item->idmaterial;
		$data['cantidad'] = $item->cantidad;
		$data['rendimiento'] = $item->rendimiento;
		$data['subtotal'] = isset($item->subtotal)?$item->subtotal:0;
		$this->db->insert('apu_has_material', $data);
		return $this->db->insert_id();
	}
	public function modMaterial($item)
	{
		$data = array();
		$data['apu_idapu'] = $item->idapu;
		$data['material_idmaterial'] = $item->material_idmaterial;
		$data['cantidad'] = $item->cantidad;
		$data['rendimiento'] = $item->rendimiento;
		$data['subtotal'] = isset($item->subtotal)?$item->subtotal:0;
		$this->db->update('apu_has_material', $data, 'idapu_has_material = '.$item->idapu_has_material);
	}

	public function getMaterialBy($where)
	{
		$this->db->where($where);
		$this->db->from('apu')	
				->join('apu_has_material AS apu_m','apu.idapu = apu_m.apu_idapu')
				->join('material AS m', 'apu_m.material_idmaterial = m.idmaterial');
		return $this->db->get();
	}
	public function delMaterial($id)
	{
	}

	# personal
	public function addPersona($item, $idapu)
	{
		$data = array();
		$data['apu_idapu'] = $idapu;
		$data['personal_idpersonal'] = $item->idpersonal;
		$data['cantidad'] = $item->cantidad;
		$data['rendimiento'] = $item->rendimiento;
		$data['subtotal'] = isset($item->subtotal)?$item->subtotal:0;
		$this->db->insert('apu_has_personal', $data);
		return $this->db->insert_id();
	}
	public function modPersona($item)
	{
		$data = array();
		$data['apu_idapu'] = $item->idapu;
		$data['personal_idpersonal'] = $item->personal_idpersonal;
		$data['cantidad'] = $item->cantidad;
		$data['rendimiento'] = $item->rendimiento;
		$data['subtotal'] = isset($item->subtotal)?$item->subtotal:0;
		$this->db->update('apu_has_personal', $data, 'idapu_has_personal = '.$item->idapu_has_personal);
	}
	public function getPersonalBy($where)
	{
		$this->db->where($where);
		$this->db->from('apu')	
				->join('apu_has_personal AS apu_p','apu.idapu = apu_p.apu_idapu')
				->join('personal AS p', 'apu_p.personal_idpersonal = p.idpersonal');
		return $this->db->get();
	}
	public function delPersona($id)
	{
	}

	# equipo
	public function addEquipo($item, $idapu)
	{
		$data = array();
		$data['apu_idapu'] = $idapu;
		$data['equipo_idequipo'] = isset($item->equipo_idequipo)?$item->equipo_idequipo:$item->idequipo;
		$data['cantidad'] = $item->cantidad;
		$data['rendimiento'] = $item->rendimiento;
		$data['subtotal'] = isset($item->subtotal)?$item->subtotal:0;
		$this->db->insert('apu_has_equipo', $data );
		return $this->db->insert_id();
	}
	public function modEquipo($item)
	{
		$data = array();
		$data['apu_idapu'] = $item->idapu;
		$data['equipo_idequipo'] = isset($item->equipo_idequipo)?$item->equipo_idequipo:$item->idequipo;
		$data['cantidad'] = $item->cantidad;
		$data['rendimiento'] = $item->rendimiento;
		$data['subtotal'] = isset($item->subtotal)?$item->subtotal:0;
		$this->db->update('apu_has_equipo', $data, 'idapu_has_equipo = '.$item->idapu_has_equipo);
	}
	public function getEquiposBy($where)
	{
		$this->db->where($where);
		$this->db->from('apu')	
				->join('apu_has_equipo AS apu_e','apu.idapu = apu_e.apu_idapu')
				->join('equipo AS e', 'apu_e.equipo_idequipo = e.idequipo');
		return $this->db->get();
	}
	public function delEquipo($id)
	{
	}

	# DB proc
	public function start()
	{
		$this->load->database();
		$this->db->trans_begin();
	}

	public function end()
	{
		$this->load->database();
		$status = $this->db->trans_status();
		if ( $status === FALSE){
		    $this->db->trans_rollback();
		}else{
			$this->db->trans_commit();
		}
		return $status;
	}

	public function rollback()
	{
		$this->load->database();
		$this->db->trans_rollback();
	}

}
/* End of file  */
/* Location: ./application/models/ */