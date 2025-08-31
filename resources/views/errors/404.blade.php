@extends('layouts.frontend')

@section('title', 'Page Not Found')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="error-page">
                <h1 class="display-1 text-muted">404</h1>
                <h2 class="mb-4">Page Not Found</h2>
                <p class="lead mb-4">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
                
                <div class="mb-4">
                    <a href="{{ route('frontend.home') }}" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-home me-2"></i>Go Home
                    </a>
                    <a href="{{ route('frontend.courses.index') }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-shopping-cart me-2"></i>Browse Products
                    </a>
                </div>
                
                <div class="mt-5">
                    <h5>Popular Pages</h5>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <a href="{{ route('frontend.about-us') }}" class="text-decoration-none">
                                <i class="fas fa-info-circle me-2"></i>About Us
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('customer.contact-us') }}" class="text-decoration-none">
                                <i class="fas fa-envelope me-2"></i>Contact
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('frontend.blogs.index') }}" class="text-decoration-none">
                                <i class="fas fa-blog me-2"></i>Blog
                            </a>
                        </div>
                    </div>
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
    color: #6c757d;
}
.error-page h2 {
    color: #495057;
}
.error-page .btn {
    border-radius: 50px;
    padding: 12px 30px;
}
</style>
@endsection
