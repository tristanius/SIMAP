<ul id="menu-lateral" class="vertical menu accordion-menu" data-accordion-menu>
	<li class="menu-text">
		<p><img src="<?= base_url('assets/img/termotecnica.png') ?>" width="100"></p>
        <div>
            <span style="color:#3B61A4">Usuario: xxxxxx</span>
        </div>
	</li>

    <li class="divider"></li>
    <li class="header-divider"> A.P.U. :</li>

    <li>        
       <a href="#">Proyecto</a>

       <ul class="menu vertical nested">
            <li><a href="<?= site_url('proyecto/gestion') ?>">Maestro de info. proyectos</a></li>            
        </ul>
    </li>
    <li>
    	<!-- personal -->
       <a href="#">Personal</a>

       <ul class="menu vertical nested">
        	<li><a href="<?= site_url('personal/importar') ?>">Maestros cargos personal</a></li>
        </ul>
    </li>
    <li>
        <a href="#">Equipos</a>
        <ul class="menu vertical nested">
            <li><a href="<?= site_url('equipo/importar') ?>">Maestro de equipo</a></li>
        </ul>
    </li>
    <li><a href="#">Material</a>
        <ul class="menu vertical nested">
            <li><a href="<?= site_url('material/importar') ?>">Maestro de material</a></li>        
        </ul>
    </li>


    <li><a href="#">A.P.U.´s</a>
        <ul class="menu vertical nested">      
            <li><a href="<?= site_url('apu/gestion') ?>">Maestro de A.P.U. por proyecto</a></li>    
            <li><a href="<?= site_url('apu/consulta') ?>">Consulta APU</a></li>     
            <li><a href="#">Informe comprativo APU</a></li>     
        </ul>
    </li>

    <li class="divider"></li>
    <li class="header-divider"> Programación de obra:</li>


    <li><a href="#">Cronograma</a>
        <ul class="menu vertical nested">
            <li><a href="<?= site_url('project/cronograma') ?>">Gantt</a></li>
            <li><a href="<?= site_url('priject/recursos') ?>">Recursos</a></li>       
        </ul>
    </li>
    <li><a href="#">Informes</a>
        <ul class="menu vertical nested">
            <li><a href="<?= site_url('informe/diagramas') ?>">Diagramas</a></li>
            <li><a href="<?= site_url('informe/export/flex') ?>">Exportar informes</a></li>
        </ul>
    </li>


    <li class="divider"></li>
    <li class="header-divider"> Sesion:</li>


    <li>
        <a href="#">Volver a panel</a>
    </li>
    <li>
        <a href="#">Cerrar sesión</a>
    </li>

</ul>


<style type="text/css">
    #menu-lateral > li > a{
        border-bottom: 1px solid #999;
        color: #3B61A4;
    }

    #menu-lateral > li ul li a{
        border-top: 1px solid #999;
        border-left: 1px solid #999;
        background: #3B61A4;
        color: #FFF;
    }

    li.divider{
        margin-top: 1ex;
        border-bottom: 1px #777 solid;
    }

    li.header-divider{
        color: #777;
        padding: 1ex;
    }
    .off-canvas{
        background: #FFF;
    }
</style>