@extends('layouts.app')

@section('title','Contact Us – GNIMT Patiala & Karnal')
@section('meta_description','Contact Guru Nanak Institute of Medical Technology. Patiala: +91-8283929908 | Karnal: +91-8150019000. Visit us for admission guidance in B.Voc & Diploma programs.')

@section('schema')
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"ContactPage",
  "name":"Contact GNIMT",
  "url":"{{ url('/contact') }}",
  "mainEntity":{"@type":"EducationalOrganization","name":"Guru Nanak Institute of Medical Technology","telephone":"+91-8283929908","email":"info@gurunanakinstitute.com"}
}
</script>
@endsection

@section('content')

<section class="page-hero" aria-label="Contact Us">
  <div class="container-fluid px-4 px-lg-5">
    <div class="gold-line"></div>
    <h1>Contact Us</h1>
    <p>We're here to help — reach out to our team at either branch</p>
  </div>
</section>

<nav class="gnimt-breadcrumb" aria-label="Breadcrumb">
  <div class="container-fluid px-4 px-lg-5">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <span class="current">Contact Us</span>
  </div>
</nav>

{{-- QUICK CONTACT CARDS --}}
<section class="section-py" style="background:var(--light);">
  <div class="container-fluid px-4 px-lg-5">
    <div class="row g-4 justify-content-center">
      @foreach([
        ['fas fa-map-marker-alt','Patiala Branch','Near Civil Hospital, Patiala, Punjab – 147001','+91-8283929908','patiala'],
        ['fas fa-phone-alt','Karnal Branch','Karnal, Haryana','+91-8150019000','karnal'],
        ['fas fa-envelope','Email Us','info@gurunanakinstitute.com',null,null],
        ['fab fa-whatsapp','WhatsApp','Chat with our counsellors instantly','+91-8283929908',null],
      ] as [$icon,$title,$info,$phone,$id])
      <div class="col-md-6 col-lg-3" @if($id) id="{{ $id }}" @endif>
        <div class="contact-info-card">
          <div class="contact-icon"><i class="{{ $icon }}" aria-hidden="true"></i></div>
          <h3>{{ $title }}</h3>
          <p>{{ $info }}</p>
          @if($phone)
          <a href="{{ str_starts_with($icon,'fab') ? 'https://wa.me/91'.preg_replace('/[^0-9]/','',$phone) : 'tel:'.preg_replace('/[^0-9]/','',$phone) }}" class="contact-link">{{ $phone }}</a>
          @else
          <a href="mailto:{{ $info }}" class="contact-link">{{ $info }}</a>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- FORM + MAP --}}
<section class="section-py">
  <div class="container-fluid px-4 px-lg-5">
    <div class="row g-5">
      <div class="col-lg-6">
        <div class="gold-line"></div>
        <h2 class="section-title mb-4">Send Us a Message</h2>
        <form action="{{ route('contact.store') }}" method="POST" novalidate class="contact-form">
          @csrf
          <div class="row g-3">
            <div class="col-sm-6">
              <label class="form-label-gnimt" for="c_name">Full Name *</label>
              <input type="text" id="c_name" name="name" class="enq-input" required autocomplete="name">
            </div>
            <div class="col-sm-6">
              <label class="form-label-gnimt" for="c_phone">Phone *</label>
              <input type="tel" id="c_phone" name="phone" class="enq-input" required autocomplete="tel">
            </div>
            <div class="col-sm-6">
              <label class="form-label-gnimt" for="c_email">Email</label>
              <input type="email" id="c_email" name="email" class="enq-input" autocomplete="email">
            </div>
            <div class="col-sm-6">
              <label class="form-label-gnimt" for="c_course">Course Interested In</label>
              <select id="c_course" name="course" class="enq-input">
                <option value="">Select Course</option>
                @foreach(['B.Voc OT Technology','B.Voc MLT','B.Voc Radiology','B.Voc Cardiac Care','B.Voc Dialysis','B.Voc Ophthalmic','B.Voc Hospital Management','B.Voc Physiotherapy','DMLT','X-Ray Technology'] as $c)
                <option>{{ $c }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12">
              <label class="form-label-gnimt" for="c_subject">Subject</label>
              <input type="text" id="c_subject" name="subject" class="enq-input">
            </div>
            <div class="col-12">
              <label class="form-label-gnimt" for="c_message">Message *</label>
              <textarea id="c_message" name="message" class="enq-input" rows="4" required></textarea>
            </div>
            <div class="col-12">
              <button type="submit" class="btn-primary-gnimt" style="padding:13px 32px;font-size:.9rem;">
                <i class="fas fa-paper-plane me-2" aria-hidden="true"></i>Send Message
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-6">
        <div class="gold-line"></div>
        <h2 class="section-title mb-4">Find Us</h2>
        <div class="map-embed mb-3" id="patiala">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3433.4!2d76.3869!3d30.3398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzDCsDIwJzIzLjMiTiA3NsKwMjMnMTMuMiJF!5e0!3m2!1sen!2sin!4v1" width="100%" height="280" style="border:0;border-radius:10px;" allowfullscreen loading="lazy" title="GNIMT Patiala Location"></iframe>
          <p class="map-label"><i class="fas fa-map-marker-alt me-1" style="color:var(--gold)" aria-hidden="true"></i><strong>Patiala Branch</strong> – Near Civil Hospital, Patiala</p>
        </div>
        <div class="map-embed" id="karnal">
          <p class="map-label"><i class="fas fa-map-marker-alt me-1" style="color:var(--gold)" aria-hidden="true"></i><strong>Karnal Branch</strong> – Karnal, Haryana</p>
          <div style="background:var(--light);border-radius:10px;padding:20px;font-size:.85rem;color:var(--muted);">
            <i class="fas fa-map me-2" aria-hidden="true"></i>Map coming soon. Call <a href="tel:8150019000" style="color:var(--gold);">+91-8150019000</a> for directions.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('styles')
<style>
.contact-info-card{background:#fff;border-radius:14px;padding:28px 22px;text-align:center;box-shadow:0 4px 20px rgba(26,53,102,.07);height:100%;border-top:3px solid var(--gold);transition:transform .22s;}
.contact-info-card:hover{transform:translateY(-4px);}
.contact-icon{width:56px;height:56px;border-radius:50%;background:rgba(232,160,32,.1);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;}
.contact-icon i{font-size:1.4rem;color:var(--gold);}
.contact-info-card h3{font-size:.95rem;font-weight:700;color:var(--navy);margin-bottom:8px;}
.contact-info-card p{font-size:.8rem;color:var(--muted);margin-bottom:8px;line-height:1.6;}
.contact-link{color:var(--gold);font-weight:700;text-decoration:none;font-size:.83rem;}
.contact-link:hover{color:var(--navy);}
.form-label-gnimt{font-size:.77rem;font-weight:600;color:var(--navy);margin-bottom:5px;display:block;}
.enq-input{width:100%;border:1.5px solid var(--border);border-radius:8px;padding:11px 15px;font-size:.84rem;font-family:'Poppins',sans-serif;color:var(--txt);outline:none;transition:border-color .2s;background:#fff;display:block;}
.enq-input:focus{border-color:var(--gold);}
.map-embed{margin-bottom:16px;}
.map-label{font-size:.82rem;color:var(--muted);margin-top:8px;}
</style>
@endsection
