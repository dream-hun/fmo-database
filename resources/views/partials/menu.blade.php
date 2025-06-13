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
                <img src="{{ auth()->user()->avatar() }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
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
                    <li class="nav-header mt-3">CHILD PROTECTION PROGRAM</li>
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
                    @can('empowerment_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.empowerments.index') }}"
                               class="nav-link {{request()->is('admin/empowerments*')?'active':''}}">
                                <i class="bi bi-building"></i>
                                <p>{{ trans('cruds.empowerment.title') }}</p>
                            </a>
                        </li>
                    @endcan

                @endcan
                @can('house_hold_access')

                    @can('tank_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.tanks.index') }}"
                               class="nav-link {{ request()->is('admin/tanks') || request()->is('admin/tanks/*') ? 'active' : '' }}">
                                <i class="bi bi-water"></i>
                                <p>
                                    {{ trans('cruds.tank.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('girinka_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.girinkas.index') }}"
                               class="nav-link {{ request()->is('admin/girinkas') || request()->is('admin/girinkas/*') ? 'active' : '' }}">
                                <i class="bi bi-bookmark-check"></i>

                                </i>
                                <p>
                                    {{ trans('cruds.girinka.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('livestock_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.livestocks.index') }}"
                               class="nav-link {{ request()->is('admin/livestocks') || request()->is('admin/livestocks/*') ? 'active' : '' }}">
                                <i class="bi bi-bookmark-check"></i>

                                </i>
                                <p>
                                    {{ trans('cruds.livestock.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('fruit_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.fruits.index') }}"
                               class="nav-link {{ request()->is('admin/fruits') || request()->is('admin/fruits/*') ? 'active' : '' }}">
                                <i class="bi bi-tree"></i>


                                <p>
                                    {{ trans('cruds.fruit.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endcan
                @can('work_force_development_access')
                    <li class="nav-header mt-3">WORKFORCE DEVELOPMENT</li>
                    @can('scholarship_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.scholarships.index') }}"
                               class="nav-link {{ request()->is('admin/scholarships') || request()->is('admin/scholarships/*') ? 'active' : '' }}">
                                <i class="bi bi-building"></i>
                                <p>
                                    {{ trans('cruds.scholarship.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('transaction_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.transactions.index') }}"
                               class="nav-link {{ request()->is('admin/transactions') || request()->is('admin/transactions/*') ? 'active' : '' }}">
                                <i class="bi bi-people-fill"></i>
                                <p>
                                    {{ trans('cruds.vsla.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('individual_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.individuals.index') }}"
                               class="nav-link {{ request()->is('admin/individuals') || request()->is('admin/individuals/*') ? 'active' : '' }}">
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
                            <a href="{{ route('admin.toolkits.index') }}"
                               class="nav-link {{ request()->is('admin/toolkits') || request()->is('admin/toolkits/*') ? 'active' : '' }}">
                                <i class="bi bi-gear">

                                </i>
                                <p>
                                    {{ trans('cruds.toolkit.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('mvtc_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.mvtcs.index') }}"
                               class="nav-link {{ request()->is('admin/mvtcs') || request()->is('admin/mvtcs/*') ? 'active' : '' }}">
                                <i class="bi bi-building"></i>

                                <p>
                                    {{ trans('cruds.mvtc.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('training_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.trainings.index') }}"
                               class="nav-link {{ request()->is('admin/trainings') || request()->is('admin/trainings/*') ? 'active' : '' }}">
                                <i class="bi bi-building"></i>

                                <p>
                                    {{ trans('cruds.training.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endcan

                <li class="nav-header mt-3">URGENT COMMUNITY SUPPORT</li>
                @can('urgent_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.urgents.index') }}"
                           class="nav-link {{ request()->is('admin/urgents') || request()->is('admin/urgents/*') ? 'active' : '' }}">
                            <i class="bi bi-building"></i>
                            <p>
                                {{ trans('cruds.urgent.title') }}
                            </p>
                        </a>
                    </li>
                @endcan

                <li class="nav-header mt-3">ZAMUKA PROGRAMS</li>
                @can('zamuka_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.zamukas.index') }}"
                           class="nav-link {{ request()->is('admin/zamukas') || request()->is('admin/zamukas/*') ? 'active' : '' }}">
                            <i class="bi bi-building"></i>
                            <p>
                                {{ trans('cruds.zamuka.title') }}
                            </p>
                        </a>
                    </li>
                @endcan

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
