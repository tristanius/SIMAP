<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal_db extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function addCargo($per)
	{
		$this->load->database();
		$data = (array) $per;
		$this->db->insert('personal', $data);
		return $this->db->insert_id();
	}

	public function listado_cargos($idproyecto=NULL)
	{
		$this->load->database();
		if( isset($idproyecto) ){
			$this->db->where('pr.idproyecto', $idproyecto );
		}
		return $this->db->from('personal AS p')->join('proyecto AS pr','p.proyecto_idproyecto = pr.idproyecto')->get();
	}

	public function getBy($data)
	{
		$this->load->database();
		foreach ($data as $key => $val) {
			$this->db->where($key, $val);
		}
		return $this->db->from('personal')->get();
	}

	public function remove($where)
	{
		$this->load->database();
		$this->db->delete('personal', $where);
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

/* End of file  */
/* Location: ./application/models/ */