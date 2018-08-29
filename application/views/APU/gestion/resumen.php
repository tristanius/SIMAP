<div>
	<h6>Resumen de datos generales del proyecto <span ng-bind="proyecto.nombre_proyecto"></span></h6>

	<div class="grid-x grid-margin-x">

		<div class="cell medium-7">
			<table class="table stack font11">
				<thead class="text-center">
					<tr>
						<th>Proyecto: <span ng-bind="proyecto.nombre_proyecto"></span></th>
						<th colspan="3">Subtotales</th>
						<th></th>
					</tr>
					<tr class="bg-light-orange">
						<th>Version</th>
						<th>Subtotal personal</th>
						<th>Subtotal equipo</th>
						<th>Subtotal material</th>
						<th>total</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="subs in proyecto.subtotales">
						<td ng-bind="subs.no_version"></td>
						<td ng-bind="subs.subtotal_personal | currency: '$ ':2 "></td>
						<td ng-bind="subs.subtotal_equipo | currency: '$ ':2 "></td>
						<td ng-bind="subs.subtotal_material | currency: '$ ':2 "></td>
						<td ng-bind="subs.total_directo | currency: '$ ':2 "></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="cell medium-12">

			<table class="table stack font11">
				<thead class="text-center">
					<tr>
						<th colspan="4">Proyecto: <span ng-bind="proyecto.nombre_proyecto"></span></th>
						<th colspan="4">subtotales</th>
					</tr>
					<tr class="bg-light-orange">
						<th>Version</th>
						<th>Tipo</th>
						<th>Grupo</th>
						<th>Clasificacion</th>
						<th>Subtotal personal</th>
						<th>Subtotal equipo</th>
						<th>Subtotal material</th>
						<th>Directos</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="sub in proyecto.subtotales_grupo">
						<td ng-bind="sub.no_version"></td>
						<td ng-bind="sub.tipo"></td>
						<td ng-bind="sub.grupo"></td>
						<td ng-bind="sub.clasificacion"></td>
						<td ng-bind="sub.subtotal_personal | currency: '$ ':2 "></td>
						<td ng-bind="sub.subtotal_equipo | currency: '$ ':2 "></td>
						<td ng-bind="sub.subtotal_material | currency: '$ ':2 "></td>
						<td ng-bind="sub.total_directo | currency: '$ ':2 "></td>
					</tr>
				</tbody>

			</table>

		</div>

	</div>
	
</div>