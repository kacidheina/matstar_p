@if (Session::has('error'))
    <div class="toast toast-error flash-message">
        <button class="toast-close-button" role="button">×</button>
        <div class="toast-title">Kujdes!</div>
        <div class="toast-message">{{session('error')}}</div>
    </div>
@endif

@if (Session::has('success'))
    <div class="toast toast-success flash-message">
        <button class="toast-close-button" role="button">×</button>
        <div class="toast-title">Sukses !</div>
        <div class="toast-message">{{session('success')}}</div>
    </div>
@endif

@if (Session::has('warning'))
    <div class="toast toast-warning flash-message">
        <button class="toast-close-button" role="button">×</button>
        <div class="toast-title">Vemendje!</div>
        <div class="toast-message">{{session('warning')}}</div>
    </div>
@endif