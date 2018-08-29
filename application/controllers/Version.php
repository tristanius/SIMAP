<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Version extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}

	public function add()
	{
		$pr = json_decode( file_get_contents('php://input') );
		$this->load->model('version_db', 'ver');
		$vr = new stdClass();
		$ret = new stdClass();

		$this->ver->start();
		$vr->no_version = sizeof($pr->versiones)+1;
		$vr->idproyecto = $pr->idproyecto;
		$vr->idversion = $this->ver->add($vr);

		if($vr->no_version > 1){
			$ret->apu = $this->copiarItems( $pr->idproyecto, $vr->idversion);
		}
		
		$ret->versiones =  $this->ver->getBy( array( 'proyecto_idproyecto'=>$pr->idproyecto ) )->result();
		$ret->status = TRUE;

		$this->ver->end();
		echo json_encode($ret);
	}

	private function copiarItems($idproyecto, $idversion)
	{
		$this->load->model('apu_db', 'apu');
		$apu = NULL;
		$rows = $this->apu->getBy(array('apu.proyecto_idproyecto'=>$idproyecto, 'version.no_version'=>1));
		foreach ($rows->result() as $key => $apu) {
			$id = $apu->idapu;
			$apu->version_idversion = $idversion;
			$apu->idapu = $this->apu->add($apu, $idproyecto);
			$apu->materiales = $this->apu->getMaterialBy( array('apu.idapu'=>$id) )->result();
			$this->save_recursos($apu->materiales, $apu->idapu, $idversion, 'material');

			$apu->personal = $this->apu->getPersonalBy( array('apu.idapu'=>$id) )->result();
			$this->save_recursos($apu->personal, $apu->idapu, $idversion, 'personal');

			$apu->equipos = $this->apu->getEquiposBy( array('apu.idapu'=>$id) )->result();
			$this->save_recursos($apu->materiales, $apu->idapu, $idversion, 'equipos');
		}
		return $apu;
	}

	private function save_recursos($recursos, $idapu, $idversion, $tipo)	{
		foreach ($recursos as $key => $rec) {
			switch ($tipo) {
				case 'material':
					$this->apu->addMaterial($rec, $idapu);
					break;
				case 'personal':
					$this->apu->addPersona($rec, $idapu);
					break;
				case 'equipos':
					$this->apu->addEquipo($rec, $idapu);
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

	public function delete($idversion)
	{
		$this->load->model('version_db', 'ver');
		$this->ver->start();
		$this->ver->delete( array('idversion' => $idversion) );
		$this->ver->end();
		$ret = new stdClass();
		$ret->status = TRUE;
		echo json_encode($ret);
	}

}

/* End of file Version.php */
/* Location: ./application/controllers/Version.php */