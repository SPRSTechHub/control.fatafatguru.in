 <div class="page">
     <div class="page-main">
         <div class="app-header header sticky">
             <div class="container-fluid main-container">
                 <div class="d-flex">
                     <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
                         href="javascript:void(0)"></a>
                     <a class="logo-horizontal " href="index.html">
                         <img src="<?= base_url(); ?>assets/images/brand/logo.png" class="header-brand-img desktop-logo"
                             alt="logo">
                         <img src="<?= base_url(); ?>assets/images/brand/logo-3.png"
                             class="header-brand-img light-logo1" alt="logo">
                     </a>
                     <div class="main-header-center ms-3 d-none d-lg-block">
                         <input type="text" class="form-control" id="typehead" placeholder="Search for results..."
                             autocomplete="off">
                         <button class="btn px-0 pt-2"><i class="fe fe-search" aria-hidden="true"></i></button>
                     </div>
                     <div class="d-flex order-lg-2 ms-auto header-right-icons">
                         <div class="dropdown d-none">
                             <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                 <i class="fe fe-search"></i>
                             </a>
                             <div class="dropdown-menu header-search dropdown-menu-start">
                                 <div class="input-group w-100 p-2">
                                     <input type="text" class="form-control" placeholder="Search....">
                                     <div class="input-group-text btn btn-primary">
                                         <i class="fe fe-search" aria-hidden="true"></i>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                             data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                             aria-controls="navbarSupportedContent-4" aria-expanded="false"
                             aria-label="Toggle navigation">
                             <span class="navbar-toggler-icon icon"><i
                                     class="fe fe-settings fa-spin text_primary"></i></span>
                         </button>
                         <div class="navbar navbar-collapse responsive-navbar p-0">
                             <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                 <div class="d-flex order-lg-2">
                                     <div class="dropdown d-lg-none d-flex">
                                         <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                             <i class="fe fe-search"></i>
                                         </a>
                                         <div class="dropdown-menu header-search dropdown-menu-start">
                                             <div class="input-group w-100 p-2">
                                                 <input type="text" class="form-control" placeholder="Search....">
                                                 <div class="input-group-text btn btn-primary">
                                                     <i class="fa fa-search" aria-hidden="true"></i>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="d-flex country">
                                         <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                             <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                             <span class="light-layout"><i class="fe fe-sun"></i></span>
                                         </a>
                                     </div>
                                     <a class="nav-link icon" href="/home/setting_all/">
                                         <i class="fe fe-settings fa-spin text_primary"></i>
                                     </a>

                                     <!-- <div class="dropdown d-flex notifications">
                                       
                                           <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                             <div class="drop-heading border-bottom">
                                                 <div class="d-flex">
                                                     <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Settings
                                                     </h6>
                                                 </div>
                                             </div>
                                             <div class="notifications-menu">
                                                 <a class="dropdown-item d-flex" href="#" onClick="updateLiveAlert();">
                                                     <div class="me-3 notifyimg bg-primary brround box-shadow-primary">
                                                         <i class="fe fe-mail"></i>
                                                     </div>
                                                     <div class="mt-1 wd-80p">
                                                         <h5 class="notification-label mb-1">Show Live Game Alert
                                                         </h5>
                                                         <span class="notification-subtext">Yes/No</span>
                                                     </div>
                                                 </a>
                                             </div>
                                             <div class="dropdown-divider m-0"></div>
                                         </div>
                                     </div> -->
                                     <div class="dropdown d-flex">
                                         <a class="nav-link icon full-screen-link nav-link-bg">
                                             <i class="fe fe-minimize fullscreen-button"></i>
                                         </a>
                                     </div>
                                     <div class="dropdown d-flex notifications">
                                         <a class="nav-link icon" data-bs-toggle="dropdown"><i
                                                 class="fe fe-bell"></i><span class=" pulse"></span>
                                         </a>
                                         <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                             <div class="drop-heading border-bottom">
                                                 <div class="d-flex">
                                                     <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications
                                                     </h6>
                                                 </div>
                                             </div>
                                             <div class="notifications-menu">
                                                 <a class="dropdown-item d-flex" href="notify-list.html">
                                                     <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                                         <i class="fe fe-mail"></i>
                                                     </div>
                                                     <div class="mt-1 wd-80p">
                                                         <h5 class="notification-label mb-1">New Application received
                                                         </h5>
                                                         <span class="notification-subtext">3 days ago</span>
                                                     </div>
                                                 </a>
                                                 <a class="dropdown-item d-flex" href="notify-list.html">
                                                     <div
                                                         class="me-3 notifyimg  bg-secondary brround box-shadow-secondary">
                                                         <i class="fe fe-check-circle"></i>
                                                     </div>
                                                     <div class="mt-1 wd-80p">
                                                         <h5 class="notification-label mb-1">Project has been
                                                             approved</h5>
                                                         <span class="notification-subtext">2 hours ago</span>
                                                     </div>
                                                 </a>
                                                 <a class="dropdown-item d-flex" href="notify-list.html">
                                                     <div class="me-3 notifyimg  bg-success brround box-shadow-success">
                                                         <i class="fe fe-shopping-cart"></i>
                                                     </div>
                                                     <div class="mt-1 wd-80p">
                                                         <h5 class="notification-label mb-1">Your Product Delivered
                                                         </h5>
                                                         <span class="notification-subtext">30 min ago</span>
                                                     </div>
                                                 </a>
                                                 <a class="dropdown-item d-flex" href="notify-list.html">
                                                     <div class="me-3 notifyimg bg-pink brround box-shadow-pink">
                                                         <i class="fe fe-user-plus"></i>
                                                     </div>
                                                     <div class="mt-1 wd-80p">
                                                         <h5 class="notification-label mb-1">Friend Requests</h5>
                                                         <span class="notification-subtext">1 day ago</span>
                                                     </div>
                                                 </a>
                                             </div>
                                             <div class="dropdown-divider m-0"></div>
                                         </div>
                                     </div>
                                     <div class="dropdown  d-flex message">
                                         <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                                             <i class="fe fe-message-square"></i><span class="pulse-danger"></span>
                                         </a>
                                     </div>
                                     <div class="dropdown d-flex header-settings">
                                         <a href="<?= base_url(); ?>/home/logout/" class="nav-link icon"
                                             data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                                             <i class="fe fe-alert-circle"></i>
                                         </a>
                                     </div>
                                     <div class="dropdown d-flex profile-1">
                                         <a href="javascript:void(0)" data-bs-toggle="dropdown"
                                             class="nav-link leading-none d-flex">
                                             <img src="<?= base_url(); ?>assets/images/users/21.jpg" alt="profile-user"
                                                 class="avatar  profile-user brround cover-image">
                                         </a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- /app-Header -->