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
                    <li class="active">Generate Reports</li>
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
                            <h3 class="panel-title">CIS Reports Selection</h3>
                        </div>

                        <div class="panel-body">
                            <div class="container">
                                <form action="#" id="form" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Select Report Type :</label>
                                            <div class="col-md-4">
                                                <select name="report_type" id="report_type" class="form-control" style="font-size: 15px;">
                                                    <option value="null">--Select Type--</option>
                                                    <option value="cis-active-male">CIS Active Records - Male</option>
                                                    <option value="cis-active-female">CIS Active Records - Female</option>
                                                    <option value="cis-graduated-male">CIS Graduated Records - Male</option>
                                                    <option value="cis-graduated-female">CIS Graduated Records - Female</option>
                                                    <!-- <option value="damaged">Damaged Report</option>
                                                    <option value="borrow">Borrow Report</option> -->

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                                <div class="modal-footer col-md-11">
                                    <button type="button" id="generate_report" onclick="set_report()" class="btn btn-dark" style="font-size: 15px;" disabled><i class="fa fa-file"></i> &nbsp;Generate CIS Report</button>
                                </div>
                            </div>
                        </div>
                        <hr style="background-color: #ccccff; height: 10px;">
                        <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Monthly Monitoring Reports Selection</h3>
                        </div>

                        <div class="panel-body">
                            <div class="container">
                                <form action="#" id="form" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Select Report Type :</label>
                                            <div class="col-md-4">
                                                <select name="report_type_monthly" id="report_type_monthly" class="form-control" style="font-size: 15px;">
                                                    <option value="null">--Select Type--</option>
                                                    <option value="monthly-male">Monthly Monitoring Records - Male</option>
                                                    <option value="monthly-female">Monthly Monitoring Records - Female</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Select Month Period :</label>
                                            <div class="col-md-4">
                                                <select name="month_selection" id="month_selection" class="form-control" style="font-size: 15px;">
                                                    <option value="null">--Select Month--</option>
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>

                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Select Year :</label>
                                            <div class="col-md-4">
                                                <select name="year_selection" id="year_selection" class="form-control" style="font-size: 15px;">
                                                    <option value="null">--Select Year--</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                                <div class="modal-footer col-md-11">
                                    <button type="button" id="generate_report_monthly" onclick="set_report_monthly()" class="btn btn-dark" style="font-size: 15px;" disabled><i class="fa fa-file"></i> &nbsp;Generate Monthly Checkup Report</button>
                                </div>
                            </div>
                        </div>
                        <hr style="background-color: #ccccff; height: 10px;">
                        <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Child Profile Reports Selection</h3>
                        </div>

                        <div class="panel-body">
                            <div class="container">
                                <form action="#" id="form" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Select Child Name :</label>
                                            <div class="col-md-4">
                                                <select name="report_type_child" id="report_type_child" class="form-control" style="font-size: 15px;">
                                                    <option value="null">--Select Fullname--</option>
                                                    <?php 
                                                        foreach($cis as $row)
                                                        { 
                                                          echo '<option value="' . $row->child_id . '">' . $row->lastname . ', ' . $row->firstname . ' ' . $row->middlename . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                                <div class="modal-footer col-md-11">
                                    <button type="button" id="generate_report_child" onclick="set_report_child()" class="btn btn-dark" style="font-size: 15px;" disabled><i class="fa fa-file"></i> &nbsp;Generate Child Profile Report</button>
                                </div>
                            </div>
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

