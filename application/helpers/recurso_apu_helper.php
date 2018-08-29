<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function calcularSubtotales($recurso, $tipo)
{
	try {
		switch ($tipo) {
			case 'equipo':
				if($recurso->cantidad == 0 || $recurso->rendimiento == 0){
					$recurso->subtotal = 0;
				}else{
					$recurso->subtotal = ($recurso->costo_unidad) / ( ($recurso->cantidad) * ($recurso->rendimiento) );
				}
				break;
			case 'personal':
				if($recurso->cantidad == 0 || $recurso->rendimiento == 0){
					$recurso->subtotal = 0;
				}else{
					$recurso->subtotal = ($recurso->costo_unidad) / ( ($recurso->cantidad) * ($recurso->rendimiento) );
				}
				break;
			case 'material':
				$recurso->subtotal = ($recurso->costo_unidad)  * ($recurso->cantidad);
				break;
			
			default:
				$recurso->subtotal = 0;
				break;
		}
		$recurso->subtotal = round( $recurso->subtotal, 4 );
		return $recurso;	
	} catch (Exception $e) {
		return $recurso;
	}
}

function calcular_apu($apu)
{
	$apu->subtotal_material = 0;
	foreach ($apu->materiales as $key => $mat) {
		$mat = calcularSubtotales( $mat, 'material' );
		$apu->subtotal_material += $mat->subtotal;
	}

	$apu->subtotal_equipos = 0;
	foreach ($apu->equipos as $key => $eq) {
		$eq = calcularSubtotales( $eq, 'equipo' );
		$apu->subtotal_equipos += $eq->subtotal;
	}

	$apu->subtotal_personal = 0;
	foreach ($apu->personal as $key => $per) {
		$per = calcularSubtotales( $per, 'personal' );
		$apu->subtotal_personal += $per->subtotal;
	}
	$apu->valor_und = round( ( $apu->subtotal_material + $apu->subtotal_equipos + $apu->subtotal_personal ), 4 );
	$apu->total_directo =  round( ( $apu->valor_und * $apu->cantidad ), 4);
	return $apu;
}