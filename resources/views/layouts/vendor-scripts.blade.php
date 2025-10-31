<script src="{{ URL::asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/feather-icons/feather-icons.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/node-waves/node-waves.min.js') }}"></script>

<script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
{{--<script src="{{ URL::asset('assets/js/pages/plugins/lord-icon-2.1.0.min.js') }}"></script>--}}
<script src="{{ URL::asset('assets/js/plugins.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- App: load once globally to avoid duplicate execution which flips layout state -->
<script src="{{ URL::asset('/assets/js/app.js') }}"></script>

@yield('script')
@yield('script-bottom')
