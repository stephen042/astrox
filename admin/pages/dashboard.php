<?php
session_start();
include_once "..\../config\config.php";
include_once "..\../controller_user\dbcon.php";
  
  if (empty($_SESSION['auth'])) {
  //  header("location: ..\../user/pages\dashboard.php");
  }
   $sql = "SELECT * FROM `user`;";
   $result = mysqli_query($conn,$sql);
   if ($result->num_rows > 0) {
    $userdatas = [];
      while($data = $result->fetch_assoc()){
       $userdatas[] = $data;
     }
   $userno = count($userdatas);
  //  print_r($userno);
  //  die();
    }
   $sql = "SELECT * FROM `billing`;";
   $result = mysqli_query($conn,$sql);
   if ($result->num_rows > 0) {
    $billingdatas = [];
      while($data = $result->fetch_assoc()){
       $billingdatas[] = $data;
     }
   $billingno = count($billingdatas);
  //  print_r($billingno);
  //  die();
    }
    // working for billing
    $sql = "SELECT * FROM `billing` ORDER BY`created_at` DESC LIMIT 0, 5;";
    $result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
     $datas = [];
       while($data = $result->fetch_assoc()){
        $datas[] = $data;
      }
   //  print_r($billingno);
   //  die();
     }
?>
<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php include_once "../includes/header.php"?>
<!-- head end -->

<body class="g-sidenav-show  bg-gray-200">
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <!--sidebar start  -->
  <?php
  require_once '../includes/side-bar.php';
  ?>
  <!-- sidebar end   -->
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <!-- <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li> -->
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <!-- <label class="form-label">Type here...</label> -->
              <!-- <input type="text" class="form-control"> -->
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <!-- <a class="nav-link text-white " href="../pages/sign-out.php">
              <div><i class="material-icons opacity-10">login</i> </div>
            <span class="nav-link-text ms-1">Sign out</span>
          </a> -->
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="https://demos.creative-tim.com/material-dashboard/assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">receipt_long</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize"> Current <br>student's orders</p>
                <h4 class="mb-0"><?=$billingno?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span></p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Current Students</p>
                <h4 class="mb-0"><?=$userno?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than half a year </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">New Client / student</p>
                <h4 class="mb-0">72</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+2%</span> than last month</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">investments <br> Per Annum Estimated <br> by CySEC </p>
                <h4 class="mb-0">£100m</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4 align-items-center justify-content-center">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>ORDERS</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1" style="margin-left:auto;"><a href="billing.php">View all</a></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
              <table class="table align-items-center justify-content-center mb-0">
                <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">amount</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Payment_slip</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($datas)){   ?>

          <?php foreach ($datas as $data) { ?>
          <?php    if(empty($data["status"])){  ?>
            <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <?php  $method = strtolower($data["method"])?>
                                <?php   if($method == "bitcion"){  ?>
                            <img src="../../user/assets/img/bit.jfif" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                <?php  }else if($method == "lithuim") {   ?>
                            <img src="../../user/assets/img/lit.jfif" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                <?php   }else if($method == "paypal"){  ?>
                            <img src="../../user/assets/img/pay.jfif" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                <?php   }else if($method == "etherum"){  ?>
                            <img src="../../user/assets/img/ethe.jfif" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                <?php   }  ?>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <?php  
                                $userid = $data["user_id"];
                                $sql = "SELECT * FROM `user` WHERE  `id`= $userid";
                                $result = mysqli_query($conn,$sql);
                                if (mysqli_num_rows($result) > 0) {
                                 $userdata = mysqli_fetch_assoc($result);  ?>
                            <h6 class="mb-0 text-sm" style="text-transform:uppercase;"><?=$userdata["name"]?></h6>
                            <p class="text-xs text-secondary mb-0"><a href="#"><?=$userdata["email"]?></a></p>
                          </div>
                                <!-- print_r( $userdata["name"]); -->
                             <?php  } ?>

                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?=$data["Amount"]?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><span class="ms-sm-2 font-weight-bold"><i class="material-icons opacity-10">check</i>added</span></span></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                      <p class="text-xs font-weight-bold mb-0"><span class="ms-sm-2 font-weight-bold"><i class="material-icons opacity-10">warning</i></span></span></p>
                    </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?=date("d/M/Y",strtotime($data["created_at"]))?></span>
                      </td>
                    </tr>
          <?php    } /**end of checking if it,s not pending */ ?>
          <?php    } /**end of foreach */ ?>

          <?php }else{   ?>
          <tr>

            </tr>
           <?php }   ?> 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
       
      </div>
      <!-- for users -->
      <div class="row mb-4 align-items-center justify-content-center">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Callbacks</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1" style="margin-left:auto;"><a href="users.php">View all</a></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
              <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact Number</th>
                      <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email Address</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Country</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">selection</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($userdatas)){  ?>
                <?php foreach ($userdatas as $userdata) { ?>
                  <?php if(empty($userdata["password"])){ ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?=$userdata["name"]?></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?=$userdata["phoneNum"]?></p>
                      </td>
                      <td style="overflow:hidden;word-break: break-all;">
                        <p class="text-xs font-weight-bold mb-0"><?=$userdata["email"]?></p>
                      </td>
                      <td style="text-align:center;">
                        <p class="text-xs font-weight-bold mb-0"><?=$userdata["country"]?></p>
                      </td>
                      <td style="text-align:center;">
                        <p class="text-xs font-weight-bold mb-0"><?=$userdata["radio_selection"]?></p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?=date("d/M/Y",strtotime($userdata["created_at"]))?></span>
                      </td>
                      <td class="align-middle text-center text-sm">
                      <p class="text-xs font-weight-bold mb-0"><span class="ms-sm-2 font-weight-bold"><i class="material-icons opacity-10">warning</i></span></span></p>
                      </td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
       
      </div>
      <!-- footer start -->
      <?php require_once '../includes/footer.php'; ?>
      <!-- footer end -->
    </div>
  </main>

  <!-- settings start -->
  <?php require_once '../includes/setting.php'; ?>
  <!-- settings stop -->

  <!--   Core JS Files   -->
  <!-- script start -->
  <?php require_once '../includes/script.php'; ?>
  <!-- script end -->
</body>



</html>
