<?php

require_once '../core/init.php';

$user = new User();
 $userSyscategory = escape($user->data()->syscategory_id);
 
if (!$user->isLoggedIn()) {

    Redirect::to('../login/');
    
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>KEALUCK</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Bootstrap Core CSS -->

        <!-- Add the evo-calendar.css for styling -->
        <link rel="stylesheet" type="text/css" href="css/evo-calendar.min.css" />

        <link href="css/main.css" rel="stylesheet">
        <link href="assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
        <!-- This page CSS -->
        <!-- chartist CSS -->
        <link href="assets/node_modules/morrisjs/morris.css" rel="stylesheet">
        <!--c3 CSS -->
        <link href="assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/rila.css" rel="stylesheet">
        <!-- Dashboard 1 Page CSS -->
        <link href="css/pages/dashboard1.css" rel="stylesheet">
        <!-- You can change the theme colors from here -->
        <link href="css/colors/default.css" id="theme" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="assets/ext/consolehome.css" />
        <link rel="stylesheet" type="text/css" href="assets/ext/forms.css" />
        <link rel="stylesheet" type="text/css" href="assets/ext/console.css" />
        <link rel="stylesheet" type="text/css" href="assets/ext/menu.css" />
        <link rel="stylesheet" type="text/css" href="assets/ext/tree.css" />
        <link rel="stylesheet" type="text/css" href="assets/ext/jquerycss.css" />
        
        <script>
            window.onbeforeunload = function() { return "Your work will be lost."; };
            
            window.history.pushState(null, "", window.location.href);
            window.onpopstate = function () {
                window.history.pushState(null, "", window.location.href);
            };
            
        </script>

        <script src="assets/ext/jquery.js"></script>
        <script src="assets/ext/jquery-1.10.2.min.js"></script>
        <script src="assets/ext/jquery-u.js"></script>
        <script src="assets/ext/tree.js"></script>
        <script src="assets/ext/jquery-uis.1.10.2.min.js"></script>
        <script src="jlib/pop.js"></script>
        <script src="jlib/normarizr.js"></script>
        <script src="jlib/pageloader.js"></script>
        <link rel='stylesheet' type="text/css" href="jlib/pop.css" />
        <script src="assets/ext/alertdialog.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <style>
            .menutree {
                margin-left: -22px;
                width: 190px;
                padding-left: 5px;
                border: dotted 1px #fff;
                margin-top: 5px;
                text-decoration: none;
            }

            .menutree:hover {
                position: relative;
                border: dotted 1px #fff;
                text-decoration: none;
            }

            .sub-menutree text-white {
                margin-left: 10px;
                width: 190px;
                padding: 2px 5px;
                margin-top: 5px;
                border: dotted 1px #fff;
                text-decoration: none;
            }

            .foot {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                text-align: center;
            }

            .farm-color {
                background-color: #77bc54;
                color: #ffffff;
            }

            .farm-button {
                background-color: #77bc54;
                font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;

                font-weight:800;
                color: #ffffff;
                border: solid 1px #77bc54;
                border-radius: 1px;
            }
            .farm-button-disabled {
                background-color: #dddddd;
                font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;

                font-weight:800;
                color: #333333;
                border: solid 1px #666666;
                border-radius: 1px;
            }
            
            .farm-tab-button {
                background-color: #ffffff;
                font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;

                color: #77bc54;
                border: solid 1px #77bc54;
                border-radius: 1px;
            }

            .farm-tab-button:active {
                background-color: #77bc54;
                font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;

                color: #ffffff;
                border: solid 1px #77bc54;
                border-radius: 1px;
            }

            .farm-tab-button:hover {
                background-color: #ccd5ae;
                font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;

                color: #ffffff;
                border: solid 1px #77bc54;
                border-radius: 1px;
            }

            .farm-button-blend {
                background-color: #ccd5ae;
                font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;

                color: #555555;
                border: solid 1px #77bc54;
                border-radius: 1px;
            }

            .farm-button-cancel {
                background-color: #E8F5E9;
                font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;

                color: #333333;
                border: solid 1px #77bc54;
                border-radius: 1px;
            }

            .farm-button-icon-button {
                background-color: #ccd5ae;
                font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;

                color: #555555;
                border: solid 1px #ccd5ae;
                border-radius: 1px;
            }

            .nav-link .active {
                background-color: #E8F5E9;
                font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;

                color: #333333;
                border: solid 1px #77bc54;
                border-radius: 1px;
            }
            .farmbtn {
                  display: inline-block;
                  font-weight: normal;
                  text-align: left;
                  white-space: nowrap;
                  vertical-align: middle;
                  -webkit-user-select: none;
                     -moz-user-select: none;
                      -ms-user-select: none;
                          user-select: none;
                  border: 1px solid transparent;
                  padding: 0.5rem 0.75rem;
                  font-size: 1rem;
                  line-height: 1.25;
                  border-radius: 0.25rem;
                  transition: all 0.15s ease-in-out;
                }
            .farmbtn:focus, .btn:hover {
                  text-decoration: none;
                  
                }
                
                .farmbtn:focus, .farmbtn.focus {
                  outline: 0;
                  text-decoration: none;
                }
            .farm-menu-button {
                color: #ffffff;
                background-color: #77bc54;
                border-color: #77bc54;
                }
                
            .farm-menu-button:hover {
                color: #ffffff;
                background-color: #95c77b;
                border-color: #95c77b;
                }
                
            .farm-menu-button:focus, .farm-menu-button.focus {
                text-decoration: none;
                color: #ffffff;
                }
                
            .farm-menu-button.disabled, .farm-menu-button:disabled {
                background-color: #77bc54;
                border-color: #77bc54;
                }
                
            .farm-menu-button:active, .farm-menu-button.active,
                .show > .btn-primary.dropdown-toggle {
                background-color: #95c77b;
                background-image: none;
                border-color: #95c77b;
                color: #ffffff;
                }
            .image-upload>input {
                  display: none;
                }
           
        </style>

    </head>

    <body class="fix-header fix-sidebar card-no-border">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">KEALUCK</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <header class="topbar" style="top:0px;">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">

                    <div class="navbar-header">
                        <a class="navbar-brand" href="console">
                          
                            <img src="assets/images/simple.jpg" alt="homepage" />
                           
                        </a>
                    </div>
                    <div class="navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)">
                                    <i class="fa fa-bars"></i></a>
                            </li>
                        </ul>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav mx-5">
                            <!-- ============================================================== -->
                            <!-- Profile -->
                            <!-- ============================================================== -->
                            <li class="nav-item dropdown u-pro mr-5">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="hidden-md-down">
                                        <?php

                                        $username = escape($user->data()->username);

                                        

                                            $staff = Db::getInstance()->query("SELECT * FROM `staff_record` WHERE `user_id`='$username'");

                                            foreach ($staff->results() as $staff) {
                                                if (!empty($staff->image)) {
                                                    echo '<img src="view/usermanager/staff/' . $staff->image . '" class="img-fluid" alt="user">';
                                                } else {
                                                    echo '<img class="img-thumbnail border" src="view/usermanager/staff/add_user_icon.jpg" alt="user" />';
                                                }
                                                if (!empty($staff->firstname)) {
                                                    echo '<span class="card-title p-2 my-0">' . $staff->firstname . ' ' . $staff->lastname . '</span>';
                                                } else {
                                                    echo '<span class="card-title p-2 my-0">' . $staff->user_id . '</span>';
                                                }
                                            }
                                        

                                        ?>

                                    </span>
                                </a>
                                <div class="dropdown-menu mr-5 pr-5">

                                    <div class="_mc">
                                        <a class="dropdown-item" href="javascript:void(0)" id="view/usermanager/user">Profile Settings</a>

                                    </div>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                                </div>
                            </li>
                        </ul>

                    </div>

                </nav>
            </header>
        </div>
        <section>
            <aside class="left-sidebar" style="background-color: #77bc00;">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav mt-2" style="background-color: #77bc00; border-top:solid 1px #b6e0a6">
                        <?php
                       

                        if ($userSyscategory == 0) {

                        ?>
                        
                            <p class="px-4 py-3 text-light shadow bg-secondary">Super Administrator</p>
                               <div class="row mb-3">
                                    <div class="col-md-12">
                                        <ul>
                                        <li class="_mc">
                                        
                                                <a class="farmbtn farm-menu-button text-white text-decoration-none" href="javascript:void(0)" id="view/configurations" aria-expanded="false">
                                                    <i class="fa fa-cog text-white" aria-hidden="true"></i> Configurations
                                                </a>
                                                
                                            </li>
                                            <li class="_mc">
                                        
                                                <a class="farmbtn farm-menu-button text-white text-decoration-none" href="javascript:void(0)" id="view/approvals" aria-expanded="false">
                                                    <i class="fa fa-thumbs-o-up text-white"></i> Requests &amp; Approvals
                                                </a>
                                                
                                            </li>
                                            <li class="_mc">
                                        
                                                <a class="farmbtn farm-menu-button text-white text-decoration-none" href="javascript:void(0)" id="view/schedule" aria-expanded="false">
                                                    <i class="fa fa-calendar text-white"></i> Event &amp; Planning
                                                </a>
                                                
                                            </li>
                                </ul>
                                    </div>
                                </div>
                            <div class="tree overflow-auto" style="height:400px;">
                        
                                <ul id="sidebarnav">
                                    <li><a>Dashboard</a>
                                        <ul>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Administration 1</span>
                                                </a>
                                                <ul style="margin-left:-15px;">

                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/usermanager/users" aria-expanded="false">
                                                            <span class="hide-menu"> Employee Mgt</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/usermanager/staff" aria-expanded="false">
                                                            <span class="hide-menu"> Staff info</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/usermanager/payroll" aria-expanded="false">
                                                            <span class="hide-menu"> Payroll</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/usermanager/contractors" aria-expanded="false">
                                                            <span class="hide-menu"> Contractors</span>
                                                        </a>
                                                    </li>
                                                    <!--li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="#" aria-expanded="false">
                                                            <span class="hide-menu">Webshop Customers</span>
                                                        </a>
                                                    </li!-->
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4 pr-0">
                                                    <span class="hide-menu">Sales &amp; Marketing</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/order-voucher/" aria-expanded="false">
                                                            <span class="hide-menu">Order Voucher</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/orders/" aria-expanded="false">
                                                            <span class="hide-menu">Sales Orders</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/received" aria-expanded="false">
                                                            <span class="hide-menu"> Received</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/customers" aria-expanded="false">
                                                            <span class="hide-menu"> CRM</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Purchasing</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/purchases/orders" aria-expanded="false">
                                                            <span class="hide-menu">Purchase Orders</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/purchases/utility" aria-expanded="false">
                                                            <span class="hide-menu">Utility Bills</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/purchases/suppliers" aria-expanded="false">
                                                            <span class="hide-menu">Suppliers</span>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Livestock</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farmer/livestocks" aria-expanded="false">
                                                            <span class="hide-menu"> Poutry</span>
                                                        </a>
                                                    </li>
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farmer/livestocks" aria-expanded="false">
                                                            <span class="hide-menu"> Goatry</span>
                                                        </a>
                                                    </li>
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farmer/livestocks" aria-expanded="false">
                                                            <span class="hide-menu"> Apiary</span>
                                                        </a>
                                                    </li>
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farmer/livestocks" aria-expanded="false">
                                                            <span class="hide-menu"> Fishery</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Plantings</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farm/crops" aria-expanded="false">
                                                            <span class="hide-menu"> Crops Planning</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farm/crops/growlocation" aria-expanded="false">
                                                            <span class="hide-menu"> Grow Locations</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farm/crops/harvest.php" aria-expanded="false">
                                                            <span class="hide-menu"> Harvesting</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farm/crops" aria-expanded="false">
                                                            <span class="hide-menu"> Harvest-to-Market Process</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Agro-Processing</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/manufacturing/operations" aria-expanded="false">
                                                            <span class="hide-menu"> Work Orders</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    Finance &amp; Accounting
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/accounting/acc_reconciliation" aria-expanded="false">
                                                            <span class="hide-menu"> Reconciliation</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/accounting/journal" aria-expanded="false">
                                                            <span class="hide-menu"> Journal Entry</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/accounting/reports" aria-expanded="false">
                                                            <span class="hide-menu"> Reports</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/accounting/chart_of_accounts" aria-expanded="false">
                                                            <span class="hide-menu"> Chart of Account</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/accounting/currecy_type" aria-expanded="false">
                                                            <span class="hide-menu"> Exchange List</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Assets Management</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/assets_mgt/equipment" aria-expanded="false">
                                                            Equipment
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/assets_mgt/warehouses" aria-expanded="false">
                                                            Warehouses
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/assets_mgt/inventory" aria-expanded="false">
                                                            Inventory
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>

                                    </li>
                                </ul>
                                
                            </div>
                          
                        <?php
                        } else if ($userSyscategory == 1) {

                        ?>
                        
                            <p class="px-4 py-3 text-light shadow bg-secondary">Super Administrator</p>
                            <div class="row mb-3">
                                    <div class="col-md-12">
                                        <ul>
                                        <li class="_mc">
                                        
                                                <a class="farmbtn farm-menu-button text-white text-decoration-none" href="javascript:void(0)" id="view/configurations" aria-expanded="false">
                                                    <i class="fa fa-cog text-white" aria-hidden="true"></i> Configurations
                                                </a>
                                                
                                            </li>
                                            <li class="_mc">
                                        
                                                <a class="farmbtn farm-menu-button text-white text-decoration-none" href="javascript:void(0)" id="view/approvals" aria-expanded="false">
                                                    <i class="fa fa-thumbs-o-up text-white"></i> Requests &amp; Approvals
                                                </a>
                                                
                                            </li>
                                            <li class="_mc">
                                        
                                                <a class="farmbtn farm-menu-button text-white text-decoration-none" href="javascript:void(0)" id="view/schedule" aria-expanded="false">
                                                    <i class="fa fa-calendar text-white"></i> Event &amp; Planning
                                                </a>
                                                
                                            </li>
                                </ul>
                                    </div>
                                </div>
                            <div class="tree overflow-auto" style="height:400px;">
                        
                                <ul id="sidebarnav">
                                    <li><a>Dashboard</a>
                                        <ul>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Administration </span>
                                                </a>
                                                <ul style="margin-left:-15px;">

                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/usermanager/users" aria-expanded="false">
                                                            <span class="hide-menu"> Employee Mgt</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/usermanager/staff" aria-expanded="false">
                                                            <span class="hide-menu"> Staff info</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/usermanager/payroll" aria-expanded="false">
                                                            <span class="hide-menu"> Payroll</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/usermanager/contractors" aria-expanded="false">
                                                            <span class="hide-menu"> Contractors</span>
                                                        </a>
                                                    </li>
                                                    <!--li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="#" aria-expanded="false">
                                                            <span class="hide-menu">Webshop Customers</span>
                                                        </a>
                                                    </li!-->
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4 pr-0">
                                                    <span class="hide-menu">Sales &amp; Marketing</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                   <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/order-voucher/" aria-expanded="false">
                                                            <span class="hide-menu">Order Voucher</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/orders/" aria-expanded="false">
                                                            <span class="hide-menu">Sales Orders</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/received" aria-expanded="false">
                                                            <span class="hide-menu"> Received</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/customers" aria-expanded="false">
                                                            <span class="hide-menu"> CRM</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Purchasing</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/purchases/orders" aria-expanded="false">
                                                            <span class="hide-menu">Purchase Orders</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/purchases/utility" aria-expanded="false">
                                                            <span class="hide-menu">Utility Bills</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/purchases/suppliers" aria-expanded="false">
                                                            <span class="hide-menu">Suppliers</span>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Livestock</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farmer/livestocks" aria-expanded="false">
                                                            <span class="hide-menu"> Poutry</span>
                                                        </a>
                                                    </li>
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farmer/livestocks" aria-expanded="false">
                                                            <span class="hide-menu"> Goatry</span>
                                                        </a>
                                                    </li>
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farmer/livestocks" aria-expanded="false">
                                                            <span class="hide-menu"> Apiary</span>
                                                        </a>
                                                    </li>
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farmer/livestocks" aria-expanded="false">
                                                            <span class="hide-menu"> Fishery</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Plantings</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farm/crops" aria-expanded="false">
                                                            <span class="hide-menu"> Crops Planning</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farm/crops/growlocation" aria-expanded="false">
                                                            <span class="hide-menu"> Grow Locations</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farm/crops/harvest.php" aria-expanded="false">
                                                            <span class="hide-menu"> Harvesting</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farm/crops" aria-expanded="false">
                                                            <span class="hide-menu"> Harvest-to-Market Process</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Agro-Processing</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/manufacturing/operations" aria-expanded="false">
                                                            <span class="hide-menu"> Work Orders</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    Finance &amp; Accounting
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/accounting/acc_reconciliation" aria-expanded="false">
                                                            <span class="hide-menu"> Reconciliation</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/accounting/journal" aria-expanded="false">
                                                            <span class="hide-menu"> Journal Entry</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/accounting/reports" aria-expanded="false">
                                                            <span class="hide-menu"> Reports</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/accounting/chart_of_accounts" aria-expanded="false">
                                                            <span class="hide-menu"> Chart of Account</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/accounting/currecy_type" aria-expanded="false">
                                                            <span class="hide-menu"> Exchange List</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Assets Management</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/assets_mgt/equipment" aria-expanded="false">
                                                            Equipment
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/assets_mgt/warehouses" aria-expanded="false">
                                                            Warehouses
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/assets_mgt/inventory" aria-expanded="false">
                                                            Inventory
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>

                                    </li>
                                </ul>
                                
                            </div>
                          
                        <?php
                        } else if ($userSyscategory == 2) {


                        ?>
                          
                            <p class="px-4 py-3 text-light shadow bg-dark">Administrator</p>
                               <div class="row mb-3">
                                    <div class="col-md-12">
                                        <ul>
                                            <li class="_mc">
                                        
                                                <a class="farmbtn farm-menu-button text-white text-decoration-none" href="javascript:void(0)" id="view/schedule" aria-expanded="false">
                                                    <i class="fa fa-calendar text-white"></i> Event &amp; Planning
                                                </a>
                                                
                                            </li>
                                </ul>
                                    </div>
                                </div>
                            <div class="tree overflow-auto" style="height:400px;">
                             
                                <ul id="sidebarnav">
                                    <li><a>Dashboard</a>
                                        <ul>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Administration </span>
                                                </a>
                                                <ul style="margin-left:-15px;">

                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/usermanager/users" aria-expanded="false">
                                                            <span class="hide-menu"> Employee Mgt</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/usermanager/staff" aria-expanded="false">
                                                            <span class="hide-menu"> Staff info</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/usermanager/payroll" aria-expanded="false">
                                                            <span class="hide-menu"> Payroll</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/usermanager/contractors" aria-expanded="false">
                                                            <span class="hide-menu"> Contractors</span>
                                                        </a>
                                                    </li>
                                                    <!--li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="#" aria-expanded="false">
                                                            <span class="hide-menu">Webshop Customers</span>
                                                        </a>
                                                    </li!-->
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4 pr-0">
                                                    <span class="hide-menu">Sales &amp; Marketing</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                   <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/order-voucher/" aria-expanded="false">
                                                            <span class="hide-menu">Order Voucher</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/orders/" aria-expanded="false">
                                                            <span class="hide-menu">Sales Orders</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/received" aria-expanded="false">
                                                            <span class="hide-menu"> Received</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/customers" aria-expanded="false">
                                                            <span class="hide-menu"> CRM</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Purchasing</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/purchases/orders" aria-expanded="false">
                                                            <span class="hide-menu">Purchase Orders</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/purchases/utility" aria-expanded="false">
                                                            <span class="hide-menu">Utility Bills</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/purchases/suppliers" aria-expanded="false">
                                                            <span class="hide-menu">Suppliers</span>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Livestock</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farmer/livestocks" aria-expanded="false">
                                                            <span class="hide-menu"> Poutry</span>
                                                        </a>
                                                    </li>
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farmer/livestocks" aria-expanded="false">
                                                            <span class="hide-menu"> Goatry</span>
                                                        </a>
                                                    </li>
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farmer/livestocks" aria-expanded="false">
                                                            <span class="hide-menu"> Apiary</span>
                                                        </a>
                                                    </li>
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farmer/livestocks" aria-expanded="false">
                                                            <span class="hide-menu"> Fishery</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Plantings</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farm/crops" aria-expanded="false">
                                                            <span class="hide-menu"> Crops Planning</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farm/crops/growlocation" aria-expanded="false">
                                                            <span class="hide-menu"> Grow Locations</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farm/crops/harvest.php" aria-expanded="false">
                                                            <span class="hide-menu"> Harvesting</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/farm/crops" aria-expanded="false">
                                                            <span class="hide-menu"> Harvest-to-Market Process</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Agro-Processing</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/manufacturing/operations" aria-expanded="false">
                                                            <span class="hide-menu"> Work Orders</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    Finance &amp; Accounting
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/accounting/acc_reconciliation" aria-expanded="false">
                                                            <span class="hide-menu"> Reconciliation</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/accounting/journal" aria-expanded="false">
                                                            <span class="hide-menu"> Journal Entry</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/accounting/reports" aria-expanded="false">
                                                            <span class="hide-menu"> Reports</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/accounting/chart_of_accounts" aria-expanded="false">
                                                            <span class="hide-menu"> Chart of Account</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/accounting/currecy_type" aria-expanded="false">
                                                            <span class="hide-menu"> Exchange List</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Assets Management</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/assets_mgt/equipment" aria-expanded="false">
                                                            Equipment
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/assets_mgt/warehouses" aria-expanded="false">
                                                            Warehouses
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/assets_mgt/inventory" aria-expanded="false">
                                                            Inventory
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>

                                    </li>
                                </ul>
                            </div>
                          
                        <?php
                        } else if ($userSyscategory == 3) {


                        ?>
                          
                            <p class="px-4 py-3 text-light shadow bg-dark">Finance & Account</p>
                               <div class="row mb-3">
                                    <div class="col-md-12">
                                        <ul>
                                            <li class="_mc">
                                        
                                                <a class="farmbtn farm-menu-button text-white text-decoration-none" href="javascript:void(0)" id="view/schedule" aria-expanded="false">
                                                    <i class="fa fa-calendar text-white"></i> Event &amp; Planning
                                                </a>
                                                
                                            </li>
                                </ul>
                                    </div>
                                </div>
                            <div class="tree overflow-auto" style="height:400px;">
                                <ul id="sidebarnav">
                                    <li><a>Dashboard</a>
                                        <ul>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    Finance &amp; Accounting
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/accounting/acc_reconciliation" aria-expanded="false">
                                                            <span class="hide-menu"> Reconciliation</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/accounting/journal" aria-expanded="false">
                                                            <span class="hide-menu"> Journal Entry</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/accounting/reports" aria-expanded="false">
                                                            <span class="hide-menu"> Reports</span><!-- view/accounting/general_ledger !-->
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/accounting/chart_of_accounts" aria-expanded="false">
                                                            <span class="hide-menu"> Chart of Account</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/accounting/currecy_type" aria-expanded="false">
                                                            <span class="hide-menu"> Exchange List</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            
                                        </ul>

                                    </li>
                                </ul>
                            </div>
                          
                        <?php
                        } else if ($userSyscategory == 4) {


                        ?>
                          
                            <p class="px-4 py-3 text-light shadow bg-dark">Sales & Marketing</p>
                               <div class="row mb-3">
                                    <div class="col-md-12">
                                        <ul>
                                        
                                            <li class="_mc">
                                        
                                                <a class="farmbtn farm-menu-button text-white text-decoration-none" href="javascript:void(0)" id="view/schedule" aria-expanded="false">
                                                    <i class="fa fa-calendar text-white"></i> Event &amp; Planning
                                                </a>
                                                
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <div class="tree overflow-auto" style="height:400px;">
                                <ul id="sidebarnav">
                                    <li><a>Dashboard</a>
                                        <ul>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4 pr-0">
                                                    <span class="hide-menu">Sales &amp; Marketing</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/order-voucher/" aria-expanded="false">
                                                            <span class="hide-menu">Order Voucher</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/orders/" aria-expanded="false">
                                                            <span class="hide-menu">Sales Orders</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/received" aria-expanded="false">
                                                            <span class="hide-menu"> Received</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/sales/customers" aria-expanded="false">
                                                            <span class="hide-menu"> CRM</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Purchasing</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/purchases/utility" aria-expanded="false">
                                                            <span class="hide-menu">Utility Bills</span>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                            </li>
                                            <li><a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Assets Management</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/assets_mgt/equipment" aria-expanded="false">
                                                            Equipment
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/assets_mgt/warehouses" aria-expanded="false">
                                                            Warehouses
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/assets_mgt/inventory" aria-expanded="false">
                                                            Inventory
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>

                                    </li>
                                </ul>
                            </div>
                          
                        <?php
                        } else if ($userSyscategory == 5) {


                        ?>
                          
                            <p class="px-4 py-3 text-light shadow bg-dark">Agro Processing</p>
                               <div class="row mb-3">
                                    <div class="col-md-12">
                                        <ul>
                                            <li class="_mc">
                                        
                                                <a class="farmbtn farm-menu-button text-white text-decoration-none" href="javascript:void(0)" id="view/schedule" aria-expanded="false">
                                                    <i class="fa fa-calendar text-white"></i> Event &amp; Planning
                                                </a>
                                                
                                            </li>
                                </ul>
                                    </div>
                                </div>
                            <div class="tree overflow-auto" style="height:400px;">
                                <ul id="sidebarnav">
                                    <li><a>Dashboard</a>
                                        <ul>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Purchasing</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/purchases/orders" aria-expanded="false">
                                                            <span class="hide-menu">Purchase Orders</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white pr-0" href="javascript:void(0)" id="view/purchases/utility" aria-expanded="false">
                                                            <span class="hide-menu">Utility Bills</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/purchases/suppliers" aria-expanded="false">
                                                            <span class="hide-menu">Suppliers</span>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Agro-Processing</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree text-white" href="javascript:void(0)" id="view/manufacturing/operations" aria-expanded="false">
                                                            <span class="hide-menu"> Work Orders</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                           
                                        </ul>

                                    </li>
                                </ul>
                            </div>
                          
                        <?php
                        } else if ($userSyscategory == 9) {


                        ?>
                          
                            <p class="px-4 py-3 text-light shadow bg-dark">Non Officer</p>
                             
                            <div class="tree overflow-auto" style="height:400px;">
                                <ul id="sidebarnav">
                                    <li><a>Dashboard</a></li>
                                </ul>
                            </div>
                          
                        <?php
                        } 
                        ?>
                    </nav>

                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>


            <div id="contentbar" class="page-wrapper pb-0">
                <div id="contentbar_inner" class="container-fluid">
                <div class="col-md-12">    
                    <h2>Daily Perfomance Charts</h2>
                </div>
                    <!-- inner window !-->

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
   
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-xl-8 col-sm-6 mb-xl-0 mb-2">
          
        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
        <!-- https://www.w3schools.com/ai/ai_chartjs.asp !-->
        <script>
        var xValues = ["Crop", "Livestock", "Manufacturing"];
        var yValues = [55, 49, 44,];
        var barColors = [
          "#b91d47",
          "#00aba9",
          "#2b5797"
        ];
        
        new Chart("myChart", {
          type: "doughnut",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "Total sales on all product"
            }
          }
        });
        </script>
         
        </div>
        <!--div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                <h4 class="mb-0">2,300</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">New Clients</p>
                <h4 class="mb-0">3,462</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p>
            </div>
          </div>
        </div!-->
        <div class="col-xl-4 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Sales</p>
                <h4 class="mb-0">N103,430</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row my-2">
        <div class="col-lg-4 col-md-6 mt-4 mb-2">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Crops</h6>
              <p class="text-sm ">Performance</p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> usage record 2 days ago </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-4 mb-2">
          <div class="card z-index-2  ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 "> Livestock </h6>
              <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today sales. </p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> updated 4 min ago </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mt-4 mb-2">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Manufacturing</h6>
              <p class="text-sm ">Performance</p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm">just updated</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    
    </div>
  </main>

                    <!-- end of inner window !-->
                </div>

            </div>
            </div>
        </Section>
        <footer id="contentbar_footers" class="footer foot fixed-bottom ">
            <div id="loader_httpFeed"><img src="loading.gif" /></div>
             &copy; &nbsp; KEALUCK 
            <script>
                document.write(new Date().getFullYear());
            </script>
        </footer>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to Logout?
                    </div>
                    <div class="modal-footer">
                        <button class="btn farm-button-cancel" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn farm-button" href="../login/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Modal-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete?
                    </div>
                    <div class="modal-footer">
                        <button class="btn farm-button-cancel" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn farm-button" href="../login/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        
      

        <!-- ============================================================== -->
        <!-- All Jquery -->

        <script src="assets/node_modules/jquery/jquery.min.js"></script>
        <!-- Bootstrap popper Core JavaScript -->
        <script src="assets/node_modules/bootstrap/js/popper.min.js"></script>
        <script src="assets/node_modules/bootstrap/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="js/perfect-scrollbar.jquery.min.js"></script>
        <!--Wave Effects -->
        <script src="js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="js/custom.min.js"></script>
        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->
        <!--morris JavaScript -->
        <script src="assets/node_modules/raphael/raphael-min.js"></script>
        <script src="assets/node_modules/morrisjs/morris.min.js"></script>
        <!--c3 JavaScript -->
        <script src="assets/node_modules/d3/d3.min.js"></script>
        <script src="assets/node_modules/c3-master/c3.min.js"></script>
        <!-- Chart JS -->
        <script src="js/dashboard1.js"></script>
        <!-- Add jQuery library (required) -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

        <!-- Add the evo-calendar.js for.. obviously, functionality! -->
        <script src="js/evo-calendar.min.js"></script>
        
        
          
    </body>

    </html>
<?php
}
?>