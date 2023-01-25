<?php
include_once "..\../config\config.php";
include_once "..\../controller_user\dbcon.php";

session_start();
$id = $_SESSION["id"];
 $username =$_SESSION["userName"];
$useremail =  $_SESSION["email"];
if (!empty($_POST["submit_trans"])) {
  //  print_r($_POST);
   $error = [];
   $emailerror;
   $currency = mysqli_real_escape_string($conn, $_POST['currency']);
   $ammount = mysqli_real_escape_string($conn, $_POST['ammount']);
  //  $slip = mysqli_real_escape_string($conn, $_POST['images']);
   if (empty($currency)) {
      $error["currency"] ='currency empty'; 
   }
   if (empty($ammount)) {
      $error["ammount"] ='ammount empty'; 
   }
     // for empty image input
    if (!empty($_FILES)) {
    $file= $_FILES['images'];
    $size =  $file["size"];
    $type= $file["type"];
    $tmp_location = $file["tmp_name"];
  /**checking if they is any error or if it is empty */
  if ($file["error"] > 0) {
    $error['image']="error occured in the image input";
    $error['empty']="empty border";

  } else{
    $target_dir ="../assets/order-images/";
    $file_ext = explode('/', $type);
    $image_ext = strtolower(end($file_ext));
    $image = hash("sha256", uniqid());
    $image_name = substr($image,0,15);
    $image_path = $target_dir .$image_name.".".$image_ext;
    if (move_uploaded_file($tmp_location, $image_path)) {
        // return $image_path;
    }else{
        $error['image']="error occured in the image input";
    }
  }

  } else{/**end ofimage validation */
  $error['image']="error occured in the image input";
  }/** end of validating else */
  
  if (empty($error)) { /**begining of sending email */
    // echo $Success;
    $sql = "INSERT INTO `billing` (`id`, `user_id`, `method`, `Amount`, `paymentSlip`, `status`, `created_at`) 
    VALUES (NULL, '$id', '$currency', '$ammount', '$image_path', '', current_timestamp());";
    $inserted_data = mysqli_query($conn, $sql);
    if ($inserted_data) {
        // echo "<script>  Swal.fire({
        //   title:'Transaction Successfully submitted',
        //   text:'".$username." Please Wait,Your order is being proccessed',
        //   icon:'success',
        //   timer:5000
        //  })</script>";
        //  die();
    }else{
        $emailerror="error occured in  transaction";
    }
  //  sending mail  
  }/**end of sending email */
   
}
// working for transaction details
$sql = "SELECT * FROM billing WHERE `user_id` = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
 $datas = [];
   while($data = $result->fetch_assoc()){
    $datas[] = $data;
  }
  // print_r($datas);
  // die()
}
// working for address
$sql = "SELECT * FROM `payment_address` WHERE `id` = 0";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $address = mysqli_fetch_assoc($result);
 }
//  print_r($address);
//  die();
?>
<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<?php include_once "../includes/header.php"?>


