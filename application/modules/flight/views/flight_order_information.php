
<div class="container">
    <br><br>
         
          <h2> Pesanan Anda </h2>
         <div class="col-xs-7">
           
           <div class="row" style="border-style: groove; padding: 10px;">
           <div id="data-diri" class = "col-xs-5"  >
             <table class="table">
                <thead><h3>Informasi Pemesanan</h3></thead>
               <tr>
                  <td>
                      <img src="<?php echo  $myorder->data[0]->order_photo;?>"><br> 
                      <p><?php echo $myorder->data[0]->uri; ?></p>
                  </td>
                </tr>
               <tr>
                 <td><?php echo $myorder->data[0]->detail->flight_number; ?></td>
               </tr>
               <tr>
                 <td><?php echo $myorder->data[0]->detail->departure_time; ?>
                 <br> <?php echo $myorder->data[0]->detail->departure_airport_name; ?>-<?php echo $myorder->data[0]->detail->departure_city; ?>
                 </td>
               </tr>
                <tr>
                 <td> <?php echo $myorder->data[0]->detail->arrival_time; ?>
                 <br> <?php echo $myorder->data[0]->detail->arrival_airport_name; ?>-<?php echo $myorder->data[0]->detail->arrival_city; ?>
                 </td>
               </tr>
               <tr>
                 <td>
                 <?php echo $myorder->data[0]->order_name; ?>
                 </td>
               </tr>
              </table>    
           
            </div>

            <div id="data-diri" class = "col-xs-7">
             <table class="table">
                <thead><h3>Informasi Penumpang</h3></thead>
                <?php
                 foreach ($myorder->data[0]->detail->passengers as $key => $value) {
                   foreach ($value as $key2 => $value2) 
                   {
                       echo '<tr>
                      <td>
                          '.$value2->type.'
                      </td>
                      <td>
                          ('.$value2->title.') '.$value2->first_name.' '.$value2->last_name.'
                      </td>
                    </tr>';
                   }
                   
                 }
               ?>
              </table>    
           
            </div>
            </div>
            <br>
            <div class="row" >
            <a href="flight_payment.html">
            <button type="button" class="btn btn-primary btn-lg col-xs-12">Lanjutkan Checkout</button>
            </a>
            </div>
            </div>
            <div class="col-xs-1"></div>
           <div class="col-xs-4" style="border-style: groove; padding: 10px;">
            <div id="data-diri">
             <table class="table">
               <thead colspan=2>
               <td><h3>Rincian Biaya</h3></td>
               </thead>
               <thead >
               <td colspan = 2>
                      <div class="form-group">
                          
                          <div class="input-group">
                            <div class="input-group-addon">Mata Uang</div>
                            <select class="form-control">
                              <option>IDR - Indonesian</option>
                              <option>SGD - Singapore</option>
                              
                            </select>
                            </div>
                      </div>
               </td>
               </thead>

               <?php
               foreach ($myorder->data[0]->detail->breakdown_price as $key => $value) {
                 //echo ."<br>";
                 echo '<tr>
                 <td>'.$value->text.'</td>
                 <td>'.$value->currency.'  '.number_format((int)$value->value).'</td>
               </tr>';
               }
               ?>
               
           </table>    
           
            </div>
           
           

         </div>
         
        
        
   </div>
   <br>