<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav ">
                <a class="px-4 " href="/"><img src="{{ asset('./images/logo.png') }}" width="120" alt=""></a>

                <a class="nav-link pt-5" href="/berandaAdmin">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    BERANDA
                </a>

                @if (session('role_id') == 2)
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                        MENGELOLA AKUN
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/akun-siswa"><i class="fas fa-user-alt"></i>&nbsp;&nbsp;AKUN SISWA</a>
                            <a class="nav-link" href="/akun-admin"><i class="fas fa-user-shield"></i>&nbsp;AKUN ADMIN</a>
                        </nav>
                    </div>
                @endif

                <a class="nav-link" href="/kelola-materi">
                    <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                    MENGELOLA MATERI
                </a>
                <a class="nav-link" href="/daftar-lencana">
                    <div class="sb-nav-link-icon"><i class="fas fas fa-medal"></i></div>
                    LENCANA SISWA
                </a>
                <a class="nav-link" href="/pencapaian-siswa">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                    PENCAPAIAN SISWA
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <i class="fas fa-sign-out"></i> &nbsp;LOG OUT
        </div>
    </nav>
</div>
