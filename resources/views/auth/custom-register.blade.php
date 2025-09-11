@extends('layouts.frontend')
@section('styles')

<link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
@endsection
@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title"> مستخدم جديد</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active">دخول</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->

<div class="login-register-area pt-100px pb-100px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="login-register-wrapper">
                    <div class="tab-loading-overlay">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="login-register-tab-list nav">
                        <a data-bs-toggle="tab" href="#lg1">
                            <h4>تسجيل عميل</h4>
                        </a>
                        <a data-bs-toggle="tab" href="#lg2">
                            <h4>تسجيل تاجر</h4>
                        </a>
                    </div>

                    <div class="tab-content">
                        @if ($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div id="lg1" class="tab-pane active @if (
                                $errors->hasAny([
                                    'customer_name',
                                    'customer_password',
                                    'customer_country',
                                    'customer_region',
                                    'customer_complete-add',
                                    'customer_phone',
                                ])) ) active @endif">

                            <div class="login-form-container">
                                <h4 class="text-center">بيانات العميل</h4>
                                <div class="login-register-form">
                                    <form action="{{ route('frontend.register_customer') }}" method="post" id="custome-form">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <input class="form-control {{ $errors->has('customer_name') ? 'is-invalid' : '' }}" type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', '') }}" placeholder="أسم المستخدم" required>
                                                @if ($errors->has('customer_name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('customer_name') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" placeholder="البريد الالكتروني" required>
                                                @if ($errors->has('email'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-with-toggle">
                                                    <input class="form-control {{ $errors->has('customer_password') ? 'is-invalid' : '' }}" type="password" name="customer_password" id="customer_password" placeholder="كلمة المرور" required>
                                                    <button type="button" class="toggle-password" data-target="#customer_password" aria-label="عرض/إخفاء كلمة المرور">👁️</button>
                                                </div>
                                                @if ($errors->has('customer_password'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('customer_password') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="customer_country" class="form-control">
                                                    <option value=""> الدوله</option>
                                                    @foreach (\App\Models\User::CITY_SELECT as $key => $value)
                                                    <option value="{{ $key }}" @if (old('customer_country')==$key) selected @endif>
                                                        {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="customer_region" class="form-control" required>
                                                    <option value="">المحافظه / المنطقه </option>
                                                    @foreach (\App\Models\User::AREA_SELECT as $key => $value)
                                                    <option value="{{ $key }}" @if (old('customer_region')==$key) selected @endif>
                                                        {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" name="customer_complete-add" class="form-control" placeholder="اسم الشارع" required />
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="customer_identity" id="customer_identity" class="form-control {{ $errors->has('customer_identity') ? 'is-invalid' : '' }}" required>
                                                    <option value="">نوع الهوية</option>
                                                    <option value="saudi" {{ old('customer_identity') == 'saudi' ? 'selected' : '' }}>سعودي</option>
                                                    <option value="resident" {{ old('customer_identity') == 'resident' ? 'selected' : '' }}>مقيم</option>
                                                </select>
                                                @if ($errors->has('customer_identity'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('customer_identity') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input class="form-control {{ $errors->has('customer_identity_number') ? 'is-invalid' : '' }}" type="text" name="customer_identity_number" id="customer_identity_number" placeholder="رقم الهوية" required>
                                                @if ($errors->has('customer_identity_number'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('customer_identity_number') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input class="form-control {{ $errors->has('customer_phone') ? 'is-invalid' : '' }} customer_phone" type="tel" name="customer_phone" id="customer_phone" placeholder="رقم الجوال" value="{{ old('customer_phone', '') }}" required>
                                                @if ($errors->has('customer_phone'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('customer_phone') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <div class="button-box">
                                                    <div class="row">
                                                        <div class="col-4 col-md-4 mx-auto">
                                                            <button type="submit" class="btn btn-cta w-75 py-2 m-2"><span>تسجيل</span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div id="lg2" class="tab-pane @if (
                                $errors->hasAny([
                                    'name',
                                    'password',
                                    'country',
                                    'region',
                                    'complete-add',
                                    'phone',
                                    'store_name',
                                    'description',
                                    'photo',
                                ])) ) active @endif">

                            <!-- Wizard Progress Bar -->
                            <div class="wizard-progress mb-4">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 20%" id="wizard-progress"></div>
                                </div>
                                <div class="wizard-steps">
                                    <div class="step active" data-step="1">
                                        <div class="step-number">1</div>
                                        <div class="step-title">البيانات الأساسية</div>
                                    </div>
                                    <div class="step" data-step="2">
                                        <div class="step-number">2</div>
                                        <div class="step-title">نوع التاجر</div>
                                    </div>
                                    <div class="step" data-step="3">
                                        <div class="step-number">3</div>
                                        <div class="step-title">الوثائق</div>
                                    </div>
                                    <div class="step" data-step="4">
                                        <div class="step-number">4</div>
                                        <div class="step-title">البيانات المصرفية</div>
                                    </div>
                                    <div class="step" data-step="5">
                                        <div class="step-number">5</div>
                                        <div class="step-title">المراجعة</div>
                                    </div>
                                </div>
                            </div>

                            <div class="login-form-container">
                                <h4 class="text-center">بيانات التاجر</h4>
                                <div class="login-register-form">
                                    <form action="{{ route('frontend.register_seller') }}" id="seller-form" method="post">
                                        @csrf

                                        <!-- Wizard Step 1: Basic Information -->
                                        <div class="wizard-step active" data-step="1">
                                            <div class="card border-primary">
                                                <div class="card-header bg-primary text-white">
                                                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>البيانات الأساسية</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label fw-bold">الاسم الكامل <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-lg {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" placeholder="أدخل اسمك الكامل" required>
                                                            @if ($errors->has('name'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('name') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label fw-bold">البريد الإلكتروني <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-lg {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" placeholder="أدخل بريدك الإلكتروني" required>
                                                            @if ($errors->has('email'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('email') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label fw-bold">كلمة المرور <span class="text-danger">*</span></label>
                                                            <div class="input-with-toggle">
                                                                <input class="form-control form-control-lg {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" placeholder="أدخل كلمة المرور" required>
                                                                <button type="button" class="toggle-password" data-target="#password" aria-label="عرض/إخفاء كلمة المرور">👁️</button>
                                                            </div>
                                                            @if ($errors->has('password'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('password') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label fw-bold">نوع الهوية <span class="text-danger">*</span></label>
                                                            <select name="identity" id="identity" class="form-control form-control-lg {{ $errors->has('identity') ? 'is-invalid' : '' }}" required>
                                                                <option value="">اختر نوع الهوية</option>
                                                                <option value="saudi" {{ old('identity') == 'saudi' ? 'selected' : '' }}>سعودي</option>
                                                                <option value="resident" {{ old('identity') == 'resident' ? 'selected' : '' }}>مقيم</option>
                                                            </select>
                                                            @if ($errors->has('identity'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('identity') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label fw-bold">رقم الهوية <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-lg {{ $errors->has('identity_number') ? 'is-invalid' : '' }}" type="text" name="identity_number" id="identity_number" placeholder="أدخل رقم الهوية" required>
                                                            @if ($errors->has('identity_number'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('identity_number') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label fw-bold">اسم المتجر <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-lg {{ $errors->has('store_name') ? 'is-invalid' : '' }}" type="text" name="store_name" id="store_name" value="{{ old('store_name', '') }}" placeholder="أدخل اسم المتجر" required>
                                                            @if ($errors->has('store_name'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('store_name') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label fw-bold">رقم الجوال <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-lg {{ $errors->has('phone') ? 'is-invalid' : '' }} customer_phone" type="tel" name="phone" id="phone" placeholder="أدخل رقم الجوال" value="{{ old('phone', '') }}" required>
                                                            @if ($errors->has('phone'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('phone') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label fw-bold">الدولة <span class="text-danger">*</span></label>
                                                            <select name="country" class="form-control form-control-lg" required>
                                                                <option value="">اختر الدولة</option>
                                                                @foreach (\App\Models\User::CITY_SELECT as $key => $value)
                                                                <option value="{{ $key }}" @if (old('country')==$key) selected @endif>
                                                                    {{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('country'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('country') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label fw-bold">المنطقة <span class="text-danger">*</span></label>
                                                            <select name="region" class="form-control form-control-lg" required>
                                                                <option value="">اختر المنطقة</option>
                                                                @foreach (\App\Models\User::AREA_SELECT as $key => $value)
                                                                <option value="{{ $key }}" @if (old('region')==$key) selected @endif>
                                                                    {{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label fw-bold">العنوان التفصيلي <span class="text-danger">*</span></label>
                                                            <input type="text" name="complete-add" class="form-control form-control-lg" placeholder="أدخل العنوان التفصيلي" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Wizard Step 2: Seller Type -->
                                        <div class="wizard-step" data-step="2" style="display: none;">
                                            <div class="card border-info">
                                                <div class="card-header bg-info text-white">
                                                    <h5 class="mb-0"><i class="fas fa-store me-2"></i>نوع التاجر</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label fw-bold">نوع الكيان <span class="text-danger">*</span></label>
                                                            <select name="seller_type" id="seller_type" class="form-control form-control-lg {{ $errors->has('seller_type') ? 'is-invalid' : '' }}" required>
                                                                <option value="">اختر نوع الكيان</option>
                                                                <option value="individual" {{ old('seller_type') == 'individual' ? 'selected' : '' }}>فرد مستقل</option>
                                                                <option value="organization" {{ old('seller_type') == 'organization' ? 'selected' : '' }}>جمعية/مؤسسة</option>
                                                                <option value="affiliated" {{ old('seller_type') == 'affiliated' ? 'selected' : '' }}>تابع لمنظمة</option>
                                                            </select>
                                                            @if ($errors->has('seller_type'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('seller_type') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 col-md-6" id="organization_name_field" style="display: none;">
                                                            <label class="form-label fw-bold">اسم المنظمة <span class="text-danger">*</span></label>
                                                            <input type="text" name="organization_name" id="organization_name" class="form-control form-control-lg {{ $errors->has('organization_name') ? 'is-invalid' : '' }}" placeholder="أدخل اسم المنظمة" value="{{ old('organization_name') }}">
                                                            @if ($errors->has('organization_name'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('organization_name') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 col-md-6" id="parent_organization_field" style="display: none;">
                                                            <label class="form-label fw-bold">المنظمة التابعة لها <span class="text-danger">*</span></label>
                                                            <select name="organization_id" id="organization_id" class="form-control form-control-lg {{ $errors->has('organization_id') ? 'is-invalid' : '' }}">
                                                                <option value="">اختر المنظمة</option>
                                                                @foreach(\App\Models\Organization::all() as $org)
                                                                <option value="{{ $org->id }}" {{ old('organization_id') == $org->id ? 'selected' : '' }}>
                                                                    {{ $org->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('organization_id'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('organization_id') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Wizard Step 3: Documents -->
                                        <div class="wizard-step" data-step="3" style="display: none;">
                                            <!-- Document Type Selection -->
                                            <div class="col-12">
                                                <div class="card border-primary mb-4">
                                                    <div class="card-header bg-primary text-white">
                                                        <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>نوع الوثيقة</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <label class="form-label fw-bold">اختر نوع الوثيقة <span class="text-danger">*</span></label>
                                                                <select name="document_type" id="document_type" class="form-control form-control-lg {{ $errors->has('document_type') ? 'is-invalid' : '' }}" required>
                                                                    <option value="">اختر نوع الوثيقة</option>
                                                                    <option value="commercial_register" {{ old('document_type') == 'commercial_register' ? 'selected' : '' }}>سجل تجاري</option>
                                                                    <option value="freelance_work" {{ old('document_type') == 'freelance_work' ? 'selected' : '' }}>وثيقة عمل حر</option>
                                                                </select>
                                                                @if ($errors->has('document_type'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('document_type') }}
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Commercial Register Fields -->
                                            <div id="commercial_register_fields" style="display: none;">
                                                <div class="col-12">
                                                    <div class="card border-success">
                                                        <div class="card-header bg-success text-white">
                                                            <h5 class="mb-0"><i class="fas fa-building me-2"></i>بيانات السجل التجاري</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row g-4">
                                                                <!-- Document Upload -->
                                                                <div class="col-12">
                                                                    <label class="form-label fw-bold">صورة السجل التجاري <span class="text-danger">*</span></label>
                                                                    <div class="dropzone-container">
                                                                        <div class="needsclick dropzone style--three {{ $errors->has('commercial_register_document') ? 'is-invalid' : '' }}" id="commercial-register-dropzone">
                                                                        </div>
                                                                    </div>
                                                                    @if ($errors->has('commercial_register_document'))
                                                                    <div class="invalid-feedback d-block">
                                                                        {{ $errors->first('commercial_register_document') }}
                                                                    </div>
                                                                    @endif
                                                                </div>

                                                                <!-- Expiry Date -->
                                                                <div class="col-12 col-md-6">
                                                                    <label class="form-label fw-bold">تاريخ انتهاء السجل التجاري <span class="text-danger">*</span></label>
                                                                    <input type="date" name="commercial_register_expiry" id="commercial_register_expiry" class="form-control form-control-lg {{ $errors->has('commercial_register_expiry') ? 'is-invalid' : '' }}" value="{{ old('commercial_register_expiry') }}">
                                                                    @if ($errors->has('commercial_register_expiry'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('commercial_register_expiry') }}
                                                                    </div>
                                                                    @endif
                                                                </div>

                                                                <!-- Register Number -->
                                                                <div class="col-12 col-md-6">
                                                                    <label class="form-label fw-bold">رقم السجل التجاري <span class="text-danger">*</span></label>
                                                                    <input type="text" name="commercial_register_number" id="commercial_register_number" class="form-control form-control-lg {{ $errors->has('commercial_register_number') ? 'is-invalid' : '' }}" placeholder="أدخل رقم السجل التجاري" value="{{ old('commercial_register_number') }}">
                                                                    @if ($errors->has('commercial_register_number'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('commercial_register_number') }}
                                                                    </div>
                                                                    @endif
                                                                </div>

                                                                <!-- Tax Number -->
                                                                <div class="col-12 col-md-6">
                                                                    <label class="form-label fw-bold">الرقم الضريبي <span class="text-danger">*</span></label>
                                                                    <input type="text" name="tax_number" id="tax_number" class="form-control form-control-lg {{ $errors->has('tax_number') ? 'is-invalid' : '' }}" placeholder="أدخل الرقم الضريبي" value="{{ old('tax_number') }}">
                                                                    @if ($errors->has('tax_number'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('tax_number') }}
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Freelance Work Document Fields -->
                                            <div id="freelance_work_fields" style="display: none;">
                                                <div class="col-12">
                                                    <div class="card border-info">
                                                        <div class="card-header bg-info text-white">
                                                            <h5 class="mb-0"><i class="fas fa-user-tie me-2"></i>بيانات وثيقة العمل الحر</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row g-4">
                                                                <!-- Document Upload -->
                                                                <div class="col-12">
                                                                    <label class="form-label fw-bold">وثيقة العمل الحر <span class="text-danger">*</span></label>
                                                                    <div class="dropzone-container">
                                                                        <div class="needsclick dropzone style--three {{ $errors->has('freelance_work_document') ? 'is-invalid' : '' }}" id="freelance-work-dropzone">
                                                                        </div>
                                                                    </div>
                                                                    @if ($errors->has('freelance_work_document'))
                                                                    <div class="invalid-feedback d-block">
                                                                        {{ $errors->first('freelance_work_document') }}
                                                                    </div>
                                                                    @endif
                                                                </div>

                                                                <!-- Document Number -->
                                                                <div class="col-12 col-md-6">
                                                                    <label class="form-label fw-bold">رقم المستند <span class="text-danger">*</span></label>
                                                                    <input type="text" name="freelance_work_number" id="freelance_work_number" class="form-control form-control-lg {{ $errors->has('freelance_work_number') ? 'is-invalid' : '' }}" placeholder="أدخل رقم المستند" value="{{ old('freelance_work_number') }}">
                                                                    @if ($errors->has('freelance_work_number'))
                                                                    <div class="invalid-feedback">
                                                                        {{ $errors->first('freelance_work_number') }}
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Wizard Step 4: Bank Information -->
                                        <div class="wizard-step" data-step="4" style="display: none;">
                                            <div class="card border-warning">
                                                <div class="card-header bg-warning text-dark">
                                                    <h5 class="mb-0"><i class="fas fa-university me-2"></i>البيانات المصرفية</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label fw-bold">البنك <span class="text-danger">*</span></label>
                                                            <select name="bank_id" id="bank_id" class="form-control form-control-lg {{ $errors->has('bank_id') ? 'is-invalid' : '' }}" required>
                                                                <option value="">اختر البنك</option>
                                                                @foreach(\App\Models\Bank::all() as $bank)
                                                                <option value="{{ $bank->id }}" {{ old('bank_id') == $bank->id ? 'selected' : '' }}>
                                                                    {{ $bank->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('bank_id'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('bank_id') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label fw-bold">رقم الحساب <span class="text-danger">*</span></label>
                                                            <input type="text" name="account_number" id="account_number" class="form-control form-control-lg {{ $errors->has('account_number') ? 'is-invalid' : '' }}" placeholder="أدخل رقم الحساب" value="{{ old('account_number') }}" required>
                                                            @if ($errors->has('account_number'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('account_number') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-bold">رقم IBAN <span class="text-danger">*</span></label>
                                                            <input type="text" name="iban" id="iban" class="form-control form-control-lg {{ $errors->has('iban') ? 'is-invalid' : '' }}" placeholder="أدخل رقم IBAN" value="{{ old('iban') }}" required>
                                                            @if ($errors->has('iban'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('iban') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Wizard Step 5: Review and Submit -->
                                        <div class="wizard-step" data-step="5" style="display: none;">
                                            <div class="card border-secondary">
                                                <div class="card-header bg-secondary text-white">
                                                    <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>المراجعة النهائية</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label fw-bold">صورة شخصية <span class="text-danger">*</span></label>
                                                            <div class="dropzone-container">
                                                                <div class="needsclick dropzone style--three {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('photo'))
                                                            <div class="invalid-feedback d-block">
                                                                {{ $errors->first('photo') }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-bold">وصف المتجر <span class="text-danger">*</span></label>
                                                            <textarea id="description" name="description" rows="4" cols="50" class="form-control form-control-lg" maxlength="600" required placeholder="أدخل وصف مختصر عن متجرك..."></textarea>
                                                            <div class="char-counter mt-2"><span id="desc-count">0</span> / 600</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Wizard Navigation -->
                                        <div class="wizard-navigation">
                                            <button type="button" class="wizard-btn wizard-btn-prev" id="prevBtn" style="display: none;">
                                                <i class="fas fa-arrow-right me-2"></i>السابق
                                            </button>
                                            <div class="ms-auto">
                                                <button type="button" class="wizard-btn wizard-btn-next" id="nextBtn">
                                                    التالي<i class="fas fa-arrow-left ms-2"></i>
                                                </button>
                                                <button type="submit" class="wizard-btn wizard-btn-submit" id="submitBtn" style="display: none;">
                                                    <i class="fas fa-check me-2"></i>تسجيل
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login area end -->
@endsection
@section('scripts')
<script>
    // Wizard Functionality
    $(document).ready(function() {
        let currentStep = 1;
        const totalSteps = 5;

        // Update progress bar
        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            $('#wizard-progress').css('width', progress + '%');

            // Update step indicators
            $('.step').removeClass('active completed');
            for (let i = 1; i <= totalSteps; i++) {
                if (i < currentStep) {
                    $('.step[data-step="' + i + '"]').addClass('completed');
                } else if (i === currentStep) {
                    $('.step[data-step="' + i + '"]').addClass('active');
                }
            }

            // Update navigation buttons
            if (currentStep === 1) {
                $('#prevBtn').hide();
            } else {
                $('#prevBtn').show();
            }

            if (currentStep === totalSteps) {
                $('#nextBtn').hide();
                $('#submitBtn').show();
            } else {
                $('#nextBtn').show();
                $('#submitBtn').hide();
            }
        }

        // Show step
        function showStep(step) {
            $('.wizard-step').hide();
            $('.wizard-step[data-step="' + step + '"]').show();
            currentStep = step;
            updateProgress();
        }

        // Next button
        $('#nextBtn').click(function() {
            if (validateCurrentStep()) {
                showStep(currentStep + 1);
            }
        });

        // Previous button
        $('#prevBtn').click(function() {
            showStep(currentStep - 1);
        });

        // Step validation
      function validateCurrentStep() {
    const currentStepElement = $('.wizard-step[data-step="' + currentStep + '"]');
    const form = currentStepElement.closest("form"); 
    const validator = form.data("validator"); 
    
    let isValid = true;
    let firstInvalid = null;

    // تحقق من كل الحقول داخل الـ step الحالي باستخدام jQuery Validate
    currentStepElement.find("input, select, textarea").each(function () {
        if (!validator.element(this)) {
            isValid = false;
            if (!firstInvalid) {
                firstInvalid = this; // أول حقل فيه مشكلة
            }
        }
    });

    if (currentStep === 3) {
        const documentType = $('#document_type').val();
        if (documentType === 'commercial_register') {
            const commercialFields = ['#commercial_register_expiry', '#commercial_register_number', '#tax_number'];
            commercialFields.forEach(function(field) {
                if (!validator.element($(field))) {
                    isValid = false;
                    if (!firstInvalid) {
                        firstInvalid = $(field)[0];
                    }
                }
            });
        } else if (documentType === 'freelance_work') {
            if (!validator.element($('#freelance_work_number'))) {
                isValid = false;
                if (!firstInvalid) {
                    firstInvalid = $('#freelance_work_number')[0];
                }
            }
        }
    }

    // ركّز على أول حقل فيه خطأ
    if (!isValid && firstInvalid) {
        $(firstInvalid).focus();
    }

    return isValid;
}


        // Initialize wizard
        updateProgress();

        // Seller type change handler
        $('#seller_type').change(function() {
            const sellerType = $(this).val();
            if (sellerType === 'organization') {
                $('#organization_name_field').show();
                $('#parent_organization_field').hide();
            } else if (sellerType === 'affiliated') {
                $('#organization_name_field').hide();
                $('#parent_organization_field').show();
            } else {
                $('#organization_name_field').hide();
                $('#parent_organization_field').hide();
            }
        });

        // Document type change handler
        $('#document_type').change(function() {
            const documentType = $(this).val();
            if (documentType === 'commercial_register') {
                $('#commercial_register_fields').show();
                $('#freelance_work_fields').hide();
            } else if (documentType === 'freelance_work') {
                $('#commercial_register_fields').hide();
                $('#freelance_work_fields').show();
            } else {
                $('#commercial_register_fields').hide();
                $('#freelance_work_fields').hide();
            }
        });
    });

</script>
<script>
    Dropzone.options.documentDropzone = {
        url: '{{ route('frontend.sellers.storeMedia') }}'
        , maxFilesize: 5, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.pdf'
        , maxFiles: 1
        , addRemoveLinks: true
        , headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
        , success: function(file, response) {
            $('form').find('input[name="document"]').remove();
            $('<input>').attr({
                type: 'hidden'
                , name: 'document'
                , value: response.name
            }).appendTo('form');
        }
        , removedfile: function(file) {
            file.previewElement.remove();
            if (file.status !== 'error') {
                $('form').find('input[name="document"]').remove();
                this.options.maxFiles = this.options.maxFiles + 1
            }
        }
        , init: function() {
            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
            });
        }
    };

    Dropzone.options.photoDropzone = {
        url: '{{ route('frontend.sellers.storeMedia') }}'
        , maxFilesize: 5, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.pdf'
        , maxFiles: 1
        , addRemoveLinks: true
        , headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
        , success: function(file, response) {
            $('form').find('input[name="photo"]').remove();
            $('<input>').attr({
                type: 'hidden'
                , name: 'photo'
                , value: response.name
            }).appendTo('form');
        }
        , removedfile: function(file) {
            file.previewElement.remove();
            if (file.status !== 'error') {
                $('form').find('input[name="photo"]').remove();
                this.options.maxFiles = this.options.maxFiles + 1
            }
        }
        , init: function() {
            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
            });
        }
    };

    Dropzone.options.commercialRegisterDropzone = {
        url: '{{ route('frontend.sellers.storeMedia') }}'
        , maxFilesize: 5, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.pdf'
        , maxFiles: 1
        , addRemoveLinks: true
        , headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
        , success: function(file, response) {
            $('form').find('input[name="commercial_register_document"]').remove();
            $('<input>').attr({
                type: 'hidden'
                , name: 'commercial_register_document'
                , value: response.name
            }).appendTo('form');
        }
        , removedfile: function(file) {
            file.previewElement.remove();
            if (file.status !== 'error') {
                $('form').find('input[name="commercial_register_document"]').remove();
                this.options.maxFiles = this.options.maxFiles + 1
            }
        }
        , init: function() {
            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
            });
        }
    };

    Dropzone.options.freelanceWorkDropzone = {
        url: '{{ route('frontend.sellers.storeMedia') }}'
        , maxFilesize: 5, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.pdf'
        , maxFiles: 1
        , addRemoveLinks: true
        , headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
        , success: function(file, response) {
            $('form').find('input[name="freelance_work_document"]').remove();
            $('<input>').attr({
                type: 'hidden'
                , name: 'freelance_work_document'
                , value: response.name
            }).appendTo('form');
        }
        , removedfile: function(file) {
            file.previewElement.remove();
            if (file.status !== 'error') {
                $('form').find('input[name="freelance_work_document"]').remove();
                this.options.maxFiles = this.options.maxFiles + 1
            }
        }
        , init: function() {
            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
            });
        }
    };

    $(document).ready(function() {
        $('#type').on('change', function() {
            if ($(this).val() == 'oragainzation') {
                $('#org-container').removeClass('d-none');
            } else {
                $('#org-container').addClass('d-none');
            }
        });
    });

</script>
<script>
    $(document).ready(function() {
        function SimpleUploadAdapter(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                return {
                    upload: function() {
                        return loader.file
                            .then(function(file) {
                                return new Promise(function(resolve, reject) {
                                    // Init request
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('POST'
                                        , '{{ route('frontend.sellers.storeCKEditorImages') }}'
                                        , true);
                                    xhr.setRequestHeader('x-csrf-token', window._token);
                                    xhr.setRequestHeader('Accept', 'application/json');
                                    xhr.responseType = 'json';

                                    // Init listeners
                                    var genericErrorText =
                                        `Couldn't upload file: ${ file.name }.`;
                                    xhr.addEventListener('error', function() {
                                        reject(genericErrorText)
                                    });
                                    xhr.addEventListener('abort', function() {
                                        reject()
                                    });
                                    xhr.addEventListener('load', function() {
                                        var response = xhr.response;

                                        if (!response || xhr.status !== 201) {
                                            return reject(response && response
                                                .message ?
                                                `${genericErrorText}\n${xhr.status} ${response.message}` :
                                                `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`
                                            );
                                        }

                                        $('form').append(
                                            '<input type="hidden" name="ck-media[]" value="' +
                                            response.id + '">');

                                        resolve({
                                            default: response.url
                                        });
                                    });

                                    if (xhr.upload) {
                                        xhr.upload.addEventListener('progress', function(
                                            e) {
                                            if (e.lengthComputable) {
                                                loader.uploadTotal = e.total;
                                                loader.uploaded = e.loaded;
                                            }
                                        });
                                    }

                                    // Send request
                                    var data = new FormData();
                                    data.append('upload', file);
                                    data.append('crud_id', '{{ $seller->id ?? 0 }}');
                                    xhr.send(data);
                                });
                            })
                    }
                };
            }
        }

        var allEditors = document.querySelectorAll('.ckeditor');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(
                allEditors[i], {
                    extraPlugins: [SimpleUploadAdapter]
                }
            );
        }
    });

</script>
<script>
    $(document).ready(function() {
        var $sellerTab = $('#lg2'); // Use jQuery selector to select the seller tab
        var $customerTab = $('#lg1'); // Use jQuery selector to select the customer tab

        // Show loading overlay when switching tabs
        var $overlay = $('.tab-loading-overlay');
        $(document).on('show.bs.tab', '.login-register-tab-list a[data-bs-toggle="tab"]', function() {
            $overlay.addClass('show');
        });
        $(document).on('shown.bs.tab', '.login-register-tab-list a[data-bs-toggle="tab"]', function() {
            setTimeout(function() {
                $overlay.removeClass('show');
            }, 300);
        });

        // Toggle password visibility
        $(document).on('click', '.toggle-password', function() {
            var target = $(this).data('target');
            var $input = $(target);
            if (!$input.length) return;
            var type = $input.attr('type') === 'password' ? 'text' : 'password';
            $input.attr('type', type);
        });

        @if(
            $errors -> hasAny([
                'name'
                , 'email'
                , 'password'
                , 'country'
                , 'region'
                , 'complete-add'
                , 'phone'
                , 'store_name'
                , 'description'
                , 'photo'
            , ]))
        // If there are errors in seller registration fields, show the "تسجيل تاجر" tab
        $sellerTab.addClass('active show');
        $customerTab.removeClass('active show');
        @endif
    });

</script>

<script>
$(document).ready(function () {
    // رسائل بالعربية
    if ($.validator) {
        $.extend($.validator.messages, {
            required: "هذا الحقل مطلوب",
            email: "البريد الإلكتروني غير صالح",
            minlength: $.validator.format("يجب ألا يقل عن {0} أحرف"),
        });
    }

    // قاعدة مخصصة للتحقق من الهوية
    $.validator.addMethod("saudiId", function (value, element) {
        if (!/^\d{10}$/.test(value)) return false; // لازم 10 أرقام
        return value.startsWith("1") || value.startsWith("2"); // يبدأ بـ1 (سعودي) أو 2 (مقيم)
    }, "رقم الهوية غير صالح، يجب أن يكون 10 أرقام ويبدأ بـ 1 (سعودي) أو 2 (مقيم)");

    // تفعيل intlTelInput
    function initPhone(selector) {
        var input = document.querySelector(selector);
        if (input) {
            var iti = window.intlTelInput(input, {
                initialCountry: "sa", // افتراضي السعودية
                separateDialCode: true,
                utilsScript: "{{ asset('vendor/intl-tel-input/js/utils.js') }}"
            });

            // قاعدة مخصصة للتحقق من الهاتف
            $.validator.addMethod("saudiPhone", function (value, element) {
                if (value.trim() === "") return true; // لو فاضي يسيب required يتصرف
                var country = iti.getSelectedCountryData();
                var number = value.replace(/\D/g, ""); // شيل أي رموز أو مسافات
                if (country.iso2 === "sa") {
                    return number.length === 9; // بعد +966 لازم 9 أرقام
                }
                return iti.isValidNumber(); // باقي الدول يتحقق من المكتبة
            }, "رقم الجوال يجب ان يكون 9 أرقام للرقم السعودي ");
            
            // اربط الفاليديشن بالـinput ده
            $(input).rules("add", {
                required: true,
                saudiPhone: true,
                messages: {
                    required: "رقم الجوال مطلوب"
                }
            });
        }
    }


    // seller form
    $("#seller-form").validate({
        rules: {
            name: { required: true, minlength: 3 },
            email: { required: true, email: true },
            password: { required: true, minlength: 8 },
            store_name: { required: true, minlength: 4 },
            country: { required: true },
            region: { required: true },
             identity_number: {
            required: true,
            saudiId: true,
            messages: {
                required: "رقم الهوية مطلوب"
            }
        },
        }
    });

    // customer form
    $("#custome-form").validate({
        rules: {
            customer_name: { required: true, minlength: 3 },
            email: { required: true, email: true },
            customer_password: { required: true, minlength: 8 },
            customer_country: { required: true },
            customer_region: { required: true },
            customer_identity_number: {
            required: true,
            saudiId: true,
            messages: {
                required: "رقم الهوية مطلوب"
            }
        },
        }
    });

    // فعل intlTelInput + القاعدة المخصصة للهاتف على الفورمين
    initPhone("#phone");
    initPhone("#customer_phone");
});
</script>

@endsection
