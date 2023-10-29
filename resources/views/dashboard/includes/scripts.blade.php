
<!-- jQuery -->
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>


<!-- Bootstrap 4 -->
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


@yield('scripts')
@stack('scripts')

<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/demo.js')}}"></script>

<!--notiflix packages -->

<script src="{{ asset('vendor/notiflix/notiflix-notify-aio-3.2.5.min.js') }}"></script>
<script src="{{ asset('vendor/notiflix/notiflix-report-aio-3.2.5.min.js') }}"></script>
<script src="{{ asset('vendor/notiflix/notiflix-confirm-aio-3.2.5.min.js') }}"></script>
<script src="{{ asset('vendor/notiflix/notiflix-loading-aio-3.2.5.min.js') }}"></script>
<script src="{{ asset('vendor/notiflix/notiflix-block-aio-3.2.5.min.js') }}"></script>
<!-- pop up any message with notiflix -->
<script>
  
    @if ($message = Session::get('error') ) 
        Notiflix.Notify.init({
        fontSize: '15px',
        cssAnimation: true,
        cssAnimationDuration: 400,
        cssAnimationStyle: 'zoom',
        position: 'center-top',
        width: '380px',
        timeout: 2000,
        });  
        Notiflix.Notify.failure('{{ $message }} ');
    @endif

   @if ($message = Session::get('success')) 
        Notiflix.Notify.init({
        fontSize: '15px',
        cssAnimation: true,
        cssAnimationDuration: 400,
        cssAnimationStyle: 'zoom',
        position: 'center-top',
        width: '380px',
        timeout: 2000,
        });  
        Notiflix.Notify.success('{{ $message }} ');
   @endif
</script>

