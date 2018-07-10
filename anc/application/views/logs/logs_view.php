            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow"><?php echo $title; ?></h1>

                    <!--Searchbox-->
                    <!-- <div class="searchbox">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..">
                            <span class="input-group-btn">
                                <button class="text-muted" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div> -->
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->

                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url('dashboard');?>">Dashboard</a></li>
                    <li class="active">System Logs List</li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <!-- Basic Data Tables -->
                    <!--===================================================-->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">System Logs Information Table</h3>
                        </div>

                        <div class="panel-body">
                            
                            <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> &nbsp;Reload</button>
                            <br><br>
                            <table id="logs-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>LogID</th>
                                        <th>Type</th>
                                        <th>Details</th>
                                        <th>User</th>
                                        <th>DateTime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--===================================================-->
                    <!-- End Striped Table -->
                    <span>&nbsp; <i style = "color: #99ff99;" class="fa fa-square"></i> - Add &nbsp; | &nbsp; <i style = "color: #99ffff;" class="fa fa-square"></i> - Update &nbsp; | &nbsp; <i style = "color: #ffcc99;" class="fa fa-square"></i> - Delete &nbsp; | &nbsp; <i style = "color: #ffffff;" class="fa fa-square"></i> - Login &nbsp; | &nbsp; <i style = "color: #cccccc;" class="fa fa-square"></i> - Logout | &nbsp; <i style = "color: #ccff99;" class="fa fa-square"></i> - Report</span>
                </div>
                <!--===================================================-->
                <!--End page content-->
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->
