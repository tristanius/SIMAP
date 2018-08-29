			<thead>
				<tr>
					<th colspan="6">Personal</th>
					<th>Subtotal</th>
					<th class="bg-light-orange"> <span ng-bind="myapu.subtotal_personal | currency : '$ '"></span> </th>
					<th class="bg-orange"> </th>
					<th class="bg-green" colspan="2"> subtotal</th>
					<th class="bg-green"> # </th>
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
			</thead>
			<tbody>
				<tr ng-repeat="p in myapu.personal track by $index">
					<td ng-bind="$index+1"></td>
					<td ng-bind="p.codigo"></td>
					<td ng-bind="p.cargo"></td>
					<td ng-bind="p.unidad"></td>
					<td> 
						<input type="text" class="thin-input" ng-model="p.cantidad" 
							ng-change="calc_subtotal(p); calcular_personal()" ng-init="p.cantidad = p.cantidad?p.cantidad:1;" style="width: 7ex;"> 
					</td>
					<td> 
						<input type="text" class="thin-input" ng-model="p.rendimiento" 
							ng-change="calc_subtotal(p); calcular_personal()" ng-init="p.rendimiento = p.rendimiento?p.rendimiento:1;" style="width: 7ex;"> 
					</td>
					<td ng-bind="p.costo_unidad | currency : '$ '"></td>
					<td ng-bind="p.subtotal | currency : '$ '" ng-init="calc_subtotal(p); calcular_personal()"></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="12"> - </td>
				</tr>
			</tbody>