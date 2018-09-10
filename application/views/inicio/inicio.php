<section>
	
	<nav aria-label="You are here:" role="navigation">
		<ul class="breadcrumbs">
			<li><a href="#">SIMAP</a></li>
			<li class="disabled">Inicio</li>
		</ul>
	</nav>

	<div class="text-center">
		<h3>Sistema para modulos de ayuda de APU y proyectos</h3>
		<p class="lead">Sistema en fase de prodicción, alpha v1.1</p>
		<a href="#" class="button large">ver más</a>
		<a href="#" class="button large hollow">Ir al panel de entrada</a>
		
		<p>
			<img src="<?= base_url('assets/img/ot.png') ?>" style="width:40ex">
			<div>
				<ul class="left-align browser-default">
					<li>Usuario: <span><?= $this->session->userdata('nombre_usuario') ?></span> </li>
					<li>Rol: <span><?= $this->session->userdata('nombre_rol') ?></span> </li>
					<li>C.O. asociado: <span><?= $this->session->userdata('base') ?></span> </li>
					<li>Estado: Activo</li>
				</ul>
			</div>
		</p>
	</div>

</section>