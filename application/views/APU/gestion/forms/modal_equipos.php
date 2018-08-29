<section id="modal_equipos" class="vmodal no-display" ng-init="init_modal('#modal_equipos')">
	<div class="vmodal-content">
		<div class="padding1ex">
			<h5>Equipos:</h5>
			<hr>
			<h6>Selecciona un conjunto de elementos para agregar al APU</h6>

			<table class="table stack font12">
				<thead>
					<tr class="bg-gray-blue text-white">
						<th>Selecc.</th>
						<th>Codigo</th>
						<th>Descripción</th>
						<th>Unidad</th>
						<th>Costo Und.</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="e in equipos track by $index">						
						<td> <input type="checkbox" ng-model="e.seleccion" ng-init="e.seleccion = false;"> </td>
						<td ng-bind="e.codigo"></td>
						<td ng-bind="e.descripcion_equipo"></td>
						<td ng-bind="e.unidad"></td>
						<td ng-bind="e.costo_unidad| currency"></td>
					</tr>
					<tr>
						<td colspan="5"> - </td>
					</tr>
				</tbody>
			</table>
			<p></p>

			<div>
				<button class="hollow button primary" ng-click="addRecursos('equipos', equipos, '#modal_equipos' );"> <i class="fas fa-save"></i> Agregar </button>
			</div>
		</div>	
	</div>
</section>