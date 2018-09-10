<section id="modal_equipos" class="vmodal no-display" ng-init="init_modal('#modal_equipos')">
	<div class="vmodal-content">
		<div class="vmodal-header">
			<h5>
				Equipos:
				<button class="hollow button primary" ng-click="addRecursos('equipos', equipos, '#modal_equipos' );"> <i class="fas fa-save"></i> Agregar </button>
				<button class="hollow button alert" ng-click="vmodal('#modal_equipos', 'close');"> Salir </button>
			</h5>
		</div>

		<div class="padding1ex vmodal-body">
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
					<tr class="bg-gray-blue text-white">
						<th></th>
						<th> <input type="text" style="width: 8ex;" class="thin-input" ng-model="FilterProyectEq.codigo"> </th>
						<th> <input type="text" style="width: 8ex;" class="thin-input" ng-model="FilterProyectEq.descripcion_equipo"> </th>
						<th> <input type="text" style="width: 8ex;" class="thin-input" ng-model="FilterProyectEq.unidad"> </th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="e in equipos | filter: FilterProyectEq track by $index"  ng-class="(!e.costo_unidad || e.costo_unidad == 0)?'bg-light-red':''">						
						<td ng-init="e.index = $index"> <input type="checkbox" ng-model="e.seleccion" ng-init="e.seleccion = false;"> </td>
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
		</div>	
	</div>
</section>