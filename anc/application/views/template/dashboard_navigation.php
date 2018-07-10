
            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <nav id="mainnav-container">
                <div id="mainnav">

                    <!--Shortcut buttons-->
                    <!--================================-->
                    <div id="mainnav-shortcut">
                        <ul class="list-unstyled">
                            <li class="col-xs-4" data-content="Additional Sidebar">
                                <a id="demo-toggle-aside" class="shortcut-grid" href="#">
                                    <i class="fa fa-magic"></i>
                                </a>
                            </li>
                            <li class="col-xs-4" data-content="Notification">
                                <a id="demo-alert" class="shortcut-grid" href="#">
                                    <i class="fa fa-bullhorn"></i>
                                </a>
                            </li>
                            <li class="col-xs-4" data-content="Page Alerts">
                                <a id="demo-page-alert" class="shortcut-grid" href="#">
                                    <i class="fa fa-bell"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End shortcut buttons-->

                    <!--Menu-->
                    <!--================================-->
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">
                                <ul id="mainnav-menu" class="list-group">
                        
                                    <!--Category name-->
                                    <li class="list-header">Navigation</li>
                        
                                    <!--Menu list item-->
                                    <?php if($this->uri->segment(1) == 'dashboard'){ ?>

                                    <li class="active-link">
                                        <a href="<?php echo base_url('dashboard');?>">
                                            <i class="fa fa-dashboard"></i>
                                            <span class="menu-title">
                                                <strong>Dashboard</strong>
                                                <span class="label label-success pull-right">Top</span>
                                            </span>
                                        </a>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="<?php echo base_url('dashboard');?>">
                                            <i class="fa fa-dashboard"></i>
                                            <span class="menu-title">
                                                Dashboard
                                                <span class="label label-success pull-right">Top</span>
                                            </span>
                                        </a>
                                    </li>

                                    <?php } ?>

                                    <!--Menu list item-->
                                    <?php if($this->uri->segment(1) == 'statistics-page'){ ?>

                                    <li class="active-link">
                                        <a href="<?php echo base_url('statistics-page');?>">
                                            <i class="fa fa-area-chart"></i>
                                            <span class="menu-title">
                                                <strong>Statistics / Charts</strong>
                                            </span>
                                        </a>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="<?php echo base_url('statistics-page');?>">
                                            <i class="fa fa-area-chart"></i>
                                            <span class="menu-title">
                                                Statistics / Charts
                                            </span>
                                        </a>
                                    </li>

                                    <?php } ?>


                        
                                    <li class="list-divider"></li>
                        
                                    <!--Category name-->
                                    
                                    <li class="list-header">Operations</li>
                                    
                                    <!--Menu list item-->
                        
<!-- ================================================== ANC CODES ====================================================================== -->
    
                                    <!-- BARANGAY NAV -->

                                    <!--Menu list item-->
                                    

                                    <?php if($this->uri->segment(1) == 'barangays-page'){ ?>

                                    <li class="active-link">
                                        <a href="#">
                                            <i class="fa fa-university"></i>
                                            <strong><span class="menu-title">Barangays</span></strong>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>barangays-page">Show List</a></li>                   
                                        </ul>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-university"></i>
                                            <span class="menu-title">Barangays</span>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>barangays-page">Show List</a></li>  
                                        </ul>
                                    </li>

                                    <?php } ?>

                                    

                                    <!-- CIS NAV -->

                                    <!--Menu list item-->
                                    

                                    <?php if($this->uri->segment(1) == 'cis-page' || $this->uri->segment(1) == 'profiles-page'){ ?>

                                    <li class="active-link">
                                        <a href="#">
                                            <i class="fa fa-address-card"></i>
                                            <strong><span class="menu-title">Child Info (CIS)</span></strong>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>cis-page">Show List</a></li>                   
                                        </ul>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-address-card"></i>
                                            <span class="menu-title">Child Info (CIS)</span>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>cis-page">Show List</a></li>  
                                        </ul>
                                    </li>

                                    <?php } ?>

                                    

                                    <!-- ATTENDANCE NAV -->

                                    <!--Menu list item-->
                                    

                                    <?php if($this->uri->segment(1) == 'attendance-page'){ ?>

                                    <li class="active-link">
                                        <a href="#">
                                            <i class="fa fa-calendar-check-o"></i>
                                            <strong><span class="menu-title">Attendance</span></strong>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>attendance-page/<?php echo date('Y-m-d');?>">Show List</a></li>                   
                                        </ul>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-calendar-check-o"></i>
                                            <span class="menu-title">Attendance</span>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>attendance-page/<?php echo date('Y-m-d');?>">Show List</a></li>  
                                        </ul>
                                    </li>

                                    <?php } ?>

                                    

                                    <!-- DEWORMS NAV -->

                                    <!--Menu list item-->
                                    

                                    <?php if($this->uri->segment(1) == 'deworming-page'){ ?>

                                    <li class="active-link">
                                        <a href="#">
                                            <i class="fa fa-smile-o"></i>
                                            <strong><span class="menu-title">Deworming</span></strong>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>deworming-page">Show List</a></li>                   
                                        </ul>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-smile-o"></i>
                                            <span class="menu-title">Deworming</span>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>deworming-page">Show List</a></li>  
                                        </ul>
                                    </li>

                                    <?php } ?>

                                    

                                    <!-- MONTHLY NAV -->

                                    <!--Menu list item-->
                                    

                                    <?php if($this->uri->segment(1) == 'monthly-page'){ ?>

                                    <li class="active-link">
                                        <a href="#">
                                            <i class="fa fa-calendar"></i>
                                            <strong><span class="menu-title">Monthly Monitoring</span></strong>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>monthly-page">Show List</a></li>                   
                                        </ul>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-calendar"></i>
                                            <span class="menu-title">Monthly Monitoring</span>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>monthly-page">Show List</a></li>  
                                        </ul>
                                    </li>

                                    <?php } ?>

                                    

                                    <!-- GRADUATED NAV -->

                                    <!--Menu list item-->
                                    

                                    <?php if($this->uri->segment(1) == 'graduated-page'){ ?>

                                    <li class="active-link">
                                        <a href="#">
                                            <i class="fa fa-graduation-cap"></i>
                                            <strong><span class="menu-title">Graduated</span></strong>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>graduated-page">Show List</a></li>                   
                                        </ul>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-graduation-cap"></i>
                                            <span class="menu-title">Graduated</span>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>graduated-page">Show List</a></li>  
                                        </ul>
                                    </li>

                                    <?php } ?>

                                    



