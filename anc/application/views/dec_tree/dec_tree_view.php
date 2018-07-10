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

                        <input type="hidden" value=<?php echo "'" . $child->child_id . "'"; ?> name="child_id"/> 

                        <div style="float:left; margin-right: 2%;">

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

                            <div align="right" style="margin-right: 3%;">
                                
                                <button type="button" class="btn btn-danger"  onclick="cancel_hvi()"><i class="fa fa-times"></i> &nbsp;Back to Profile</button>
                            </div>
                            <hr>
                            <label class="control-label col-md-9" style="color:brown;"><h3>Recommended Meal Plan &nbsp;<i class="fa fa-info-circle"></i></h3>( Sources: WHO Department of Nutrition for Health and Development, CCFP - Child Care Food Program )</label>
                            <label class="control-label col-md-3"><h4>Breakfast: <br>1/2 to 1 cup of milk, bread, biscuits, cereal, pasta, or noodles</h4></label>
                            <label class="control-label col-md-3"><h4>Lunch: <br>1/2 to 1 cup of milk, rice, vegetables, or fruits</h4></label>
                            <label class="control-label col-md-3"><h4>Dinner: <br>vegetables or fruits, meat or meat alternates, rice, milk and grains / bread</h4></label>
                            <label class="control-label col-md-3"><h4>Snack: <br>grains / bread or vegetables / fruits</h4></label>

                            <label class="control-label col-md-6"><h4>Necessary Nutrients: </h4>Protein, Energy (Calories needed per day: 1,200 to 1,600 ), Vitamin A and Carotene, Vitamin D, Vitamin E, Vitamin K, Thiamine, Riboflavin, Niacin, Vitamin B6, Pantothenic Acid, Biotin, Folate, Vitamin C, Antioxidants, Calcium, Iron, Zinc, Selenium, Magnesium, and Iodine.</label>
                        </div>
                        </div>

                            

                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        <div class="panel-body">
                            <hr>
                            <p class="panel-title"><?php echo $current_status; ?></p>
                            <hr>
                            <p style="font-size: 13px;"><i>The Decision support shows the possible problems, causes and some other factors regarding the failing nutrional status of the child as well as the recommended solutions provided. Data used are based on the CIS form, Monthly Monitoring, HVI Quarterly, HIS Family Background</i></p>
                            
                            <table id="dec-tree-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Problems / Possible Causes</th>
                                        <th>Suggestions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            <!-- End Striped Table -->
                            <!-- <span>&nbsp; <i style = "color: #99ffff;" class="fa fa-square"></i> - Male &nbsp; | &nbsp; <i style = "color: #ffcccc;" class="fa fa-square"></i> - Female</span> -->

                        </div>
                        <hr>
                        <label class="control-label col-md-9" style="color:green;"><h3>Recommended Vitamins &nbsp;<i class="fa fa-info-circle"></i></h3></label>

                        <label class="control-label col-md-6"><h4>Vitamin A ( Atleast twice a week): </h4>Fruits (Mangoes, Oranges, Papaya, Watermelon ) | Vegetables ( Cabbage, Carrots, Squash, Sweet Potato, Tomato )</label>

                        <label class="control-label col-md-6"><h4>Vitamin C (Daily): </h4>Fruits (Apples, Avocados, Banana, Guava, Oranges, Papaya, Pineapple, Watermelon ) | Vegetables ( Cabbage, Carrots, Corn, Cucumber, Green Beans, Okra, Potato, Squash, Tomato )</label>
                    </div>
                    <!--===================================================-->
                    
                </div>
                <!--===================================================-->
                <!--End page content-->
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->