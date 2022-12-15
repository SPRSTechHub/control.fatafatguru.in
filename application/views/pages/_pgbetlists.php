  <?
    require_once(APPPATH . "views/widgets/functions.php");
    ?>
  <!--app-content open-->
  <div class="main-content app-content mt-0">
      <div class="side-app">
          <!-- CONTAINER -->
          <div class="main-container container-fluid">
              <!-- PAGE-HEADER -->
              <div class="page-header">
                  <h1 class="page-title">Game Master</h1>
                  <div>
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Game Lists</li>
                      </ol>
                  </div>
              </div>
              <!-- PAGE-HEADER END -->

              <!--  <div class="row">
                  <div class="col-sm-12 col-md-6 col-lg-6  col-xl-3">
                      <div class="card widgets-cards bg-primary box-primary-shadow">
                          <div class="card-body d-flex justify-content-center align-items-center">
                              <div class="text-white display-1">
                                  <?= $totalGames; ?>
                              </div>
                              <div class="wrp text-wrapper text-white p-3">
                                  <p class="mt-0"> <?= $totalBetAmount; ?></p>
                                  <p class="mt-1 mb-0">Total Placed Bets</p>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-6  col-xl-3">
                      <div class="card widgets-cards bg-success box-success-shadow">
                          <div class="card-body d-flex justify-content-center align-items-center">
                              <div class="text-white display-1">
                                  <?= $totalGames; ?>
                              </div>
                              <div class="wrp text-wrapper text-white p-3">
                                  <p class="mt-0">6477</p>
                                  <p class=" mt-1 mb-0">This Week Views</p>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-6  col-xl-3">
                      <div class="card widgets-cards bg-warning box-warning-shadow">
                          <div class="card-body d-flex justify-content-center align-items-center">
                              <div class="text-white display-1">
                                  <?= $totalGames; ?>
                              </div>
                              <div class="wrp text-wrapper text-white p-3">
                                  <p class="mt-0">7847</p>
                                  <p class=" mt-1 mb-0">This Week Earnings</p>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-6  col-xl-3">
                      <div class="card widgets-cards bg-danger box-danger-shadow">
                          <div class="card-body d-flex justify-content-center align-items-center">
                              <div class="text-white display-1">
                                  <?= $totalGames; ?>
                              </div>
                              <div class="wrp text-wrapper text-white p-3">
                                  <p class="mt-0">345</p>
                                  <p class=" mt-1 mb-0">This Week Comments</p>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
                      <div class="card">
                          <div class="row">
                              <div class="col-4">
                                  <div
                                      class="card-img-absolute circle-icon bg-primary text-center align-self-center box-primary-shadow bradius">
                                      <img src="https://codeigniter.spruko.com/sash/sash/assets/images/svgs/circle.svg"
                                          alt="img" class="card-img-absolute">
                                      <i class="lnr lnr-user fs-30  text-white mt-4"></i>
                                  </div>
                              </div>
                              <div class="col-8">
                                  <div class="card-body p-4">
                                      <h2 class="mb-2 fw-normal mt-2">9,678</h2>
                                      <h5 class="fw-normal mb-0">Total Requests</h5>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
                      <div class="card">
                          <div class="row">
                              <div class="col-4">
                                  <div
                                      class="card-img-absolute circle-icon bg-secondary align-items-center text-center box-secondary-shadow bradius">
                                      <img src="https://codeigniter.spruko.com/sash/sash/assets/images/svgs/circle.svg"
                                          alt="img" class="card-img-absolute">
                                      <i class="lnr lnr-briefcase fs-30 text-white mt-4"></i>
                                  </div>
                              </div>
                              <div class="col-8">
                                  <div class="card-body p-4">
                                      <h2 class="mb-2 fw-normal mt-2">10,257</h2>
                                      <h5 class="fw-normal mb-0">Total Revenue</h5>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
                      <div class="card">
                          <div class="row">
                              <div class="col-4">
                                  <div
                                      class="card-img-absolute  circle-icon bg-success align-items-center text-center box-success-shadow bradius">
                                      <img src="https://codeigniter.spruko.com/sash/sash/assets/images/svgs/circle.svg"
                                          alt="img" class="card-img-absolute">
                                      <i class="lnr lnr-gift fs-30 text-white mt-4"></i>
                                  </div>
                              </div>
                              <div class="col-8">
                                  <div class="card-body p-4">
                                      <h2 class="mb-2 fw-normal mt-2">$67,953</h2>
                                      <h5 class="fw-normal mb-0">Total Profit</h5>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
                      <div class="card">
                          <div class="row">
                              <div class="col-4">
                                  <div
                                      class="card-img-absolute circle-icon bg-danger align-items-center text-center box-danger-shadow bradius">
                                      <img src="https://codeigniter.spruko.com/sash/sash/assets/images/svgs/circle.svg"
                                          alt="img" class="card-img-absolute">
                                      <i class=" lnr lnr-cart fs-30 text-white mt-4"></i>
                                  </div>
                              </div>
                              <div class="col-8">
                                  <div class="card-body p-4">
                                      <h2 class="mb-2 fw-normal mt-2">7,632</h2>
                                      <h5 class="fw-normal mb-0">Total Sales</h5>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
 -->

              <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header bg-danger-gradient">
                              <h3 class="card-title text-white">Bet Lists</h3>
                              <div class="card-options">
                                  <span class="tag tag-rounded tag-icon tag-red"><i class="fe fe-clock"></i>Time <a
                                          href="javascript:void(0)"
                                          class="tag-addon tag-addon-cross tag-red"></a></span>
                                  <a href="javascript:void(0)"><i class="mdi mdi-refresh text-white"></i></a>
                                  <a href="javascript:void(0)" class="card-options-collapse"
                                      data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-white"></i></a>
                                  <a href="javascript:void(0)" class="card-options-remove"
                                      data-bs-toggle="card-remove"><i class="fe fe-x text-white"></i></a>
                              </div>
                          </div>
                          <div class="card-body text-danger bg-danger-transparent card-transparent">
                              <div class="table-responsive">
                                  <table id="table1" class="table table-bordered border text-nowrap mb-0"></table>
                              </div>
                          </div>
                          <div class="card-footer bg-gray-dark text-white">
                              This is Basic card footer
                          </div>
                      </div>
                  </div>
              </div>
              <!-- CONTAINER CLOSED -->
          </div>
      </div>
      <!--app-content closed-->
  </div>

  <script>
