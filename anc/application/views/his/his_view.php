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
                    <div class="panel" style="height: 1800px;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b><?php echo $child->lastname . ', ' . $child->firstname . ' ' . $child->middlename ?></b></h3>
                        </div>
                        <br>

                        <div style="float:left;">

                        <!-- check for pic1 if empty. assign default images if empty base on sex -->
                        <?php if ($child->pic1 == ''){ ?>

                            <?php if ($child->sex == 'Male'){ ?>
                                <img id="image1" src="../uploads/pic1/male.png" style="width:200px; max-height: 275px; margin-left:20px;">
                            <?php } else { ?>
                                <img id="image1" src="../uploads/pic1/female.png" style="width:200px; max-height: 275px; margin-left:20px;">
                            <?php } ?>

                        <?php } else { ?>
                            <img id="image1" src=<?php echo "'" . "../uploads/pic1/" . $child->pic1 . "'"; ?>  style="width:200px; max-height: 275px; margin-left:20px;">
                        <?php } ?>
                        
                        <?php echo form_open_multipart('profiles/profiles_controller/do_upload');?> 
                          <form action = "" method = "">
                            <input type="hidden" value=<?php echo "'" . $child->child_id . "'"; ?> name="child_id"/> 
                             <br />  
                             <input type = "file" name = "userfile1" id="userfile1" size = "20" style = "padding-left: 20px;"/> 
                             <br />
                             
                             <input type = "submit" value = "Upload" class="btn btn-success" style = "width:200px; margin-left: 20px;"/>
                          </form>
                        </div>

                        <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3" style="color:gray;"><h5>ID: <?php echo $child->child_id ?></h5></label>
                            <label class="control-label col-md-3" style="color:blue;"><h5>Status: <?php if($child->graduated == 0){ echo 'Ongoing Treatment'; }else{ echo 'Graduated'; } ?></h5></label>

                            <?php 
                            echo '<span class="control-label col-md-3"><a class="btn btn-lg btn-info" onclick="edit_cis_view('."'".$child->child_id."'".')" href="javascript:void(0)" title="View" style="font-size: 15px; width:250px;"><i class="fa fa-pencil-square-o"></i> &nbsp;&nbsp;Edit Child Info (CIS) </a></span>'
                            ?>

                            

                            <label class="control-label col-md-3">Gender: <h4><?php echo $child->sex ?></h4></label>
                            <label class="control-label col-md-3">Date Registered: <h4><?php echo $child->date_registered ?></h4></label>

                            <span class="control-label col-md-3" style="margin-top: 20px;"><a class="btn btn-lg btn-success" href="javascript:void(0)" title="View" style="font-size: 15px; width:250px;"><i class="fa fa-child"></i> &nbsp;&nbsp;Add Household Info (HIS) </a></span>

                            <label class="control-label col-md-3">Age in Months: <h4><?php $birthday = new DateTime($child->dob);

                                                                        $diff = $birthday->diff(new DateTime());
                                                                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                                                                        echo $months . ' mos';   ?></h4></label>
                            
                            <label class="control-label col-md-3">Birthday: <h4><?php echo date("M j, Y", strtotime($child->dob)) ?></h4></label>

                            <span class="control-label col-md-3" style="margin-top: 20px;"><a class="btn btn-lg btn-warning" href="javascript:void(0)" title="View" style="font-size: 15px; width:250px;"><i class="fa fa-home"></i> &nbsp;&nbsp;Go to Home Visitation (HVI) </a></span>

                            <label class="control-label col-md-3">Barangay: <h4><?php echo $this->barangays->get_barangay_name($child->barangay_id) ?></h4></label>
                            <label class="control-label col-md-6">Place of Birth: <h4><?php echo $child->pob ?></h4></label>
                            

                            <label class="control-label col-md-3">Address: <h4><?php echo $child->address ?></h4></label>
                            <label class="control-label col-md-3">Religion: <h4><?php echo $child->religion ?></h4></label>
                            
                            
                        </div>   
                        </div>


                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        <hr>
                        <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2" style="color:gray;"><h5>Initial Weight: <?php echo $child->weight ?> Kg</h5></label>
                            <label class="control-label col-md-2" style="color:gray;"><h5>Initial Height: <?php echo $child->height ?> Kg</h5></label>
                            <label class="control-label col-md-2" style="color:gray;"><h5>Initial BMI Index: <?php $bmi = ($child->weight / ($child->height / 100)) / ($child->height / 100); echo number_format((float)$bmi, 1, '.', '');  ?></h5></label>
                            <label class="control-label col-md-4" style="color:gray;"><h5>Initital BMI Status: Severely Underweight (SU)</h5></label>

                            <span class="control-label col-md-2" style="margin-top: 5px;"><a class="btn btn-sm btn-danger" href="javascript:void(0)" title="View" style="font-size: 13px; width:145px; height:35px;"><i class="fa fa-pencil-square-o"></i> &nbsp;&nbsp;Go to Monthly </a></span>

                            <label class="control-label col-md-2" style="color:gray;"><h5>Latest Weight: <?php echo $child->weight ?> Kg</h5></label>
                            <label class="control-label col-md-2" style="color:gray;"><h5>Latest Height: <?php echo $child->height ?> Kg</h5></label>
                            <label class="control-label col-md-2" style="color:gray;"><h5>Latest BMI Index: <?php $bmi = ($child->weight / ($child->height / 100)) / ($child->height / 100); echo number_format((float)$bmi, 1, '.', '');  ?></h5></label>
                            <label class="control-label col-md-4" style="color:gray;"><h5>Latest BMI Status: Severely Underweight (SU)</h5></label>

                        </div>
                        </div>

                        <br><br><br><br>
                        <hr>
                        <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Contact: <h4><?php if($child->contact == ''){ echo 'n/a'; } else { echo $child->contact; } ?></h4></label>
                            <label class="control-label col-md-3">School: <h4><?php if($child->school == ''){ echo 'n/a'; } else { echo $child->school; } ?></h4></label>
                            <label class="control-label col-md-3">Grade Level: <h4><?php if($child->grade_level == ''){ echo 'n/a'; } else { echo $child->grade_level; } ?></h4></label>
                            <label class="control-label col-md-3">Disability: <h4><?php if($child->disability == ''){ echo 'n/a'; } else { echo $child->disability; } ?></h4></label>

                        </div>
                        </div>
                        <br><br><br><br><br><br>
                        <hr>
  



                        <div class="panel-body">
                            <button class="btn btn-success" onclick="add_family()"><i class="fa fa-plus-square"></i> &nbsp;Add Family Member</button>
                            <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> &nbsp;Reload</button>
                            <br><br>
                            <table id="family-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:60px;">ID#</th>
                                        <th>FullName</th>
                                        <th>Relation</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Status</th>
                                        <th>Education</th>
                                        <th>Occupation</th>
                                        <th>Income</th>
                                        <th style="width:50px;">Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            <!-- End Striped Table -->
                            <span>&nbsp; <i style = "color: #99ffff;" class="fa fa-square"></i> - Male &nbsp; | &nbsp; <i style = "color: #ffcccc;" class="fa fa-square"></i> - Female</span>

                        </div>
                        <hr>
                        <h4 style="margin-left: 3%">Images</h4>
                        <hr>
                        
