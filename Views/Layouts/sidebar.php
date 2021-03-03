  <aside class="main-sidebar">
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/user/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $username['name']; ?></p>
          <a href=""><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
<!--       <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <ul class="sidebar-menu" data-widget="tree">
        <li class="active"><a href="index.php?url="><i class="fa fa-dashboard"></i> <span>Index</span></a></li>
        <li><a href="index.php?url=notificaciones"> <span>Notificaciones</span></a></li>
        <li><a href="index.php?url=influencers"> <span>Recursos</span></a></li>
        <li><a href="index.php?url=presupuesto"> <span>Presupuestos</span></a></li>
        <li><a href="index.php?url=compensar"> <span>Compensar</span></a></li>
        <li><a href="index.php?url=cuenta"> <span>Cuenta</span></a></li>
        <li><a href="index.php?url=logout"><i class="glyphicon glyphicon-log-out"></i> <span>Log Out</span></a></li>
      </ul>

    </section>
  </aside>