            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow"><img src="assets/img/anc.jpg" style="width: 8%; margin-top: 0%; margin-right: 2%;">Archdiocesan Nourishment Center (ANC) </h1>

                    <!-- For alert and notifications assets/js/demo/nifty-demo.js-->

                    <input type="hidden" value=<?php echo "'" . $this->session->userdata('firstname').' '.$this->session->userdata('lastname') . "'"; ?> name="user_fullname"/>

                    <input type="hidden" value=<?php echo "'" . date('l, F j, Y', strtotime(date('Y-m-d'))) . "'"; ?> name="current_date"/>


                    <input type="hidden" id="severe_status" value=<?php echo "'" . $severe_status . "'"; ?> name="severe_status"/>

                    <input type="hidden" id="current_month_bday" value=<?php echo "'" . date('F', strtotime(date('Y-m-d'))) . "'"; ?> name="current_month_bday"/>

                    <input type="hidden" id="no_monthly" value=<?php echo "'" . $no_monthly . "'"; ?> name="no_monthly"/>

                    <input type="hidden" id="no_quarterly" value=<?php echo "'" . $no_quarterly . "'"; ?> name="no_quarterly"/>

                    <input type="hidden" id="no_deworming" value=<?php echo "'" . $no_deworming . "'"; ?> name="no_deworming"/>

                    <input type="hidden" id="birthdays" value=<?php echo "'" . $birthdays . "'"; ?> name="birthdays"/>

                    <input type="hidden" id="schedules_today_str" value=<?php echo "'" . $schedules_today_str . "'"; ?> name="schedules_today_str"/>               

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
                <!-- <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Library</a></li>
                    <li class="active">Data</li>
                </ol> -->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                
                    <!--Tiles - Bright Version-->
                    <!--===================================================-->

                    <!--===================================================-->
                    <!--End Tiles - Bright Version-->               
                    <div class="row">
                        <div class="col-lg-12">                  
                            <div class="row">
                                <!--Large tile (Visit Today)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="col-sm-6 col-md-2">
                                    <div class="panel panel-dark panel-colorful">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">Registered Children Today</p>
                                            <i class="fa fa-child fa-5x"></i>
                                            <hr>
                                            <p class="h1 text-thin">
                                            <?php echo $registered_today; ?>     
                                            </p>
                                            <small><span class="text-semibold"><?php echo $registered_percent_than_yesterday; ?></small>
                                        </div>
                                    </div>
                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--End large tile (Visit Today)-->
                    
                                <!--Large tile (New orders)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="col-sm-6 col-md-2">
                                    <div class="panel panel-success panel-colorful">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">Total Children Registered</p>
                                            <i class="fa fa-smile-o fa-5x"></i>
                                            <hr>
                                            <p class="h1 text-thin"><?php echo ($children_count + $children_graduated_male + $children_graduated_female); ?> </p>
                                            <small><span class="text-semibold"><?php echo ($children_active_male + $children_graduated_male); ?> Males  &nbsp;&nbsp;|&nbsp;&nbsp;    <?php echo ($children_active_female + $children_graduated_female); ?> Females<br><br></small>
                                        </div>
                                    </div>
                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--End Large tile (New orders)-->

                                <!--Large tile (Comments)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="col-sm-6 col-md-2">
                                    <div class="panel panel-danger panel-colorful">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">Total Children Graduated </p>
                                            <i class="fa fa-graduation-cap fa-5x"></i>
                                            <hr>
                                            <p class="h1 text-thin"><?php echo ($children_graduated_male + $children_graduated_female); ?> </p>
                                            <small><span class="text-bold"><?php echo ($children_active_male + $children_active_female); ?> Active / Ongoing Treatment</small>
                                        </div>
                                    </div>
                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--Large tile (Comments)-->
                                                    
                                <!--Large tile (New orders)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="col-sm-6 col-md-2">
                                    <div class="panel panel-primary panel-colorful">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">Total Family Visited / Interviewed</p>
                                            <i class="fa fa-home fa-5x"></i>
                                            <hr>
                                            <p class="h1 text-thin"><?php echo $family_visited; ?></p>
                                            <small><span class="text-semibold">Latest: <?php echo $date_last_visit; ?></small>
                                        </div>
                                    </div>
                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--End Large tile (New orders)-->
                                <!--Large tile (Visit Today)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="col-sm-6 col-md-2">
                                    <div class="panel panel-warning panel-colorful">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">Total Family Members</p>
                                            <i class="fa fa-users fa-5x"></i>
                                            <hr>
                                            <p class="h1 text-thin">
                                            <?php echo $family_members; ?>     
                                            </p>
                                            <small><span class="text-semibold">Avg family members: <?php echo number_format(($family_members / $count_child_family), 0, '.', ',') 
                                            . ' | Income: Php ' . number_format(($income_child_family / $count_child_family), 2, '.', ','); ?> </small>
                                        </div>
                                    </div>
                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--End large tile (Visit Today)-->
                    
                                <!--Large tile (New orders)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="col-sm-6 col-md-2">
                                    <div class="panel panel-mint panel-colorful">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">Total Barangays Registered</p>
                                            <i class="fa fa-university fa-5x"></i>
                                            <hr>
                                            <p class="h1 text-thin"><?php echo $barangays_count; ?> </p>
                                            <small><span class="text-semibold">Most children registered: <?php echo $top_barangay . ' - ' . $barangay_child; ?></small>
                                        </div>
                                    </div>
                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--End Large tile (New orders)-->

                            </div>                
                        </div>
                    </div>
                    
                    



                    
















                </div>
                <!--===================================================-->
                <!--End page content-->
                <hr style="background-color: #cccccc; height:1px;">
                <hr>
                <hr>

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->


            
        