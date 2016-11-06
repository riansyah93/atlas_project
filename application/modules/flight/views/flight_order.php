<div class="container">
    <br><br>
          <div class="row">
          <h2> Form Pemesanan </h2>
         <div class="col-xs-8">
           
           <div id="data-diri" style="border-style: groove; padding: 10px;">
             
           <h3> Data Diri </h3>
           <form method="post" action="<?php echo base_url('flight/add_order')?>" >
           <input type="hidden" name="flight_id" value="<?php echo $list->flight_id; ?>">
           <input type="hidden" name="count_adult" value="<?php echo $list->count_adult; ?>">
           <input type="hidden" name="count_child" value="<?php echo $list->count_child; ?>">
           <input type="hidden" name="count_infant" value="<?php echo $list->count_infant; ?>">
           <input type="hidden" name="token_id" value="<?php echo $token_id; ?>">
             <div class="row">
               <div class="form-group col-xs-2">
                <label for="exampleInputEmail1">Salutation </label>
                <select class="form-control" name="conSalutation">
                  <option>Tuan</option>
                  <option>Nyonya</option>
                  
                </select>
              </div>
               <div class="form-group col-xs-5">
                <label for="conFirstName">FirstName</label>
                <input type="text" name="conFirstName" class="form-control" id="conFirstName" placeholder="Email">
              </div>
              <div class="form-group col-xs-5">
                <label for="conLastName">LastName</label>
                <input type="text" name="conLastName" class="form-control" id="conLastName" placeholder="Email">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-xs-6">
                <label for="conEmailAddress">Email</label>
                <input type="email" name ="conEmailAddress" class="form-control" id="conEmailAddress" placeholder="Email">
              </div>
              <div class="form-group col-xs-6">
                <label for="conPhone">Phone</label>
                <input type="number" name="conPhone" class="form-control" id="conPhone" placeholder="Email">
              </div>
            </div>
            
            </div>
            <br>
             <div id="data-diri" style="border-style: groove; padding: 10px;">
             
           <h3> Data Penumpang(Dewasa-1) </h3>
          
           <div id="adult-1">
             <div class="row">
               <div class="form-group col-xs-2">
                <label for="exampleInputEmail1">Salutation </label>
                <select class="form-control" name="titlea1">
                  <option>Tuan</option>
                  <option>Nyonya</option>
                  
                </select>
              </div>
               <div class="form-group col-xs-5">
                <label for="exampleInputEmail1">FirstName</label>
                <input type="text" name="firstnamea1" class="form-control" id="exampleInputEmail1" placeholder="Email">
              </div>
              <div class="form-group col-xs-5">
                <label for="exampleInputEmail1">LastName</label>
                <input type="text" name="lastnamea1" class="form-control" id="exampleInputEmail1" placeholder="Email">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-xs-6">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
              </div>
              <div class="form-group col-xs-6">
                <label for="exampleInputEmail1">Phone</label>
                <input type="number" name="conOtherPhone" class="form-control" id="exampleInputEmail1" placeholder="Email">
              </div>
            </div>
            <label for="exampleInputEmail1">Tanggal Lahir</label>
            <div class="row">

              <div class="form-group col-xs-6">
                
                <div class="col-xs-3" id="exampleInputEmail1">
                  <select class="form-control" placeholder="tanggal" name="datebirtha1">
                    <?php for($a =1; $a <=31; $a++){
                      echo "<option value='".str_pad($a, 2, "0", STR_PAD_LEFT)."'>".str_pad($a, 2, "0", STR_PAD_LEFT)."</option>";
                    }?>
                  </select>
                </div>
                <div class="col-xs-5" id="exampleInputEmail1">
                  <select class="form-control" placeholder="tanggal" name="monthBirtha1">
                  <option value="01">Januari</option>
                  <option value="02">Februari</option>
                  <option value="03">Maret</option>
                  <option value="04">April</option>
                  <option value="05">Mei</option>
                  <option value="06">Juni</option>
                  <option value="07">Juli</option>
                  <option value="08">Agustus</option>
                  <option value="09">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">November</option>
                  <option value="12">Desember</option>
                  </select>
                </div>
                <div class="col-xs-4" id="exampleInputEmail1">
                  <select class="form-control" placeholder="tanggal" name="yearBirtha1">
                  <?php for($a =2016; $a >=1910; $a--){
                    echo "<option value='".$a."'>".$a."</option>";
                    }?>
                  
                  <option>2013</option>
                  </select>
                </div>
                
              </div>
              
            </div>
            
            </div>
            </div>

            <?php 
            if($list->count_adult > 1){
              for ($i=2; $i <= $list->count_adult ; $i++) { 
            ?>
                  <div id="data-diri" style="border-style: groove; padding: 10px;">
             
                       <h3> Data Penumpang(Dewasa-<?php echo $i;?>) </h3>
                     
                       <div id="adult-<?php echo $i;?>">
                         <div class="row">
                           <div class="form-group col-xs-2">
                            <label for="exampleInputEmail1">Salutation </label>
                            <select class="form-control" name="titlea<?php echo $i;?>">
                              <option>Tuan</option>
                              <option>Nyonya</option>
                              
                            </select>
                          </div>
                           <div class="form-group col-xs-5">
                            <label for="exampleInputEmail1">FirstName</label>
                            <input type="text" name="firstnamea<?php echo $i;?>" class="form-control" id="exampleInputEmail1" placeholder="Email">
                          </div>
                          <div class="form-group col-xs-5">
                            <label for="exampleInputEmail1">LastName</label>
                            <input type="text" name="lastnamea<?php echo $i;?>" class="form-control" id="exampleInputEmail1" placeholder="Email">
                          </div>
                        </div>
                        <label for="exampleInputEmail1">Tanggal Lahir</label>
                        <div class="row">

                          <div class="form-group col-xs-6">
                            
                            <div class="col-xs-3" id="exampleInputEmail1">
                              <select class="form-control" placeholder="tanggal" name="datebirtha<?php echo $i;?>">
                             <?php for($a =1; $a <=31; $a++){
                      echo "<option value='".str_pad($a, 2, "0", STR_PAD_LEFT)."'>".str_pad($a, 2, "0", STR_PAD_LEFT)."</option>";
                    }?>
                              </select>
                            </div>
                            <div class="col-xs-5" id="exampleInputEmail1">
                              <select class="form-control" placeholder="tanggal" name="monthBirtha<?php echo $i;?>">
                                  <option value="01">Januari</option>
                                  <option value="02">Februari</option>
                                  <option value="03">Maret</option>
                                  <option value="04">April</option>
                                  <option value="05">Mei</option>
                                  <option value="06">Juni</option>
                                  <option value="07">Juli</option>
                                  <option value="08">Agustus</option>
                                  <option value="09">September</option>
                                  <option value="10">Oktober</option>
                                  <option value="11">November</option>
                                  <option value="12">Desember</option>
                              </select>
                            </div>
                            <div class="col-xs-4" id="exampleInputEmail1">
                              <select class="form-control" placeholder="tanggal" name="yearBirtha<?php echo $i;?>">
                              <?php for($a =2016; $a >=1910; $a--){
                                    echo "<option value='".$a."'>".$a."</option>";
                              }?>
                              </select>
                            </div>
                            
                          </div>
                          
                        </div>
                        
                        </div>
            </div>
            <br>

            <?php
              }
            }
            ?>

              <?php 
            if($list->count_child >= 1){
              for ($i=1; $i <= $list->count_child ; $i++) { 
            ?>
                  <div id="data-diri" style="border-style: groove; padding: 10px;">
             
                       <h3> Data Penumpang(Anak-<?php echo $i;?>) </h3>
                     
                       <div id="child-<?php echo $i;?>">
                         <div class="row">
                           <div class="form-group col-xs-2">
                            <label for="exampleInputEmail1">Salutation </label>
                            <select class="form-control" name="titlec<?php echo $i;?>">
                             <option value="Mstr">Mstr</option>
                              <option value="Miss">Miss</option>
                              
                            </select>
                          </div>
                           <div class="form-group col-xs-5">
                            <label for="exampleInputEmail1">FirstName</label>
                            <input type="text" name="firstnamec<?php echo $i;?>" class="form-control" id="exampleInputEmail1" placeholder="Email">
                          </div>
                          <div class="form-group col-xs-5">
                            <label for="exampleInputEmail1">LastName</label>
                            <input type="text" name="lastnamec<?php echo $i;?>" class="form-control" id="exampleInputEmail1" placeholder="Email">
                          </div>
                        </div>
                        <label for="exampleInputEmail1">Tanggal Lahir</label>
                        <div class="row">

                          <div class="form-group col-xs-6">
                            
                            <div class="col-xs-3" id="exampleInputEmail1">
                              <select class="form-control" placeholder="tanggal" name="datebirthc<?php echo $i;?>">
                              <?php for($a =1; $a <=31; $a++){
                            echo "<option value='".str_pad($a, 2, "0", STR_PAD_LEFT)."'>".str_pad($a, 2, "0", STR_PAD_LEFT)."</option>";
                    }?>
                              </select>
                            </div>
                            <div class="col-xs-5" id="exampleInputEmail1">
                              <select class="form-control" placeholder="tanggal" name="monthBirthc<?php echo $i;?>">
                                  <option value="01">Januari</option>
                                  <option value="02">Februari</option>
                                  <option value="03">Maret</option>
                                  <option value="04">April</option>
                                  <option value="05">Mei</option>
                                  <option value="06">Juni</option>
                                  <option value="07">Juli</option>
                                  <option value="08">Agustus</option>
                                  <option value="09">September</option>
                                  <option value="10">Oktober</option>
                                  <option value="11">November</option>
                                  <option value="12">Desember</option>
                              </select>
                            </div>
                            <div class="col-xs-4" id="exampleInputEmail1">
                              <select class="form-control" placeholder="tanggal" name="yearBirthc<?php echo $i;?>">
                             <?php for($a =2016; $a >=2004; $a--){
                                echo "<option value='".$a."'>".$a."</option>";
                             }?>
                              </select>
                            </div>
                            
                          </div>
                          
                        </div>
                        
                        </div>
            </div>

            <br>
            <?php
              }
            }
            ?>

             <?php 
            if($list->count_infant >= 1){
              for ($i=1; $i <= $list->count_infant ; $i++) { 
            ?>
                  <div id="data-diri" style="border-style: groove; padding: 10px;">
             
                       <h3> Data Penumpang(Bayi-<?php echo $i;?>) </h3>
                     
                       <div id="child-<?php echo $i;?>">
                         <div class="row">
                           <div class="form-group col-xs-2">
                            <label for="exampleInputEmail1">Salutation </label>
                            <select class="form-control" name="titlei<?php echo $i;?>">
                              <option value="Mstr">Mstr</option>
                              <option value="Miss">Miss</option>
                              
                            </select>
                          </div>
                           <div class="form-group col-xs-5">
                            <label for="exampleInputEmail1">FirstName</label>
                            <input type="text" name="firstnamei<?php echo $i;?>" class="form-control" id="exampleInputEmail1" placeholder="Email">
                          </div>
                          <div class="form-group col-xs-5">
                            <label for="exampleInputEmail1">LastName</label>
                            <input type="text" name="lastnamei<?php echo $i;?>" class="form-control" id="exampleInputEmail1" placeholder="Email">
                          </div>
                        </div>
                        <label for="exampleInputEmail1">Tanggal Lahir</label>
                        <div class="row">

                          <div class="form-group col-xs-6">
                            
                            <div class="col-xs-3" id="exampleInputEmail1">
                              <select class="form-control" placeholder="tanggal" name="datebirthi<?php echo $i;?>">
                              <?php for($a =1; $a <=31; $a++){
                            echo "<option value='".str_pad($a, 2, "0", STR_PAD_LEFT)."'>".str_pad($a, 2, "0", STR_PAD_LEFT)."</option>";
                    }?>
                              </select>
                            </div>
                            <div class="col-xs-5" id="exampleInputEmail1">
                              <select class="form-control" placeholder="tanggal" name="monthBirthi<?php echo $i;?>">
                              <option value="01">Januari</option>
                                  <option value="02">Februari</option>
                                  <option value="03">Maret</option>
                                  <option value="04">April</option>
                                  <option value="05">Mei</option>
                                  <option value="06">Juni</option>
                                  <option value="07">Juli</option>
                                  <option value="08">Agustus</option>
                                  <option value="09">September</option>
                                  <option value="10">Oktober</option>
                                  <option value="11">November</option>
                                  <option value="12">Desember</option>
                              </select>
                            </div>
                            <div class="col-xs-4" id="exampleInputEmail1">
                              <select class="form-control" placeholder="tanggal" name="yearBirthi<?php echo $i;?>">
                              <?php for($a =2016; $a >=2014; $a--){
                                echo "<option value='".$a."'>".$a."</option>";
                             }?>
                              </select>
                            </div>
                            
                          </div>

                          <div class="form-group col-xs-6">
                          <div class="form-group col-xs-12">
                            <label for="exampleInputEmail1">Parent </label>
                            <select class="form-control" name="parenti<?php echo $i;?>">
                              <?php
                              for ($i=1; $i <= $list->count_adult ; $i++) { 
                              echo "<option value='".$i."'>Parent - ".$i."</option>"; 
                              
                              }
                              ?>
                              
                            </select>
                          </div>
                          </div>
                          
                        </div>
                        
                        </div>
            </div>

            <br>
            <?php
              }
            }
            ?>

          


            <div class="row" style="padding: 10px;">
           
              <button type="submit" value="submit" class="btn btn-primary col-xs-11" style="margin-top: 25px">Lakukan Pembayaran</button>
           
            </div>
            </form>
            </div>
           <div class="col-xs-4">
           
           <div class="row" id="rincian_penerbangan" style="border-style: groove; padding: 10px;">
                <table class="table">
                <thead><h3>Informasi Pemesanan</h3></thead>
               <tr><td><img src="<?php echo $list->image; ?>"> <br> <p><?php echo $list->airlines_name; ?></p></tr></td>
               <tr>
                 <td><?php echo $list->flight_infos->flight_info->flight_number; ?></td>
               </tr>
               <tr>
                 <td><?php echo $list->flight_infos->flight_info->simple_departure_time; ?>
                 <br> <?php echo $list->flight_infos->flight_info->departure_city_name; ?>-<?php echo $list->flight_infos->flight_info->departure_city; ?>
                 </td>
               </tr>
                <tr>
                 <td><?php echo $list->flight_infos->flight_info->simple_arrival_time; ?>
                 <br> <?php echo $list->flight_infos->flight_info->arrival_city_name; ?>-<?php echo $list->flight_infos->flight_info->arrival_city; ?>
                 </td>
               </tr>
               </table>    
           </div>
            <br>
           <div class="row" id="rincian_biaya" style="border-style: groove; padding: 10px;">
           <table class="table">
               <thead><h3>Rincian Biaya</h3></thead>
               <tr>
                 <td>1 Dewasa</td>
                 <td><?php echo $list->price_adult?></td>
               </tr>
               <tr>
                 <td>1 Anak</td>
                 <td><?php echo $list->price_child?></td>
               </tr>
                <tr>
                 <td>1 Bayi</td>
                 <td><?php echo $list->price_infant?></td>
               </tr>
                <tr>
                 <td>Pajak</td>
                 <td>IDR 2.450.000</td>
               </tr>
               <tr>
                 <td>Subtotal</td>
                 <td>IDR 2.450.000</td>
               </tr>
               <tr>
                 <td>diskon</td>
                 <td>IDR 2.450.000</td>
               </tr>
              <tr>
                 <td>Total Pembayaran</td>
                 <td>IDR 2.450.000</td>
               </tr>
           </table>    
           </div>

         </div>
         
        </div>
        
   </div>