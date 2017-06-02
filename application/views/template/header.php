<!DOCTYPE html>
<html>
    <head>
        <title><?php echo APP_TITLE; ?></title>
        <link rel="stylesheet" href="<?php echo base_url("asset/css/uikit.min.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("asset/css/base.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("asset/css/addons/uikit.addons.css"); ?>">
        
        <script src="<?php echo base_url("asset/js/jquery-2.1.1.min.js"); ?>"></script>
        <script src="<?php echo base_url("asset/js/uikit.min.js"); ?>"></script>
        <script src="<?php echo base_url("asset/js/addons/search.js"); ?>"></script>
    </head>
    <body>
        <div class="tara-wrapper">
            <nav class="tm-navbar uk-navbar uk-navbar-attached">
                <div class="uk-container uk-container-center">
                    <a href="<?php echo base_url(); ?>" class="uk-navbar-brand uk-hidden-small">
                        <?php echo APP_BRAND; ?>
                    </a>
                    
                    <ul class="uk-navbar-nav uk-hidden-small">
                        <?php
                        if($this->session->userdata("is_logged_in") == TRUE)
                        {
                            ?>
                            <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
                            <li data-uk-dropdown="" class="uk-parent">
                                <a href="<?php echo base_url(); ?>">Master</a>
                                <div class="uk-dropdown uk-dropdown-navbar" style="">
                                    <ul class="uk-nav uk-nav-navbar">
                                        <li><a href="<?php echo base_url("jenis_service"); ?>">Jenis Service</a></li>
                                        <li><a href="<?php echo base_url("service"); ?>">Service</a></li>
                                        <?php
                                        if($this->session->userdata("userlevelid") == 0)
                                        {
                                            ?>
                                            <li class="uk-nav-divider"></li>
                                            <li><a href="<?php echo base_url("divisi"); ?>">Divisi</a></li>
                                            <li><a href="<?php echo base_url("jabatan"); ?>">Jabatan</a></li>
                                            <li class="uk-nav-divider"></li>
                                            <li><a href="<?php echo base_url("pegawai"); ?>">Pegawai</a></li>
                                            <li><a href="<?php echo base_url("intensif"); ?>">Komisi Pegawai</a></li>
                                            <?php
                                        }
                                        ?>
                                        <!--
                                        <li class="uk-nav-divider"></li>
                                        <li><a href="<?php echo base_url("customer"); ?>">Customer</a></li>
                                        -->
                                    </ul>
                                </div>
                            </li>
                            <li><a href="<?php echo base_url("transaksi"); ?>">Transaksi</a></li>
                            <?php
                            if($this->session->userdata("userlevelid") == 0)
                            {
                                ?>
                                <li data-uk-dropdown="" class="uk-parent">
                                    <a href="<?php echo base_url("laporan_penjualan"); ?>">Laporan</a>
                                    <div class="uk-dropdown uk-dropdown-navbar">
                                        <ul class="uk-nav uk-nav-navbar">
                                            <li><a href="<?php echo base_url("laporan_penjualan"); ?>">Penjualan</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <?php
                            }
                        }
                        ?>
                        <li data-uk-dropdown="" class="uk-parent">
                            <a href="<?php echo base_url("presensi"); ?>">Presensi</a>
                            <?php
                            if($this->session->userdata("userlevelid") == 0)
                            {
                                ?>
                                <div class="uk-dropdown uk-dropdown-navbar" style="">
                                    <ul class="uk-nav uk-nav-navbar">
                                        <li><a href="<?php echo base_url("presensi/rekap_presensi"); ?>">Rekap Presensi</a></li>
                                    </ul>
                                </div>
                                <?php
                            }
                            ?>
                        </li>
                    </ul>
                    
                    <div class="uk-navbar-flip">
                        <ul class="uk-navbar-nav">
                            <?php
                            if($this->session->userdata('is_logged_in') == TRUE)
                            {
                                ?>
                                <li data-uk-dropdown="" class="uk-parent">
                                    <a href="<?php echo base_url("auth/logout"); ?>">Logout <?php echo ucfirst($this->session->userdata("username")); ?></a>
                                    <div class="uk-dropdown uk-dropdown-navbar" style="">
                                        <ul class="uk-nav uk-navbar">
                                            <li><a href="<?php echo base_url("auth/ubah_password"); ?>">Ubah Password</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <?php
                            }
                            else
                            {
                                ?>
                                <li><a href="<?php echo base_url("auth"); ?>">Login</a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    
                    <a class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas="" href="#tm-offcanvas"></a>
                    
                    <div class="uk-navbar-brand uk-navbar-center uk-visible-small">
                        <?php echo APP_BRAND; ?>
                    </div>
                </div>
            </nav>
            
            <div class="tara-middle">
                <div class="uk-container uk-container-center">
                    <div class="uk-grid">
                        <div class="tara-main uk-width-medium-1-1">
                            <div class="uk-panel uk-panel-header">
                                <h3 class="uk-panel-title"><?php echo $panel_title; ?></h3>