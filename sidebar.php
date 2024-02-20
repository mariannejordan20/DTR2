</style>
<ul style="background-color: #152039;" class="stickys navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="AdminDashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="sidebar-brand-text mx-3">BIZMATECH</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="AdminDashboard.php">
                    <i class="ml-1 fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
        
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                <h6>User Settings</h6>
            </div>

            <!-- Nav Item - Pages Collapse Menu --> 
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCreate"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="ml-1 fas fa-fw fa-plus"></i>
                    <span>Create Account</span>
                </a>
                <div id="collapseCreate" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> 
                        <a class="collapse-item" href="AdminCreateAccountEmployee.php"><i class="fas fa-fw fa-user"></i> Employee Accounts</a> 
                        <a class="collapse-item" href="AdminCreateAccountAdmin.php"><i class="fas fa-fw fa-user"></i> Admin Accounts</a>  
                        <div class="collapse-divider"></div> 
                    </div>
                </div>
            </li>  
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccounts"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="ml-1 fas fa-fw fa-list"></i>
                    <span>Account Lists</span>
                </a>
                <div id="collapseAccounts" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> 
                        <a class="collapse-item" href="AdminDashboardEmployeeAccounts.php"><i class="fas fa-fw fa-user"></i> Employee Accounts</a> 
                        <a class="collapse-item" href="AdminDashboardAdminAccounts.php"><i class="fas fa-fw fa-user"></i> Admin Accounts</a>  
                        <div class="collapse-divider"></div> 
                    </div>
                </div>
            </li>  
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfig"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="ml-1 fas fa-fw fa-cog"></i>
                    <span>Config</span>
                </a>
                <div id="collapseConfig" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> 
                        <a class="collapse-item" href="AdminBranch.php"><i class="fas fa-fw fa-building"></i> Branch</a> 
                        <a class="collapse-item" href="AdminDepartment.php"><i class="fas fa-fw fa-users"></i> Department</a>  
                        <div class="collapse-divider"></div> 
                    </div>
                </div>
            </li>  
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                <h6>Generate</h6>
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="ml-1 fas fa-fw fa-folder"></i>
                    <span>Reports</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> 
                        <a class="collapse-item" href="AdminReportsDaily.php"><i class="fas fa-fw fa-list"></i> Daily Logs</a>  
                        <div class="collapse-divider"></div> 
                    </div>
                </div>
            </li> 
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
  
        </ul>