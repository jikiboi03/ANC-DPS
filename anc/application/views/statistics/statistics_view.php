            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow"><img src="assets/img/anc.jpg" style="width: 8%; margin-top: 0%; margin-right: 2%;">Archdiocesan Nourishment Center (ANC) </h1>


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
                <div id="page-content" class="panel panel-light panel-colorful">
                
                    <div class="panel-heading">
                        <h3 class="panel-title">ANC Statistics / Charts</h3>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-sm-6 col-md-5">
                                <div id="container-gender" style="height: 350px; max-width: 500px; margin: 0"></div>
                            </div>
                            <div class="col-sm-6 col-md-7">
                                <div id="container-age" style="min-width: 310px; height: 350px; margin: 0"></div>
                            </div>
                        </div>
                    </div>    

                    
                    
                    <hr style="background-color: #ccccff; height: 40px;">

                    <div id="container-registrations-prev" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

                    <div id="container-registrations" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                    
                    <hr style="background-color: #ccccff; height: 40px;">
                    <!-- <div id="container-register" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-sm-6 col-md-6">
                                <div id="container-height-status" style="min-width: 310px; max-width: 600px; height: 400px; margin: 0 auto"></div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div id="container-weight-status" style="min-width: 310px; max-width: 600px; height: 400px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div> 

                    <hr style="background-color: #ccccff; height: 40px;">

                    <div id="container-target-male-low" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

                    <hr style="background-color: #ccccff; height: 10px;">

                    <div id="container-target-female-low" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

                    <hr style="background-color: #ccccff; height: 10px;">

                    <div id="container-target-male-high" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

                    <hr style="background-color: #ccccff; height: 10px;">

                    <div id="container-target-female-high" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

                    <hr style="background-color: #ccccff; height: 40px;">

                    <div class="panel-heading">
                        <h3 class="panel-title">Data Analytics - Regression Analysis (Actual ANC Statistics Data)</h3>
                        
                    </div>
                    <br>

                    <div id="container-individuals-age-reg" style="min-width: 350px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

                    <hr style="background-color: #ccccff; height: 10px;">

                    <div id="container-individuals-reg" style="min-width: 350px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

                    <hr style="background-color: #ccccff; height: 40px;">

                    <div class="panel-heading">
                        <h3 class="panel-title">Data Analytics - Regression Analysis (W.H.O. Statistics Data)</h3>
                        
                    </div>
                    <br>

                    <div id="container-individuals-age" style="min-width: 350px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

                    <hr style="background-color: #ccccff; height: 10px;">

                    <div id="container-individuals" style="min-width: 350px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

                    <!-- <div class="row">
                        <div class="col-lg-12">
                            <div class="col-sm-6 col-md-6">
                                <div id="container-target-male" style="min-width: 310px; max-width: 600px; height: 500px; margin: 0 auto"></div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div id="container-target-female" style="min-width: 310px; max-width: 600px; height: 500px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>  -->

                </div>

                           
                    

                    



                    
                    
                    


                    <!-- Hidden input files to be fetched by charts (active/graduated, gender PIE CHART)-->
                    <input type="hidden" value=<?php echo "'" . $children_count . "'"; ?> name="children_count"/>

                    <input type="hidden" value=<?php echo "'" . $children_active_male . "'"; ?> name="children_active_male"/>
                    <input type="hidden" value=<?php echo "'" . $children_active_female . "'"; ?> name="children_active_female"/>

                    <input type="hidden" value=<?php echo "'" . $children_graduated_male . "'"; ?> name="children_graduated_male"/>
                    <input type="hidden" value=<?php echo "'" . $children_graduated_female . "'"; ?> name="children_graduated_female"/>


                    <!-- Hidden input files to be fetched by charts (age, gender column-stacked-and-grouped BAR CHART)-->
                    <input type="hidden" value=<?php echo "'" . $m3_up . "'"; ?> name="m3_up"/>
                    <input type="hidden" value=<?php echo "'" . $m4_up . "'"; ?> name="m4_up"/>
                    <input type="hidden" value=<?php echo "'" . $m5_up . "'"; ?> name="m5_up"/>
                    <input type="hidden" value=<?php echo "'" . $m6_up . "'"; ?> name="m6_up"/>
                    <input type="hidden" value=<?php echo "'" . $m7_up . "'"; ?> name="m7_up"/>
                    <input type="hidden" value=<?php echo "'" . $m8_up . "'"; ?> name="m8_up"/>
                    <input type="hidden" value=<?php echo "'" . $m9_up . "'"; ?> name="m9_up"/>

                    <input type="hidden" value=<?php echo "'" . $f3_up . "'"; ?> name="f3_up"/>
                    <input type="hidden" value=<?php echo "'" . $f4_up . "'"; ?> name="f4_up"/>
                    <input type="hidden" value=<?php echo "'" . $f5_up . "'"; ?> name="f5_up"/>
                    <input type="hidden" value=<?php echo "'" . $f6_up . "'"; ?> name="f6_up"/>
                    <input type="hidden" value=<?php echo "'" . $f7_up . "'"; ?> name="f7_up"/>
                    <input type="hidden" value=<?php echo "'" . $f8_up . "'"; ?> name="f8_up"/>
                    <input type="hidden" value=<?php echo "'" . $f9_up . "'"; ?> name="f9_up"/>


                    <!-- Hidden input files to be fetched by charts (MONTHLY REGISTRATION LINE CHART)-->

                    <input type="hidden" value=<?php echo "'" . $current_year . "'"; ?> name="current_year"/>

                    <input type="hidden" value=<?php echo "'" . $jan . "'"; ?> name="jan"/>
                    <input type="hidden" value=<?php echo "'" . $feb . "'"; ?> name="feb"/>
                    <input type="hidden" value=<?php echo "'" . $mar . "'"; ?> name="mar"/>
                    <input type="hidden" value=<?php echo "'" . $apr . "'"; ?> name="apr"/>

                    <input type="hidden" value=<?php echo "'" . $may . "'"; ?> name="may"/>
                    <input type="hidden" value=<?php echo "'" . $jun . "'"; ?> name="jun"/>
                    <input type="hidden" value=<?php echo "'" . $jul . "'"; ?> name="jul"/>
                    <input type="hidden" value=<?php echo "'" . $aug . "'"; ?> name="aug"/>

                    <input type="hidden" value=<?php echo "'" . $sep . "'"; ?> name="sep"/>
                    <input type="hidden" value=<?php echo "'" . $oct . "'"; ?> name="oct"/>
                    <input type="hidden" value=<?php echo "'" . $nov . "'"; ?> name="nov"/>
                    <input type="hidden" value=<?php echo "'" . $dec . "'"; ?> name="dec"/>

                    <input type="hidden" value=<?php echo "'" . $prev_year . "'"; ?> name="prev_year"/>

                    <input type="hidden" value=<?php echo "'" . $prev_jan . "'"; ?> name="prev_jan"/>
                    <input type="hidden" value=<?php echo "'" . $prev_feb . "'"; ?> name="prev_feb"/>
                    <input type="hidden" value=<?php echo "'" . $prev_mar . "'"; ?> name="prev_mar"/>
                    <input type="hidden" value=<?php echo "'" . $prev_apr . "'"; ?> name="prev_apr"/>

                    <input type="hidden" value=<?php echo "'" . $prev_may . "'"; ?> name="prev_may"/>
                    <input type="hidden" value=<?php echo "'" . $prev_jun . "'"; ?> name="prev_jun"/>
                    <input type="hidden" value=<?php echo "'" . $prev_jul . "'"; ?> name="prev_jul"/>
                    <input type="hidden" value=<?php echo "'" . $prev_aug . "'"; ?> name="prev_aug"/>

                    <input type="hidden" value=<?php echo "'" . $prev_sep . "'"; ?> name="prev_sep"/>
                    <input type="hidden" value=<?php echo "'" . $prev_oct . "'"; ?> name="prev_oct"/>
                    <input type="hidden" value=<?php echo "'" . $prev_nov . "'"; ?> name="prev_nov"/>
                    <input type="hidden" value=<?php echo "'" . $prev_dec . "'"; ?> name="prev_dec"/>





                    <input type="hidden" value=<?php echo "'" . $sst . "'"; ?> name="sst"/>
                    <input type="hidden" value=<?php echo "'" . $st . "'"; ?> name="st"/>
                    <input type="hidden" value=<?php echo "'" . $hn . "'"; ?> name="hn"/>
                    <input type="hidden" value=<?php echo "'" . $t . "'"; ?> name="t"/>

                    <input type="hidden" value=<?php echo "'" . $su . "'"; ?> name="su"/>
                    <input type="hidden" value=<?php echo "'" . $u . "'"; ?> name="u"/>
                    <input type="hidden" value=<?php echo "'" . $wn . "'"; ?> name="wn"/>
                    <input type="hidden" value=<?php echo "'" . $o . "'"; ?> name="o"/>











                </div>
                <!--===================================================-->
                <!--End page content-->


            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->


            
        