{{-- partials/footer.blade.php --}}
<footer class="site-footer" role="contentinfo">
  <div class="footer-accent"></div>

  <div class="footer-main">
    <div class="container-fluid px-4 px-lg-5">
      <div class="row g-5">

        {{-- COL 1: Brand + Contact --}}
        <div class="col-lg-3 col-md-6">
          <div class="footer-logo">
            <img src="https://www.gurunanakinstitute.com/wp-content/themes/GNIMT/images/logo.png" alt="Guru Nanak Institute of Medical Technology" width="68" loading="lazy">
            {{-- <img src="{{ asset('images/logo.png') }}" alt="Guru Nanak Institute of Medical Technology" width="68" loading="lazy"> --}}
          </div>
          <div class="footer-brand-name">Guru Nanak Institute<br>of Medical Technology</div>
          <div class="footer-tagline">UGC Recognised &nbsp;|&nbsp; Est. 1991</div>
          <p class="footer-about">
            A premier institution in medical technology education, producing skilled healthcare professionals for top hospitals across India and abroad.
          </p>
          <address class="footer-contacts" style="font-style:normal;">
            <div class="fc-row"><i class="fas fa-map-marker-alt" aria-hidden="true"></i><span>Near Civil Hospital, Patiala, Punjab – 147001</span></div>
            <div class="fc-row"><i class="fas fa-map-marker-alt" aria-hidden="true"></i><span>Karnal Branch, Haryana</span></div>
            <div class="fc-row"><i class="fas fa-phone-alt" aria-hidden="true"></i>
              <div>
                <a href="tel:8283929908">+91-8283929908</a> (Patiala)<br>
                <a href="tel:8150019000">+91-8150019000</a> (Karnal)
              </div>
            </div>
            <div class="fc-row"><i class="fas fa-envelope" aria-hidden="true"></i>
              <a href="mailto:info@gurunanakinstitute.com">info@gurunanakinstitute.com</a>
            </div>
          </address>
          <div class="footer-social" aria-label="Social Media Links">
            <a href="https://www.facebook.com/Guru-Nanak-Institute-of-Medical-Technology-689772771089266" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
            <a href="https://www.instagram.com/gnimtpatiala/" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
            <a href="#" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a>
            <a href="#" target="_blank" rel="noopener" aria-label="Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
            <a href="https://wa.me/918283929908" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
          </div>
        </div>

        {{-- COL 2: Quick Links --}}
        <div class="col-lg-2 col-md-6 col-sm-6">
          <h3 class="f-col-head">Quick Links</h3>
          <ul class="f-links">
            <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right" aria-hidden="true"></i>Home</a></li>
            <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right" aria-hidden="true"></i>About Us</a></li>
            <li><a href="{{ route('academics') }}"><i class="fas fa-chevron-right" aria-hidden="true"></i>All Courses</a></li>
            <li><a href="{{ route('admissions') }}"><i class="fas fa-chevron-right" aria-hidden="true"></i>Admissions</a></li>
            <li><a href="{{ route('gallery') }}"><i class="fas fa-chevron-right" aria-hidden="true"></i>Gallery</a></li>
            <li><a href="{{ route('achievers') }}"><i class="fas fa-chevron-right" aria-hidden="true"></i>Our Achievers</a></li>
            <li><a href="{{ route('results') }}"><i class="fas fa-chevron-right" aria-hidden="true"></i>Results</a></li>
            <li><a href="{{ route('contact') }}"><i class="fas fa-chevron-right" aria-hidden="true"></i>Contact Us</a></li>
            <li><a href="{{ route('news') }}"><i class="fas fa-chevron-right" aria-hidden="true"></i>News & Events</a></li>
          </ul>
        </div>

        {{-- COL 3: Courses --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
          <h3 class="f-col-head">Our Courses</h3>
          <ul class="f-links">
            @foreach([
              ['B.Voc Operation Theatre Technology','operation-theatre-technology'],
              ['B.Voc Medical Lab Technology','medical-lab-technology'],
              ['B.Voc Ophthalmic Technology','ophthalmic-technology'],
              ['B.Voc Cardiac Care Technology','cardiac-care-technology'],
              ['B.Voc Radiology & Imaging','radiology-imaging-technology'],
              ['DMLT – Medical Lab Technology','medical-lab-technology'],
              ['X-Ray Technology Diploma','radiology-imaging-technology'],
              ['Hospital Management','hospital-management'],
              ['B.Voc Physiotherapy','physiotherapy'],
            ] as [$label,$slug])
              <li>
                <a href="{{ route('courses.show', $slug) }}">
                  <i class="fas fa-chevron-right" aria-hidden="true"></i>{{ $label }}
                </a>
              </li>
            @endforeach
          </ul>
          <div class="mt-3" aria-label="Other programs">
            <a href="{{ route('academics') }}#other" class="f-course-badge">Cath Lab</a>
            <a href="{{ route('academics') }}#other" class="f-course-badge">ECG</a>
            <a href="{{ route('academics') }}#other" class="f-course-badge">Nanny Course</a>
            <a href="{{ route('academics') }}#other" class="f-course-badge">First Aid</a>
          </div>
        </div>

        {{-- COL 4: Portals + Branches --}}
        <div class="col-lg-2 col-md-6">
          <h3 class="f-col-head">Student Portals</h3>
          <ul class="f-links">
            <li><a href="https://portal.gurunanakinstitute.com/admin/login"><i class="fas fa-user-shield" aria-hidden="true"></i>Admin Login</a></li>
            <li><a href="https://portal.gurunanakinstitute.com/student/login"><i class="fas fa-user-graduate" aria-hidden="true"></i>Student Login</a></li>
            <li><a href="https://portal.gurunanakinstitute.com/branch/login"><i class="fas fa-building" aria-hidden="true"></i>Branch Login</a></li>
            <li><a href="https://portal.gurunanakinstitute.com/branch/staff/login"><i class="fas fa-users" aria-hidden="true"></i>Staff Login</a></li>
          </ul>
          <h3 class="f-col-head mt-4">Our Branches</h3>
          <ul class="f-links">
            <li><a href="{{ route('contact') }}#patiala"><i class="fas fa-map-pin" aria-hidden="true"></i>Patiala Branch</a></li>
            <li><a href="{{ route('contact') }}#karnal"><i class="fas fa-map-pin" aria-hidden="true"></i>Karnal Branch</a></li>
          </ul>
        </div>

        {{-- COL 5: Quick Enquiry --}}
        <div class="col-lg-2 col-md-6">
          <h3 class="f-col-head">Quick Enquiry</h3>
          <div class="footer-enquire">
            <h4><i class="fas fa-headset me-2" style="color:var(--gold)" aria-hidden="true"></i>We're Here to Help</h4>
            <p>Drop your details — our counsellor will call you back.</p>
            <form class="f-enq-form" action="{{ route('enquiry.store') }}" method="POST" novalidate>
              @csrf
              <input type="text" name="name" placeholder="Your Name" required autocomplete="name" aria-label="Your Name">
              <input type="tel" name="phone" placeholder="Phone Number" required autocomplete="tel" aria-label="Phone Number">
              <button type="submit"><i class="fas fa-paper-plane me-1" aria-hidden="true"></i> Send</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

  <hr class="footer-divider">

  <div class="container-fluid px-4 px-lg-5">
    <div class="footer-bottom">
      <div>&copy; <span id="fyear"></span> Guru Nanak Institute of Medical Technology. All Rights Reserved.</div>
      <nav class="footer-bottom-links" aria-label="Footer legal links">
        <a href="{{ route('privacy') }}">Privacy Policy</a>
        <a href="{{ route('terms') }}">Terms of Use</a>
        <a href="{{ route('disclaimer') }}">Disclaimer</a>
        <a href="{{ url('sitemap.xml') }}">Sitemap</a>
      </nav>
      <a href="#main-content" class="back-top" aria-label="Back to top"><i class="fas fa-chevron-up" aria-hidden="true"></i></a>
    </div>
  </div>
</footer>

<script>document.getElementById('fyear').textContent=new Date().getFullYear();</script>
