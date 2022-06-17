@if (session('status'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close btn-close" data-bs-dismiss="alert"></button>
                    {{ session('status') }}
                </div>
            </div>
        </div>
    </div>
@endif
