			<thead>
				<tr>
					<th colspan="6">Material</th>
					<th>Subtotal</th>
					<th class="bg-light-orange"> <span ng-bind="myapu.subtotal_material | currency : '$ '"></span> </th>
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
					<th> <input type="text" class="thin-input" ng-model="filterMatAPU.codigo" style="width: 8ex;" > </th>
					<th> <input type="text" class="thin-input" ng-model="filterMatAPU.descripcion_material" style="width: 8ex;" > </th>
					<th> <input type="text" class="thin-input" ng-model="filterMatAPU.unidad" style="width: 8ex;" > </th>
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
				<tr ng-repeat="m in myapu.materiales | filter: filterMatAPU track by $index">
					<td ng-bind="$index+1"></td>
					<td ng-bind="m.codigo"></td>
					<td ng-bind="m.descripcion_material"></td>
					<td ng-bind="m.unidad"></td>					
					<td> 
						<input type="text" class="thin-input" ng-model="m.cantidad" 
							ng-change="m.subtotal = (m.cantidad * m.costo_unidad); calcular_material()" ng-init="m.cantidad = m.cantidad?m.cantidad:1" style="width: 7ex;"> 
					</td>
					<td> 
						<input type="text" class="thin-input" ng-model="m.rendimiento" 
							ng-change="m.subtotal = (m.cantidad * m.costo_unidad); calcular_material()" ng-init="m.rendimiento = m.rendimiento?m.rendimiento:0" style="width: 7ex;"> 
					</td>
					<td ng-bind="m.costo_unidad | currency : '$ '"></td>
					<td ng-bind="m.subtotal | currency : '$ '" ng-init="m.subtotal = (m.cantidad * m.costo_unidad);"></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="12"> - </td>
				</tr>
			</tbody>
