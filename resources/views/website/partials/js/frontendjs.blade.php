 <!-- latest jquery-->
 <script src="{{ asset('frontend_assets/js/jquery-3.3.1.min.js') }}"></script>

 <!-- slick js-->
 <script src="{{ asset('frontend_assets/js/slick.js')}}"></script>
 <script src="{{ asset('frontend_assets/js/slick-animation.min.js') }}"></script>

 <!-- wow js-->
 <script src="{{ asset('frontend_assets/js/wow.min.js')}}"></script>

 <!-- menu js-->
 <script src="{{ asset('frontend_assets/js/menu.js')}}"></script>

 <!-- lazyload js-->
 <script src="{{ asset('frontend_assets/js/lazysizes.min.js')}}"></script>

 <!-- Bootstrap js-->
 <script src="{{ asset('frontend_assets/js/bootstrap.bundle.min.js')}}"></script>

 <!-- Bootstrap Notification js-->
 <script src="{{ asset('frontend_assets/js/bootstrap-notify.min.js')}}"></script>

 <!-- Theme js-->
 <script src="{{ asset('frontend_assets/js/theme-setting.js')}}"></script>
 <script src="{{ asset('frontend_assets/js/color-setting.js')}}"></script>
 <script src="{{ asset('frontend_assets/js/script.js') }}"></script>
 <script src="{{ asset('frontend_assets/js/custom-slick-animated.js') }}"></script>

 <!--<script src="{{ asset('frontend_assets/js/cart.js') }}"></script>-->

<style>
 .fv-invalid {
     border: 1px solid #dc3545 !important;
     box-shadow: 0 0 0 0.12rem rgba(220, 53, 69, 0.25) !important;
 }
 .fv-error {
     color: #dc3545;
     font-size: 12px;
     margin-top: 4px;
 }
</style>

<script>
 (function () {
     if (window.__globalFrontendValidationInitialized) return;
     window.__globalFrontendValidationInitialized = true;

     function markInvalid(el, msg) {
         if (!el) return;
         el.classList.add('fv-invalid');

         var next = el.nextElementSibling;
         if (!next || !next.classList || !next.classList.contains('fv-error')) {
             next = document.createElement('div');
             next.className = 'fv-error';
             el.insertAdjacentElement('afterend', next);
         }
         next.textContent = msg || 'This field is required.';
     }

     function clearInvalid(el) {
         if (!el) return;
         el.classList.remove('fv-invalid');
         var next = el.nextElementSibling;
         if (next && next.classList && next.classList.contains('fv-error')) {
             next.remove();
         }
     }

     function isEmail(val) {
         return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
     }

     function validateField(el) {
         if (!el || el.disabled || el.type === 'hidden' || el.dataset.noValidate !== undefined) {
             return true;
         }

         var value = (el.value || '').trim();
         var required = el.hasAttribute('required');
         var type = (el.type || '').toLowerCase();

         if (required) {
             if (type === 'checkbox' || type === 'radio') {
                 var form = el.form || document;
                 var selector = 'input[name="' + el.name + '"]:checked';
                 if (!form.querySelector(selector)) {
                     markInvalid(el, 'Please select an option.');
                     return false;
                 }
             } else if (value === '') {
                 markInvalid(el, 'This field is required.');
                 return false;
             }
         }

         if (type === 'email' && value !== '' && !isEmail(value)) {
             markInvalid(el, 'Enter a valid email.');
             return false;
         }

         if (el.hasAttribute('pattern') && value !== '') {
             try {
                 var re = new RegExp('^(?:' + el.getAttribute('pattern') + ')$');
                 if (!re.test(value)) {
                     markInvalid(el, 'Invalid format.');
                     return false;
                 }
             } catch (e) {}
         }

         clearInvalid(el);
         return true;
     }

     function validateForm(form) {
         if (!form || form.noValidate || form.dataset.noValidate !== undefined) return true;

         var fields = form.querySelectorAll('input, select, textarea');
         var firstInvalid = null;
         var ok = true;

         fields.forEach(function (el) {
             if (!validateField(el)) {
                 ok = false;
                 if (!firstInvalid) firstInvalid = el;
             }
         });

         if (!ok && firstInvalid) firstInvalid.focus();
         return ok;
     }

     document.addEventListener('submit', function (e) {
         var form = e.target;
         if (form && form.tagName === 'FORM' && !validateForm(form)) {
             e.preventDefault();
             e.stopPropagation();
         }
     }, true);

     document.addEventListener('input', function (e) {
         var el = e.target;
         if (el && (el.matches('input') || el.matches('textarea'))) {
             validateField(el);
         }
     }, true);

     document.addEventListener('change', function (e) {
         var el = e.target;
         if (el && (el.matches('select') || el.matches('input[type="checkbox"]') || el.matches('input[type="radio"]'))) {
             validateField(el);
         }
     }, true);
 })();
</script>
