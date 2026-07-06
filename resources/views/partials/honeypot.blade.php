{{-- Hidden anti-bot fields: real visitors never see/change these; a bot that fills the trap or submits
     instantly (before form_rendered_at + 3s) gets silently rejected server-side via HasSpamProtection::isBot() --}}
<div class="hp-trap" aria-hidden="true">
    <label for="website">Leave this field empty</label>
    <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
</div>
<input type="hidden" name="form_rendered_at" value="{{ time() }}">
