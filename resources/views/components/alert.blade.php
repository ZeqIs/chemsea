@if (session()->has('message'))
    <div id="alert" x-init="setTimeout(() => $('#alert').alert('close'), 3000)"
        class="position-fixed top-0 start-50 translate-middle-x shadow alert alert-{{ session('type') }} alert-dismissible mt-2 show fade"
        role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
