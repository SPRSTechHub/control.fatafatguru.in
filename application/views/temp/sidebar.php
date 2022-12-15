<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="#">
                <img src="<?= base_url(); ?>assets/images/brand/logo.png" class="header-brand-img desktop-logo"
                    alt="logo">
                <img src="<?= base_url(); ?>assets/images/brand/logo-1.png" class="header-brand-img toggle-logo"
                    alt="logo">
                <img src="<?= base_url(); ?>assets/images/brand/logo-2.png" class="header-brand-img light-logo"
                    alt="logo">
                <img src="<?= base_url(); ?>assets/images/brand/logo-3.png" class="header-brand-img light-logo1"
                    alt="logo">
            </a>
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="<?= base_url(); ?>"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
                </li>
                <li class="sub-category">
                    <h3>Controll & Management</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">User
                            Controll</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="/home/users/" class="slide-item"> User Manage</a></li>
                        <li><a href="/home/allreferral/" class="slide-item"> User Referral</a></li>
                        <li><a href="/" class="slide-item"> User Report</a></li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-package"></i><span class="side-menu__label">Games &
                            Features</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="/home/gamelists/" class="slide-item"> Games Management</a></li>
                        <li><a href="/home/betlists/" class="slide-item"> Bet Placements</a></li>
                        <li><a href="/home/winlists/" class="slide-item"> Win Results</a></li>
                        <li><a href="#" class="slide-item"> Export Games</a></li>
                    </ul>
                </li>
                <li class="sub-category">
                    <h3>Money Controll</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/home/userwallet/"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">User
                            Wallet</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/home/userdeposites/"><i
                            class="side-menu__icon fe fe-inbox"></i><span class="side-menu__label">User
                            Deposites</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-layers"></i><span class="side-menu__label">Payment
                            Management</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="/home/allpayment/" class="slide-item"> All Payments</a></li>
                        <li><a href="/home/settingpayment/" class="slide-item"> Payments Setting</a></li>
                        <li><a href="#" class="slide-item"> Payment Reports</a></li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-shopping-bag"></i><span class="side-menu__label">Withdraw
                            Management</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="/home/withdrawlist/" class="slide-item"> Withdraw Master</a></li>
                        <li><a href="/home/banklist/" class="slide-item"> View Bank & UPI</a></li>
                        <li><a href="#" class="slide-item"> Withdraw Reports</a></li>
                    </ul>
                </li>

                <li class="sub-category">
                    <h3>Misc Pages</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Offers &
                            Updates</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="/home/offers/" class="slide-item">All Offers</a></li>
                        <li><a href="#" class="slide-item"> xxxx</a></li>
                        <li><a href="#" class="slide-item"> xxxx</a></li>
                        <li><a href="#" class="slide-item"> xxxx</a></li>
                    </ul>
                </li>
                <li class="sub-category">
                    <h3>General</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/home/setting_all/"><i
                            class="side-menu__icon fe fe-settings fa-spin"></i><span
                            class="side-menu__label">Settings</span></a>
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
</div>