 <div class="vertical-menu">

     <div data-simplebar class="h-100">

         <!-- User details -->
         <!--- Sidemenu -->
         <div id="sidebar-menu">
             <!-- Left Menu Start -->
             <ul class="metismenu list-unstyled" id="side-menu">
                 <li class="menu-title">Menu</li>

                 <li>
                     <a href="{{ route('login') }}" class="waves-effect">
                         <i class="mdi mdi-view-dashboard-outline"></i><span
                             class="badge rounded-pill bg-success float-end">3</span>
                         <span>Dashboard</span>
                     </a>
                 </li>


                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="mdi mdi-truck-delivery"></i>

                         <span>Manage Project</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('all.project') }}">all Project</a></li>
                         <li><a href="{{ route('project.add') }}">add Project</a></li>
                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="mdi mdi-truck-delivery"></i>

                         <span>Manage Categories</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('all.category') }}">all Categories</a></li>
                         <li><a href="{{ route('category.add') }}">add Categories</a></li>
                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="mdi mdi-truck-delivery"></i>

                         <span>Manage Plots</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('all.plots') }}">all plots</a></li>
                     </ul>
                 </li>


                 {{-- <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="mdi mdi-storefront-outline"></i>

                         <span>Manage Stock</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('stock.report') }}">Stock Report</a></li>
                         <li><a href="{{ route('stock.supplier.wise') }}">Supplier / Product Wise </a></li>

                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="fas fa-hand-holding-usd"></i>

                         <span>Manage Expenses</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('expense.add') }}">Add Expense</a></li>
                         <li><a href="{{ route('today.expense') }}">Today Expense</a></li>
                         <li><a href="{{ route('monthly.expense') }}">Monthly Expense </a></li>
                         <li><a href="{{ route('yearly.expense') }}">Yearly Expense </a></li>
                         <li><a href="{{ route('wisely.expense') }}">daily Expense </a></li>
                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="fas fa-hand-holding-usd"></i>

                         <span>Manage Debts</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('credit.customer') }}">Credit Customer</a></li>

                     </ul>
                 </li> --}}



             </ul>
         </div>
         <!-- Sidebar -->
     </div>
 </div>
