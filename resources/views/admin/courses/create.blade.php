@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-courses-create.css') }}">
@endsection

@section('content')
    <div class="page-title mb-4">
        <h2>Add Course</h2>
        <p>Create new course/program details</p>
    </div>

    <div class="panel-card hero-card">
        <form action="{{ route('admin.courses.store') }}" method="POST">
            @csrf

            <div class="form-section-title">
                <i class="fas fa-book-medical"></i>
                Course Information
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Category <span>*</span></label>
                    <select name="course_category_id" class="form-control custom-input" required>
                        <option value="">Select Category</option>
                        @foreach ($courses as $category)
                            <option value="{{ $category->id }}"
                                {{ old('course_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Course Title <span>*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="form-control custom-input" placeholder="Physiotherapy" required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                        class="form-control custom-input" placeholder="physiotherapy">
                    @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Badge</label>
                    <input type="text" name="badge" value="{{ old('badge') }}" class="form-control custom-input"
                        placeholder="Popular Course">
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control custom-textarea" rows="3"
                        placeholder="Enter short description">{{ old('short_description') }}</textarea>
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label">Quote</label>
                    <input type="text" name="quote" value="{{ old('quote') }}" class="form-control custom-input"
                        placeholder="Your future in healthcare starts here">
                </div>
                <div class="row">

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Duration Title 1</label>
                        <input type="text" name="duration_title_one"
                            value="{{ old('duration_title_one', $course->duration_title_one ?? '') }}"
                            class="form-control custom-input" placeholder="Program Duration">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Duration 1</label>
                        <input type="text" name="duration_one"
                            value="{{ old('duration_one', $course->duration_one ?? '') }}"
                            class="form-control custom-input" placeholder="1 Year">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Duration Title 2</label>
                        <input type="text" name="duration_title_two"
                            value="{{ old('duration_title_two', $course->duration_title_two ?? '') }}"
                            class="form-control custom-input" placeholder="Internship Duration">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Duration 2</label>
                        <input type="text" name="duration_two"
                            value="{{ old('duration_two', $course->duration_two ?? '') }}"
                            class="form-control custom-input" placeholder="6 Months">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Duration Title 3</label>
                        <input type="text" name="duration_title_three"
                            value="{{ old('duration_title_three', $course->duration_title_three ?? '') }}"
                            class="form-control custom-input" placeholder="Clinical Training">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Duration 3</label>
                        <input type="text" name="duration_three"
                            value="{{ old('duration_three', $course->duration_three ?? '') }}"
                            class="form-control custom-input" placeholder="3 Months">
                    </div>

                </div>


                <div class="col-md-4 mb-4">
                    <label class="form-label">Eligibility</label>
                    <input type="text" name="eligibility" value="{{ old('eligibility') }}"
                        class="form-control custom-input" placeholder="10+2">
                </div>

                <div class="col-md-4 mb-4">
                    <label class="form-label">Recognition</label>
                    <input type="text" name="recognition" value="{{ old('recognition') }}"
                        class="form-control custom-input" placeholder="Recognized Program">
                </div>

                <div class="col-md-4 mb-4">
                    <label class="form-label">Placement Rate</label>
                    <input type="text" name="placement_rate" value="{{ old('placement_rate') }}"
                        class="form-control custom-input" placeholder="100%">
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label">Program Overview</label>
                    <textarea name="program_overview" class="form-control custom-textarea" rows="5">{{ old('program_overview') }}</textarea>
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label">About Course</label>
                    <textarea name="about_course" class="form-control custom-textarea" rows="5">{{ old('about_course') }}</textarea>
                </div>

                <div class="col-md-12 mb-4">
                    <label class="status-box">
                        <input type="checkbox" name="status" value="1" checked>
                        <div>
                            <strong>Active Status</strong>
                            <p>Show this course on frontend.</p>
                        </div>
                    </label>
                </div>
            </div>

            <div class="form-section-title mt-4">
                <i class="fas fa-briefcase-medical"></i>
                Dynamic Course Details
            </div>

            <div class="mb-4">
                <label class="form-label">Employment Opportunities</label>
                <div id="employmentWrapper">
                    <div class="input-group mb-2">
                        <input type="text" name="employment_opportunities[]" class="form-control custom-input"
                            placeholder="Hospitals and Clinics">
                        <button type="button" class="btn add-btn addEmployment">+</button>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Career Roles</label>
                <div id="careerWrapper">
                    <div class="input-group mb-2">
                        <input type="text" name="career_roles[]" class="form-control custom-input"
                            placeholder="Physiotherapist">
                        <button type="button" class="btn add-btn addCareer">+</button>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Graduates Work</label>
                <div id="graduateWrapper">
                    <div class="input-group mb-2">
                        <input type="text" name="graduates_work[]" class="form-control custom-input"
                            placeholder="Apollo Hospital">
                        <button type="button" class="btn add-btn addGraduate">+</button>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">FAQs</label>
                <div id="faqWrapper">
                    <div class="faq-box mb-3">
                        <input type="text" name="faqs[0][question]" class="form-control custom-input mb-2"
                            placeholder="Question">
                        <textarea name="faqs[0][answer]" class="form-control custom-textarea" rows="3" placeholder="Answer"></textarea>
                    </div>
                </div>

                <button type="button" id="addFaq" class="btn add-btn">
                    <i class="fas fa-plus"></i> Add FAQ
                </button>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn save-btn">
                    <i class="fas fa-save"></i> Save Course
                </button>

                <a href="{{ route('admin.courses.index') }}" class="btn back-btn">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </form>
    </div>


    <script>
        document.getElementById('title').addEventListener('keyup', function() {
            let slug = this.value.toLowerCase().trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            document.getElementById('slug').value = slug;
        });

        function repeater(wrapper, name, placeholder) {
            document.getElementById(wrapper).insertAdjacentHTML('beforeend', `
            <div class="input-group mb-2">
                <input type="text" name="${name}[]" class="form-control custom-input" placeholder="${placeholder}">
                <button type="button" class="btn remove-btn removeItem">X</button>
            </div>
        `);
        }

        document.querySelector('.addEmployment').addEventListener('click', function() {
            repeater('employmentWrapper', 'employment_opportunities', 'Employment Opportunity');
        });

        document.querySelector('.addCareer').addEventListener('click', function() {
            repeater('careerWrapper', 'career_roles', 'Career Role');
        });

        document.querySelector('.addGraduate').addEventListener('click', function() {
            repeater('graduateWrapper', 'graduates_work', 'Graduate Work Place');
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeItem')) {
                e.target.closest('.input-group').remove();
            }
        });

        let faqIndex = 1;

        document.getElementById('addFaq').addEventListener('click', function() {
            document.getElementById('faqWrapper').insertAdjacentHTML('beforeend', `
            <div class="faq-box mb-3">
                <input type="text" name="faqs[${faqIndex}][question]" class="form-control custom-input mb-2" placeholder="Question">
                <textarea name="faqs[${faqIndex}][answer]" class="form-control custom-textarea" rows="3" placeholder="Answer"></textarea>
                <button type="button" class="btn remove-btn mt-2 removeFaq">Remove</button>
            </div>
        `);

            faqIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeFaq')) {
                e.target.closest('.faq-box').remove();
            }
        });
    </script>
@endsection
