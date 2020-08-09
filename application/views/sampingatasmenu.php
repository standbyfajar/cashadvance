<?php 

$this_session_account = $this->session->userlogin;
$this_result_case = null;

if($this_session_account){
  if($this_session_account['level'] != null){
    if( (int)$this_session_account['level'] == 1 ){
      $this_result_case = 1;
    }else if( (int)$this_session_account['level'] == 2 ){
      $this_result_case = 2;
    }else {
      $this_result_case = 3;
    }
  }
}

?>
<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url('Cashadvance/home') ?>" class="site_title"><i class="fa fa-paw"></i> <span>Welcome !</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url('image/abc.jpg') ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $this->session->userlogin['nama']." ".$this_result_case; ?></h2>

              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('Cashadvance') ?>">Dashboard</a></li>
                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Master Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <!-- <li><a href="<?php echo base_url('CAbsenTarik/tarik'); ?>">Proses Tarik Absen</a></li> -->
                      <!-- <li><a href="<?php echo base_url('Cattendance/'); ?>">Attendance Correction</a></li> -->
                      <li><a <?php 
                          if($this_result_case != 1 && $this_result_case != 2 )
                            { echo 'href="'.base_url('Cashadvance/admin').'"'; }
                          else{ echo 'style="cursor:not-allowed; "'; }
                          ?>
                          >Administrator</a></li> 
                      <li><a href="<?php echo base_url('CKaryawan/'); ?>">Karyawan</a></li>
                      <li><a <?php 
                          if($this_result_case == 1 )
                            { echo 'href="'.base_url('CDepartment/index').'"'; }
                          else{ echo 'style="cursor:not-allowed; "'; }
                          ?>
                        >Department</a></li>
                      <li><a <?php 
                          if($this_result_case == 1 )
                            { echo 'href="'.base_url('Ceducation/index').'"'; }
                          else{ echo 'style="cursor:not-allowed; "'; }
                          ?>
                          >Education</a></li>
                      <li><a href="<?php echo base_url('CBank/'); ?>">Bank</a></li>
                      <li><a href="<?php echo base_url('Cshift/'); ?>">WorkShift</a></li>
                      <li><a href="<?php echo base_url('Cgrup/'); ?>">Group Shift</a></li>
          
                    </ul>
                  </li>

                  <li><a><i class="fa fa-home"></i> Transaction <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a <?php 
                          if($this_result_case == 1)
                            { echo 'href="'.base_url('Cpermintaan/index').'"'; }
                          else{ echo 'style="cursor:not-allowed; "'; }
                          ?>
                          >
                          Permintaan Peminjaman
                        </a></li>

                      </li>
                    <li >
                        <a 
                        <?php 
                          if($this_result_case == 2 ){
                              echo 'href="'.base_url('Pinjam/index').'"';
                               }
                              else{   echo 'style="cursor:not-allowed;"';} 
                                 
                          
                            
                            
                          ?> 
                        >
                          Cash Advance
                        </a>
                      </ul>

                    </li>
                  <li><a><i class="fa fa-desktop"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <li><a href="<?php echo base_url('Pinjam/laporan_perbul'); ?>">Laporan Per bulan</a></li>
                      <li><a href="<?php echo base_url('Pinjam/laporan'); ?>">Laporan Per user</a></li>
                      <li><a href="<?php echo base_url('Pinjam/laporantrans'); ?>">Laporan Per Transaksi</a></li>
                    
                    </ul>

                  </li>
                  <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Tables</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li>
               </ul>
              </div>
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                
                              
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('Login/logout') ?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
 </div>

