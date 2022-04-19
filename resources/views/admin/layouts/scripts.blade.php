<script src="{{asset('admin/js/jquery.js')}}"></script>
<script src="{{asset('admin/js/datatable.js')}}"></script>
<script src="{{asset('admin/js/dataTables.buttons.js')}}"></script>
<script src="{{asset('admin/js/buttons.html5.js')}}"></script>
<script src="{{asset('admin/js/buttons.print.js')}}"></script>
<script src="{{asset('admin/js/pdfmake.min.js')}}"></script>
<script src="{{asset('admin/js/vfs_fonts.js')}}"></script>
<script src="{{asset('admin/js/jszip.min.js')}}"></script>
<script src="{{asset('admin/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('admin/js/toastr.js')}}"></script>
<script src="{{asset('admin/js/jquery-ui.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.js')}}"></script>
<script src="{{asset('admin/js/datepicker.js')}}"></script>
<script src="{{asset('admin/js/waves.js')}}"></script>
<script>
    $(function (){
        $(".loader").delay(1000).fadeOut("slow");
        $("#overlayer").delay(1000).fadeOut("slow");

        $('.toggle-sidebar').on('click', function () {
            $('.sidebar').toggleClass('active');
        });
        $('.sidebar .dropdown').click(function (){
            $('.sidebar .dropdown .dropdown-toggle.show .fa-plus').toggleClass('fa-minus')
        })
        // Add slideDown animation to Bootstrap dropdown when expanding.
        $('.sidebar .dropdown').on('show.bs.dropdown', function() {
            $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
        });
        // Add slideUp animation to Bootstrap dropdown when collapsing.
        $('.sidebar .dropdown').on('hide.bs.dropdown', function() {
            $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
        });
        //Toastr Message
        @if(Session::has('message'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.success("{{ session('message') }}");
        @endif
            @if(Session::has('error'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.error("{{ session('error') }}");
        @endif
            @if(Session::has('warning'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.warning("{{ session('warning') }}");
        @endif
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.error("{{ $error }}");
        @endforeach
        @endif
    });
    Waves.attach('.waves-effect', ['waves-light'])
</script>
@stack('js')
