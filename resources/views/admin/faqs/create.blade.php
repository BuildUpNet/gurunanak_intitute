@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-faqs-create.css') }}">
@endsection

@section('content')
    <div class="page-title mb-4">
        <h2>Add FAQs</h2>
        <p>Select page and add multiple frequently asked questions</p>
    </div>

    <div class="panel-card hero-card">
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf

            <div class="form-section-title">
                <i class="fas fa-question-circle"></i>
                FAQ Information
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Page Name <span>*</span></label>
                    <select name="page_name" class="form-control custom-input" required>
                        <option value="">Select Page</option>

                        <option value="home" {{ old('page_name') == 'home' ? 'selected' : '' }}>
                            Home
                        </option>

                        <option value="about" {{ old('page_name') == 'about' ? 'selected' : '' }}>
                            About Us
                        </option>


                        <option value="admission" {{ old('page_name') == 'admission' ? 'selected' : '' }}>
                            Admission Page
                        </option>

                        <option value="admission_form" {{ old('page_name') == 'admission_form' ? 'selected' : '' }}>
                            Admission Form
                        </option>

                        <option value="gallery" {{ old('page_name') == 'gallery' ? 'selected' : '' }}>
                            Gallery
                        </option>

                        <option value="placement" {{ old('page_name') == 'placement' ? 'selected' : '' }}>
                            Placement
                        </option>

                        <option value="achievers" {{ old('page_name') == 'achievers' ? 'selected' : '' }}>
                            Achievers
                        </option>
                        <option value="contact_patiala" {{ old('page_name') == 'contact_patiala' ? 'selected' : '' }}>
                            Contact Patiala
                        </option>

                        <option value="contact_karnal" {{ old('page_name') == 'contact_karnal' ? 'selected' : '' }}>
                            Contact Karnal
                        </option>
                        <option value="gallery" {{ old('page_name') == 'gallery' ? 'selected' : '' }}>
                            Gallery
                        </option>

                        <option value="news" {{ old('page_name') == 'news' ? 'selected' : '' }}>
                            News & Announcements
                        </option>
                        <option value="placement" {{ old('page_name') == 'placement' ? 'selected' : '' }}>
                            Placement
                        </option>
                        <option value="results" {{ old('page_name') == 'results' ? 'selected' : '' }}>
                            Result
                        </option>
                        <option value="anti_ragging" {{ old('page_name') == 'anti_ragging' ? 'selected' : '' }}>
                            Anti-Ragging Policy
                        </option>
                    </select>

                    @error('page_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-section-title mt-4">
                <i class="fas fa-list"></i>
                Add FAQs
            </div>

            <div class="mb-4">
                <div id="faqWrapper">
                    <div class="faq-box mb-3">
                        <div class="mb-3">
                            <label class="form-label">Question <span>*</span></label>
                            <input type="text" name="faqs[0][question]" class="form-control custom-input"
                                placeholder="Enter question" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Answer <span>*</span></label>
                            <textarea name="faqs[0][answer]" class="form-control custom-textarea" rows="4" placeholder="Enter answer"
                                required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="faqs[0][sort_order]" class="form-control custom-input"
                                    value="0">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select name="faqs[0][status]" class="form-control custom-input">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" id="addFaq" class="btn add-btn">
                    <i class="fas fa-plus"></i> Add More FAQ
                </button>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn save-btn">
                    <i class="fas fa-save"></i> Save FAQs
                </button>

                <a href="{{ route('admin.faqs.index') }}" class="btn back-btn">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </form>
    </div>


    <script>
        let faqIndex = 1;

        document.getElementById('addFaq').addEventListener('click', function() {
            document.getElementById('faqWrapper').insertAdjacentHTML('beforeend', `
                <div class="faq-box mb-3">
                    <div class="mb-3">
                        <label class="form-label">Question <span>*</span></label>
                        <input type="text"
                               name="faqs[${faqIndex}][question]"
                               class="form-control custom-input"
                               placeholder="Enter question"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Answer <span>*</span></label>
                        <textarea name="faqs[${faqIndex}][answer]"
                                  class="form-control custom-textarea"
                                  rows="4"
                                  placeholder="Enter answer"
                                  required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sort Order</label>
                            <input type="number"
                                   name="faqs[${faqIndex}][sort_order]"
                                   class="form-control custom-input"
                                   value="${faqIndex}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="faqs[${faqIndex}][status]" class="form-control custom-input">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <button type="button" class="btn remove-btn removeFaq">
                        Remove
                    </button>
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
