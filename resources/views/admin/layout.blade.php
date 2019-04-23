<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

    <style>
        #loader {
            transition: all 0.3s ease-in-out;
            opacity: 1;
            visibility: visible;
            position: fixed;
            height: 100vh;
            width: 100%;
            background: #fff;
            z-index: 90000;
        }

        #loader.fadeOut {
            opacity: 0;
            visibility: hidden;
        }

        .spinner {
            width: 40px;
            height: 40px;
            position: absolute;
            top: calc(50% - 20px);
            left: calc(50% - 20px);
            background-color: #333;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
            animation: sk-scaleout 1.0s infinite ease-in-out;
        }

        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1.0);
                opacity: 0;
            }
        }

        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }
            100% {
                -webkit-transform: scale(1.0);
                transform: scale(1.0);
                opacity: 0;
            }
        }
    </style>
    <link href="/assets/styles/style.css" rel="stylesheet">

</head>
<body class="app">
<div id='loader'>
    <div class="spinner"></div>
</div>

<script>
    window.addEventListener('load', () => {
        const loader = document.getElementById('loader');
        setTimeout(() => {
            loader.classList.add('fadeOut');
        }, 300);
    });
</script>

<!-- @App Content -->
<!-- =================================================== -->
<div>
    <!-- #Left Sidebar ==================== -->
    <div class="sidebar">
        <div class="sidebar-inner">
            <!-- ### $Sidebar Header ### -->
            <div class="sidebar-logo">
                <div class="peers ai-c fxw-nw">
                    <div class="peer peer-greed">
                        <a class="sidebar-link td-n" href="#">
                            <div class="peers ai-c fxw-nw">
                                <div class="peer">
                                    <div class="logo">
                                    </div>
                                </div>
                                <div class="peer peer-greed">
                                    <h5 class="lh-1 mB-0 logo-text">Adminator</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="peer">
                        <div class="mobile-toggle sidebar-toggle">
                            <a href="" class="td-n">
                                <i class="ti-arrow-circle-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ### $Sidebar Menu ### -->
            <ul class="sidebar-menu scrollable pos-r">
                <li class="nav-item mT-30 active">
                    <a class="sidebar-link" href="/adm/">
                        <span class="icon-holder">
                          <i class="c-blue-500 ti-home"></i>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item mT-30">
                    <a class="sidebar-link" href="/adm/post">
                        <span class="icon-holder">
                          <i class="c-blue-500 ti-home"></i>
                        </span>
                        <span class="title">Post</span>
                    </a>
                </li>
                <li class="nav-item mT-30">
                    <a class="sidebar-link" href="/adm/share">
                        <span class="icon-holder">
                          <i class="c-blue-500 ti-home"></i>
                        </span>
                        <span class="title">Share</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- #Main ============================ -->
    <div class="page-container">
        <!-- ### $Topbar ### -->
        <div class="header navbar">
            <div class="header-container">
            </div>
        </div>

        <!-- ### $App Screen Content ### -->
        <main class='main-content bgc-grey-100'>
            <div id='mainContent'>
                <div class="container-fluid">
                    <h4 class="c-grey-900 mT-10 mB-30"></h4>
                    <div class="row gap-20">
                        @yield('content')
                    </div>
                </div>
            </div>
    </div>
    </main>

    <!-- ### $App Screen Footer ### -->
    <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
        <span>Copyright © 2017 Designed by Colorlib. All rights reserved.</span>
    </footer>
</div>
</div>

<script src="/assets/scripts/vendor.js"></script>
<script src="/assets/scripts/bundle.js"></script>
<script src="/assets/scripts/jquery.min.js"></script>
<script src="/assets/scripts/bootstrap.min.js"></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="45e3d080e18c8653b5a972de-|49" defer=""></script>

@yield('script')
</body>
</html>
