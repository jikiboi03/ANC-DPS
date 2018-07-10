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
                    <div class="panel" style="height: 2600px;">
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

                        <div class="form-group">
                            <label class="control-label col-md-3" style="color:gray;"><h5>ID: <?php echo $child->child_id ?></h5></label>
                            <label class="control-label col-md-3" style="color:blue;"><h5>Status: <?php if($child->graduated == 0){ echo 'Ongoing Treatment'; }else{ echo 'Graduated'; } ?></h5></label>

                            <div align="right" style="margin-right: 3%">
                                <button type="button" id="btnSave" onclick="save_update_his()" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;&nbsp;Save</button>

                                <button type="button" class="btn btn-danger"  onclick="cancel_his()"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                            </div>

                            <hr>
                        </div>    

                    <form action="#" id="form">
                        <input type="hidden" value=<?php echo "'" . $child->child_id . "'" ?> name="child_id"/>
                        <input type="hidden" value=<?php echo "'" . $child->firstname . ', ' . $child->middlename . ' ' . $child->lastname . "'" ?> name="child_fullname"/>
                        
                        <div class="form-body col-md-9">

                            <div class="form-group">
                                <label class="control-label col-md-4">Date Interviewed :</label>
                                <label class="control-label col-md-4">Ulohan sa Pamilya :</label>
                                <label class="control-label col-md-4">Adlaw nga Natawhan :</label>
                                <br><br>
                                <div class="col-md-4">
                                    <input name="date_interviewed" placeholder="Date Interviewed" class="form-control" type="date" style="height:33px;" value=<?php echo "'" . $his->date_interviewed . "'" ?> />
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="head_id" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 
                                            foreach($family as $row)
                                            { 
                                                if ($his->head_id == $row->family_id)
                                                {
                                                    echo '<option value="'.$row->family_id.'" selected>'.$row->name.'</option>';      
                                                }
                                                else
                                                {
                                                    echo '<option value="'.$row->family_id.'">'.$row->name.'</option>';         
                                                }
                                              
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <input name="dob" placeholder="Head's Date of Birth" class="form-control" type="date" style="height:33px;" value=<?php echo "'" . $his->dob . "'" ?>>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Lugar nga Natawhan:</label>
                                <br><br>
                                <div class="col-md-8">
                                    <input name="pob" placeholder="Family Head's Place of Birth" class="form-control" type="text" value=<?php echo "'" . $his->pob . "'" ?> />
                                    <span class="help-block"></span>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <hr>
                            </div>  

                            <div class="form-group">
                                <label class="control-label col-md-8">Kasagarang Kahanas? :</label>
                                <label class="control-label col-md-4">Insurance Naapilan? :</label>
                                
                                <br><br><br><br><br><br>
                                <div class="col-md-8">
                                    <select name="income_source" class="form-control">
                                        <option value="">----- Select -----</option>
                                        
                                        <?php 

                                            if ($his->income_source == '1')
                                            {
                                                echo '<option value="1" selected>Kahanas sa pagtahi</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Kahanas sa pagtahi</option>';   
                                            }
                                            if ($his->income_source == '2')
                                            {
                                                echo '<option value="2" selected>Kahanas sa pagbuhat ug mga jewelries</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Kahanas sa pagbuhat ug mga jewelries</option>';
                                            }
                                            if ($his->income_source == '3')
                                            {
                                                echo '<option value="3" selected>Kahanas sa pagbuhat ug bag</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >Kahanas sa pagbuhat ug bag</option>';
                                            }
                                            if ($his->income_source == '4')
                                            {
                                                echo '<option value="4" selected>Kahanas sa pagpanday</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >Kahanas sa pagpanday</option>';
                                            }
                                            if ($his->income_source == '5')
                                            {
                                                echo '<option value="5" selected>Kahanas sa pagpintura</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="5" >Kahanas sa pagpintura</option>';
                                            }
                                            if ($his->income_source == '6')
                                            {
                                                echo '<option value="6" selected>Uban pa</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="6" >Uban pa</option>';   
                                            }
                                        ?>
                                        
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="insurance" class="form-control">
                                        <option value="">----- Select -----</option>

                                        <?php 

                                            if ($his->insurance == '1')
                                            {
                                                echo '<option value="1" selected>SSS</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >SSS</option>';
                                            }
                                            if ($his->insurance == '2')
                                            {
                                                echo '<option value="2" selected>GSIS</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >GSIS</option>';
                                            }
                                            if ($his->insurance == '3')
                                            {
                                                echo '<option value="3" selected>PhilHealth</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >PhilHealth</option>';   
                                            }
                                            if ($his->insurance == '4')
                                            {
                                                echo '<option value="4" selected>Coop Insurance</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >Coop Insurance</option>';
                                            }
                                        ?>                                            
                                        
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br>

                            <div class="col-md-12">
                                <br>
                                <br>
                                <label class="control-label col-md-8" style="font-size: 15px;">Unsa ang kahimtang sa balay nga mga mosunod?</label>
                                <br>
                                <hr>
                            </div>  
                            
                            <div class="form-group">
                                <label class="control-label col-md-8">BALAY :</label>
                                <label class="control-label col-md-4">ATOP :</label>
                                <br><br> 
                                
                                <div class="col-md-8">
                                    <select name="house" class="form-control">
                                        <option value="">----- Select -----</option>

                                        <?php 

                                            if ($his->house == '1')
                                            {
                                                echo '<option value="1" selected>Gipanag-iyahan ang balay og yuta</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Gipanag-iyahan ang balay og yuta</option>';
                                            }
                                            if ($his->house == '2')
                                            {
                                                echo '<option value="2" selected>Gipanag-iyahan ang balay, apan girentahan ang yuta</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Gipanag-iyahan ang balay, apan girentahan ang yuta</option>';
                                            }
                                            if ($his->house == '3')
                                            {
                                                echo '<option value="3" selected>Nagrenta sa balay og yuta</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >Nagrenta sa balay og yuta</option>';
                                            }
                                            if ($his->house == '4')
                                            {
                                                echo '<option value="4" selected>Libreng nagpuyo sa balay og yuta</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >Libreng nagpuyo sa balay og yuta</option>';
                                            }
                                            if ($his->house == '5')
                                            {
                                                echo '<option value="5" selected>Nakishare sa balay sa paryente</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="5" >Nakishare sa balay sa paryente</option>';
                                            }
                                        ?>

                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="roof" class="form-control">
                                        <option value="">----- Select -----</option>

                                        <?php 

                                            if ($his->roof == '1')
                                            {
                                                echo '<option value="1" selected>Sin</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Sin</option>';   
                                            }
                                            if ($his->roof == '2')
                                            {
                                                echo '<option value="2" selected>Guma</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Guma</option>';
                                            }
                                            if ($his->roof == '3')
                                            {
                                                echo '<option value="3" selected>Trapal</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >Trapal</option>';
                                            }
                                            if ($his->roof == '4')
                                            {
                                                echo '<option value="4" selected>Anahaw</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >Anahaw</option>';
                                            }
                                            if ($his->roof == '5')
                                            {
                                                echo '<option value="5" selected>Walay atop</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="5" >Walay atop</option>';   
                                            }
                                            if ($his->roof == '6')
                                            {
                                                echo '<option value="6" selected>Busloton ang atop</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="6" >Busloton ang atop</option>';   
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br>

                            <div class="form-group">
                                <label class="control-label col-md-4">BUNGBONG :</label>
                                <label class="control-label col-md-4">SALOG :</label>
                                <label class="control-label col-md-4">KWARTO :</label>
                                <br><br> 
                                
                                <div class="col-md-4">
                                    <select name="wall" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->wall == '1')
                                            {
                                                echo '<option value="1" selected>Amakan</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Amakan</option>';
                                            }
                                            if ($his->wall == '2')
                                            {
                                                echo '<option value="2" selected>Konkreto</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Konkreto</option>';
                                            }
                                            if ($his->wall == '3')
                                            {
                                                echo '<option value="3" selected>Trapal</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >Trapal</option>';
                                            }
                                            if ($his->wall == '4')
                                            {
                                                echo '<option value="4" selected>Plywood</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >Plywood</option>';
                                            }
                                            if ($his->wall == '5')
                                            {
                                                echo '<option value="5" selected>Halu-halo</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="5" >Halu-halo</option>';
                                            }
                                            if ($his->wall == '6')
                                            {
                                                echo '<option value="6" selected>Sako</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="6" >Sako</option>';
                                            }
                                            if ($his->wall == '7')
                                            {
                                                echo '<option value="7" selected>Walay bungbong</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="7" >Walay bungbong</option>';
                                            }

                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="floor" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->floor == '1')
                                            {
                                                echo '<option value="1" selected>Konkreto</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Konkreto</option>';
                                            }
                                            if ($his->floor == '2')
                                            {
                                                echo '<option value="2" selected>Tabla</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Tabla</option>';   
                                            }
                                            if ($his->floor == '3')
                                            {
                                                echo '<option value="3" selected>Plywood</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >Plywood</option>';   
                                            }
                                            if ($his->floor == '4')
                                            {
                                                echo '<option value="4" selected>Kawayan</option>';
                                            }
                                            else
                                            {   
                                                echo '<option value="4" >Kawayan</option>';
                                            }
                                            if ($his->floor == '5')
                                            {
                                                echo '<option value="5" selected>Deretso sa yuta</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="5" >Deretso sa yuta</option>';
                                            }
                                        ?>

                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="room" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->room == '1')
                                            {
                                                echo '<option value="1" selected>Walay kwarto</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Walay kwarto</option>';
                                            }
                                            if ($his->room == '2')
                                            {
                                                echo '<option value="2" selected>May 1 ka kwarto</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >May 1 ka kwarto</option>';
                                            }
                                            if ($his->room == '3')
                                            {
                                                echo '<option value="3" selected>May 2 ka kwarto</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >May 2 ka kwarto</option>';
                                            }
                                            if ($his->room == '4')
                                            {
                                                echo '<option value="4" selected>May 3 ka kwarto</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >May 3 ka kwarto</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br>

                            <div class="col-md-12">
                                <hr>
                                <br>
                            </div>  

                            <div class="form-group">
                                <label class="control-label col-md-6">Pagdispatsa sa hugaw sa lawas? :</label>
                                <label class="control-label col-md-6">Pamaagi sa paglabay sa basura? :</label>
                                
                                <br><br><br><br><br><br>
                                <div class="col-md-6">
                                    <select name="disposition" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->disposition == '1')
                                            {
                                                echo '<option value="1" selected>Deretso sa silong</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Deretso sa silong</option>';   
                                            }
                                            if ($his->disposition == '2')
                                            {
                                                echo '<option value="2" selected>May inidoro</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >May inidoro</option>';
                                            }
                                            if ($his->disposition == '3')
                                            {
                                                echo '<option value="3" selected>Nakigamit sa silingan</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >Nakigamit sa silingan</option>';
                                            }
                                            if ($his->disposition == '4')
                                            {
                                                echo '<option value="4" selected>Giputos ug gilabay sa basurahan</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >Giputos ug gilabay sa basurahan</option>';
                                            }
                                            if ($his->disposition == '5')
                                            {
                                                echo '<option value="5" selected>Giputos ug gilabay sa dagat</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="5" >Giputos ug gilabay sa dagat</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6">
                                    <select name="garbage" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->garbage == '1')
                                            {
                                                echo '<option value="1" selected>Ginalahi ang malata, di malata, og mapuslan</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Ginalahi ang malata, di malata, og mapuslan</option>';
                                            }
                                            if ($his->garbage == '2')
                                            {
                                                echo '<option value="2" selected>Ginalabay sa ilalom sa balay</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Ginalabay sa ilalom sa balay</option>';
                                            }
                                            if ($his->garbage == '3')
                                            {
                                                echo '<option value="3" selected>Ginalabay sa dagat</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >Ginalabay sa dagat</option>';
                                            }
                                            if ($his->garbage == '4')
                                            {
                                                echo '<option value="4" selected>Ginalabay sa bisan asa</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >Ginalabay sa bisan asa</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br>

                            <div class="col-md-12">
                                <hr>
                                <br>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-6">Unsay pamaagi sa pagkuha sa tubig? :</label>
                                <label class="control-label col-md-6">Unsay gigamit nga suga? :</label>
                                
                                <br><br><br><br><br><br>
                                <div class="col-md-6">
                                    <select name="water" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->water == '1')
                                            {
                                                echo '<option value="1" selected>May kaugalingong gripo</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >May kaugalingong gripo</option>';
                                            }
                                            if ($his->water == '2')
                                            {
                                                echo '<option value="2" selected>Magpalit sa silingan</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Magpalit sa silingan</option>';   
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6">
                                    <select name="light" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->light == '1')
                                            {
                                                echo '<option value="1" selected>Kuryente</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Kuryente</option>';
                                            }
                                            if ($his->light == '2')
                                            {
                                                echo '<option value="2" selected>Lampara</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Lampara</option>';
                                            }
                                            if ($his->light == '3')
                                            {
                                                echo '<option value="3" selected>Kandila</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >Kandila</option>';
                                            }
                                            if ($his->light == '4')
                                            {
                                                echo '<option value="4" selected>Hayag gikan sa poste</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >Hayag gikan sa poste</option>';
                                            }
                                            if ($his->light == '5')
                                            {
                                                echo '<option value="5" selected>Wala</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="5" >Wala</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br><br>

                            <div class="form-group">
                                <label class="control-label col-md-4">Pila ka beses maligoan ang mga bata? :</label>
                                <label class="control-label col-md-8">Rason nganong dili mapaligoan ang mga bata? :</label>
                                
                                <br>
                                <div class="col-md-4">
                                    <select name="bath" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->bath == '1')
                                            {
                                                echo '<option value="1" selected>Kada adlaw</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Kada adlaw</option>';
                                            }
                                            if ($his->bath == '2')
                                            {
                                                echo '<option value="2" selected>Kada ikaduha ka adlaw</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Kada ikaduha ka adlaw</option>';
                                            }
                                            if ($his->bath == '3')
                                            {
                                                echo '<option value="3" selected>Ka usa ka beses sa 1 ka semana</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >Ka usa ka beses sa 1 ka semana</option>';
                                            }
                                            if ($his->bath == '4')
                                            {
                                                echo '<option value="4" selected>Walay ligo</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >Walay ligo</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="r_bath" placeholder="Specify the reason" class="form-control"><?php echo $his->r_bath ?></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br>

                            <div class="col-md-12">
                                <hr>
                                <br>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-6">Kapila ka beses mapakaon ang bata? :</label>
                                <label class="control-label col-md-6">Unsa gigamit na pangluto sa pagkaon? :</label>
                                
                                <br>
                                <div class="col-md-6">
                                    <select name="food" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->food == '1')
                                            {
                                                echo '<option value="1" selected>1 ka beses</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >1 ka beses</option>';
                                            }
                                            if ($his->food == '2')
                                            {
                                                echo '<option value="2" selected>2 ka beses</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >2 ka beses</option>';
                                            }
                                            if ($his->food == '3')
                                            {
                                                echo '<option value="3" selected>3 ka beses</option>';
                                            }
                                            else
                                            {   
                                                echo '<option value="3">3 ka beses</option>';
                                            }
                                            if ($his->food == '4')
                                            {
                                                echo '<option value="4" selected>Sobra sa 4 ka beses</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >Sobra sa 4 ka beses</option>';
                                            }
                                            if ($his->food == '5')
                                            {
                                                echo '<option value="5" selected>Walay mapakaon</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="5" >Walay mapakaon</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6">
                                    <select name="cook" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->cook == '1')
                                            {
                                                echo '<option value="1" selected>LPG (Liquified Petrolium Gas)</option>';
                                            }
                                            else
                                            {   
                                                echo '<option value="1" >LPG (Liquified Petrolium Gas)</option>';
                                            }
                                            if ($his->cook == '2')
                                            {
                                                echo '<option value="2" selected>Lutoan gamit ang kerosene</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Lutoan gamit ang kerosene</option>';
                                            }
                                            if ($his->cook == '3')
                                            {
                                                echo '<option value="3" selected>Lutoan gamit ang uling</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >Lutoan gamit ang uling</option>';
                                            }
                                            if ($his->cook == '4')
                                            {
                                                echo '<option value="4" selected>Lutoan gamit ang kahoy</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >Lutoan gamit ang kahoy</option>';
                                            }
                                            if ($his->cook == '5')
                                            {
                                                echo '<option value="5" selected>Walay lutoan</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="5" >Walay lutoan</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br>

                            <div class="col-md-12">
                                <hr>
                                <br>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Nakasinati nga pagpang-abuso? :</label>
                                <label class="control-label col-md-8">Kung naa ky kinsa ug unsa?:</label>
                                
                                <br>
                                <div class="col-md-4">
                                    <select name="harassment" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->harassment == '1')
                                            {
                                                echo '<option value="1" selected>Wala</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Wala</option>';   
                                            }
                                            if ($his->harassment == '2')
                                            {
                                                echo '<option value="2" selected>Naa</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Naa</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="r_harassment" placeholder="Specify to whom and the type of abuse experienced" class="form-control"><?php echo $his->r_harassment ?></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br><br>


                            <div class="form-group">
                                <label class="control-label col-md-4">Kontento na kahimtang? :</label>
                                <label class="control-label col-md-8">Ngano man? :</label>
                                
                                <br><br><br><br><br><br>
                                <div class="col-md-4">
                                    <select name="contented" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->contented == '1')
                                            {
                                                echo '<option value="1" selected>Oo</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Oo</option>';   
                                            }
                                            if ($his->contented == '2')
                                            {
                                                echo '<option value="2" selected>Dili</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Dili</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="r_contented" placeholder="Specify the reason" class="form-control"><?php echo $his->r_contented ?></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br>

                            <div class="col-md-12">
                                <hr>
                                <br>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-6">Unsa ang relihiyon nga gitoohan sa pamilya? :</label>
                                <label class="control-label col-md-6">Makanunayon ba ang pagduaw sa simbahan? kapila? :</label>
                                
                                <br><br><br><br><br><br>
                                <div class="col-md-6">
                                    <select name="religion" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->religion == '1')
                                            {
                                                echo '<option value="1" selected>Katoliko</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Katoliko</option>';
                                            }
                                            if ($his->religion == '2')
                                            {
                                                echo '<option value="2" selected>Muslim</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Muslim</option>';
                                            }
                                            if ($his->religion == '3')
                                            {
                                                echo '<option value="3" selected>Iglesia ni Kristo</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >Iglesia ni Kristo</option>';
                                            }
                                            if ($his->religion == '4')
                                            {
                                                echo '<option value="4" selected>Mormon</option>';
                                            }
                                            else
                                            {   
                                                echo '<option value="4" >Mormon</option>';
                                            }
                                            if ($his->religion == '5')
                                            {
                                                echo '<option value="5" selected>Born Again</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="5" >Born Again</option>';
                                            }
                                            if ($his->religion == '6')
                                            {
                                                echo '<option value="6" selected>Walay gituhoang relihiyon</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="6" >Walay gituhoang relihiyon</option>';
                                            }
                                            if ($his->religion == '7')
                                            {
                                                echo '<option value="7" selected>Uban pa</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="7" >Uban pa</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6">
                                    <select name="church" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->church == '1')
                                            {
                                                echo '<option value="1" selected>Kada adlaw</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Kada adlaw</option>';
                                            }
                                            if ($his->church == '2')
                                            {
                                                echo '<option value="2" selected>Kada semana</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Kada semana</option>';
                                            }
                                            if ($his->church == '3')
                                            {
                                                echo '<option value="3" selected>Kasal, bunyag og lubong</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >Kasal, bunyag og lubong</option>';
                                            }
                                            if ($his->church == '4')
                                            {
                                                echo '<option value="4" selected>Kausa sa 1 ka tuig</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >Kausa sa 1 ka tuig</option>';
                                            }
                                            if ($his->church == '5')
                                            {
                                                echo '<option value="5" selected>Dili nagasimba</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="5" >Dili nagasimba</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br><br><br><br>

                            <div class="form-group">
                                <label class="control-label col-md-6">Unsang pundok sa komunidad ka aktibong membro? :</label>
                                <label class="control-label col-md-6">Unsa ang imong mga plano sa umaabot? :</label>
                                
                                <br>
                                <div class="col-md-6">
                                    <select name="community" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->community == '1')
                                            {
                                                echo '<option value="1" selected>GKK</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >GKK</option>';
                                            }
                                            if ($his->community == '2')
                                            {
                                                echo '<option value="2" selected>Kooperatiba</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Kooperatiba</option>';
                                            }
                                            if ($his->community == '3')
                                            {
                                                echo '<option value="3" selected>Senior Citizen</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="3" >Senior Citizen</option>';
                                            }
                                            if ($his->community == '4')
                                            {
                                                echo '<option value="4" selected>Women\'s Organization</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="4" >Women\'s Organization</option>';
                                            }
                                            if ($his->community == '5')
                                            {
                                                echo '<option value="5" selected>Uban pa</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="5" >Uban pa</option>';
                                            }
                                            if ($his->community == '6')
                                            {
                                                echo '<option value="6" selected>Wala</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="6" >Wala</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6">
                                    <textarea name="plans" placeholder="Specify the reason" class="form-control"><?php echo $his->plans ?></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br>

                            <div class="col-md-12">
                                <hr>
                                <br>
                            </div>

                            

                            <div class="form-group">
                                <label class="control-label col-md-4">Kasagarang sakit sa pamilya? :</label>
                                <label class="control-label col-md-4">Nagainom ba ug tambal? :</label>
                                <label class="control-label col-md-4">Asa gipangayo o gipalit ang tambal? :</label>
                                
                                <br>
                                <div class="col-md-4">
                                    <textarea name="illness" placeholder="Please specify" class="form-control"><?php echo $his->illness ?></textarea>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="medicine" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->medicine == '1')
                                            {
                                                echo '<option value="1" selected>Oo</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Oo</option>';
                                            }
                                            if ($his->medicine == '2')
                                            {
                                                echo '<option value="2" selected>Wala</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Wala</option>';   
                                            }
                                        ?>
                                        
                                        
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <textarea name="medicine_source" placeholder="Please specify" class="form-control"><?php echo $his->medicine_source ?></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br>

                            <div class="col-md-12">
                                <hr>
                                <br>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Anaa bay nagapanigarilyo? :</label>
                                <label class="control-label col-md-4">Unsang produkto ginagamit? :</label>
                                <label class="control-label col-md-4">Makaayo ba kini sa pang lawas? :</label>
                                
                                <br>
                                <div class="col-md-4">
                                    <select name="smoking" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->smoking == '1')
                                            {
                                                echo '<option value="1" selected>Oo</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Oo</option>';
                                            }
                                            if ($his->smoking == '2')
                                            {
                                                echo '<option value="2" selected>Wala</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Wala</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <textarea name="s_product" placeholder="Please specify" class="form-control"><?php echo $his->s_product ?></textarea>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <textarea name="s_benefit" placeholder="Please specify" class="form-control"><?php echo $his->s_benefit ?></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br><br><br><br><br><br><br>

                            <div class="form-group">
                                <label class="control-label col-md-4">Anaa bay nagainom ug alak? :</label>
                                <label class="control-label col-md-4">Makaayo ba kini sa panglawas? :</label>
                                <label class="control-label col-md-4">Uyon ka ba matabangan sa ANC? :</label>
                                
                                <br>
                                <div class="col-md-4">
                                    <select name="liquor" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->liquor == '1')
                                            {
                                                echo '<option value="1" selected>Oo</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Oo</option>';
                                            }
                                            if ($his->liquor == '2')
                                            {
                                                echo '<option value="2" selected>Wala</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Wala</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <textarea name="l_benefit" placeholder="Please specify" class="form-control"><?php echo $his->l_benefit ?></textarea>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="beneficiary" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 

                                            if ($his->beneficiary == '1')
                                            {
                                                echo '<option value="1" selected>Oo</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="1" >Oo</option>';
                                            }
                                            if ($his->beneficiary == '2')
                                            {
                                                echo '<option value="2" selected>Dili</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="2" >Dili</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br>

                            <div class="col-md-12">
                                <hr>
                            </div> 

                            
                        </div>
                    </form>

                    <div class="form-group" align="right" style="margin-right: 5%;">
                        <button type="button" id="btnSave" onclick="save_update_his()" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;&nbsp;Save</button>

                        <button type="button" class="btn btn-danger"  onclick="cancel_his()"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                    </div>

  



                        <!-- <div class="panel-body">
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
                        </div> -->
                    </div>
                    <!--===================================================-->
                    <!-- End Striped Table -->
                    <!-- <span>&nbsp; <i style = "color: #99ffff;" class="fa fa-square"></i> - Male &nbsp; | &nbsp; <i style = "color: #ffcccc;" class="fa fa-square"></i> - Female</span> -->
                </div>
                <!--===================================================-->
                <!--End page content-->
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->

