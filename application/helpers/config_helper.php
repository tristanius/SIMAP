<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function config_upload($nombre="termo"){

}

function app_termo($app="app.termo"){
	$ci =& get_instance();
	$ci->load->database('app1');
	$res = $ci->db->get_where("aplicacion","nombre_app = '".$app."'");
	$r = $res->row();
	return $r->ruta_app;
}
