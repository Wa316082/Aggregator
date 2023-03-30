<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('Admin/assets/images/e-desh.ico')}}">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">



    <!-- Plugins css -->
    <link href="{{asset('Admin/assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admin/assets/libs/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('Admin/assets/css/bootstrap-modern.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{asset('Admin/assets/css/app-modern.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{asset('Admin/assets/css/bootstrap-modern-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
    <link href="{{asset('Admin/assets/css/app-modern-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled />

    <!-- icons -->
    <link href="{{asset('Admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('Admin/assets/css/style.css') }}">

    {{-- =========================for data tables start------------------------- --}}

    <!-- third party css -->
    <link href="{{asset('Admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admin/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admin/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admin/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    {{-- <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"> --}}
    {{-- for toaster css --}}
    {{-- for toaster --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    @yield('css')


    {{-- =========================for data tables end------------------------- --}}

    {{-- font awesome icon link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body data-layout-mode="detached" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": true}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        @section('header')
        @include('layouts.auth_body.top_bar')
        @show
        {{-- @include('layouts.admin_body.top_bar') --}}
        <!-- end Topbar -->
        <!-- ========== Left Sidebar Start ========== -->
        @section('sidebar')
        @include('layouts.auth_body.left_sidebar')
        @show
        {{-- @include('layouts.admin_body.left_sidebar') --}}
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        {{-- contentpage here--}}
        @if(Auth::user()->role_id == 1)


        <div class="content-page">
            @yield('admin_home_content')
            @yield('admin_dashbord_content')
            @yield('content')
        </div>

        @elseif(Auth::user()->role_id == 3)

        <div class="content-page">
            @yield('admin_home_content')
            @yield('merchant_dashbord_content')
            @yield('content')
        </div>

        @endif

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    {{-- @include('layouts.admin_body.right_sidebar') --}}
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="{{asset('Admin/assets/js/vendor.min.js')}}"></script>

    <!-- Plugins js-->
    <script src="{{asset('Admin/assets/libs/flatpickr/flatpickr.min.js')}}"></script>



    <script src="{{asset('Admin/assets/libs/selectize/js/standalone/selectize.min.js')}}"></script>

    <!-- Dashboar 1 init js-->
    {{-- <script src="{{asset('Admin/assets/js/pages/dashboard-1.init.js')}}"></script> --}}

    <!-- App js-->
    <script src="{{asset('Admin/assets/js/app.min.js')}}"></script>
    {{-- sweetalert  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    {{-- @include('sweet::alert') --}}
    {{-- sweet alert end --}}


    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>




    {{-- -----------------------------------for data table start----------------------------------- --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script> --}}
    <!-- third party js -->
    <script src="{{asset('Admin/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('Admin/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('Admin/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('Admin/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('Admin/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('Admin/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('Admin/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('Admin/assets/libs/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('Admin/assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('Admin/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('Admin/assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
    <script src="{{asset('Admin/assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('Admin/assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <!-- third party js ends -->


    {{-- jsPDF sctipt  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>

    <!-- Datatables init -->
    {{-- <script src="{{asset('Admin/assets/js/pages/datatables.init.js')}}"></script> --}}


    {{-- for datatable main start --}}


    <script>
        $(document).ready(function() {
            $('.example').DataTable({
                dom: 'Brtip '
                , buttons: [

                ]
                , "ordering": false
                , "bStateSave": true,

                "iDisplayStart": 20
                // "drawCallback": false,
            });
        });

    </script>
    {{-- for datatable main end --}}
    <!-- Toastr cdn  -->


    {{-- toaster Cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    {{-- Sweet allert cdn --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // @if (Session::has('message'))
        //     var type = "{{ Session::get('alert-type') }}"
        //     switch (type) {
        //     case 'info':
        //         toastr.options = {
        //             "closeButton":true,
        //             "porgressBar":true,
        //             "showDuration": "300000",
        //             "hideDuration": "100000",
        //             "timeOut": "500000",
        //             "extendedTimeOut": "100000",
        //             }
        //     toastr.info(" {{ Session::get('message') }} ");
        //     break;
        //     case 'success':
        //     toastr.success("{{ Session::get('message') }} ");
        //     break;
        //     case 'warning':
        //     toastr.warning(" {{ Session::get('message') }} ");
        //     break;
        //     case 'error':
        //     toastr.error(" {{ Session::get('message') }} ");
        //     break;
        //     default:
        //     break;
        //     }
        // @endif

        // @if(Session::has('success'))
        // toastr.options = {
        //     "closeButton": true
        //     , "progressBar": true,


        // }
        // toastr.success("{{ session('success') }}")

        // @endif

        // @if(Session::has('info'))
        // toastr.options = {
        //     "closeButton": true
        //     , "progressBar": true,

        // }
        // toastr.info("{{ session('info') }}")

        // @endif

        @if(session::has('success')) {
            const Toast = Swal.mixin({
                toast: true
                , background: '#8DFB00'
                , position: 'top-end'
                , showConfirmButton: false
                , timer: 3000
                , timerProgressBar: true
                , icon: 'success'
                , iconColor: '#FFFFFF'
                , didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                // title: 'hello alldone'
                title: '{{session('success')}}'
            , })
        }
        @elseif(session::has('info')) {
            const Toast = Swal.mixin({
                toast: true
                , background: '#FFC300'
                , position: 'top-end'
                , showConfirmButton: false
                , timer: 3000
                , timerProgressBar: true
                , icon: 'info'
                , iconColor: '#FFFFFF'
                , didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                title: '{{ session('info') }}'
            , })
        }

        @endif

    </script>
    {{-- for delete pop up --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script> --}}
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    {{-- <script src="sweetalert2.all.min.js"></script> --}}

    <script>
        $(document).on("click", ".show_confirm", function() {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                    title: `Are you sure ?`
                    , text: "If you delete this, It will be gone forever."
                    , icon: "question"
                        // ,position:'top'
                    , background: 'rgba(255, 255, 255,1)'
                    , showCancelButton: true
                    , confirmButtonColor: '#d33'
                    , cancelButtonColor: '#06E66F'
                    , confirmButtonText: ' Delete '
                    , iconColor: '#d33'
                , })
                .then((result) => {
                    if (result.isConfirmed) {
                        form.submit();

                    } else {
                        Swal.fire(
                            'Cancelled'
                            , 'Your imaginary file is safe'
                            , 'success'
                        )
                    }
                });
        });
        const ToastSuccess = Swal.mixin({
            toast: true
            , background: '#8DFB00'
            , position: 'top-end'
            , showConfirmButton: false
            , timer: 3000
            , timerProgressBar: true
            , icon: 'success'
            , iconColor: '#FFFFFF'
            , didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        const ToastInfo = Swal.mixin({
            toast: true
            , background: '#FFC300'
            , position: 'top-end'
            , showConfirmButton: false
            , timer: 3000
            , timerProgressBar: true
            , icon: 'info'
            , iconColor: '#FFFFFF'
            , didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

    </script>
    @if(session('status'))
    <script>
        const Toast = Swal.mixin({
            toast: true
            , position: 'top-end'
            , showConfirmButton: false
            , timer: 3000
            , timerProgressBar: true
            , didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success'
            , title: '{{session('
            status ')}}'
        })

    </script>
    @endif



    {{-- -----------------------------------for data table end----------------------------------- --}}
    @yield('scripts')

</body>
</html>
