<section id="modal_material" class="vmodal no-display" ng-init="init_modal('#modal_material')">
	<div class="vmodal-content">
		
		<div class="vmodal-header">
			<h5>
				Materiales:
				<button class="hollow button primary" ng-click="addRecursos('materiales', materiales, '#modal_material');"> <i class="fas fa-save"></i> Agregar </button>
				<button class="hollow button alert" ng-click="vmodal('#modal_material', 'close');"> Salir </button>
			</h5>
		</div>
		
		<div class="padding1ex vmodal-body">
			<hr>
			<h6>Selecciona un conjunto de elementos para agregar al APU</h6>

			<table class="table font12">
				<thead>
					<tr class="bg-gray-blue text-white">
						<th>Selecc.</th>
						<th>Codigo</th>
						<th>Material</th>
						<th>Unidad</th>
						<th>Costo Und.</th>
					</tr>
					<tr class="bg-gray-blue text-white">
						<th></th>
						<th> <input type="text" class="thin-input" style="width: 8ex;" ng-model="FilterProyectMat.codigo"> </th>
						<th> <input type="text" class="thin-input" ng-model="FilterProyectMat.descripcion_material"> </th>
						<th> <input type="text" class="thin-input" style="width: 8ex;" ng-model="FilterProyectMat.unidad"> </th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="m in materiales | filter: FilterProyectMat track by $index" ng-class="(!m.costo_unidad || m.costo_unidad == 0)?'bg-light-red':''">						
						<td> <input type="checkbox" ng-model="m.seleccion" ng-init="m.seleccion = false;" ng-init="m.seleccion = false"> </td>
						<td ng-bind="m.codigo"></td>
						<td ng-bind="m.descripcion_material"></td>
						<td ng-bind="m.unidad"></td>
						<td ng-bind="m.costo_unidad| currency"></td>
					</tr>
					<tr>
						<td colspan="5"> - </td>
					</tr>
				</tbody>
			</table>
		</div>		
	</div>
</section>