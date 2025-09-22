@extends('layouts.frontend')
@section('content')
    <!-- Course Blog Area Start -->
    <div class="blog-grid pb-100px pt-100px main-blog-page single-blog-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-9 col-md-12 ">
                    <div class="blog-posts">
                        <div class="single-blog-post blog-grid-post">
                            @if (isset($course->photo))
                                <div class="blog-image single-blog" data-aos="fade-up" data-aos-delay="200">
                                    <img class="img-fluid h-auto" src="{{ $course->photo->getUrl() }}" alt="blog" />
                                </div>
                            @else
                                <div class="blog-image single-blog" data-aos="fade-up" data-aos-delay="200">
                                    <img class="img-fluid h-auto" src="{{ asset('assets/images/blank.jpg') }}"
                                        alt="blog" />
                                </div>
                            @endif


                            <div class="blog-post-content-inner mt-30px" data-aos="fade-up" data-aos-delay="400">
                                <div class="blog-athor-date">
                                    <span class="m-5"> بواسطة,<a class="blog-author cercle-shape"
                                            href="#">{{ $course->trainer }}</a></span>
                                    <span class="blog-date mr-4"
                                        href="#">{{ $course->created_at->format('  j F    ') }}</span>
                                </div>
                                <h4 class="blog-title">{{ $course->name }}</h4>
                                <p data-aos="fade-up">{{ $course->description }}</p>
                                {{-- <p data-aos="fade-up" data-aos-delay="200"></p> --}}
                            </div>

                        </div>
                    </div>
                    <!-- single blog post -->


                </div>
                <!-- Sidebar Area Start -->
                <div class="col-lg-4 col-xl-3 col-md-12 mt-md-50px mt-lm-50px" data-aos="fade-up" data-aos-delay="200">
                    <div class="blog-sidebar mr-20px">
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget text-center">
                            <h3 class="sidebar-title">الاشتراك والدفع</h3>

                            <div class="instructor_pricing_widget csv2">
                                <h2> بواسطة - {{ $course->trainer }}</h2>
                                <h3 class="new-price"> {{ $course->price }}ر.س</h3>
                                <h5 class="subtitle text-right">يشمل</h5>

                                <ul class="price_quere_list text-right">
                                    <li><a href="#"> {{ $course->courses_hours }} ساعة تدريبية </a></li>
                                    <li><a href="#"> الفيدوهات المسجلة </a></li>
                                    <li><a href="#">إتاحة طوال الوقت</a></li>
                                    <li><a href="#"> تابع الدورة من اي لابتوب او موبايل </a></li>
                                </ul>
                                <h5> الشهاده :- {{ App\Models\Course::TYPE_SELECT[$course->type] }}</h5>
                            </div>
                            <br />
                            @if($isSubscribed)
                                <a href="{{ route('frontend.courses.content', $course->id) }}" 
                                   class="btn btn-success btn-hover-dark border-0 blog-btn btn-center mt-30px">
                                    ابدأ التعلم الآن
                                </a>
                            @else
                                <button class="btn btn-primary btn-hover-dark border-0 blog-btn btn-center mt-30px"
                                        type="button" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#subscriptionModal"
                                        data-course-id="{{ $course->id }}"
                                        data-course-name="{{ $course->name }}"
                                        data-course-price="{{ $course->price }}"
                                        data-course-type="{{ $course->type }}">
                                    اشترك الان
                                </button>
                            @endif
                        </div>
                        <!-- Sidebar single item -->


                    </div>
                </div>
                <!-- Sidebar Area End -->
            </div>
        </div>
    </div>
    <!-- Course Blag Area End -->

    <!-- Subscription Modal -->
    <div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subscriptionModalLabel">اشتراك في الدورة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h4 id="courseName"></h4>
                        <div class="mt-3">
                            <span class="badge bg-info" id="courseType"></span>
                        </div>
                        <div class="mt-3">
                            <h3 class="text-primary" id="coursePrice"></h3>
                        </div>
                        <div class="mt-3">
                            <p id="subscriptionMessage"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" id="confirmSubscription">تأكيد الاشتراك</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('subscriptionModal');
            const courseId = modal.querySelector('[data-course-id]');
            const courseName = document.getElementById('courseName');
            const courseType = document.getElementById('courseType');
            const coursePrice = document.getElementById('coursePrice');
            const subscriptionMessage = document.getElementById('subscriptionMessage');
            const confirmBtn = document.getElementById('confirmSubscription');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const courseIdValue = button.getAttribute('data-course-id');
                const courseNameValue = button.getAttribute('data-course-name');
                const coursePriceValue = button.getAttribute('data-course-price');
                const courseTypeValue = button.getAttribute('data-course-type');

                courseName.textContent = courseNameValue;
                coursePrice.textContent = coursePriceValue + ' ر.س';
                
                // Set course type badge
                const typeMap = {
                    'C-paid': 'شهادة مدفوعة',
                    'C': 'شهادة مجانية',
                    'No-C': 'بدون شهادة'
                };
                courseType.textContent = typeMap[courseTypeValue] || courseTypeValue;

                // Set subscription message based on price
                if (parseFloat(coursePriceValue) > 0) {
                    subscriptionMessage.textContent = 'هل أنت متأكد من الاشتراك في هذه الدورة المدفوعة؟';
                } else {
                    subscriptionMessage.textContent = 'هل أنت متأكد من الاشتراك في هذه الدورة المجانية؟';
                }

                // Set up confirm button
                confirmBtn.onclick = function() {
                    subscribeToCourse(courseIdValue);
                };
            });

            function subscribeToCourse(courseId) {
                fetch(`/courses/${courseId}/subscribe`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Close modal
                        const modalInstance = bootstrap.Modal.getInstance(modal);
                        modalInstance.hide();
                        
                        // Show success message
                        alert(data.success);
                        
                        // Reload page to update subscription status
                        location.reload();
                    } else if (data.redirect) {
                        // Redirect to login page
                        window.location.href = data.redirect;
                    } else {
                        alert(data.error || 'حدث خطأ أثناء الاشتراك');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء الاشتراك');
                });
            }
        });
    </script>
@endsection
