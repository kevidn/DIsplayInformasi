@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')


      <div class="panel-header panel-header-sm">
        
      </div>
      
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">TAMPILAN DISPLAY INFORMASI</h4>
                <img src="{{ asset('/images/mockupdisplay.jpg') }}" class="" width="90%">
                
                <br><br>
              </div>    
              
              <div class="container-fluid py-4">
                <div class="row">
                  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                      <div class="card-body p-3">
                        <div class="row">
                          <div class="col-8">
                            <div class="numbers">
                              <p class="text-sm mb-0 text-uppercase font-weight-bold"> Jumlah Berita Yang Ditampilkan</p>
                               <h5 class="font-weight-bolder">
                                6
                              </h5>
                              
                            </div>
                          </div>
                          <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                      <div class="card-body p-3">
                        <div class="row">
                          <div class="col-8">
                            <div class="numbers">
                              <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Agenda Yang Ditampilkan</p>
                              <h5 class="font-weight-bolder">
                              5
                              </h5>
                            
                            </div>
                          </div>
                          <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                              <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                          
                  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Video Yang DiPutar</p>
                    <h5 class="font-weight-bolder">
                      5
                      </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
         <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Video Yang Sedang DiPutar</p>
                    <h5 class="font-weight-bolder">
                     0
                      </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i> 
                
                
                
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
                          
    
        
        
         
      
     
      
    </div>
  </div>
@include('dashboard.partials.corejs')