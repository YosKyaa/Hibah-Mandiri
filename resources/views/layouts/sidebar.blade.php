<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme no-print">
    <div class="app-brand demo ">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo" style="margin-left: -10px">
                <img src="{{ asset('assets/img/logo_lppm_jgu2.png') }}" height="44">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto bg-primary">
            <i class="bx bx-chevron-right bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Main Menu</span>
        </li>
        <li class="menu-item {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboard</div>
            </a>
        </li>
        <li class="menu-item {{ request()->segment(1) == 'user-announcements' ? 'active' : '' }}">
            <a href="{{ route('user-announcements.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                <div data-i18n="Dashboards">Pengumuman</div>
            </a>
        </li>
        <li class="menu-item {{ request()->segment(1) == 'user-proposals' ? 'active' : '' }}">
            <a href="{{ route('user-proposals.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Dashboards">Pengajuan</div>
            </a>
        </li>
        @can('manage_reviewer')
        <li class="menu-item {{ request()->segment(1) == 'reviewer' ? 'active' : '' }}">
            <a href="{{ route('reviewers.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-reader"></i>
                <div data-i18n="Dashboards">Review Proposals</div>
                <!-- <span class="notification-badge" id="">3</span> -->
            </a>
        </li>
        @endcan
        @can('manage_warek1')
        <li class="menu-item {{ request()->segment(1) == 'vicerector1' ? 'active' : '' }}">
            <a href="{{ route('vicerector1.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-reader"></i>
                <div data-i18n="Dashboards">Verifikasi Warek I</div>
                <!-- <span class="notification-badge" id="">3</span> -->
            </a>
        </li>
        @endcan
        @can('manage_warek2')
        <li class="menu-item {{ request()->segment(1) == 'vicerector2' ? 'active' : '' }}">
            <a href="{{ route('vicerector2.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-reader"></i>
                <div data-i18n="Dashboards">Verifikasi Warek II</div>
                <!-- <span class="notification-badge" id="">3</span> -->
            </a>
        </li>
@endcan
        @can('control panel.read')
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Control Panel</span>
            </li>
        @endcan
        @can('setting.read')
            <li class="menu-item {{ request()->segment(1) == 'setting' ? 'open active' : '' }}">
                <a href="#" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div>Pengaturan</div>
                </a>
                <ul class="menu-sub">
                    @can('setting/manage_account.read')
                        <li class="menu-item {{ request()->segment(2) == 'manage_account' ? 'open active' : '' }}">
                            <a href="" class="menu-link menu-toggle">
                                <div>Kelola Akun</div>
                            </a>
                            <ul class="menu-sub">
                                @can('setting/manage_account/users.read')
                                    <li class="menu-item {{ request()->segment(3) == 'users' ? 'active' : '' }}">
                                        <a href="{{ route('users.index') }}" class="menu-link">
                                            <div>Users</div>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting/manage_account/roles.read')
                                    <li class="menu-item {{ request()->segment(3) == 'roles' ? 'active' : '' }}">
                                        <a href="{{ route('roles.index') }}" class="menu-link">
                                            <div>Roles</div>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting/manage_account/permissions.read')
                                    <li class="menu-item {{ request()->segment(3) == 'permissions' ? 'active' : '' }}">
                                        <a href="{{ route('permissions.index') }}" class="menu-link">
                                            <div>Permissions</div>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    @can('setting/manage_data.read')
                        <li class="menu-item {{ request()->segment(2) == 'manage_data' ? 'open active' : '' }}">
                            <a href="" class="menu-link menu-toggle">
                                <div>Kelola Data</div>
                            </a>
                            <ul class="menu-sub">
                                @can('setting/manage_data/study_program.read')
                                    <li class="menu-item {{ request()->segment(3) == 'studyprogram' ? 'active' : '' }}">
                                        <a href="{{ route('program.index') }}" class="menu-link">
                                            <div>Study Program</div>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting/manage_data/department.read')
                                    <li class="menu-item {{ request()->segment(3) == 'department' ? 'active' : '' }}">
                                        <a href="{{ route('dept.index') }}" class="menu-link">
                                            <div>Departement</div>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
                <li class="menu-item {{ request()->segment(1) == 'cms' ? 'active' : '' }}">
                    <a href="{{ route('cms.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-book-reader"></i>
                        <div data-i18n="Dashboards">CMS</div>
                      
                    </a>
                </li>
            </li>
        @endcan
        @can('manage_admin')
        <li class="menu-header small text-uppercase">
                <span class="menu-header-text">ADMIN</span>
            </li>
        <li class="menu-item {{ request()->segment(1) == 'admin' ? 'open active' : '' }}">
                <a href="#" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div>Manage Proposals</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->segment(2) == 'proposals' ? 'active' : '' }}">
                        <a href="{{ route('proposals.index') }}" class="menu-link">

                            <div>Data</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->segment(2) == 'addreviewer' ? 'active' : '' }}">
                        <a href="{{ route('addreviewer.index') }}" class="menu-link">

                            <div>Reviewer</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->segment(2) == 'presentation' ? 'active' : '' }}">
                        <a href="{{ route('presentation.index') }}" class="menu-link">

                            <div>Presentasi</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->segment(2) == 'fundsfinalization' ? 'active' : '' }}">
                        <a href="{{ route('fundsfinalization.index') }}" class="menu-link">

                            <div>Finalisasi Dana</div>
                        </a>
                    </li>
                    <!-- <li class="menu-item {{ request()->segment(2) == 'loa' ? 'active' : '' }}">
                        <a href="{{ route('loa.index') }}" class="menu-link">

                            <div>LoA & Kontrak</div>
                        </a>
                    </li> -->
                    <li class="menu-item {{ request()->segment(2) == 'monev' ? 'active' : '' }}">
                        <a href="{{ route('monev.index') }}" class="menu-link">

                            <div>Verifikasi Monev</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item {{ request()->segment(1) == 'announcements' ? 'active' : '' }}">
                <a href="{{ route('announcements.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-upload"></i>
                    <div data-i18n="Dashboards">Kelola Pengumuman</div>
                </a>
            </li>
            @endcan
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Dokumentasi</span>
            </li>
            <li class="menu-item {{ request()->segment(1) == 'dokumentasi' ? 'active' : '' }}">
                <a href="{{ route('dokumentasi') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Dashboards">Dokumentasi</div>
                </a>
            </li>
    </ul>
</aside>
<!-- / Menu -->
