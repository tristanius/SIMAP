<section id="modal_personal" class="vmodal no-display" ng-init="init_modal('#modal_personal')">
	<div class="vmodal-content">
		<div class="vmodal-header">
			<h5>
				Cargos de personal: 
				<button class="hollow button primary" ng-click="addRecursos('personal', personal, '#modal_personal');"> <i class="fas fa-save"></i> Agregar </button>
				<button class="hollow button alert" ng-click="vmodal('#modal_personal', 'close');"> Salir </button>
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
						<th>Cargo</th>
						<th>Nivel</th>
						<th>Tipo L/C</th>
						<th>Unidad</th>
						<th>Costo Und.</th>
					</tr>
					<tr class="bg-gray-blue text-white">
						<th></th>
						<th> <input type="text" class="thin-input" style="width: 8ex;" ng-model="FilterProyectPer.codigo"> </th>
						<th> <input type="text" class="thin-input" ng-model="FilterProyectPer.cargo"> </th>
						<th> <input type="text" class="thin-input" style="width: 8ex;" ng-model="FilterProyectPer.nivel_salarial"> </th>
						<th> <input type="text" class="thin-input" style="width: 8ex;" ng-model="FilterProyectPer.tipo_cargo"> </th>
						<th> <input type="text" class="thin-input" style="width: 8ex;" ng-model="FilterProyectPer.unidad"> </th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="p in personal track by $index" ng-class="(!p.costo_unidad || p.costo_unidad == 0)?'bg-light-red':''">						
						<td> <input type="checkbox" ng-model="p.seleccion" /> </td>
						<td ng-bind="p.codigo"></td>
						<td ng-bind="p.cargo"></td>
						<td ng-bind="p.nivel_salarial"></td>
						<td ng-bind="p.tipo_cargo"></td>
						<td ng-bind="p.unidad"></td>
						<td ng-bind="p.costo_unidad| currency"></td>
					</tr>
					<tr>
						<td colspan="7"> - </td>
					</tr>
				</tbody>
			</table>
		</div>	
	</div>
</section>