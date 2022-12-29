@php
$title = isset($title) ? $title : '';
$path = isset($path) ? $path : $title;
@endphp
<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="/../assets/js/lib/jquery-1.11.min.js"></script>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="REZA PIRY GHADIM">
    <meta charset='utf-8'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Viewport metatags -->
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="320" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- iOS webapp metatags -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- iOS webapp icons -->
    <link rel="apple-touch-icon-precomposed" href="/../assets/images/ios/fickle-logo-72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/../assets/images/ios/fickle-logo-72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/../assets/images/ios/fickle-logo-114.png" />

    <!-- TODO: Add a favicon -->
    <link rel="shortcut icon" href="/../assets/images/ico/fab.ico">

    <title>{{ isset($title) && $title ? $title : 'نمایندگان - ' . auth()->user()->role }}</title>
    <!--Page loading plugin Start -->
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/pace-rtl.css">
    <script src="/../assets/js/pace.min.js"></script>
    <!--Page loading plugin End   -->

    <!-- Plugin Css Put Here -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="/../assets/css/bootstrap-rtl.css">
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/bootstrap-progressbar-3.1.1-rtl.css">
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/jquery-jvectormap-rtl.css">
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/selectize.bootstrap3-rtl.css">
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/summernote-rtl.css">
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/accordion-rtl.css">
    <link rel="stylesheet" href="/../assets/css/plugins/icheck/skins/all.css">
    <link rel="stylesheet" href="/../assets/css/font-awesome/css/font-awesome-rtl.css">
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/tab-rtl.css">
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/persian-datepicker-cheerup.css">
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/selectize.bootstrap3-rtl.css">

    <!--AmaranJS Css Start-->
    <link href="/../assets/css/rtl-css/plugins/amaranjs/jquery.amaran-rtl.css" rel="stylesheet">
    <link href="/../assets/css/rtl-css/plugins/amaranjs/theme/all-themes-rtl.css" rel="stylesheet">
    <link href="/../assets/css/rtl-css/plugins/amaranjs/theme/awesome-rtl.css" rel="stylesheet">
    <link href="/../assets/css/rtl-css/plugins/amaranjs/theme/default-rtl.css" rel="stylesheet">
    <link href="/../assets/css/rtl-css/plugins/amaranjs/theme/blur-rtl.css" rel="stylesheet">
    <link href="/../assets/css/rtl-css/plugins/amaranjs/theme/user-rtl.css" rel="stylesheet">
    <link href="/../assets/css/rtl-css/plugins/amaranjs/theme/rounded-rtl.css" rel="stylesheet">
    <link href="/../assets/css/rtl-css/plugins/amaranjs/theme/readmore-rtl.css" rel="stylesheet">
    <link href="/../assets/css/rtl-css/plugins/amaranjs/theme/metro-rtl.css" rel="stylesheet">
    <!--AmaranJS Css End -->

    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/select.dataTables.min.css">
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/pmd-datatable.css">
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/propeller.min.css">

    <!-- Plugin Css End -->
    <!-- Custom styles Style -->
    <link href="/../assets/css/rtl-css/style-rtl-default.css" rel="stylesheet">
    <link rel="stylesheet" href="/../assets/css/rtl-css/plugins/fileinput-rtl.css">
    <link href="/../assets/css/rtl-css/responsive-rtl.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="/../css/app.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css"> --}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="/../assets/css/persian-datepicker.min.css">
</head>

