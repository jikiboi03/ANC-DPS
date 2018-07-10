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
                    <li class="active">Attendance Records List</li>
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
                            <h3 class="panel-title">Attendance Records Table</h3>
                        </div>
                        <div class="panel-heading">
                            <h3 class="panel-title"><b><?php echo date('l, F j, Y', strtotime($date))?></b></h3>
                        </div>
                        <br>
                        

                        <div class="panel-body">
                            
                            <label class="control-label col-md-2" style="font-size: 15px; text-align: right;">Select Date :</label>
                            <div class="col-md-3">
                                <input name="attendance_date" id="attendance_date" value=<?php echo "'" . $date . "'"; ?> placeholder="Date" class="form-control" type="date" style="height:33px;">
                            </div>
                            <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> &nbsp;Reload</button>

                            <input class="control-label col-md-2" style="font-size: 15px; text-align: left; width: 220px; border: none;" id="present_count" readonly>
                            <br><br>
                            <table id="attendance-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:60px;">ChildID</th>
                                        <th>LastName</th>
                                        <th>FirstName</th>
                                        <th>MiddleName</th>
                                        
                                        <th>Sex</th>
                                        <th>Barangay</th>

                                        <th style="width:20px;">Action</th>
                                        <th></th>
                                        <th>Encoded</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            <!-- End Striped Table -->
                            <!-- <span>&nbsp; <i style = "color: #99ffff;" class="fa fa-square"></i> - Male &nbsp; | &nbsp; <i style = "color: #ffcccc;" class="fa fa-square"></i> - Female</span> -->

                        </div>
                       <!--  <div class="panel-body">
                            <button class="btn btn-success" onclick="add_barangay()"><i class="fa fa-plus-square"></i> &nbsp;Register Barangay</button>
                            <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> &nbsp;Reload</button>
                            <br><br>
                            <table id="barangays-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:60px;">BarangayID</th>
                                        <th>BarangayName</th>
                                        <th class="min-desktop">Encoded</th>
                                        <th style="width:60px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div> -->
                    </div>
                    <!--===================================================-->
                    <!-- End Striped Table -->
                    <!-- <span>&nbsp; <i style = "color: #666666;" class="fa fa-square"></i> - Male &nbsp; | &nbsp; <i style = "color: #ff6666;" class="fa fa-square"></i> - Female</span> -->
                </div>
                <!--===================================================-->
                <!--End page content-->
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->

        