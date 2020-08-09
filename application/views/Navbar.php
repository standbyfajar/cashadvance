<!DOCTYPE html>
<html>
<head>
  <title></title>

<!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --> 
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url('DataTables/DataTables-1.10.16/js/dataTables.bootstrap.min.js') ?>"> -->
 <!--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
  </script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script> -->
</head>
<body >
    <style type="text/css">
   body{
            padding: 0;
            margin: 0;
    font-family:"open sans";
        }
        header{
            background:#232323;
            padding:10px;   
            color:#fff;         
            overflow:hidden;
            margin: 0;
        }

        .judul{
            float: left;
            margin: 0;
        }

        .menu{
            position: fixed;
            background: #f6f6f6;
            color: #232323;         
            height: 100%;
            width: 200px;
            top: 70px;
            left: -300px;
            -webkit-transition: left 0.2s;
            transition: left 0.2s;
            padding: 20px;
            border: 1px solid #ccc;         
        }

        .menu ul{
            padding: 0;
        }

        .menu li{
            list-style-type: none;
            padding: 10px 0px;
        }

        .menu a{
            color: #232323;
            text-decoration: none;
            font-size: 10pt;
        }

        .tombol{
            float: right;
            background: transparent;
            padding: 10px;
            color: #fff;
            border: 1px solid #fff;
            cursor: pointer;
        }

        .slide-menu-tampil{
            left: 0 !important;
        }
</style>
  <!-- <?php $useri//d= $_POST//['userlogin']; ?> -->
<div  class="container-fluid" style="margin-top:5pt"> <!-- container fluid untuk full screen -->

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" ><b><span class="glyphicon glyphicon-print"></span> <font color="#FFFFFF">Cash Advance</font></b></a>
    </div>
    <ul class="nav navbar-nav">
    <li class="active" ><a href="<?php echo base_url('Cashadvance/Home'); ?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
    <li>
      <a href=" " class="tombol">Menu</a><span class=""></span>
    </li>
      <li ><a href="<?php echo base_url('Pinjam/') ?>"><span class="glyphicon glyphicon-shopping-cart"></span> Peminjaman Cash Advance </a></li>
    
     <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      <span class="glyphicon glyphicon-user"></span> Data Master <span class="caret"></span></a>
          <ul class="dropdown-menu">
               <li><a href="<?php echo base_url('Cashadvance/karyawan'); ?>"><i class="glyphicon glyphicon-user"></i> Data Karyawan</a></li>
         <li><a href="<?php echo base_url('Cashadvance/departmen'); ?>" ><i class="glyphicon glyphicon-lock"></i> Data Department</a> </li>
       </ul>
     </li>
     <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      <span class="glyphicon glyphicon-print"></span> Laporan <span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><a href="<?php echo base_url('Cashadvance/laporan_perbrg') ?>"><i class="glyphicon glyphicon-print"></i> Laporan Per periode</a></li>
               <li><a href="<?php echo base_url('Cashadvance/laporan') ?>"><i class="glyphicon glyphicon-print"></i>  Laporan Per barang</a></li>
        
               
          </ul>
          
    </li>
      
    </ul>
  
      <ul class="nav navbar-nav navbar-right">
       <li><p class="navbar-text navbar-left"><b><i> Welcome : <?php echo $this->session->userlogin['nama']; ?> <font color="#FFFFFF"></font> </i></b></p></li> 
        <li><a href="<?php echo base_url('Login/logout'); ?>" role="button" ><span class="glyphicon glyphicon-log-in"></span> Logout </a></li>
    
      </ul>

  </div>

</nav>
</div>
<!-- <?php echo $y ?> -->
<nav class="menu">    
            <h4>Menu Navigasi</h4>
            <ul>
                <li><a href="#">Peminjaman Cash Advance</a></li>
                <li><a href="#">Data Karyawan</a></li>
                <li><a href="#">Department</a></li>
                <li><a href="#">Laporan</a></li>
            </ul>
        </nav>

</body>
<script type="text/javascript">
      $(document).ready(function(){
            $('.tombol').click(function(){
                $('.menu').toggleClass("slide-menu-tampil");
            });
        });
    </script>
</html>


