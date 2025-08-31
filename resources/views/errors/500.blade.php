@extends('layouts.frontend')

@section('title', 'Server Error')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="error-page">
                <h1 class="display-1 text-danger">500</h1>
                <h2 class="mb-4">Server Error</h2>
                <p class="lead mb-4">Something went wrong on our end. We're working to fix the problem. Please try again later.</p>
                
                <div class="mb-4">
                    <a href="{{ route('frontend.home') }}" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-home me-2"></i>Go Home
                    </a>
                    <button onclick="window.location.reload()" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-redo me-2"></i>Try Again
                    </button>
                </div>
                
                <div class="alert alert-info mt-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Need Help?</strong> If this problem persists, please contact our support team.
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('customer.contact-us') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-headset me-2"></i>Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.error-page {
    padding: 3rem 0;
}
.error-page h1 {
    font-size: 8rem;
    font-weight: 300;
    color: #dc3545;
}
.error-page h2 {
    color: #495057;
}
.error-page .btn {
    border-radius: 50px;
    padding: 12px 30px;
}
.alert {
    border-radius: 15px;
}
</style>
@endsection
