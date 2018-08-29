<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Material_db extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function addItem($mat)
	{
		$this->load->database();
		$data = (array) $mat;
		$this->db->insert('material', $data);
		return $this->db->insert_id();
	}

	public function listado_items($idproyecto=NULL)
	{
		$this->load->database();
		if( isset($idproyecto) ){
			$this->db->where('pr.idproyecto', $idproyecto );
		}
		return $this->db->from('material AS mat')->join('proyecto AS pr','mat.proyecto_idproyecto = pr.idproyecto')->get();
	}
	
	public function getBy($data)
	{
		$this->load->database();
		foreach ($data as $key => $val) {
			$this->db->where($key, $val);
		}
		return $this->db->from('material')->get();
	}

	public function remove($wh)
	{
		$this->load->database();
		$this->db->delete('material', $wh );
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

/* End of file Material_db.php */
/* Location: ./application/models/Material_db.php */