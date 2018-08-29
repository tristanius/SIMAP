<div id="form_item" class="vmodal no-display" ng-init="init_modal('#form_item')">
	<div class="vmodal-content">
		<h4> <img src="<?= base_url('assets/img/termotecnica.png') ?>" width="100"> Formulario de Item (APU) del propyecto</h4>
		  
		<button class="close-button" ng-click="vmodal('#form_item', 'close');" type="button">
			<span aria-hidden="true">&times;</span>
		</button>

		<p><div style="border:1px solid #4491DD"></div></p>

		<div class="grid-x grid-padding-x grid-margin-x font12 callout">

			<div class="input-group cell large-3">
				<span class="input-group-label bg-gray-blue"> <b>No. Item :</b> </span>
				<input class="input-group-field" type="text" ng-model="formItem.item" style="margin: auto;" placeholder="No. de item">
			</div>

			<div class="input-group cell large-8">
				<span class="input-group-label bg-gray-blue"> <b>Descripción:</b> </span>
				<input class="input-group-field" type="text" ng-model="formItem.descripcion" style="margin: auto;" placeholder="Ej: Excavación de material ....">
			</div>

			<div class="input-group cell large-3">
				<span class="input-group-label bg-gray-blue"> <b>Unidad :</b> </span>
				<select class="input-group-field" style="margin: auto;" ng-model="formItem.unidad">
					<option value="">Sin selección</option>
					<option value="m3">m3</option>
					<option value="m2">m2</option>
					<option value="metro">Metro</option>
					<option value="km">Km</option>
					<option value="Ha">Hectarea (ha)</option>
					<option value="hr">hr</option>
					<option value="dia/m3">dia/m3</option>
					<option value="día">día</option>
					<option value="mes">mes</option>
					<option value="UN">UN</option>
					<option value="und">und</option>
					<option value="ton">ton</option>
					<option value="kg">Kg</option>
					<option value="Lb">Lb</option>
					<option value="turno">Turno</option>
					<option value="gal">Gal</option>
					<option value="Litro">Litro (L)</option>
					<option value="LT">Litro (LT)</option>
					<option value="rollo">Rollo</option>
					<option value="kit">Kit</option>
					<option value="cm">cm</option>
				</select>
			</div>

			<div class="input-group cell large-3">
				<span class="input-group-label bg-gray-blue"> <b>Tipo :</b> </span>
				<select class="input-group-field" style="margin: auto;" ng-model="formItem.tipo" placeholder="Selecciona un tipo de APU" >
					<option value="">Sin selección</option>
					<option value="Actividad">Actividad</option>
					<option value="Equipo">Equipo</option>
					<option value="Personal">Personal</option>
					<option value="Material">Material</option>
				</select>
			</div>


			<div class="input-group cell large-3">
				<span class="input-group-label bg-gray-blue"> <b>Grupo :</b> </span>
				<select class="input-group-field" style="margin: auto;" ng-model="formItem.grupo">
					<option value="">Sin selección</option>
					<option ng-repeat="g in proyecto.lista_grupo_apu" value="{{g.nombre_grupo}}">{{g.nombre_grupo}}</option>
				</select>
			</div>
			
			<div class="input-group cell large-3">
				<span class="input-group-label bg-gray-blue"> <b>Clasificacion :</b> </span>
				<select class="input-group-field" style="margin: auto;" ng-model="formItem.clasificacion" >
					<option value="">Sin selección</option>
					<option ng-repeat="g in proyecto.lista_clasificacion_apu" value="{{g.nombre_clasificacion}}">{{g.nombre_clasificacion}}</option>
				</select>
			</div>

			<div class="input-group cell large-3">
				<span class="input-group-label bg-gray-blue"> <b>Composición :</b> </span>
				<select class="input-group-field" style="margin: auto;" ng-model="formItem.composicion">
					<option value="">Sin selección</option>
					<option value="Simple">Simple</option>
					<option value="Compuesto">Compuesto</option>
				</select>
			</div>

			<div class="input-group cell large-3">
				<span class="input-group-label bg-gray-blue"> <b>Cantidad estimada:</b> </span>
				<input class="input-group-field" type="text" style="margin: auto;" placeholder="550" ng-model="formItem.cantidad" >
			</div>

			<div></div>

		</div>

		<p></p>

		<div class="float-right">
			<button class="btn-green button" ng-click="save_item('<?= site_url('apu/save') ?>', '#form_item'); selectVersion('<?= site_url('apu/subtotales_proyecto') ?>', filterItems.version_idversion)" 
				ng-disabled="!formItem.item && !formItem.descripcion && !formItem.unidad && !formItem.tipo"> 
				<i class="fas fa-check-circle"></i> Guardar Item 
			</button>
			<button class="hollow button alert" ng-click="vmodal('#form_item', 'close');" > 
				<i class="fas fa-times-circle"></i> Volver
			</button>
		</div>
		<div class="clearfix"></div>
	</div>
</div>