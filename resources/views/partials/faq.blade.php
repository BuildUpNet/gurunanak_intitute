{{-- partials/faq.blade.php --}}

@php
    $faqs = collect($faqs ?? []);

    $faqTitle = $title ?? 'Frequently Asked Questions';
    $faqSubtitle = $subtitle ?? 'Quick answers to the most common questions.';

    $half = (int) ceil($faqs->count() / 2);

    $left = $faqs->slice(0, $half)->values();
    $right = $faqs->slice($half)->values();
@endphp

@if($faqs->count() > 0)
<section class="gnimt-faq section-py" aria-label="Frequently Asked Questions">
  <div class="container-fluid px-4 px-lg-5">

    <div class="text-center mb-5">
      <div class="gold-line mx-auto"></div>
      <h2 class="section-title">{{ $faqTitle }}</h2>
      <p class="section-subtitle mx-auto mt-2">{{ $faqSubtitle }}</p>
    </div>

    <div class="row g-4 justify-content-center">

      <div class="col-lg-6">
        <div class="accordion faq-accordion" id="faqLeft">
          @foreach($left as $i => $faq)
            @php
                $id = 'faq-l-' . $i;
                $question = is_array($faq) ? ($faq['q'] ?? $faq['question'] ?? '') : ($faq->question ?? '');
                $answer = is_array($faq) ? ($faq['a'] ?? $faq['answer'] ?? '') : ($faq->answer ?? '');
            @endphp

            <div class="faq-item">
              <button class="faq-q collapsed" data-bs-toggle="collapse"
                data-bs-target="#{{ $id }}" aria-expanded="false">
                <span class="faq-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <span>{{ $question }}</span>
                <i class="fas fa-chevron-down faq-icon"></i>
              </button>

              <div id="{{ $id }}" class="collapse" data-bs-parent="#faqLeft">
                <div class="faq-a">{!! $answer !!}</div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      @if($right->count() > 0)
      <div class="col-lg-6">
        <div class="accordion faq-accordion" id="faqRight">
          @foreach($right as $i => $faq)
            @php
                $id = 'faq-r-' . $i;
                $question = is_array($faq) ? ($faq['q'] ?? $faq['question'] ?? '') : ($faq->question ?? '');
                $answer = is_array($faq) ? ($faq['a'] ?? $faq['answer'] ?? '') : ($faq->answer ?? '');
            @endphp

            <div class="faq-item">
              <button class="faq-q collapsed" data-bs-toggle="collapse"
                data-bs-target="#{{ $id }}" aria-expanded="false">
                <span class="faq-num">{{ str_pad($half + $i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <span>{{ $question }}</span>
                <i class="fas fa-chevron-down faq-icon"></i>
              </button>

              <div id="{{ $id }}" class="collapse" data-bs-parent="#faqRight">
                <div class="faq-a">{!! $answer !!}</div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      @endif

    </div>

    <div class="faq-cta text-center mt-5">
      <p class="faq-cta-text">Still have questions? Our team is happy to help.</p>
      <div class="d-flex justify-content-center gap-3 flex-wrap mt-3">
        <a href="{{ route('contact.patiala') }}" class="btn faq-btn-outline">
          <i class="fas fa-envelope me-2"></i>Contact Us
        </a>
        <a href="{{ route('admissions.form') }}" class="btn faq-btn-solid">
          <i class="fas fa-paper-plane me-2"></i>Apply Now
        </a>
      </div>
    </div>

  </div>
</section>
@endif