<!-- ============================================================ IMAGES =============================================================== -->
                       
                        <div style="float:left;">
                            <!-- check for pic1 if empty. assign default images if empty base on sex -->
                            <?php if ($child->pic2 == ''){ ?>
                                <img id="image2" src="../uploads/pic2/none.jpg" style="width:280px; max-height: 400px; margin-left:20px;">
                            <?php } else { ?>
                                <img id="image2" src=<?php echo "'" . "../uploads/pic2/" . $child->pic2 . "'"; ?>  style="width:280px; max-height: 400px; margin-left:20px;">
                            <?php } ?>
                            
                            <?php echo form_open_multipart('profiles/profiles_controller/do_upload_2');?> 
                              <form action = "" method = "">
                                <input type="hidden" value=<?php echo "'" . $child->child_id . "'"; ?> name="child_id"/> 
                                 <br />  
                                 <input type = "file" name = "userfile2" id="userfile2" size = "20" style = "padding-left: 20px;"/> 
                                 <br />
                                 
                                 <input type = "submit" value = "Upload" class="btn btn-success" style = "width:280px; margin-left: 20px;"/>
                              </form>
                        </div>


                        <div style="float:left;">
                            <!-- check for pic1 if empty. assign default images if empty base on sex -->
                            <?php if ($child->pic3 == ''){ ?>
                                <img id="image3" src="../uploads/pic3/none.jpg" style="width:280px; max-height: 400px; margin-left:20px;">
                            <?php } else { ?>
                                <img id="image3" src=<?php echo "'" . "../uploads/pic3/" . $child->pic3 . "'"; ?>  style="width:280px; max-height: 400px; margin-left:20px;">
                            <?php } ?>
                            
                            <?php echo form_open_multipart('profiles/profiles_controller/do_upload_3');?> 
                              <form action = "" method = "">
                                <input type="hidden" value=<?php echo "'" . $child->child_id . "'"; ?> name="child_id"/> 
                                 <br />  
                                 <input type = "file" name = "userfile3" id="userfile3" size = "20" style = "padding-left: 20px;"/> 
                                 <br />
                                 
                                 <input type = "submit" value = "Upload" class="btn btn-success" style = "width:280px; margin-left: 20px;"/>
                              </form>
                        </div>



                    </div>
                    <!--===================================================-->
                    
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
                            <h3 class="modal-title">Family Member Form</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">

                                <input type="hidden" value="" name="family_id"/>
                                <input type="hidden" value=<?php echo "'" . $child->child_id . "'"; ?> name="child_id"/> 

                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Full Name :</label>
                                        <div class="col-md-9">
                                            <input name="name" placeholder="Name of family member" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Relation :</label>
                                        <div class="col-md-9">
                                            <input name="relation" placeholder="Relation to the child" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Age :</label>
                                        <div class="col-md-9">
                                            <input name="age" placeholder="Age of family member" class="form-control" type="number">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Gender :</label>
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
                                        <label class="control-label col-md-3">Marital Status :</label>
                                        <div class="col-md-9">
                                            <input name="status" placeholder="Marital status of family member" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Education :</label>
                                        <div class="col-md-9">
                                            <input name="education" placeholder="Educational attainment" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Occupation :</label>
                                        <div class="col-md-9">
                                            <input name="occupation" placeholder="Current occupation" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Income :</label>
                                        <div class="col-md-9">
                                            <input name="income" placeholder="Current income" class="form-control" type="number">
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