<body class="blue-color">
    <nav class="navigation">
        <div class="container-fluid">
            <div class="header-logo">
                <a href="/admin" title="">
                    <h1 style="font-size: 12pt">پنل مدیریت </h1>
                </a>
            </div>
            <div class="top-navigation">
                <div class="menu-control ">
                    <a href="javascript:void(0)">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="search-box">
                    <ul>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                                <span class="fa fa-search"></span>
                            </a>
                            <div class="dropdown-menu  top-dropDown-1">
                                <h4>جستجو</h4>
                                <form>
                                    <input type="search" placeholder="جستجو زیرنماینده ها - کاربران شما ...">
                                </form>
                            </div>

                        </li>
                    </ul>
                </div>

                <ul>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                            <span class="fa fa-envelope-o"></span>
                            @if (isset($newMessages) && count($newMessages) > 0)
                                <span class="badge badge-red">{{ convert2persian(count([])) }}</span>
                            @endif
                        </a>
                    </li>

                    <li>
                        <a href="/logout">
                            <i class="fa fa-power-off"></i>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <section id="main-container">
        <section id="left-navigation">
            <div class="user-image">
            </div>
            <ul class="social-icon">

            </ul>
            <div class="phone-nav-box visible-xs">
                <a class="phone-logo" href="/admin" title="">
                    <h1 style="font-size: 12pt">نمایندگان </h1>
                </a>
                <a class="phone-nav-control" href="javascript:void(0)">
                    <span class="fa fa-bars"></span>
                </a>
                <div class="clearfix"></div>
            </div>
            <ul class="mainNav" id="mainNav">
                <li><a href="/panel/{{ auth()->user()->role }}"><i class="fa fa-dashboard"></i>
                        <span>داشبورد</span></a></li>

                {{-- menu generate by user role --}}
                @include('panel.theme.menu.' . auth()->user()->role)

                <li><a href="/panel/change_password"><i class="fa fa-key"></i> <span>تغییر رمز عبور</span></a></li>
                <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>خروج از سیستم</span></a></li>


            </ul>
        </section>

        <section id="min-wrapper">
            <div id="main-content">
                <div class="container-fluid" id="app_vue">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="ls-top-header">{{ $path ?? '' }}</h3>

                            <ol class="breadcrumb">
                                <li><a href="#"><i class="fa fa-home"></i></a></li>
                                <li class="active">{{ $path ?? '' }}</li>
                            </ol>
                        </div>
                    </div>
                    <div>
                        @if (session()->get('up_level_user'))
                            <p class="alert alert-danger">شما به پنل زیر نماینده خود وارد شدید . <a
                                    href="/panel/agent/login_up"> برگشت به پنل اصلی </a></p>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>


        </section>
    </section>


    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script> --}}
    @stack('scripts')
    <script type="text/javascript" src="/../assets/js/lib/jquery-1.11.min.js"></script>

    <script src="/../assets/js/icheck.min.js"></script>
    <script src="/../assets/js/pages/checkboxRadio.js"></script>
    <script src="/../assets/js/tabulous.js"></script>
    <script src="/../assets/js/datePikerAll.js"></script>
    <script type="text/javascript" src="/../assets/js/color.js"></script>
    <script type="text/javascript" src="/../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/../assets/js/multipleAccordion.js"></script>
    <script src="/../assets/js/lib/jquery.easing.js"></script>
    <script src="/../assets/js/jquery.nanoscroller.min.js"></script>
    <script src="/../assets/js/switchery.min.js"></script>
    <script src="/../assets/js/bootstrap-switch.js"></script>
    <script src="/../assets/js/jquery.easypiechart.min.js"></script>
    {{-- <script src="/../assets/js/bootstrap-progressbar.min.js"></script> --}}
    {{-- <script type="text/javascript" src="/../assets/js/chart/flot/jquery.flot.js"></script> --}}
    {{-- <script type="text/javascript" src="/../assets/js/chart/flot/jquery.flot.pie.js"></script> --}}
    {{-- <script type="text/javascript" src="/../assets/js/chart/flot/jquery.flot.resize.js"></script> --}}
    <script type="text/javascript" src="/../assets/js/pages/layout.js"></script>
    {{-- <script src="/../assets/js/countUp.min.js"></script> --}}
    {{-- <script src="/../assets/js/skycons.js"></script> --}}
    {{-- <script src="/../assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> --}}
    {{-- <script src="/../assets/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script> --}}
    {{-- <script src="/../assets/js/jquery.amaran.js"></script> --}}
    <script src="/../assets/js/pages/dashboard.js"></script>
    <script src="/../assets/js/lib/jquery_cookie.js"></script>
    <script src="/../assets/js/selectize.min.js"></script>
    <script src="/../assets/js/pages/selectTag.js"></script>
    {{-- <script src="/../assets/js/propeller.min.js"></script> --}}

    <script src="/../assets/js/jquery.dataTables.min.js"></script>
    <script src="/../assets/js/dataTables.bootstrap.min.js"></script>
    <script src="/../assets/js/dataTables.responsive.min.js"></script>
    <script src="/../assets/js/dataTables.select.min.js"></script>

    <script src="/../assets/js/fileinput.min.js" charset="utf-8"></script>
    <script src="/../assets/js/jquery.autosize.js"></script>
    {{-- <script src="/../assets/js/pages/sampleForm.js"></script> --}}

    <script src="/../assets/js/summernote.min.js"></script>
    <script>
        $(".summernote").summernote({
            height: 150,
            minHeight: null,
            maxHeight: null,
            focus: true,
            codemirror: {
                theme: "monokai"
            }
        });

        $(".bookContents").summernote({
            height: 500,
            minHeight: null,
            maxHeight: null,
            focus: true,
            codemirror: {
                theme: "monokai"
            }
        });
    </script>


    <script>
        // var checkCookie = $.cookie("nav-item");
        // if (checkCookie != "") {
        //     $('#mainNav > li:eq(' + checkCookie + ')').addClass('active').next().show();
        //     $('#mainNav > li > a:eq(' + checkCookie + ')').addClass('active').next().show();
        // }
        //
        // $('#mainNav > li > ul > li > a').click(function () {
        //     var checkElement = $(this).next();
        //     $(this).removeClass('active');
        //     $(this).closest('li').addClass('testing');
        //     $('#mainNav li li .active').removeClass('active');
        //     $(this).addClass('active');
        // });
        //
        // $('#mainNav > li > a').click(function () {
        //     var navIndex = $('#mainNav > li > a').index(this);
        //     $.cookie("nav-item", navIndex);
        //     $('#mainNav li').removeClass('active');
        //     $('#mainNav li a').removeClass('active');
        //
        //     $(this).addClass('active');
        // });
    </script>
    <script src="/../assets/js/main.js"></script>
    <script src="/../assets/js/compressedNotify_all.js"></script>
    <script src="/../assets/js/dropzone.js"></script>
    <script src="/../assets/lib/ckeditor/ckeditor.js"></script>
    <script src="/../assets/js/resumable.js"></script>

    <script type="text/javascript" src="/../assets/js/persian-date.min.js"></script>
    <script type="text/javascript" src="/../assets/js/persian-datepicker.min.js"></script>


    <!--Demo ui element Script Start -->
    <script>
        function datatable_edit(id) {
            window.location.replace($(location).attr('href') + '/edit/' + id);

        }

        function datatable_details(id) {
            window.location.replace($(location).attr('href') + '/details/' + id);

        }

        function order_by_agent(id) {
            window.open($(location).attr('href') + '/' + id + '/order', '_blank');

        }

        function login_as(id) {
            window.open($(location).attr('href') + '/' + id + '/login_as');

        }

        function datatable_delete(id) {
            Swal.fire({
                "title": "با موفقیت حذف شد!",
                "text": "",
                "timer": "1500",
                "width": "300",
                "heightAuto": true,
                "padding": "1.25rem",
                "animation": true,
                "showConfirmButton": false,
                "showCloseButton": true,
                "toast": true,
                "type": "success",
                "position": "center"
            });

        }

        tabulous_trigger_call();

        function tabulous_trigger_call() {
            $("#tabs").tabulous({
                effect: "scale"
            });
            $("#tabs2").tabulous({
                effect: "slideLeft"
            });
            $("#tabs3").tabulous({
                effect: "scaleUp"
            })
        }


        $(document).ready(function() {
            $(".datepicker").persianDatepicker({
                observer: true,
                initialValue: false,
                initialValueType: 'persian',
                format: 'YYYY/MM/DD',
                showGregorianDate: false,
            });
        });
    </script>

    <!--Demo ui element Script End -->
    <script src="/vendor/sweetalert/sweetalert.all.js"></script>

    @include('sweetalert::alert')

</body>

</html>