<body class="g-sidenav-show  bg-gray-200">
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="<?=APP_URL?>" target="_blank">
        <img src="../assets/img/logo_01.png" class="navbar-brand-img h-100" alt="main_logo">
        <br>
        <span class="ms-1 font-weight-bold text-white">User Dashboard </span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link text-white " href="../pages/dashboard.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/billing.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/notifications.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/sign-out.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">Sign out</span>
          </a>
        </li>
      </ul>
    </div>
    <!-- <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-primary mt-4 w-100" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
      </div>
    </div> -->
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <!-- <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Billing</li> -->
          </ol>
          <h6 class="font-weight-bolder mb-0">Billing</h6>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">
            <!-- beginig of biiling customized -->
            <div class="col-xl-6 mb-xl-0 mb-4" style="margin:20px 0px">
              <div class="card bg-transparent shadow-xl">
                <div class="overflow-hidden position-relative border-radius-xl">
                  <img src="../assets/img/bit.jfif" class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100" alt="pattern-tree">
                  <span class="mask bg-gradient-dark opacity-10"></span>
                  <div class="card-body position-relative z-index-1 p-3">
                    <i class="material-icons text-white p-2">Bitcion</i>
                    <h5 class="text-white mt-4 mb-5 pb-2">Bitcion Address</h5>
                    <div class="d-flex">
                      <div class="d-flex">
                        <div class="me-4">
                          <p class="text-white text-sm opacity-8 mb-0">Copy Address <i class="material-icons opacity-10">copy</i></p>
                        </div>
                      </div>
                      <div class="ms-auto w-20 d-flex align-items-end justify-content-end" id="copy-box">
                         <span><i class="material-icons opacity-10">copy</i></span>
                        <input style="width:150px; margin:0px 5px;background-color:rgba(0,0,0,0.8);border:none;border-radius:5px;padding:0px 5px;color:#fff;" class="form-control" readonly type="text" value='<?=$address["btc"]?>'  id="addreess">
                         <img style="border-radius:50%; width:30px;height:30px;cursor:pointer;object-fit:cover;" class="w-60 mt-2" src="../assets/img/bitcoinlogo.png" alt="logo" style="cursor: pointer;"  id="button" data-index="1">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ending of biiling customized -->
            <!-- beginig of biiling customized 2 -->
            <div class="col-xl-6 mb-xl-0 mb-4" style="margin:20px 0px">
              <div class="card bg-transparent shadow-xl">
                <div class="overflow-hidden position-relative border-radius-xl">
                  <img src="../assets/img/lit.jfif" class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100" alt="pattern-tree">
                  <span class="mask bg-gradient-dark opacity-10"></span>
                  <div class="card-body position-relative z-index-1 p-3">
                    <i class="material-icons text-white p-2">Lithuim</i>
                    <h5 class="text-white mt-4 mb-5 pb-2">Lithuim Address</h5>
                    <div class="d-flex">
                      <div class="d-flex">
                        <div class="me-4">
                          <p class="text-white text-sm opacity-8 mb-0">Copy Address <i class="material-icons opacity-10">copy</i></p>
                        </div>
                      </div>
                      <div class="ms-auto w-20 d-flex align-items-end justify-content-end" style="cursor: pointer;" id="copy-box">
                         <span><i class="material-icons opacity-10">copy</i></span>
                        <input style="width:150px; margin:0px 5px;background-color:rgba(0,0,0,0.8);border:none;border-radius:5px;padding:0px 5px;color:#fff;" readonly type="text" value='<?=$address["lith"]?>'  id="addreess">
                         <img style="width:30px;height:30px;cursor:pointer;object-fit:cover; border-radius:50%; " class="w-60 mt-2" src="../assets/img/litecoinlogo.jfif" alt="logo" id="button" data-index="2">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ending of biiling customized -->
            <!-- beginig of biiling customized 3-->
            <div class="col-xl-6 mb-xl-0 mb-4" style="margin:20px 0px">
              <div class="card bg-transparent shadow-xl">
                <div class="overflow-hidden position-relative border-radius-xl">
                  <img src="../assets/img/pay.jfif" class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100" alt="pattern-tree">
                  <span class="mask bg-gradient-dark opacity-10"></span>
                  <div class="card-body position-relative z-index-1 p-3">
                    <i class="material-icons text-white p-2">paypal</i>
                    <h5 class="text-white mt-4 mb-5 pb-2">paypal Address</h5>
                    <div class="d-flex">
                      <div class="d-flex">
                        <div class="me-4">
                          <p class="text-white text-sm opacity-8 mb-0">Copy Address <i class="material-icons opacity-10">copy</i></p>
                        </div>
                      </div>
                      <div class="ms-auto w-20 d-flex align-items-end justify-content-end" style="cursor: pointer;" id="copy-box">
                         <span><i class="material-icons opacity-10">copy</i></span>
                        <input style="width:150px; margin:0px 5px;background-color:rgba(0,0,0,0.8);border:none;border-radius:5px;padding:0px 5px;color:#fff;" readonly type="text" value='<?=$address["pay"]?>'  id="addreess">
                         <img style="border-radius:50%; width:30px;height:30px;cursor:pointer;object-fit:cover;" class="w-60 mt-2" src="../assets/img/paypallogo.png" alt="logo" id="button" data-index="3">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ending of biiling customized -->
            <!-- beginig of biiling customized -->
            <div class="col-xl-6 mb-xl-0 mb-4" style="margin:20px 0px">
              <div class="card bg-transparent shadow-xl">
                <div class="overflow-hidden position-relative border-radius-xl">
                  <img src="../assets/img/ethe.jfif" class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100" alt="pattern-tree">
                  <span class="mask bg-gradient-dark opacity-10"></span>
                  <div class="card-body position-relative z-index-1 p-3">
                    <i class="material-icons text-white p-2">Etherum</i>
                    <h5 class="text-white mt-4 mb-5 pb-2">Etherum Address</h5>
                    <div class="d-flex">
                      <div class="d-flex">
                        <div class="me-4">
                          <p class="text-white text-sm opacity-8 mb-0">Copy Address <i class="material-icons opacity-10">copy</i></p>
                        </div>
                      </div>
                      <div class="ms-auto w-20 d-flex align-items-end justify-content-end" style="cursor: pointer;" id="copy-box">
                         <span><i class="material-icons opacity-10">copy</i></span>
                        <input style="width:150px; margin:0px 5px;background-color:rgba(0,0,0,0.8);border:none;border-radius:5px;padding:0px 5px;color:#fff;" readonly type="text" value='<?=$address["ethe"]?>'  id="addreess">
                         <img  style="border-radius:50%; width:30px;height:30px;cursor:pointer;object-fit:cover;"class="w-60 mt-2" src="../assets/img/ethereumlogo.jfif" alt="logo" id="button" data-index="4">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- beginig of biiling customized -->
            <!-- <div class="col-md-12 mb-lg-0 mb-4">
              <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0">Payment Method</h6>
                    </div>
                    <div class="col-6 text-end">
                      <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Card</a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-md-6 mb-md-0 mb-4">
                      <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                        <img  class="w-10 me-3  style="border-radius:50%; width:30px;height:30px;cursor:pointer;object-fit:cover;"mb-0" src="../assets/img/logos/mastercard.png" alt="logo">
                        <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;7852</h6>
                        <i class="material-icons ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card">edit</i>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                        <img class="w-10 me-3 mb-0" src="../assets/img/logos/visa.png" alt="logo">
                        <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;5248</h6>
                        <i class="material-icons ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card">edit</i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-12 d-flex align-items-center">
                  <h6 class="mb-0">MAKE TRANSACTION</h6>
                </div>
                
              </div>
            </div>
            <div class="card-body p-3 pb-0">
             <form class="trans-box" style="text-align: center;"action="" method="POST" enctype="multipart/form-data">
             <?php if(!empty($_POST["submit_trans"])){ ?>
                        <?php if (!empty($error)) { ?>
                            <span style="color:crimson;">please fill in all the required details</span>
                        <?php  }else {  ?>
                            <?php if (!empty($emailerror)) { ?>
                        <span style="color:crimson;">An error occured Try agian Later</span>
                        <?php }else { ?>
                            <span style="color:green;">Transaction successfull</span>
                            <?php }  ?>
                            <?php }  ?>
                        <?php  }  ?>
             <div class="input-group input-group-outline">
                <select name="currency" id="" class="form-control">
                  <option value="">Method</option>
                  <option value="bitcion">Bitcion</option>
                  <option value="paypal">Paypal</option>
                  <option value="etherum">Etherum</option>
                  <option value="lithuim">Lithuim</option>
                </select>
              </div>
              <div class="input-group input-group-outline">
                <input type="text" class="form-control" name="ammount" placeholder="Input Ammount">
              </div>
              <div class="input-group input-group-outline">
                <input type="file" class="form-control" name="images">
              </div>
            <input type="submit" id="submit" value="SUBMIT" name="submit_trans">
             </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row"> 
        <div class="col-md-10 mt-6" style="margin:20px auto;">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">Billing Information</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
              <?php if (!empty($datas)) { ?>
              <?php foreach ($datas as $data) { ?>
                 <?php    if(!empty($data["status"])){  ?>
                  <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm"><?=$data["method"]?></h6>
                    <span class="mb-2 text-xs">Ammount: <span class="text-dark font-weight-bold ms-sm-2"><?=$data["Amount"]?></span></span>
                    <span class="mb-2 text-xs">Payment_Slip: <span class="ms-sm-2 font-weight-bold" style="color:green;"><i class="material-icons opacity-10">check</i>added</span></span>
                    <span class="text-xs">Status: <span class="text-dark ms-sm-2 font-weight-bold"><?=$data["status"]?></span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="#" id="delete" data-index="<?=$data["id"]?>" data-user="<?=$id?>"> <i class="material-icons opacity-10" style="margin:0px 5px;">delete</i>Delete</a>
                    <!-- <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2"></i>Edit</a> -->
                  </div>
                </li>
                  <?php } ?>
                  <?php } ?>
                 <?php   }else{   ?>
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">Wellcome <?= $_SESSION["userName"]?> make an order</h6>
                  </div>
                </li>
                 <?php   }   ?>
              </ul>
            </div>
          </div>
        </div>
       
      </div>
      <?php include_once "../includes/footer.php"?>

    </div>
  </main>
 
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="../../../buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min2513.js?v=3.0.0"></script>
  <!-- <script src="../assets/js/copy.js"></script> -->
  <script src="..\assets\dist/sweetalert2.all.min.js"></script> 
  <script src="transaction.js"></script>
</body>


<!-- Mirrored from demos.creative-tim.com/material-dashboard/pages/billing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Oct 2021 00:18:12 GMT -->
</html>