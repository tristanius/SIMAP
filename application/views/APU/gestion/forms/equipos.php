			<thead>
				<tr>
					<th colspan="6">Equipos</th>
					<th>Subtotal</th>
					<th class="bg-light-orange"><span ng-bind="myapu.subtotal_equipos | currency : '$ '"></span> </th>
					<th class="bg-orange">#</th>
					<th class="bg-green" colspan="2"> subtotal</th>
					<th class="bg-green">#</th>
				</tr>
				<tr class="bg-gray-blue text-white">
					<th></th>
					<th>Codigo</th>
					<th>Descripción</th>
					<th>Unidad</th>
					<th>Cantidad</th>
					<th>Rendimiento</th>
					<th>Valor Und.</th>
					<th>Subtotal</th>
					<th class="bg-orange">Rend.</th>
					<th class="bg-green">Cantidad</th>
					<th class="bg-green">Rend.</th>
					<th class="bg-green">subtotal</th>
				</tr>
				<tr>
					<th></th>
					<th> <input type="text" class="thin-input" ng-model="filterEqAPU.codigo" style="width: 8ex;"> </th>
					<th> <input type="text" class="thin-input" ng-model="filterEqAPU.descripcion_equipo" > </th>
					<th> <input type="text" class="thin-input" ng-model="filterEqAPU.unidad" style="width: 8ex;"> </th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th class="bg-orange"></th>
					<th class="bg-green"></th>
					<th class="bg-green"></th>
					<th class="bg-green"></th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="e in myapu.equipos | filter: filterEqAPU track by $index">
					<td> 
						<button type="button" class="hollow  button alert tiny" ng-click="removeRecursoFrom('equipos', e, myapu.equipos)"> x </button> 
						<span ng-bind="$index+1"></span>
					</td>
					<td ng-bind="e.codigo"></td>
					<td ng-bind="e.descripcion_equipo"></td>
					<td ng-bind="e.unidad"></td>
					<td> 
						<input type="text" class="thin-input" ng-model="e.cantidad" 
							ng-change="calc_subtotal(e); calcular_equipos()" ng-init="e.cantidad = e.cantidad?e.cantidad:1" style="width: 7ex;"> 
					</td>
					<td> 
						<input type="text" class="thin-input" ng-model="e.rendimiento" 
							ng-change="calc_subtotal(e); calcular_equipos()" ng-init="e.rendimiento = e.rendimiento?e.rendimiento:1" style="width: 7ex;"> 
					</td>
					<td ng-bind="e.costo_unidad | currency : '$ '"></td>
					<td ng-bind="e.subtotal | currency : '$ '" ng-init="calc_subtotal(e);calcular_equipos()"></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="12"> - </td>
				</tr>
			</tbody>
