<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                        Administrador
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i>Cultivo</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=1" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Fincas</a>
                            </li>
                            <li @click="menu=2" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Historico cultivo</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Productores</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i> Detalle Productores</a>
                            </li>
                            <li @click="menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Control Fitosanitario</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Ventas</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=5" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-basket-loaded"></i> Ventas</a>
                            </li>
                            <li  @click="menu=6" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Categorias Mora</a>
                            </li>
                            <li  @click="menu=23" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Lugares de Venta</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                            </li>
                            <li @click="menu=8" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i>Caracterizacion</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=9" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Predio y cultivo </a>
                            </li>
                            <li @click="menu=10" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Podas</a>
                            </li>
                            <li @click="menu=11" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Estado fitosanitario:Plagas</a>
                            </li>
                            <li @click="menu=12" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Nutricion</a>
                            </li>
                            <li @click="menu=13" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Tutorado</a>
                            </li>
                            <li @click="menu=14" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Riego</a>
                            </li>
                            <li @click="menu=15" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Buenas practicas agricolas</a>
                            </li>
                            <li @click="menu=16" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Conservacion de suelos</a>
                            </li>
                            <li @click="menu=17" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Vocacion del encuestado</a>
                            </li>
                            <li @click="menu=18" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Cosecha,produccion y venta</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Encuestas</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=19" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Visita Extensionista</a>
                            </li>
                            <li @click="menu=20" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Reporte Ventas</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>