<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $pageTitle ?>-Solan Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <link rel="icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/component.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/alertify.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/bootstrap.datepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/jquery.mCustomScrollbar.css">
</head>
<body>

    <div id="theme-loader" class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <?php $this->load->view($this->folder.'/layouts/common/header'); ?>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <?php $this->load->view($this->folder.'/layouts/common/sidebar'); ?>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <?php $this->load->view($this->folder.'/layouts/common/errors'); ?>
                                    <?php $this->load->view($this->folder.'/'.$page); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets//js/popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/SmoothScroll.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/alertify.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/axios.min.js"></script>
    <script src="<?= base_url() ?>assets/js/pcoded.min.js"></script>
    <script src="<?= base_url() ?>assets/js/demo-12.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/script.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/common.js"></script>
    <script>
        function showLoader() {
            document.getElementById("theme-loader").style.display = "block";
            document.getElementById("pcoded").style.display = "none";
        }
        function hideLoader(){
            document.getElementById("theme-loader").style.display = "none";
            document.getElementById("pcoded").style.display = "block";
        }
    </script>
    <?php
    $this->load->view($this->folder.'/layouts/common/common_pop');
    $this->load->view($this->folder.'/layouts/common/common_script');
    if(isset($scripts)){
        $this->load->view($this->folder.'/scripts/'.$scripts);
    }
    ?>
    <?php
        if($this->session->flashdata('message')) {
        $message = $this->session->flashdata('message');
    ?>
            <script>
                showNotice("<?= $message['type'] ?>", "<?= $message['message'] ?>");
            </script>
    <?php
        }
    ?>
</body>

</html>
