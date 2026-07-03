@extends('admin.layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/admin-faqs-edit.css') }}">
@endsection

@section('content')
    <div class="page-title mb-4">
        <h2>Edit FAQ</h2>
        <p>Update frequently asked question details</p>
    </div>

    <div class="panel-card hero-card">
        <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-section-title">
                <i class="fas fa-question-circle"></i>
                FAQ Information
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Page Name <span>*</span></label>
                    <select name="page_name" class="form-control custom-input" required>
                        <option value="">Select Page</option>
                        <option value="home" {{ old('page_name', $faq->page_name) == 'home' ? 'selected' : '' }}>Home</option>
                        <option value="about" {{ old('page_name', $faq->page_name) == 'about' ? 'selected' : '' }}>About Us</option>
                        <option value="contact" {{ old('page_name', $faq->page_name) == 'contact' ? 'selected' : '' }}>Contact Us</option>
                        <option value="admission" {{ old('page_name', $faq->page_name) == 'admission' ? 'selected' : '' }}>Admission</option>
                        <option value="gallery" {{ old('page_name', $faq->page_name) == 'gallery' ? 'selected' : '' }}>Gallery</option>
                        <option value="placement" {{ old('page_name', $faq->page_name) == 'placement' ? 'selected' : '' }}>Placement</option>
                        <option value="anti_ragging" {{ old('page_name', $faq->page_name) == 'anti_ragging' ? 'selected' : '' }}>Anti-Ragging Policy</option>
                    </select>

                    @error('page_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-section-title mt-4">
                <i class="fas fa-list"></i>
                Update FAQ
            </div>

            <div class="faq-box mb-3">
                <div class="mb-3">
                    <label class="form-label">Question <span>*</span></label>
                    <input type="text"
                           name="question"
                           value="{{ old('question', $faq->question) }}"
                           class="form-control custom-input"
                           placeholder="Enter question"
                           required>

                    @error('question')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Answer <span>*</span></label>
                    <textarea name="answer"
                              class="form-control custom-textarea"
                              rows="4"
                              placeholder="Enter answer"
                              required>{{ old('answer', $faq->answer) }}</textarea>

                    @error('answer')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number"
                               name="sort_order"
                               value="{{ old('sort_order', $faq->sort_order) }}"
                               class="form-control custom-input">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control custom-input">
                            <option value="1" {{ old('status', $faq->status) == 1 ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="0" {{ old('status', $faq->status) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn save-btn">
                    <i class="fas fa-save"></i> Update FAQ
                </button>

                <a href="{{ route('admin.faqs.index') }}" class="btn back-btn">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </form>
    </div>

@endsection