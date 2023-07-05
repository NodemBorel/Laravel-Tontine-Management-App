<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ url('home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Contribute
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link" href="{{ url('user-profile') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Account
                </a>               
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Welcome To:</div>
            TontineR
        </div>
    </nav>
</div>