$(function() {
    $('#table1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url(); ?>/datafunction/get_tbl_data/',
            dataType: 'json',
            data: {
                action: 'getuser',
                table: 'tbl_bets'
            },
            type: 'POST',
        },
        columns: [{
                title: "ID",
                data: 'id',
            },
            {
                title: "MATCH ID",
                data: 'match_id',
            },
            {
                title: "GAME ID",
                data: 'game_id',
            },
            {
                title: "BET TYPE",
                data: 'bet_type',
            },
            {
                title: "BET NO",
                data: 'bet_val',
            },
            {
                title: "AMOUNT",
                data: 'bet_amnt',
            },
            {
                title: "MOBILE",
                data: 'mobile',
            },
            {
                title: "DATE",
                data: 'date',
            },
            {
                title: "TIME",
                data: 'time',
            },
            {
                title: "Edit",
                className: "dt-center editor-edit",
                defaultContent: '<button id="bDel" type="button" class="btn  btn-sm btn-primary"><span class="fe fe-edit"></span></button>',
                orderable: false
            },
            {
                title: "Delete",
                className: "dt-center editor-delete",
                defaultContent: '<button id="bDel" type="button" class="btn  btn-sm btn-danger"><span class="fe fe-trash-2"></span></button>',
                orderable: false
            }
        ],
        scrollY: 400
    });
});
  </script>