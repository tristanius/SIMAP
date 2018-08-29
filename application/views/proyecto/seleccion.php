<div id="seleccion-proyecto" class="vmodal no-display" ng-init="init_modal('#seleccion-proyecto')">
	<div class="vmodal-content">
		<h5>
			<img src="<?= base_url('assets/img/termotecnica.png') ?>" width="100">  &nbsp;
			Seleciona un proyecto para continuar con la gestión:			
			<button class="close-button" type="button" ng-click="vmodal('#seleccion-proyecto', 'close');">
				<span aria-hidden="true">&times;</span>
			</button>
		</h5>

		<p></p>

		<table class="table stack font12" ng-init="getProyectos('<?= site_url('proyecto/get') ?>')">
			<thead >
				<tr class="bg-gray-blue text-white">
					<th>No. Proyecto</th>
					<th>Objeto del proyecto</th>
					<th>Contrato</th>
					<th>Cliente</th>
					<th>Contratista</th>
					<th>f. inicio</th>
					<th>f. final</th>
					<th>Selección</th>
				</tr>
				<tr>
					<th> <input type="text" placeholder="filtro" class="thin-input" ng-model="filterProyecto.nombre_proyecto"> </th>
					<th> <input type="text" placeholder="filtro" class="thin-input" ng-model="filterProyecto.objeto"> </th>
					<th> <input type="text" placeholder="filtro" class="thin-input" ng-model="filterProyecto.no_contrato"> </th>
					<th> <input type="text" placeholder="filtro" class="thin-input" ng-model="filterProyecto.cliente"> </th>
					<th> <input type="text" placeholder="filtro" class="thin-input" ng-model="filterProyecto.contratista"> </th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="pr in proyectos | filter: filterProyecto">
					<td ng-bind="pr.nombre_proyecto"></td>
					<td ng-bind="pr.objeto"></td>
					<td ng-bind="pr.no_contrato"></td>
					<td ng-bind="pr.cliente"></td>
					<td ng-bind="pr.contratista"></td>
					<td ng-bind="pr.inicio"></td>
					<td ng-bind="pr.final"></td>
					<td>
						<button type-button class="button small primary" ng-click="seleccionarProyecto(pr) ; vmodal('#seleccion-proyecto', 'close');"> Seleccionar </button>
					</td>
				</tr>
			</tbody>
		</table>
		
		<p class="subheader">
			Al seleccionar un proyecto procedera la venta a cerrarse
		</p>
	</div>
</div>
