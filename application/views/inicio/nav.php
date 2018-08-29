<div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
  <div class="title-bar-title"><a href="#" data-toggle="offCanvas">Menú</a></div>
</div>

<div class="top-bar" id="responsive-menu">
  <div class="top-bar-left">
    <ul class="menu">
      <li class="menu-text"> <img src="<?= base_url('assets/img/termotecnica.png') ?>" width="80"> </li>
      <li><a href="#" data-toggle="offCanvas">Menú</a></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="has-submenu">
        <a href="">S.I.M.A.P.</a>
        <ul class="submenu menu vertical" data-submenu>
          <li><a href="">Sistema de Manejo de A.P.U. y Programación de obra</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>

<style type="text/css">
  .top-bar{
    padding: 1px;
  }
  .top-bar .top-bar-left li{
    padding: 5px;
  }
  .title-bar, .top-bar, .top-bar ul{
    background: #FFF;
    color: #000;
  }
  div.title-bar, div.top-bar{
    box-shadow: 0px 0px 3px #555;
    margin-bottom: 1ex;
  }
</style>