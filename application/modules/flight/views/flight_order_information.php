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
                      <img src="<?php echo  $myoder->data->order_photo?>"><br> 
                      <p><?php echo $myoder->data->uri; ?></p>
                  </td>
                </tr>
               <tr>
                 <td><?php echo $myoder->data->detail->flight_number; ?></td>
               </tr>
               <tr>
                 <td><?php echo $myoder->data->detail->departure_time; ?>
                 <br> <?php echo $myoder->data->detail->departure_airport_name; ?>-<?php echo $myoder->data->detail->departure_city; ?>
                 </td>
               </tr>
                <tr>
                 <td> <?php echo $myoder->data->detail->arrival_time; ?>
                 <br> <?php echo $myoder->data->detail->arrival_airport_name; ?>-<?php echo $myoder->data->detail->arrival_city; ?>
                 </td>
               </tr>
               <tr>
                 <td>
                 <?php echo $myoder->data->order_name; ?>
                 </td>
               </tr>
              </table>    
           
            </div>

            <div id="data-diri" class = "col-xs-7">
             <table class="table">
                <thead><h3>Informasi Penumpang</h3></thead>
               <tr>
                  <td>
                      Nama Dewasa(1)
                  </td>
                  <td>
                      (Tn) Riansyah Rafsanjani
                  </td>
                </tr>
               <tr>
                  <td>
                      Nama Dewasa(2)
                  </td>
                  <td>
                      (Tn) Rafsanjani
                  </td>
                </tr>
                <tr>
                  <td>
                      Nama Anak(1)
                  </td>
                  <td>
                      Riansyah Rafsanjani
                  </td>
                </tr>
               
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
               <tr>
                 <td>1 Dewasa</td>
                 <td>IDR 2.450.000</td>
               </tr>
               <tr>
                 <td>1 Anak</td>
                 <td>IDR 2.450.000</td>
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
                 <td><b>Total Pembayaran</b></td>
                 <td><b>IDR 2.450.000</b></td>
               </tr>
           </table>    
           
            </div>
           
           

         </div>
         
        
        
   </div>
   <br>