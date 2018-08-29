<section ng-controller="gestion_apu">
	<div class="">
		<nav aria-label="You are here:" role="navigation">
			<ul class="breadcrumbs">
				<li><a href="#">APU</a></li>
				<li><a href="#">Gestión de APU</a></li>
				<li class="disabled">Listado de items, APUs y manejos de valores de incidencia</li>
			</ul>
		</nav>
		<h4>A.P.U. de proyecto </h4>
	</div>
	<div class="grid-x grid-padding-x grid-margin-x">

		<div class="cell medium-8 large-6">
			<?php $this->load->view('APU/gestion/info_contrato'); ?>
		</div>

		<div class="cell medium-4 large-6">
			<?php $this->load->view('APU/gestion/conceptos_aiu'); ?>	
		</div>
		
	</div>

	<img src="<?= base_url('assets/img/ajax-loader.gif') ?>" width="20" height="20" ng-show="loader">

	<!-- Pestañas -->
	<ul class="tabs" data-tabs id="tabs-apu" >
		<li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Item de A.P.U.</a></li>
		<li class="tabs-title"><a data-tabs-target="panel2" href="#panel2">Resumen</a></li>
		<li class="tabs-title"><a data-tabs-target="panel3" href="#panel3">Indicadores</a></li>
	</ul>
	<div class="tabs-content" data-tabs-content="tabs-apu">
		<div class="tabs-panel is-active" id="panel1">
			<?php $this->load->view('APU/gestion/listado_apu'); ?>	
		</div>
		<div class="tabs-panel" id="panel2">
			<?php $this->load->view('APU/gestion/resumen'); ?>
		</div>
		<div class="tabs-panel" id="panel3">
			<?php $this->load->view('APU/gestion/indicadores'); ?>
		</div>
	</div>

	
	<?php $this->load->view('APU/gestion/forms/form_item'); ?>
	<?php $this->load->view('APU/gestion/forms/form_apu'); ?>
	<?php $this->load->view('proyecto/seleccion'); ?>
	<?php $this->load->view('APU/gestion/agrupaciones'); ?>

	<!-- importar -->
	<?php $this->load->view('APU/gestion/importar/form_importar'); ?>

</section>
