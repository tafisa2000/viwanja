<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!-- User details -->
        <!-- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('login') }}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-truck-delivery"></i>
                        <span>Manage Projects</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.project') }}">All Projects</a></li>
                        <li><a href="{{ route('project.add') }}">Add Project</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-truck-delivery"></i>
                        <span>Manage Categories</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.category') }}">All Categories</a></li>
                        <li><a href="{{ route('category.add') }}">Add Category</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-truck-delivery"></i>
                        <span>Manage Plots</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.plots') }}">All Plots</a></li>
                    </ul>
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Customers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.customers') }}">All Customers</a></li>
                        <li><a href="{{ route('credit.customers') }}">Credit Customers</a></li>
                        <li><a href="{{ route('customers.purchases') }}">Customers Purchases</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Invoices</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.invoices') }}">All Invoices</a></li>
                        {{-- @if (Auth::user()->role_id == 2) --}}
                        <li><a href="{{ route('pending.invoices') }}">Approval Invoice</a></li>
                        {{-- @endif --}}
                        <li><a href="{{ route('daily.invoice.report') }}">Daily Invoice Report</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-storefront-outline"></i>
                        <span>Manage Expense Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('categoryExpense.all') }}">All Categories</a></li>
                        <li><a href="{{ route('categoryExpense.add') }}">Add Category</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-hand-holding-usd"></i>
                        <span>Manage Expenses</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('expense.add') }}">Add Expense</a></li>
                        <li><a href="{{ route('today.expense') }}">All Expense</a></li>
                        <li><a href="{{ route('wisely.expense') }}">Wisely Expense</a></li>
                        {{-- <li><a href="{{ route('monthly.expense') }}">Monthly Expense </a></li>
                        <li><a href="{{ route('yearly.expense') }}">Yearly Expense </a></li>
                        <li><a href="{{ route('wisely.expense') }}">Daily Expense </a></li> --}}
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-hand-holding-usd"></i>
                        <span>Manage User</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.user') }}">All Users</a></li>
                        <li><a href="{{ route('all.role') }}">All Roles</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-hand-holding-usd"></i>
                        <span>Manage Notifications</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.notification') }}">All Notifications</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar --><!-- Sidebar -->
    </div>
</div>
