<div class="container">
        <div class="row">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox" style="max-height: 500px; width: 100%; ">
                <div class="item active">
                  <img src="<?php echo base_url('assets/img/bg-1 [1].jpg')?>" alt="...">
                  <div class="carousel-caption">
                    ...
                  </div>
                </div>
                <div class="item">
                  <img src="<?php echo base_url('assets/img/bg-2 [1].jpg')?>" alt="...">
                  <div class="carousel-caption">
                    ...
                  </div>
                </div>
                <div class="item">
                  <img src="<?php echo base_url('assets/img/bg-3 [1].jpg')?>" alt="...">
                  <div class="carousel-caption">
                    ...
                  </div>
                </div>
                ...
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
                </div>
        </div>
        <div class="inline-separator"></div>
        <div class="row">
        <h2>Tiket Pesawat</h2>
        <div id="search-bar" style="background-color: #BFCFDB; padding: 10px; ">
            
            <form>
                <div class="row">
              <div class="form-group col-xs-4">
                <label for="depart">Kota Asal</label>
                <div class="input-group">
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/fliup-b.png')?>" width="20px" height="20px"></div>
                <input type="text" class="form-control" id="depart" name="depart" placeholder="kota asal">
                </div>
              </div>
              <div class="form-group col-xs-4">
                <label for="arrive">Kota Tujuan</label>
                <div class="input-group">
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/land-b.png')?>" width="20px" height="20px"></div>
                <input type="password" class="form-control" id="arrive" name="arrive" placeholder="kota tujuan">
              </div>
              </div>
              <div class="form-group col-xs-4">
                <label for="exampleInputEmail3">Jumlah Penumpang</label>
                     <div class="input-group">
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/male-b.png')?>" width="20px" height="20px"></div>
                    <select class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/child-b.png')?>" width="20px" height="20px"></div>
                    <select class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/baby-b.png')?>" width="20px" height="20px"></div>
                    <select class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
              </div>
              </div>
              <div class="row" style="margin-top: ">
                  <div class="form-group col-xs-4">
                <label for="start_date">Tanggal Keberangkatan</label>
                <div class="input-group">
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/cal-b.png')?>" width="20px" height="20px"></div>
                <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Keberangkatan">
                </div>
              </div>
              <div class="form-group col-xs-4">
                <label for="end_date">Tanggal Pulang</label>
                <div class="input-group">
                <div class="input-group-addon"><img src="<?php echo base_url('assets/img/cal-b.png')?>" width="20px" height="20px"></div>
                <input type="text" class="form-control" id="end_date" placeholder="Kepulangan">
              </div>
              </div>
               <div class="form-group col-xs-4">
                <a href="<?php echo base_url('flight/search');?>">
                <button type="button" class="btn btn-primary col-xs-12" style="margin-top: 25px">Cari</button>
                </a>
               </div>

              </div>
              
             
            </form>
        </div>
            
        </div>
        <div class="row">
         <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Mengapa Memilih Kami?</h2>
                    <h3 class="section-subheading text-muted">Kami Mengutamakan Kualitas Dengan Harga Terbaik.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-search fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Find</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-money fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Pay</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-sun-o fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Enjoy</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
            </div>
        </div>
    </section>
        </div>    
        </div>