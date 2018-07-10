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
                    <li class="active">Graduated Children List</li>
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
                            <h3 class="panel-title">Graduated Children Table</h3>
                        </div>

                        <div class="panel-body">
                            <button class="btn btn-success" onclick="add_graduated()"><i class="fa fa-plus-square"></i> &nbsp;Add Graduated Child</button>
                            <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> &nbsp;Reload</button>
                            <br><br>
                            <table id="graduated-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        
                                        <th style="width:60px;">ID#</th>
                                        <th>ChildID</th>
                                        <th>Fullname</th>
                                        <th>Date</th>
                                        <th style="width:200px;">Remarks</th>
                                        <th>Encoded</th>
                                        <th style="width:90px;">Action</th>
                                        
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
                            <h3 class="modal-title">Graduated Child Form</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">

                                <input type="hidden" value="" name="graduated_id"/> 
                                <input type="hidden" value="" name="current_child"/>
                                
                                <div class="form-body">


                                    <!-- <div class="form-group">
                                        <label class="control-label col-md-3">Child ID :</label>
                                        <div class="col-md-9">
                                            <input name="name" placeholder="Child ID" class="form-control" type="text" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div> -->

                                    <div class="form-group" id="child_id">
                                        <label class="control-label col-md-3">Fullname :</label>
                                        <div class="col-md-9">
                                            <select name="child_id" class="form-control">
                                                <option value="">--Select Fullname--</option>
                                                <?php 
                                                    foreach($cis as $row)
                                                    { 
                                                      echo '<option value="' . $row->child_id . '">' . $row->lastname . ', ' . $row->firstname . ' ' . $row->middlename . '</option>';
                                                    }
                                                ?>
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
                                        <label class="control-label col-md-3">Remarks :</label>
                                        <div class="col-md-9">
                                            <textarea name="remarks" placeholder="Child remarks" class="form-control"></textarea>
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