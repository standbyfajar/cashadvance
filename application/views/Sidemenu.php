<!DOCTYPE html>
<html>
<head>
	<title></title>
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
</head>




<nav class="menu">    
            <h4>Menu Navigasi</h4>
            <ul>
                <li><a href="#">Peminjaman Cash Advance</a></li>
                <li><a href="#">Data Karyawan</a></li>
                <li><a href="#">Department</a></li>
                <li><a href="#">Laporan</a></li>
            </ul>
        </nav>
   

    

<script type="text/javascript">
    	$(document).ready(function(){
            $('.tombol').click(function(){
                $('.menu').toggleClass("slide-menu-tampil");
            });
        });
    </script>
</html>