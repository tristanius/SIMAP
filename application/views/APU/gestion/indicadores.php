<div>
	<h6>Indicadores de recursos: </h6>

	<div class="grid-x grid-margin-x">
		<div class="cell medium-4">
			<table class="table stack font11">
				<thead class="text-center">
					<tr class="bg-light-orange">
						<th>Tipo</th>
						<th>Descripcion</th>
						<th>Unidad</th>
						<th># de recursos en APU</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="rec_tipo in proyecto.cantidades_tipo.material">
						<td ng-bind="rec_tipo.tipo_recurso"></td>
						<th ng-bind="rec_tipo.descripcion"></th>
						<th ng-bind="rec_tipo.unidad"></th>
						<td ng-bind="rec_tipo.cantidad_tipo"></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="cell medium-4">
			<table class="table stack font11">
				<thead class="text-center">
					<tr class="bg-light-orange">
						<th>Tipo</th>
						<th>Descripcion</th>
						<th>Unidad</th>
						<th># de recursos en APU</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="rec_tipo in proyecto.cantidades_tipo.equipo">
						<td ng-bind="rec_tipo.tipo_recurso"></td>
						<th ng-bind="rec_tipo.descripcion"></th>
						<th ng-bind="rec_tipo.unidad"></th>
						<td ng-bind="rec_tipo.cantidad_tipo"></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="cell medium-4">
			<table class="table stack font11">
				<thead class="text-center">
					<tr class="bg-light-orange">
						<th>Tipo</th>
						<th>Descripcion</th>
						<th>Unidad</th>
						<th># de recursos en APU</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="rec_tipo in proyecto.cantidades_tipo.personal">
						<td ng-bind="rec_tipo.tipo_recurso"></td>
						<th ng-bind="rec_tipo.descripcion"></th>
						<th ng-bind="rec_tipo.unidad"></th>
						<td ng-bind="rec_tipo.cantidad_tipo"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>