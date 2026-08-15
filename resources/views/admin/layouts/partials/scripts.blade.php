<script src="{{ asset('admin-theme/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('admin-theme/assets/js/main.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')
<script>
  window.adminHMDUser = {
    name: "{{ auth()->user()->name }}",
    workspace: "Active Workspace",
    avatar: "{{ configImage('web_logo') ?? asset('admin-theme/assets/images/brand/logo/logo-icon.svg') }}"
  };
</script>