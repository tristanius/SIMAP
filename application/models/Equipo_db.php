<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Equipo_db extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function addItem($eq)
	{
		$this->load->database();
		$data = (array) $eq;
		$this->db->insert('equipo', $data);
		return $this->db->insert_id();
	}

	public function listado_items($idproyecto=NULL)
	{
		$this->load->database();
		if( isset($idproyecto) ){
			$this->db->where('pr.idproyecto', $idproyecto );
		}
		return $this->db->from('equipo AS eq')->join('proyecto AS pr','eq.proyecto_idproyecto = pr.idproyecto')->get();
	}
	public function getBy($data)
	{
		$this->load->database();
		foreach ($data as $key => $val) {
			$this->db->where($key, $val);
		}
		return $this->db->from('equipo')->get();
	}

	public function remove($wh)
	{
		$this->load->database();
		$this->db->delete('equipo', $wh );
	}

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

/* End of file Equipo_db.php */
/* Location: ./application/models/Equipo_db.php */