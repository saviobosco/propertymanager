<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="{{ config('app.name') }} Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"> P-Manager </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> <?= auth()->user()->name ?>  </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('user.dashboard.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link text-uppercase">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Rentals
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.properties.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Properties</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manager.properties.rent_roll') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rent roll</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manager.tenants.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tenants</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manager.rental_owners.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rental owners</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Outstanding balances</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link text-uppercase">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            LEASING
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.properties.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Listings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Applicants</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manager.properties.leases.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>eLeases and draft leases</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lease renewals</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link text-uppercase">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Accounting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Financials</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General ledger</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banking</p>
                            </a>
                        </li>
                        <li>
                            <hr>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bills</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recurring transactions</p>
                            </a>
                        </li>
                        <li>
                            <hr>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Budgets</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Charts of accounts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Company financials</p>
                            </a>
                        </li>
                        <li>
                            <hr>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>1099 tax filings</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link text-uppercase">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Maintenance
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vendors</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Work orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Property inspections</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link text-uppercase">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Tasks
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.tasks.index', ['searchOption' => 'new']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Incoming requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.tasks.index', ['searchOption' => 'me']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My tasks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.tasks.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All tasks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.recurring_tasks.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recurring tasks</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link text-uppercase">
                        <i class="nav-icon fas fa-comment"></i>
                        <p>
                            Communication
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Public site</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Resident center settings</p>
                            </a>
                        </li>
                        <li>
                            <hr>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Announcements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mailings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Emails</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Automated email settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mailing and email templates</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-uppercase">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Files
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-uppercase">
                        <i class="nav-icon fas fa-hand-paper"></i>
                        <p>
                            Reports
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-uppercase">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Analytics hub
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
