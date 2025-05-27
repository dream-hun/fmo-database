<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('logo.png') }}" alt="FMO Rwanda Logo" class="brand-image img-circle elevation-0"
            style="opacity: .8">
        <span class="brand-text font-weight-light"> &nbsp;</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{auth()->user()->avatar()}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @can('childprotection_access')
                    <li
                        class="nav-item {{ request()->is("admin/malnutritions*") ? "menu-open" : "" }} {{ request()->is("admin/school-feedings*") ? "menu-open":""}} {{request()->is("admin/ecds*") ? "menu-open":""}}">
                        <a href="#"
                            class="nav-link {{ request()->is('admin/malnutritions*') ? 'active' : '' }}">
                            <i class="bi bi-people-fill"></i>
                            <p>
                                {{ trans('cruds.childprotection.title') }}
                                <i class="bi bi-chevron-down right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview" style="{{ request()->is('admin/malnutritions*') ? 'display: block;' : 'display: none;' }}">
                            @can('malnutrition_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.malnutritions.index') }}"
                                        class="nav-link {{ request()->is('admin/malnutritions*') ? 'active' : '' }}">
                                        <i class="bi bi-person-plus-fill"></i>
                                        <p>{{ trans('cruds.malnutrition.title') }}</p>
                                    </a>
                                </li>
                            @endcan
                            @can('ecd_access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.ecds.index') }}"
                                       class="nav-link {{ request()->is('admin/ecds*') ? 'active' : '' }}">
                                        <i class="bi bi-person-plus-fill"></i>
                                        <p>{{ trans('cruds.ecd.title') }}</p>
                                    </a>
                                </li>
                            @endcan
                            @can('school_feeding_access')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.school-feedings.index') }}"
                                           class="nav-link {{ request()->is('admin/school-feedings*') ? 'active' : '' }}">
                                            <i class="bi bi-person-plus-fill"></i>
                                            <p>{{ trans('cruds.schoolFeeding.title') }}</p>
                                        </a>
                                    </li>
                            @endcan


                        </ul>
                    </li>
                @endcan
                @can('house_hold_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/tanks*") ? "menu-open" : "" }} {{ request()->is("admin/girinkas*") ? "menu-open" : "" }} {{ request()->is("admin/goats*") ? "menu-open" : "" }} {{ request()->is("admin/fruits*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/tanks*") ? "active" : "" }} {{ request()->is("admin/fruits*") ? "active" : "" }} {{ request()->is("admin/girinkas*") ? "active" : "" }} {{ request()->is("admin/goats*") ? "active" : "" }}" href="#">
                            <i class="bi bi-house-fill">

                            </i>
                            <p>
                                HHST
                                <i class="bi bi-chevron-down right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('tank_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tanks.index") }}" class="nav-link {{ request()->is("admin/tanks") || request()->is("admin/tanks/*") ? "active" : "" }}">
                                        <i class="bi bi-water"></i>

                                        </i>
                                        <p>
                                            {{ trans('cruds.tank.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('girinka_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.girinkas.index") }}" class="nav-link {{ request()->is("admin/girinkas") || request()->is("admin/girinkas/*") ? "active" : "" }}">
                                        <i class="bi bi-bookmark-check"></i>

                                        </i>
                                        <p>
                                            {{ trans('cruds.girinka.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('goat_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.goats.index") }}" class="nav-link {{ request()->is("admin/goats") || request()->is("admin/goats/*") ? "active" : "" }}">
                                        <i class="bi bi-bookmark-check"></i>

                                        </i>
                                        <p>
                                            {{ trans('cruds.goat.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('fruit_access')
                                    <li class="nav-item">
                                        <a href="{{ route("admin.fruits.index") }}" class="nav-link {{ request()->is("admin/fruits") || request()->is("admin/fruits/*") ? "active" : "" }}">
                                            <i class="bi bi-tree"></i>


                                            <p>
                                                {{ trans('cruds.fruit.title') }}
                                            </p>
                                        </a>
                                    </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('work_force_development_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/scholarships*") ? "menu-open" : "" }} {{ request()->is("admin/vslas*") ? "menu-open" : "" }} {{ request()->is("admin/individuals*") ? "menu-open" : "" }}{{ request()->is("admin/toolkits*")?"menu-open": "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/scholarships*") ? "active" : "" }} {{ request()->is("admin/vslas*") ? "active" : "" }} {{ request()->is("admin/individuals*") ? "active" : "" }}" href="#">
                            <i class="bi bi-chevron-down right"></i>
                            <p>
                                {{ trans('cruds.workForceDevelopment.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('scholarship_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.scholarships.index") }}" class="nav-link {{ request()->is("admin/scholarships") || request()->is("admin/scholarships/*") ? "active" : "" }}">
                                        <i class="bi bi-building"></i>


                                        <p>
                                            {{ trans('cruds.scholarship.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('vsla_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.vslas.index") }}" class="nav-link {{ request()->is("admin/vslas") || request()->is("admin/vslas/*") ? "active" : "" }}">
                                        <i class="bi bi-people-fill"></i>


                                        <p>
                                            {{ trans('cruds.vsla.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('individual_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.individuals.index") }}" class="nav-link {{ request()->is("admin/individuals") || request()->is("admin/individuals/*") ? "active" : "" }}">
                                        <i class="bi bi-person">

                                        </i>
                                        <p>
                                            {{ trans('cruds.individual.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('toolkit_access')
                                    <li class="nav-item">
                                        <a href="{{ route("admin.toolkits.index") }}" class="nav-link {{ request()->is("admin/toolkits") || request()->is("admin/toolkits/*") ? "active" : "" }}">
                                            <i class="bi bi-gear">

                                            </i>
                                            <p>
                                                {{trans('cruds.toolkit.title')}}
                                            </p>
                                        </a>
                                    </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('urgent_community_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/scholarships*") ? "menu-open" : "" }} {{ request()->is("admin/vslas*") ? "menu-open" : "" }} {{ request()->is("admin/individuals*") ? "menu-open" : "" }}{{ request()->is("admin/toolkits*")?"menu-open": "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/scholarships*") ? "active" : "" }} {{ request()->is("admin/vslas*") ? "active" : "" }} {{ request()->is("admin/individuals*") ? "active" : "" }}" href="#">
                            <i class="bi bi-chevron-down right"></i>
                            <p>
                                {{ trans('cruds.workForceDevelopment.title') }}

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('scholarship_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.scholarships.index") }}" class="nav-link {{ request()->is("admin/scholarships") || request()->is("admin/scholarships/*") ? "active" : "" }}">
                                        <i class="bi bi-building"></i>


                                        <p>
                                            {{ trans('cruds.scholarship.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('vsla_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.vslas.index") }}" class="nav-link {{ request()->is("admin/vslas") || request()->is("admin/vslas/*") ? "active" : "" }}">
                                        <i class="bi bi-people-fill"></i>


                                        <p>
                                            {{ trans('cruds.vsla.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('individual_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.individuals.index") }}" class="nav-link {{ request()->is("admin/individuals") || request()->is("admin/individuals/*") ? "active" : "" }}">
                                        <i class="bi bi-person">

                                        </i>
                                        <p>
                                            {{ trans('cruds.individual.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('toolkit_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.toolkits.index") }}" class="nav-link {{ request()->is("admin/toolkits") || request()->is("admin/toolkits/*") ? "active" : "" }}">
                                        <i class="bi bi-gear">

                                        </i>
                                        <p>
                                            {{trans('cruds.toolkit.title')}}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
