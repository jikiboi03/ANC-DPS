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
                                <img id="image1" src="../../uploads/pic1/male.png" style="width:200px; max-height: 275px; margin-left:20px;">
                            <?php } else { ?>
                                <img id="image1" src="../../uploads/pic1/female.png" style="width:200px; max-height: 275px; margin-left:20px;">
                            <?php } ?>

                        <?php } else { ?>
                            <img id="image1" src=<?php echo "'" . "../../uploads/pic1/" . $child->pic1 . "'"; ?>  style="width:200px; max-height: 275px; margin-left:20px;">
                        <?php } ?>

                        </div>


                        <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3" style="color:gray;"><h5>ID: <?php echo $child->child_id ?></h5></label>
                            <label class="control-label col-md-3" style="color:blue;"><h5>Status: <?php if($child->graduated == 0){ echo 'Ongoing Treatment'; }else{ echo 'Graduated'; } ?></h5></label>

                            <div align="right" style="margin-right: 3%">
                                
                                <button type="button" class="btn btn-danger"  onclick="cancel_hvi()"><i class="fa fa-times"></i> &nbsp;Back to Profile</button>
                            </div>

                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        <div class="panel-body">
                            <button class="btn btn-success" onclick="add_hvi()"><i class="fa fa-plus-square"></i> &nbsp;Add HVI Record</button>
                            <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> &nbsp;Reload</button>
                            <br><br>
                            <table id="hvi-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        
                                        <th style="width:60px;">ID#</th>
            
                                        <th>Period</th>
                                        <th>Year</th>
                                        <th>Date</th>
                                        <th>Time</th>
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
                            <h3 class="modal-title">Home Visitation Interview Form</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">

                                <input type="hidden" value="" name="hvi_id"/>
                                <input type="hidden" value="" name="current_period"/>
                                <input type="hidden" value=<?php echo "'" . $child->child_id . "'"; ?> name="child_id"/> 

                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Full Name :</label>
                                        <div class="col-md-9">
                                            <input name="name" value="<?php echo $child->lastname . ', ' . $child->firstname . ' ' . $child->middlename ?>" class="form-control" type="text" disabled>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Period :</label>
                                        <div class="col-md-9">
                                            <select name="period" class="form-control">
                                                <option value="">--Select Period--</option>
                                                <option value="1">1st Quarter</option>
                                                <option value="2">2nd Quarter</option>
                                                <option value="3">3rd Quarter</option>
                                                <option value="4">4th Quarter</option>
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
                                        <label class="control-label col-md-3">Time :</label>
                                        <div class="col-md-9">
                                            <input name="time" placeholder="Time interviewed" class="form-control" type="text">
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
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Appetite :</label>
                                        <div class="col-md-9">
                                            <select name="appetite" class="form-control">
                                                <option value="">--Select Appetite--</option>
                                                <option value="1">Very Good</option>
                                                <option value="2">Good</option>
                                                <option value="3">Fair</option>
                                                <option value="4">No Appetite</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Water Intake :</label>
                                        <div class="col-md-9">
                                            <input name="water" placeholder="Approx., Glasses a day" class="form-control" type="number">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Bowel Movement :</label>
                                        <div class="col-md-9">
                                            <select name="bowel" class="form-control">
                                                <option value="">--Select Bowel--</option>
                                                <option value="1">Everyday</option>
                                                <option value="2">Every 3 days</option>
                                                <option value="3">Every 2 days</option>
                                                <option value="4">Others</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Hair :</label>
                                        <div class="col-md-9">
                                            <select name="hair" class="form-control">
                                                <option value="">--Select Hair/Scalp--</option>
                                                <option value="1">Dry</option>
                                                <option value="2">Scaly</option>
                                                <option value="3">Kuto</option>
                                                <option value="4">Normal</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Fingernails :</label>
                                        <div class="col-md-9">
                                            <select name="finger" class="form-control">
                                                <option value="">--Select Fingernails--</option>
                                                <option value="1">Long</option>
                                                <option value="2">Dirty</option>
                                                <option value="3">Normal</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Teeth :</label>
                                        <div class="col-md-9">
                                            <select name="teeth" class="form-control">
                                                <option value="">--Select Teeth--</option>
                                                <option value="1">Decayed</option>
                                                <option value="2">Discolored</option>
                                                <option value="3">Normal</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Skin :</label>
                                        <div class="col-md-9">
                                            <select name="skin" class="form-control">
                                                <option value="">--Select Skin--</option>
                                                <option value="1">Dry</option>
                                                <option value="2">Scaly</option>
                                                <option value="3">Normal</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Eyes :</label>
                                        <div class="col-md-9">
                                            <select name="eyes" class="form-control">
                                                <option value="">--Select Eyes--</option>
                                                <option value="1">Discharges</option>
                                                <option value="2">Redness</option>
                                                <option value="3">Normal</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Nose :</label>
                                        <div class="col-md-9">
                                            <select name="nose" class="form-control">
                                                <option value="">--Select Nose--</option>
                                                <option value="1">Discharges</option>
                                                <option value="2">Dirty</option>
                                                <option value="3">Normal</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Ears :</label>
                                        <div class="col-md-9">
                                            <select name="ears" class="form-control">
                                                <option value="">--Select Ears--</option>
                                                <option value="1">Discharges</option>
                                                <option value="2">Dirty</option>
                                                <option value="3">Normal</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Comments :</label>
                                        <div class="col-md-9">
                                            <input name="comments" placeholder="Comments" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Illnesses :</label>
                                        <div class="col-md-9">
                                            <input name="illness" placeholder="Illnesses over the past months" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Concerns :</label>
                                        <div class="col-md-9">
                                            <input name="concerns" placeholder="School/behavior/others" class="form-control" type="text">
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