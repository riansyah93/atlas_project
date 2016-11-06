<script type="text/javascript">
$(document).ready(function() {
  $("#depart").select2();
  $("#arrival").select2();
});
</script>

<div class="container">
    <br><br>
          <div class="row">
         <h2>Tiket Pesawat</h2>
        <div id="search-bar" style="background-color: #BFCFDB; padding: 10px; ">
            
            <form action="<?php echo base_url('flight/get_flight');?>" method = "GET">
                <div class="row">
              <div class="form-group col-xs-4">
                <label for="exampleInputEmail3">Kota Asal</label>
                <div class="input-group">
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/fliup-b.png')?>" width="20px" height="20px"></div>
                <select class="form-control" id="depart" name="depart" placeholder="kota asal">
                  <option value="-">-</option>
                   <?php 
                   foreach ($airport as $list2) {
                    if ($post['depart'] == $list2['airport_code']) {
                      echo "<option value='".$list2['airport_code']."' selected>".$list2['location_name']." - ".$list2['airport_code']."</option>";
                    }else
                    {
                     echo "<option value='".$list2['airport_code']."'>".$list2['location_name']." - ".$list2['airport_code']."</option>"; 
                    }
                     
                   
                   }
                   ?>
                   
                </select>
                </div>
              </div>
              <div class="form-group col-xs-4">
                <label for="exampleInputPassword3">Kota Tujuan</label>
                <div class="input-group">
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/land-b.png')?>" width="20px" height="20px"></div>
                 <select class="form-control" id="arrival" name="arrival" placeholder="kota asal">
                  <option value="-">-</option>
                   <?php 
                   foreach ($airport as $list2) {
                    if ($post['arrival'] == $list2['airport_code']) {
                      echo "<option value='".$list2['airport_code']."' selected>".$list2['location_name']." - ".$list2['airport_code']."</option>";
                    }else
                    {
                     echo "<option value='".$list2['airport_code']."'>".$list2['location_name']." - ".$list2['airport_code']."</option>"; 
                    }
                     
                   
                   }
                   ?>
                   
                </select>
              </div>
              </div>
              <div class="form-group col-xs-4">
                <label for="exampleInputEmail3">Jumlah Penumpang</label>
                     <div class="input-group">
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/male-b.png')?>" width="20px" height="20px"></div>
                    <select class="form-control" id="adult" name="adult">
                        <?php 
                        for ($i=1; $i <=5 ; $i++) { 
                          if ($i == $post['adult']) {
                           echo '<option value="'.$i.'" selected>'.$i.'</option>';
                          }else
                          {
                              echo '<option value="'.$i.'">'.$i.'</option>';
                          }
                        }

                        ?>
                       
                    </select>
                
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/child-b.png')?>" width="20px" height="20px"></div>
                    <select class="form-control" name="child" id="child">
                        <?php 
                        for ($i=0; $i <=5 ; $i++) { 
                          if ($i == $post['child']) {
                           echo '<option value="'.$i.'" selected>'.$i.'</option>';
                          }else
                          {
                              echo '<option value="'.$i.'">'.$i.'</option>';
                          }
                        }

                        ?>
                    </select>
                
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/baby-b.png')?>" width="20px" height="20px"></div>
                    <select class="form-control" name="infant" id="infant">
                        <?php 
                        for ($i=0; $i <=5 ; $i++) { 
                          if ($i == $post['infant']) {
                           echo '<option value="'.$i.'" selected>'.$i.'</option>';
                          }else
                          {
                              echo '<option value="'.$i.'">'.$i.'</option>';
                          }
                        }

                        ?>
                    </select>
                </div>
              </div>
              </div>
              <div class="row" style="margin-top: ">
                  <div class="form-group col-xs-4">
                <label for="exampleInputEmail3">Tanggal Keberangkatan</label>
                <div class="input-group">
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/cal-b.png')?>" width="20px" height="20px"></div>
                <input type="text" class="form-control" value="<?php echo date('Y-m-d',strtotime($post['start_date']))?>" id="start_date" name="start_date" placeholder="Keberangkatan">
                </div>
              </div>
              <div class="form-group col-xs-4">
                <label for="exampleInputPassword3">Tanggal Pulang</label>
                <div class="input-group">
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/cal-b.png')?>" width="20px" height="20px"></div>
                <input type="text" class="form-control" value="-" id="end_date" name="end_date" placeholder="Kepulangan">
              </div>
              </div>
               <div class="form-group col-xs-4">
                <button type="submit" value="Submit" class="btn btn-primary col-xs-12" style="margin-top: 25px">Cari</button>
               </div>

              </div>
              
             
            </form>
        </div>
        <div class="inline-separator"></div>
        <div class="row">
            <div class="result">
                <table class="table table-striped">
                <thead>
                   <td><label>PESAWAT</label></td>
                   <td><label>PERGI</label></td>
                   <td><label>TIBA</label></td>
                   <td><label>DURASI</label></td>
                   <td><label>TRANSIT</label></td>
                   <td><label>FASILITAS</label></td>
                   <td><label>HARGA</label></td> 
                   <td><label></label></td>
                </thead>

                <?php 
                  $counter = 0;
                  if ($list != " ") {
                    
                      foreach($list->result as $temp)
                      { 
                        if($counter%2 == 0)
                        {
                          echo '<tr class="warning">';
                        }else
                        {
                          echo '<tr>';
                        }
                    ?>
                        
                        <td><img src="<?php echo $temp->image; ?>"> <br> <p><?php echo $temp->airlines_name; ?></p></td>
                       <td><?php echo $temp->flight_infos->flight_info->simple_departure_time; ?><br></td>
                       <td><?php echo $temp->flight_infos->flight_info->simple_arrival_time;?></td>
                       <td><?php echo $temp->duration?></td>
                       <td><?php echo $temp->stop?></td>
                       <td>0</td>
                       <td><?php echo "IDR ".number_format((int)$temp->price_value); ?></td>
                       <form method="post" action="<?php echo base_url('flight/get_flight_data')?>" >
                       <input type="hidden" name="flight_id" value="<?php echo $temp->flight_id; ?>">
                       <input type="hidden" name="start_date" value="<?php echo $post['start_date']; ?>">
                       <input type="hidden" name="token_id" value="<?php echo $token_id; ?>">
                       
                       <td> <button type="submit" value="submit" class="btn btn-primary">Pesan</button></a> </form>
</td>
                    </tr>
                    <?php
                    $counter++;
                      }
                      echo " </table>";
                    }else{
                      echo " </table>";
                      echo '<center><img src="'.base_url("assets/img/not_found.jpg").'" width="700px"> </center> <br> <br>';
                    } 
                ?>

               
            </div>

        </div>
            
        </div>
        
   </div>