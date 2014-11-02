<div class="" id="top-bar">
    <div class="col-md-1"></div>
    <div class="col-md-9 color-white top-bar" >
        <div id="top-notification">Hello Admin, you're look awesome today!!!</div>
    </div>
    <div class="col-md-2 color-white top-bar text-right">
        <a href="logout" id="sign-out">Sign out</a>
    </div>
</div>
<div class="">
    <nav class="navbar navbar-default" id="top-navbar" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="<?php echo ($current_section == 'dictionary') ? 'active' : '' ?>">

                        <div class="nav-section">
                            <a href="<?php echo site_url('dictionary') ?>" >

                                <div class="row text-center">
                                    <i class="fa fa-book fa-3x"></i>
                                </div>

                                <div class="row text-center nav-section-name">
                                    <b>Dictionary</b>
                                </div>

                            </a>

                        </div>
                    </li>
                    <li class="<?php echo ($current_section == 'players') ? 'active' : '' ?>">
                        <div class="nav-section">
                            <a href="<?php echo site_url('player') ?>" >
                                <div class="row text-center">
                                    <i class="fa fa-group fa-3x"></i>
                                </div>
                                <div class="row text-center nav-section-name">
                                    <b>Players</b>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="<?php echo ($current_section == 'games') ? 'active' : '' ?>">
                        <div class="nav-section">
                            <a href="<?php echo site_url('game') ?>" >
                                <div class="row text-center">
                                    <i class="fa fa-rocket fa-3x"></i>
                                </div>
                                <div class="row text-center nav-section-name">
                                    <b>Games</b>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <div class="brand-logo">
                            <a href="<?php echo site_url()?>" id="base-url"><img class="img-responsive" src="<?php echo site_url('assets/img/logo.png') ?>"></a>
                        </div>

                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>
