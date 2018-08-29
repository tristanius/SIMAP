<section id="form_importar_apu" class="vmodal no-display" ng-init="init_modal('#form_importar_apu')" ng-controller="importar_apu">
	<div class="vmodal-content">
		<nav aria-label="You are here:" role="navigation">
			<ul class="breadcrumbs">
				<ul class="breadcrumbs">
					<li><a href="#">APU</a></li>
					<li><a href="#">Gestión de APU</a></li>
					<li class="disabled">Importar APU</li>
				</ul>
			</ul>
		</nav>
		<h4>Importar item de APU</h4>
		  
		<button class="close-button" data-close aria-label="Close reveal" type="button">
		    <span aria-hidden="true">&times;</span>
		</button>

		<fieldset class="fieldset">
			<legend>Seleccion de archivo</legend>
			
			<div class="grid-container full">
				<div class="grid-x grid-padding-x callout secondary">
			  		<div class="medium-5 cell">
			  			<label for="import_apu">
			  				Selecciona aquí el archivo:
							<input type="file" id="import_apu" name="import_apu" ng-init="resetInputFile('#import_apu')" style="display: inline-block;" ng-disabled="!proyecto && !proyecto.idproyecto">
						</label>
			  		</div>

			  		<div class="medium-6 cell">
			  			<button class="button primary" 
			  				ng-click="subirArchivo('#import_apu', '#pg_import_apu', '<?= site_url('apu/import_apu') ?>')"
			  				ng-disabled="!proyecto && !proyecto.idproyecto">
			  				Importar desde archivo
			  			</button> 
			  		</div>

					<progress id="pg_import_apu" value="0" max="100" style="width:100%"></progress>	

					<img src="<?= base_url('assets/img/loader.gif') ?>" style="width: 50px; height: 50px;" ng-show="loader">
			  	</div>
			</div>
			

		</fieldset>

		<div>
			Resultados: 
			<table>
				<tbody>
					<tr ng-repeat="rs in resultados['items']">
						<td ng-repeat="c in rs" ng-bind="c"></td>
					</tr>
				</tbody>
			</table>
		</div>

		<p>
			<button class="hollow button alert" ng-click="vmodal('#form_importar_apu', 'close'); resultados=[]"> <i class="fas fa-save"></i> Volver </button>
		</p>
	</div>
</section>