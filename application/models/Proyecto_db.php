<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyecto_db extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();		
	}

	# CRUD
	public function get($id=NULL)
	{
		$this->load->database();
		if(isset($id)){
			$this->db->where('idproyecto', $id);
		}
		return $this->db->from('proyecto')->get();
	}

	public function getBy($data)
	{
		$this->load->database();
		foreach ($data as $key => $value) {
			$this->db->where($key, $value);
		}
		return $this->db->from('proyecto')->get();
	}

	public function add($pr)
	{
		$data = (array) $pr;
		$data['inicio'] = date('Y-m-d', strtotime( $data['inicio'] ) );
		$data['final'] = date('Y-m-d', strtotime( $data['final'] ) );
		$data['lista_clasificacion_apu'] = isset($pr->lista_clasificacion_apu)?json_encode($pr->lista_clasificacion_apu):NULL;
		$data['lista_grupo_apu'] = isset($pr->lista_grupo_apu)?json_encode($pr->lista_grupo_apu):NULL;
		$this->load->database();
		$this->db->insert('proyecto', $data);
		return $this->db->insert_id();
	}

	public function mod($pr, $id)
	{
		$data = (array) $pr;
		$data['inicio'] = date('Y-m-d', strtotime( $data['inicio'] ) );
		$data['final'] = date('Y-m-d', strtotime( $data['final'] ) );
		$data['lista_clasificacion_apu'] = isset($pr->lista_clasificacion_apu)?json_encode($pr->lista_clasificacion_apu):NULL;
		$data['lista_grupo_apu'] = isset($pr->lista_grupo_apu)?json_encode($pr->lista_grupo_apu):NULL;
		unset( $data['idproyecto'] );
		$this->load->database();
		return $this->db->update('proyecto', $data, 'idproyecto = '.$id);
	}

	public function getRecursos($where)
	{
		$this->load->database();
		$this->db->select('pr.idproyecto, pr.nombre_proyecto, pr.no_proyecto');
		$this->db->select('SUM(e.idequipo) AS cant_equipos, SUM(p.idpersonal) AS cant_personal, SUM(m.idmaterial) AS cant_materiales');
		$this->db->where($where);
		return $this->db->from('proyecto AS pr')->join('equipo AS e','e.proyecto_idproyecto = pr.idproyecto','LEFT')
			->join('personal AS p','p.proyecto_idproyecto = pr.idproyecto','LEFT')->join('material AS m','m.proyecto_idproyecto = p.idproyecto','LEFT')->get();
	}

	public function remove($id)
	{
		$this->load->database();
		$this->db->delete('proyecto', array('idproyecto'=>$id) );
	}

	# ----------------------------------------------------------------------------
	public function getValoresAPUs($where)
	{
		$this->load->database();
		$this->db->where($where);
		$this->db->select('SUM(apu.subtotal_equipos) AS total_equipos, SUM(apu.subtotal_personal) AS total_personal');
		$this->db->select('SUM(apu.subtotal_material) AS total_material, SUM(apu.total_directo) AS total_directo');
		return $this->db->from('apu')->get();
	}

	# ----------------------------------------------------------------------------
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

}

/* End of file Proyecto_db.php */
/* Location: ./application/models/Proyecto_db.php */