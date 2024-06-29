<style>
  /* Main Sidebar Container */
  .main-sidebar {
    width: 250px; /* Adjust sidebar width */
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    background-color: #343a40; /* Dark background color */
    color: #ffffff; /* Text color */
    padding-top: 20px; /* Adjust top padding */
    z-index: 1030; /* Ensure sidebar appears above other content */
  }

  /* Brand Logo */
  .brand-link {
    padding: 10px 15px; /* Padding for the brand logo */
    display: block;
    text-align: center;
    border-bottom: 1px solid #4f5962; /* Bottom border color */
  }

  .brand-image {
    width: 40px; /* Adjust brand logo width */
    height: 40px; /* Adjust brand logo height */
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
  }

  .brand-text {
    font-size: 1.2rem; /* Adjust brand text size */
    font-weight: bold;
  }

  /* Sidebar Menu */
  .nav-sidebar .nav-link {
    color: #d2d6de; /* Menu item text color */
    padding: 10px 15px; /* Adjust item padding */
  }

  .nav-sidebar .nav-link:hover,
  .nav-sidebar .nav-link.active {
    background-color: #4f5962; /* Background color on hover/active */
  }

  .nav-sidebar .nav-header {
    font-size: 0.9rem; /* Header text size */
    padding: 10px 15px; /* Header padding */
    color: #8a8d93; /* Header text color */
    text-transform: uppercase;
    font-weight: bold;
    margin-top: 15px; /* Space above headers */
  }

  /* Scrollbar Styling */
  .os-scrollbar.os-scrollbar-horizontal,
  .os-scrollbar.os-scrollbar-vertical {
    display: none; /* Hide scrollbars */
  }
</style>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand bg-dark">
  <!-- Brand Logo -->
  <a href="<?php echo base_url ?>admin" class="brand-link bg-transparent text-sm border-0 shadow-sm">
    <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Store Logo" class="brand-image img-circle elevation-3 bg-black">
    <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
    <div class="os-resize-observer-host observed">
      <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
    </div>
    <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
      <div class="os-resize-observer"></div>
    </div>
    <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
    <div class="os-padding">
      <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
        <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
          <!-- Sidebar user panel (optional) -->
          <div class="clearfix"></div>
          <!-- Sidebar Menu -->
          <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item dropdown">
                <a href="./" class="nav-link nav-home">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-header">Students</li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=students/manage_student" class="nav-link nav-students_manage_student">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>
                    New Student
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=students" class="nav-link nav-students">
                  <i class="nav-icon fas fa-user-friends"></i>
                  <p>
                    Student List
                  </p>
                </a>
              </li>
              <li class="nav-header">Maintenance</li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=departments" class="nav-link nav-departments">
                  <i class="nav-icon fas fa-building"></i>
                  <p>
                    Department List
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=courses" class="nav-link nav-courses">
                  <i class="nav-icon fas fa-scroll"></i>
                  <p>
                    Course List
                  </p>
                </a>
              </li>
              <?php if($_settings->userdata('type') == 1): ?>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-link nav-user_list">
                  <i class="nav-icon fas fa-users-cog"></i>
                  <p>
                    User List
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    Settings
                  </p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
      </div>
    </div>
    <div class="os-scrollbar-corner"></div>
  </div>
  <!-- /.sidebar -->
</aside>

<script>
  var page;
  $(document).ready(function(){
    page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    page = page.replace(/\//gi,'_');

    if($('.nav-link.nav-'+page).length > 0){
      $('.nav-link.nav-'+page).addClass('active')
      if($('.nav-link.nav-'+page).hasClass('tree-item')){
        $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
        $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
      }
      if($('.nav-link.nav-'+page).hasClass('nav-is-tree')){
        $('.nav-link.nav-'+page).parent().addClass('menu-open')
      }
    }

    $('#receive-nav').click(function(){
      $('#uni_modal').on('shown.bs.modal',function(){
        $('#find-student [name="tracking_code"]').focus();
      })
      uni_modal("Enter Tracking Number","student/find_student.php");
    });
  });
</script>
