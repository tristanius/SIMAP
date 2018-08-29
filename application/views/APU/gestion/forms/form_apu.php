<section id="form_apu" class="vmodal no-display" ng-init="init_modal('#form_apu')">
	<div class="vmodal-content">
		<h4> <img src="<?= base_url('assets/img/termotecnica.png') ?>" width="100"> Analisis de precios unitario (APU)</h4>
		  
		<button class="close-button" ng-click="vmodal('#form_apu', 'close');" type="button">
			<span aria-hidden="true">&times;</span>
		</button>

		<div class="grid-x grid-padding-x grid-margin-x">

			<div class="cell small-12 font11">
				<table class="stack">
					<thead class="bg-gray-blue text-white ">
						<tr>
							<th>Item</th>
							<th>Descripción de item</th>
							<th>Unidad</th>
							<th>Cantidad Estimada</th>

							<th colspan="4">Clasificaciones</th>
							<th>Versión</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td ng-bind="myapu.item"></td>
							<td ng-bind="myapu.descripcion"></td>
							<td ng-bind="myapu.unidad"></td>
							<td> <input type="text" class="thin-input" ng-model="myapu.cantidad"  style="max-width: 7ex;"> </td>
							<td ng-bind="myapu.grupo"></td>
							<td ng-bind="myapu.tipo"></td>
							<td ng-bind="myapu.clasificacion"></td>
							<td ng-bind="myapu.composicion"></td>
							<td>1.0</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="cell medium-6 large-5">
				<button class="hollow button success" ng-click="vmodal('#modal_material', 'open');"> <i class="fas fa-plus"></i> Material <i class="fas fa-shopping-basket"></i> </button>
				<button class="hollow button success" ng-click="vmodal('#modal_equipos', 'open');"> <i class="fas fa-plus"></i> Equipo <i class="fas fa-truck-moving"></i> </button>
				<button class="hollow button success" ng-click="vmodal('#modal_personal', 'open');"> <i class="fas fa-plus"></i> Personal <i class="fas fa-users-cog"></i> </button>
			</div>

			<div class="cell medium-6 large-5 large-offset-2">
				<button class="hollow button warning" ng-click=""> <i class="fas fa-balance-scale"></i> Analisis de Rendimiento </button>
				<button class="hollow button success" ng-click=""> <i class="fas fa-project-diagram"></i> Generar </button>
			</div>

		</div>

		<?php $this->load->view('APU/gestion/forms/modal_material'); ?>
		<?php $this->load->view('APU/gestion/forms/modal_equipos'); ?>
		<?php $this->load->view('APU/gestion/forms/modal_personal'); ?>

		<p></p>

		<div>
			<table class="table stack font11">
				<?php $this->load->view('APU/gestion/forms/material'); ?>
				<?php $this->load->view('APU/gestion/forms/equipos'); ?>
				<?php $this->load->view('APU/gestion/forms/personal'); ?>
			</table>

			<h5>Valor Unitario: <span ng-bind="myapu.valor_und | currency: '$ '"></span></h5>
		</div>

		<div>
			<button class="hollow button primary" ng-click="save_apu('<?= site_url('apu/save') ?>', '#form_apu')"> <i class="fas fa-save"></i> Guardar </button>
			<button class="hollow button alert" ng-click="vmodal('#form_apu', 'close'); "> <i class="fas fa-save"></i> Volver </button>
		</div>
	</div>
</section>