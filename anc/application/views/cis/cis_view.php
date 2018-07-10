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
                    <li class="active">Children List</li>
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
                            <h3 class="panel-title">Children Information Table</h3>
                        </div>
                        <div class="panel-body">
                            <button class="btn btn-success" onclick="add_cis()"><i class="fa fa-plus-square"></i> &nbsp;Register Child</button>
                            <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> &nbsp;Reload</button>
                            <br><br>
                            <table id="cis-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:60px;">ChildID</th>
                                        <th>LastName</th>
                                        <th>FirstName</th>
                                        <th>MiddleName</th>
                                        <th>Birthdate</th>
                                        <th>Mos.</th>
                                        <th>Sex</th>
                                        <th>Weight</th>
                                        <th>Height</th>
                                        <th>Barangay</th>
                                        <th style="width:50px;">Action</th>
                                        <th>Registered</th>
                                        <th>Encoded</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--===================================================-->
                    <!-- End Striped Table -->
                    <span>&nbsp; <i style = "color: #99ffff;" class="fa fa-square"></i> - Male &nbsp; | &nbsp; <i style = "color: #ffcccc;" class="fa fa-square"></i> - Female</span>
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
                            <h3 class="modal-title">Child Information Sheet (CIS) Form</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">
                                <input type="hidden" value="" name="child_id"/> 
                                <input type="hidden" value="" name="current_name"/>
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Last Name :</label>
                                        <div class="col-md-9">
                                            <input name="lastname" placeholder="Child's Last Name" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">First Name :</label>
                                        <div class="col-md-9">
                                            <input name="firstname" placeholder="Child's First Name" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Middle Name :</label>
                                        <div class="col-md-9">
                                            <input name="middlename" placeholder="Child's Middle Name" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Date of Birth :</label>
                                        <div class="col-md-9">
                                            <input name="dob" placeholder="Child's Date of Birth" class="form-control" type="date">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Place of Birth :</label>
                                        <div class="col-md-9">
                                            <input name="pob" placeholder="Child's Place of Birth" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Sex :</label>
                                        <div class="col-md-9">
                                            <select name="sex" class="form-control">
                                                <option value="">--Select Gender--</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Religion :</label>
                                        <div class="col-md-9">
                                            <input name="religion" placeholder="Child's Religion" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Initial Weight :</label>
                                        <div class="col-md-9">
                                            <input name="weight" placeholder="Child's Initial Weight" class="form-control" type="number">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Initial Height :</label>
                                        <div class="col-md-9">
                                            <input name="height" placeholder="Child's Initial Height" class="form-control" type="number">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Disability :</label>
                                        <div class="col-md-9">
                                            <textarea name="disability" placeholder="Child's Disability" class="form-control"></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Contact :</label>
                                        <div class="col-md-9">
                                            <input name="contact" placeholder="Parents Contact Number" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">School :</label>
                                        <div class="col-md-9">
                                            <textarea name="school" placeholder="Child's School" class="form-control"></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Grade Level :</label>
                                        <div class="col-md-9">
                                            <input name="grade_level" placeholder="Child's Grade Level" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Address :</label>
                                        <div class="col-md-9">
                                            <textarea name="address" placeholder="Child's Home Address" class="form-control"></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Barangay :</label>
                                        <div class="col-md-9">
                                            <select name="barangay_id" class="form-control">
                                                <option value="">--Select Barangay--</option>
                                                <?php 
                                                    foreach($barangays as $row)
                                                    { 
                                                      echo '<option value="'.$row->barangay_id.'">'.$row->name.'</option>';
                                                    }
                                                ?>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Date Registered :</label>
                                        <div class="col-md-9">
                                            <input name="date_registered" placeholder="Registration Date" class="form-control" type="date">
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