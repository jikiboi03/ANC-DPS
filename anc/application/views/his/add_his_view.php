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
                                <button type="button" id="btnSave" onclick="save_new_his()" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;&nbsp;Save</button>

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
                                    <input name="date_interviewed" placeholder="Date Interviewed" class="form-control" type="date" style="height:33px;" />
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="head_id" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <?php 
                                            foreach($family as $row)
                                            { 
                                              echo '<option value="'.$row->family_id.'">'.$row->name.'</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <input name="dob" placeholder="Head's Date of Birth" class="form-control" type="date" style="height:33px;">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Lugar nga Natawhan :</label>
                                <label class="control-label col-md-8">Religion :</label>
                                <br><br>
                                <div class="col-md-4">
                                    <input name="pob" placeholder="Family Head's Place of Birth" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-8">
                                    <input name="religion" placeholder="Family Head's Religion" class="form-control" type="text">
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
                                        <option value="1" >Kahanas sa pagtahi</option>
                                        <option value="2" >Kahanas sa pagbuhat ug mga jewelries</option>
                                        <option value="3" >Kahanas sa pagbuhat ug bag</option>
                                        <option value="4" >Kahanas sa pagpanday</option>
                                        <option value="5" >Kahanas sa pagpintura</option>
                                        <option value="6" >Uban pa</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="insurance" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <option value="1" >SSS</option>
                                        <option value="2" >GSIS</option>
                                        <option value="3" >PhilHealth</option>
                                        <option value="4" >Coop Insurance</option>
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
                                        <option value="1" >Gipanag-iyahan ang balay og yuta</option>
                                        <option value="2" >Gipanag-iyahan ang balay, apan girentahan ang yuta</option>
                                        <option value="3" >Nagrenta sa balay og yuta</option>
                                        <option value="4" >Libreng nagpuyo sa balay og yuta</option>
                                        <option value="5" >Nakishare sa balay sa paryente</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="roof" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <option value="1" >Sin</option>
                                        <option value="2" >Guma</option>
                                        <option value="3" >Trapal</option>
                                        <option value="4" >Anahaw</option>
                                        <option value="5" >Walay atop</option>
                                        <option value="6" >Busloton ang atop</option>
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
                                        <option value="1" >Amakan</option>
                                        <option value="2" >Konkreto</option>
                                        <option value="3" >Trapal</option>
                                        <option value="4" >Plywood</option>
                                        <option value="5" >Halu-halo</option>
                                        <option value="6" >Sako</option>
                                        <option value="7" >Walay bungbong</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="floor" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <option value="1" >Konkreto</option>
                                        <option value="2" >Tabla</option>
                                        <option value="3" >Plywood</option>
                                        <option value="4" >Kawayan</option>
                                        <option value="5" >Deretso sa yuta</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="room" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <option value="1" >Walay kwarto</option>
                                        <option value="2" >May 1 ka kwarto</option>
                                        <option value="3" >May 2 ka kwarto</option>
                                        <option value="4" >May 3 ka kwarto</option>
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
                                        <option value="1" >Deretso sa silong</option>
                                        <option value="2" >May inidoro</option>
                                        <option value="3" >Nakigamit sa silingan</option>
                                        <option value="4" >Giputos ug gilabay sa basurahan</option>
                                        <option value="5" >Giputos ug gilabay sa dagat</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6">
                                    <select name="garbage" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <option value="1" >Ginalahi ang malata, di malata, og mapuslan</option>
                                        <option value="2" >Ginalabay sa ilalom sa balay</option>
                                        <option value="3" >Ginalabay sa dagat</option>
                                        <option value="4" >Ginalabay sa bisan asa</option>
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
                                        <option value="1" >May kaugalingong gripo</option>
                                        <option value="2" >Magpalit sa silingan</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6">
                                    <select name="light" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <option value="1" >Kuryente</option>
                                        <option value="2" >Lampara</option>
                                        <option value="3" >Kandila</option>
                                        <option value="4" >Hayag gikan sa poste</option>
                                        <option value="5" >Wala</option>
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
                                        <option value="1" >Kada adlaw</option>
                                        <option value="2" >Kada ikaduha ka adlaw</option>
                                        <option value="3" >Ka usa ka beses sa 1 ka semana</option>
                                        <option value="4" >Walay ligo</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="r_bath" placeholder="Specify the reason" class="form-control"></textarea>
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
                                        <option value="1" >1 ka beses</option>
                                        <option value="2" >2 ka beses</option>
                                        <option value="3" >3 ka beses</option>
                                        <option value="4" >Sobra sa 4 ka beses</option>
                                        <option value="5" >Walay mapakaon</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6">
                                    <select name="cook" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <option value="1" >LPG (Liquified Petrolium Gas)</option>
                                        <option value="2" >Lutoan gamit ang kerosene</option>
                                        <option value="3" >Lutoan gamit ang uling</option>
                                        <option value="4" >Lutoan gamit ang kahoy</option>
                                        <option value="5" >Walay lutoan</option>
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
                                <label class="control-label col-md-8">Kung naa :</label>
                                
                                <br>
                                <div class="col-md-4">
                                    <select name="harassment" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <option value="1" >Wala</option>
                                        <option value="2" >Naa</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="r_harassment" placeholder="Specify to whom and the type of abuse experienced" class="form-control"></textarea>
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
                                        <option value="1" >Oo</option>
                                        <option value="2" >Dili</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="r_contented" placeholder="Specify the reason" class="form-control"></textarea>
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
                                        <option value="1" >Katoliko</option>
                                        <option value="2" >Muslim</option>
                                        <option value="3" >Iglesia ni Kristo</option>
                                        <option value="4" >Mormon</option>
                                        <option value="5" >Born Again</option>
                                        <option value="6" >Walay gituhoang relihiyon</option>
                                        <option value="7" >Uban pa</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6">
                                    <select name="church" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <option value="1" >Kada adlaw</option>
                                        <option value="2" >Kada semana</option>
                                        <option value="3" >Kasal, bunyag og lubong</option>
                                        <option value="4" >Kausa sa 1 ka tuig</option>
                                        <option value="5" >Dili nagasimba</option>
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
                                        <option value="1" >GKK</option>
                                        <option value="2" >Kooperatiba</option>
                                        <option value="3" >Senior Citizen</option>
                                        <option value="4" >Women's Organization</option>
                                        <option value="5" >Uban pa</option>
                                        <option value="6" >Wala</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6">
                                    <textarea name="plans" placeholder="Specify the reason" class="form-control"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <br><br>

                            <div class="col-md-12">
                                <hr>
                                <br>
                            </div>

                            <br><br><br><br><br>

                            <div class="form-group">
                                <label class="control-label col-md-4">Kasagarang sakit sa pamilya? :</label>
                                <label class="control-label col-md-4">Nagainom ba ug tambal? :</label>
                                <label class="control-label col-md-4">Asa gipangayo o gipalit ang tambal? :</label>
                                
                                <br>
                                <div class="col-md-4">
                                    <textarea name="illness" placeholder="Please specify" class="form-control"></textarea>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="medicine" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <option value="1" >Oo</option>
                                        <option value="2" >Wala</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <textarea name="medicine_source" placeholder="Please specify" class="form-control"></textarea>
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
                                        <option value="1" >Oo</option>
                                        <option value="2" >Wala</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <textarea name="s_product" placeholder="Please specify" class="form-control"></textarea>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <textarea name="s_benefit" placeholder="Please specify" class="form-control"></textarea>
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
                                        <option value="1" >Oo</option>
                                        <option value="2" >Wala</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <textarea name="l_benefit" placeholder="Please specify" class="form-control"></textarea>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-4">
                                    <select name="beneficiary" class="form-control">
                                        <option value="">----- Select -----</option>
                                        <option value="1" >Oo</option>
                                        <option value="2" >Dili</option>
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
                        <button type="button" id="btnSave" onclick="save_new_his()" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;&nbsp;Save</button>

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