<!-- ================================================== MISCELLANEOUS ================================================ -->
    

                        
                                    
                                    <li class="list-divider"></li>
                        
                                    <!--Category name-->
                                    <li class="list-header">Miscellaneous</li>
                        
                                    
                                    <!--Menu list item-->
                        
                                    <!--Menu list item-->
                                    <?php if($this->session->userdata('administrator') == "1"): ?>

                                    <?php if($this->uri->segment(1) == 'users-page'){ ?>

                                    <li class="active-link">
                                        <a href="#">
                                            <i class="fa fa-user-circle"></i>
                                            <strong><span class="menu-title">Users</span></strong>
                                            <span class="label label-danger pull-right">Admin</span>
                                            
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>users-page">Show List</a></li>
                                        </ul>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user-circle"></i>
                                            <span class="menu-title">Users</span>
                                            <span class="label label-danger pull-right">Admin</span>
                                            
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>users-page">Show List</a></li>
                                        </ul>
                                    </li>

                                    <?php } ?>

                                    <?php endif ?>



                                    <!--Menu list item-->

                                    <?php if($this->uri->segment(1) == 'logs-page'){ ?>

                                    <li class="active-link">
                                        <a href="#">
                                            <i class="fa fa-history"></i>
                                            <strong><span class="menu-title">System Logs</span></strong>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>logs-page">Show List</a></li>
                                        </ul>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-history"></i>
                                            <span class="menu-title">System Logs</span>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>logs-page">Show List</a></li>
                                        </ul>
                                    </li>

                                    <?php } ?>


                                    <!--Menu list item-->
                                    
                                    <?php if($this->session->userdata('administrator') == '1'): ?>

                                    <?php if($this->uri->segment(1) == 'reports-page'){ ?>

                                    <li class="active-link">
                                        <a href="<?php echo base_url();?>reports-page">
                                            <i class="fa fa-file"></i>
                                            <strong><span class="menu-title">Reports</span></strong>
                                            <span class="label label-danger pull-right">Admin</span>
                                        </a>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="<?php echo base_url();?>reports-page">
                                            <i class="fa fa-file"></i>
                                            <span class="menu-title">Reports</span>
                                            <span class="label label-danger pull-right">Admin</span>
                                        </a>
                                    </li>

                                    <?php } ?>

                                    <?php endif ?>



                                    <!--Menu list item-->

                                    <?php if($this->uri->segment(1) == 'schedules-page'){ ?>

                                    <li class="active-link">
                                        <a href="#">
                                            <i class="fa fa-clock-o"></i>
                                            <strong><span class="menu-title">Schedules</span></strong>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>schedules-page">Schedules</a></li>
                                        </ul>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o"></i>
                                            <span class="menu-title">Schedules</span>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>schedules-page">Show List</a></li>
                                        </ul>
                                    </li>

                                    <?php } ?>

                                    

                                    <!--Menu list item-->
                                    

                                    <?php if($this->uri->segment(1) == 'notifications-page'){ ?>

                                    <li class="active-link">
                                        <a href="#">
                                            <i class="fa fa-bell"></i>
                                            <strong><span class="menu-title">Notifications</span></strong>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>notifications-page/notifications-monthly-page">No Monthly Checkup</a>
                                            </li>                                            
                                            <li><a href="<?php echo base_url();?>notifications-page/notifications-quarterly-page">No HVI (Quarterly)</a>
                                            </li>
                                            <li><a href="<?php echo base_url();?>notifications-page/notifications-deworming-page">No Deworming</a>
                                            </li>
                                            <li><a href="<?php echo base_url();?>notifications-page/notifications-severe-page">Severe Malnutrition</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-bell"></i>
                                            <span class="menu-title">Notifications</span>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>notifications-page/notifications-monthly-page">No Monthly Checkup</a>
                                            </li>                                            
                                            <li><a href="<?php echo base_url();?>notifications-page/notifications-quarterly-page">No HVI (Quarterly)</a>
                                            </li>
                                            <li><a href="<?php echo base_url();?>notifications-page/notifications-deworming-page">No Deworming</a>
                                            </li>
                                            <li><a href="<?php echo base_url();?>notifications-page/notifications-severe-page">Severe Malnutrition</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <?php } ?>


                                    


                                </ul>

                            </div>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End menu-->

                </div>
            </nav>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>
