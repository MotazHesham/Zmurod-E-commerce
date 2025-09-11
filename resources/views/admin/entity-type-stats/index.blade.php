@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">إحصائيات التجار</h3>
            </div>
            <div class="card-body">
                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">إجمالي العملاء</span>
                                <span class="info-box-number">{{ $stats['total_customers'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fas fa-store"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">إجمالي التجار</span>
                                <span class="info-box-number">{{ $stats['total_sellers'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fas fa-user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">تجار أفراد</span>
                                <span class="info-box-number">{{ $stats['total_individuals'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary"><i class="fas fa-building"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">المنظمات</span>
                                <span class="info-box-number">{{ $stats['total_organizations'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Organizations Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>اسم المنظمة</th>
                                <th>الوصف</th>
                                <th>عدد التجار</th>
                                <th>المالك</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($organizations as $organization)
                            <tr>
                                <td>{{ $organization->name }}</td>
                                <td>{{ $organization->description ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $organization->sellers_count }} تاجر</span>
                                </td>
                                <td>
                                    @if($organization->user)
                                        {{ $organization->user->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Sellers by Organization -->
                <div class="mt-4">
                    <h4>التجار حسب المنظمة</h4>
                    @foreach($organizations as $organization)
                        @if($organization->sellers_count > 0)
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5>{{ $organization->name }}</h5>
                                    <small class="text-muted">{{ $organization->sellers_count }} تاجر</small>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>الاسم</th>
                                                    <th>البريد الإلكتروني</th>
                                                    <th>الهاتف</th>
                                                    <th>البلد</th>
                                                    <th>اسم المتجر</th>
                                                    <th>تاريخ التسجيل</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($organization->sellers as $seller)
                                                    <tr>
                                                        <td>{{ $seller->user->name }}</td>
                                                        <td>{{ $seller->user->email }}</td>
                                                        <td>{{ $seller->user->phone ?? '-' }}</td>
                                                        <td>{{ $seller->user->country ?? '-' }}</td>
                                                        <td>{{ $seller->store_name ?? '-' }}</td>
                                                        <td>{{ $seller->created_at->format('Y-m-d') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection