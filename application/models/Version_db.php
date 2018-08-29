<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Version_db extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function add($vr)
	{
		$this->load->database();
		$data = array();
		$data['no_version'] = $vr->no_version;
		$data['proyecto_idproyecto'] = $vr->idproyecto;
		$this->db->insert('version', $data);
		return $this->db->insert_id();
	}

	public function delete($where)
	{
		$this->load->database();
		return $this->db->delete('version', $where);
	}

	public function getBy($where=NULL)
	{
		$this->load->database();
		if(isset($where)){
			$this->db->where($where);
		}
		return $this->db->select("vr.*, pr.idproyecto")
				->from('version AS vr')->join('proyecto AS pr', 'pr.idproyecto = vr.proyecto_idproyecto')->order_by('vr.no_version', 'ASC')->get();
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

/* End of file version_db.php */
/* Location: ./application/models/version_db.php */