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
                    <li><a href="<?php echo base_url('cis-page');?>">Children List</a></li>
                    <li class="active">Child Profile</li>

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
                            <h3 class="panel-title"><b><?php echo $child->lastname . ', ' . $child->firstname . ' ' . $child->middlename ?></b></h3>
                            
                        </div>


                        <div class="panel-body">
                            <label class="control-label col-md-3" style="color:gray;"><h5>ID: <?php echo $child->child_id ?></h5></label>
                            <label class="control-label col-md-3" style="color:blue;"><h5>Status: <?php if($child->graduated == 0){ echo 'Ongoing Treatment'; }else{ echo 'Graduated'; } ?></h5></label>

                            <div align="right" style="margin-right: 3%">
                                
                                <button type="button" class="btn btn-danger"  onclick="cancel_profiles_monthly()"><i class="fa fa-times"></i> &nbsp;Back to Profile</button>
                            </div>
                            <br>
                            <button class="btn btn-success" onclick="add_profiles_monthly()"><i class="fa fa-plus-square"></i> &nbsp;Add Monthly Checkup Record</button>
                            <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> &nbsp;Reload</button>
                            <br><br>
                            <table id="profiles-monthly-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        
                                        <th style="width:60px;">ID#</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Date</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Encoded</th>
                                        <th style="width:50px;">Action</th>
                                        
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

        <!-- Bootstrap modal -->
            <div class="modal fade" id="modal_form" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">Monthly Checkup Form</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">

                                <input type="hidden" value="" name="monthly_id"/> 
                                <input type="hidden" value="" name="current_period"/>
                                <input type="hidden" value=<?php echo "'" . $child->child_id . "'"; ?> name="child_id"/>
                                 
                                
                                <div class="form-body">


                                    <!-- <div class="form-group">
                                        <label class="control-label col-md-3">Child ID :</label>
                                        <div class="col-md-9">
                                            <input name="name" placeholder="Child ID" class="form-control" type="text" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Fullname :</label>
                                        <div class="col-md-9">
                                            <input name="fullname" placeholder="Fullname" class="form-control" value=<?php echo "'" . $child->lastname . ', ' . $child->firstname . ' ' . $child->middlename . "'"; ?> type="text" readonly>
                                            <span class="help-block"></span>
                                        </div>

                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Month :</label>
                                        <div class="col-md-9">
                                            <select name="month" class="form-control">
                                                <option value="">--Select Period--</option>
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
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Year :</label>
                                        <div class="col-md-9">
                                            <select name="year" class="form-control">
                                                <option value="">--Select Year--</option>
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Date :</label>
                                        <div class="col-md-9">
                                            <input name="date" placeholder="Date" class="form-control" type="date">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Height :</label>
                                        <div class="col-md-9">
                                            <input name="height" placeholder="Height in centimeters" class="form-control" type="number">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Weight :</label>
                                        <div class="col-md-9">
                                            <input name="weight" placeholder="Weight in kilograms" class="form-control" type="number">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- End Bootstrap modal -->