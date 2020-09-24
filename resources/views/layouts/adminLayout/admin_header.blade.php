<!--Parte del header-->
<div id="header">
  <h1>frutexco</h1>
</div>
<!--Final del header-->

<!--Menu superior del header-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav"><li class=""><a title="" ><span class="text">Bienvenid@ {{ Session::get('adminDetails')['username'] }} ({{ Session::get('adminDetails')['type'] }})</span></a></li>
    <li class=""><a title="" href="{{ url('/admin/settings') }}"><i class="icon icon-cog" style="color: black;"></i> <span class="text" >Ajustes</span></a></li>
    <li class=""><a title="" href="{{ url('/logout') }}"><i class="icon icon-share-alt" style="color: black;"></i> <span class="text">Cerrar sesión</span></a></li>
  </ul>
 
</div>

<!--Final del menu superior del header-->
