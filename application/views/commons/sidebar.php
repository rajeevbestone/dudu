<?php
$currentRouteName = uri_string();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo base_url(); ?>" class="brand-link">
        <img src="<?php echo base_url('includes/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dial Up Delta</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('includes/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php echo (($currentRouteName == 'dashboard') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item <?php echo ((($currentRouteName == 'usersFeed') || ($currentRouteName == 'pages') || ($currentRouteName == 'users') || ($currentRouteName == 'gender') || ($currentRouteName == 'ageGroup') || ($currentRouteName == 'languages') || ($currentRouteName == 'programs') || ($currentRouteName == 'durations') || ($currentRouteName == 'packages')) ? 'menu-is-opening menu-open' : ''); ?>">
                    <a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php echo ((($currentRouteName == 'usersFeed') || ($currentRouteName == 'pages') || ($currentRouteName == 'users') || ($currentRouteName == 'gender') || ($currentRouteName == 'ageGroup') || ($currentRouteName == 'languages') || ($currentRouteName == 'programs') || ($currentRouteName == 'durations') || ($currentRouteName == 'packages')) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Masters
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('users'); ?>" class="nav-link <?php echo (($currentRouteName == 'users')? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('usersFeed'); ?>" class="nav-link <?php echo (($currentRouteName == 'usersFeed')? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users Feed</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('languages'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Languages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('ageGroup'); ?>" class="nav-link <?php echo (($currentRouteName == 'ageGroup')? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Age Group</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('gender'); ?>" class="nav-link <?php echo (($currentRouteName == 'gender')? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gender</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?php echo base_url('programs'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Programs</p>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a href="<?php echo base_url('durations'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Duration</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="<?php echo base_url('pages'); ?>" class="nav-link <?php echo (($currentRouteName == 'pages')? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('packages'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Package</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('getToSleep'); ?>" class="nav-link <?php echo ((($currentRouteName == 'getToSleep') || ($currentRouteName == 'getToSleepAdd')) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Get To Sleep
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('sleepEnhancer'); ?>" class="nav-link <?php echo ((($currentRouteName == 'sleepEnhancer')) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Sleep Enhancer
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('wakeUpList'); ?>" class="nav-link <?php echo ((($currentRouteName == 'wakeUpList') || ($currentRouteName == 'wakeUpAdd')) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Wake Up
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('libraryMgmt'); ?>" class="nav-link <?php echo (($currentRouteName == 'libraryMgmt') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Library
                        </p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url('videoManagement'); ?>" class="nav-link <?php echo (($currentRouteName == 'videoManagement') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Videos
                        </p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url('programManagement'); ?>" class="nav-link <?php echo (($currentRouteName == 'programManagement') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Programs
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('dud_songs'); ?>" class="nav-link <?php echo (($currentRouteName == 'dud_songs') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dud Songs
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('feedback'); ?>" class="nav-link <?php echo (($currentRouteName == 'feedback') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Feedback
                        </p>
                    </a>

                </li>
            </ul>
        </nav>
    </div>
</aside>