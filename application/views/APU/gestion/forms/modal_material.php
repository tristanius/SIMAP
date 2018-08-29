<section id="modal_material" class="vmodal no-display" ng-init="init_modal('#modal_material')">
	<div class="vmodal-content">
		<div class="padding1ex">
			<h5>Materiales:</h5>
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
				</thead>
				<tbody>
					<tr ng-repeat="m in materiales track by $index">						
						<td> <input type="checkbox" ng-model="m.seleccion" ng-init="m.seleccion = false;"> </td>
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
			<p></p>

			<div>
				<button class="hollow button primary" ng-click="addRecursos('materiales', materiales, '#modal_material');"> <i class="fas fa-save"></i> Agregar </button>
			</div>
		</div>	
	</div>
</section>