	 @extends('app_template')
	 @section('title','Checkout Page')
	 @section('content')
	 <div class="woo-page-header">
	     <div class="">
	         <ul class="breadcrumb">
	             <li class="">
	                 <a href="#">Shopping Cart</a>
	             </li>
	             <li class="current">
	                 <i class="delimiter"></i>
	                 <a href="#">Checkout</a>
	             </li>
	             <li class="disable">
	                 <i class="delimiter"></i>
	                 <a href="#">Order Complete</a>
	             </li>
	         </ul>
	     </div>
	 </div>


	 <main id="main" class="main pt-lg">

	     <div class="page-content">

	         <div class="container">
	             <div class="main-content-wrap">
	                 <div class="main-content">
	                     <div class="woocommerce">
	                         <div class="woocommerce-notices-wrapper"></div>
	                         <div class="woocommerce-form-login-toggle">
	                             Returning customer? <a href="#" class="showlogin">Login</a></div>
	                         <form class="woocommerce-form woocommerce-form-login login" method="post" style="display:none;">


	                             <p>If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.</p>

	                             <p class="form-row form-row-first">
	                                 <label for="username">Username or email&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Required</span></label>
	                                 <input type="text" class="input-text" name="username" id="username" autocomplete="username" required aria-required="true" />
	                             </p>
	                             <p class="form-row form-row-last">
	                                 <label for="password">Password&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Required</span></label>
	                                 <input class="input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true" />
	                             </p>
	                             <div class="clear"></div>


	                             <div class="form-row form-footer">
	                                 <div class="custom-input">
	                                     <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
	                                     <label for="rememberme">Remember me</label>
	                                 </div>
	                                 <p class="lost_password">
	                                     <a href="#">Lost your password?</a>
	                                 </p>
	                             </div>

	                             <input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="8509bcd82c" /><input type="hidden" name="_wp_http_referer" value="/wordpress/wolmart/demo-1/checkout/" /> <input type="hidden" name="redirect" value="#" />
	                             <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="Login">Login</button>

	                             <div class="clear"></div>


	                         </form>
	                         <div class="woocommerce-form-coupon-toggle">
	                             Have a coupon? <a href="#" class="showcoupon">Enter your code</a></div>

	                         <form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">

	                             <p>If you have a coupon code, please apply it below.</p>

	                             <div class="form-row form-coupon">
	                                 <input type="text" name="coupon_code" class="input-text form-control" placeholder="Coupon code" id="coupon_code" value="" />
	                                 <button type="submit" class="btn button btn-rounded btn-default" name="apply_coupon" value="Apply coupon">Apply coupon</button>
	                             </div>

	                             <div class="clear"></div>
	                         </form>
	                         <div class="woocommerce-notices-wrapper"></div>
	                         <form name="checkout" method="post" class="checkout woocommerce-checkout" action="#" enctype="multipart/form-data" aria-label="Checkout">

	                             <div class="row gutter-md">
	                                 <div class="col-lg-7 pr-lg-4 mb-6">


	                                     <div id="customer_details" class="pt-2">
	                                         <wc-order-attribution-inputs></wc-order-attribution-inputs>
	                                         <div class="woocommerce-billing-fields">

	                                             <h3>Billing details</h3>



	                                             <div class="woocommerce-billing-fields__field-wrapper row gutter-sm">
	                                                 <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10"><label for="billing_first_name" class="required_field">First name&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_first_name" id="billing_first_name" placeholder="" value="" rows="5" aria-required="true" autocomplete="given-name" /></span></p>
	                                                 <p class="form-row form-row-last validate-required" id="billing_last_name_field" data-priority="20"><label for="billing_last_name" class="required_field">Last name&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_last_name" id="billing_last_name" placeholder="" value="" rows="5" aria-required="true" autocomplete="family-name" /></span></p>
	                                                 <p class="form-row form-row-wide" id="billing_company_field" data-priority="30"><label for="billing_company" class="">Company name&nbsp;<span class="optional">(optional)</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_company" id="billing_company" placeholder="" value="" rows="5" autocomplete="organization" /></span></p>
	                                                 <p class="form-row form-row-wide address-field update_totals_on_change validate-required" id="billing_country_field" data-priority="40"><label for="billing_country" class="required_field">Country / Region&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><select name="billing_country" id="billing_country" class="country_to_state country_select " rows="5" aria-required="true" autocomplete="country" data-placeholder="Select a country / region&hellip;" data-label="Country / Region">
	                                                             <option value="">Select a country / region&hellip;</option>
	                                                             <option value="AF">Afghanistan</option>
	                                                             <option value="AX">Åland Islands</option>
	                                                             <option value="AL">Albania</option>
	                                                             <option value="DZ">Algeria</option>
	                                                             <option value="AS">American Samoa</option>
	                                                             <option value="AD">Andorra</option>
	                                                             <option value="AO">Angola</option>
	                                                             <option value="AI">Anguilla</option>
	                                                             <option value="AQ">Antarctica</option>
	                                                             <option value="AG">Antigua and Barbuda</option>
	                                                             <option value="AR">Argentina</option>
	                                                             <option value="AM">Armenia</option>
	                                                             <option value="AW">Aruba</option>
	                                                             <option value="AU">Australia</option>
	                                                             <option value="AT">Austria</option>
	                                                             <option value="AZ">Azerbaijan</option>
	                                                             <option value="BS">Bahamas</option>
	                                                             <option value="BH">Bahrain</option>
	                                                             <option value="BD">Bangladesh</option>
	                                                             <option value="BB">Barbados</option>
	                                                             <option value="BY">Belarus</option>
	                                                             <option value="PW">Belau</option>
	                                                             <option value="BE">Belgium</option>
	                                                             <option value="BZ">Belize</option>
	                                                             <option value="BJ">Benin</option>
	                                                             <option value="BM">Bermuda</option>
	                                                             <option value="BT">Bhutan</option>
	                                                             <option value="BO">Bolivia</option>
	                                                             <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
	                                                             <option value="BA">Bosnia and Herzegovina</option>
	                                                             <option value="BW">Botswana</option>
	                                                             <option value="BV">Bouvet Island</option>
	                                                             <option value="BR">Brazil</option>
	                                                             <option value="IO">British Indian Ocean Territory</option>
	                                                             <option value="BN">Brunei</option>
	                                                             <option value="BG">Bulgaria</option>
	                                                             <option value="BF">Burkina Faso</option>
	                                                             <option value="BI">Burundi</option>
	                                                             <option value="KH">Cambodia</option>
	                                                             <option value="CM">Cameroon</option>
	                                                             <option value="CA">Canada</option>
	                                                             <option value="CV">Cape Verde</option>
	                                                             <option value="KY">Cayman Islands</option>
	                                                             <option value="CF">Central African Republic</option>
	                                                             <option value="TD">Chad</option>
	                                                             <option value="CL">Chile</option>
	                                                             <option value="CN">China</option>
	                                                             <option value="CX">Christmas Island</option>
	                                                             <option value="CC">Cocos (Keeling) Islands</option>
	                                                             <option value="CO">Colombia</option>
	                                                             <option value="KM">Comoros</option>
	                                                             <option value="CG">Congo (Brazzaville)</option>
	                                                             <option value="CD">Congo (Kinshasa)</option>
	                                                             <option value="CK">Cook Islands</option>
	                                                             <option value="CR">Costa Rica</option>
	                                                             <option value="HR">Croatia</option>
	                                                             <option value="CU">Cuba</option>
	                                                             <option value="CW">Cura&ccedil;ao</option>
	                                                             <option value="CY">Cyprus</option>
	                                                             <option value="CZ">Czech Republic</option>
	                                                             <option value="DK">Denmark</option>
	                                                             <option value="DJ">Djibouti</option>
	                                                             <option value="DM">Dominica</option>
	                                                             <option value="DO">Dominican Republic</option>
	                                                             <option value="EC">Ecuador</option>
	                                                             <option value="EG">Egypt</option>
	                                                             <option value="SV">El Salvador</option>
	                                                             <option value="GQ">Equatorial Guinea</option>
	                                                             <option value="ER">Eritrea</option>
	                                                             <option value="EE">Estonia</option>
	                                                             <option value="SZ">Eswatini</option>
	                                                             <option value="ET">Ethiopia</option>
	                                                             <option value="FK">Falkland Islands</option>
	                                                             <option value="FO">Faroe Islands</option>
	                                                             <option value="FJ">Fiji</option>
	                                                             <option value="FI">Finland</option>
	                                                             <option value="FR">France</option>
	                                                             <option value="GF">French Guiana</option>
	                                                             <option value="PF">French Polynesia</option>
	                                                             <option value="TF">French Southern Territories</option>
	                                                             <option value="GA">Gabon</option>
	                                                             <option value="GM">Gambia</option>
	                                                             <option value="GE">Georgia</option>
	                                                             <option value="DE">Germany</option>
	                                                             <option value="GH">Ghana</option>
	                                                             <option value="GI">Gibraltar</option>
	                                                             <option value="GR">Greece</option>
	                                                             <option value="GL">Greenland</option>
	                                                             <option value="GD">Grenada</option>
	                                                             <option value="GP">Guadeloupe</option>
	                                                             <option value="GU">Guam</option>
	                                                             <option value="GT">Guatemala</option>
	                                                             <option value="GG">Guernsey</option>
	                                                             <option value="GN">Guinea</option>
	                                                             <option value="GW">Guinea-Bissau</option>
	                                                             <option value="GY">Guyana</option>
	                                                             <option value="HT">Haiti</option>
	                                                             <option value="HM">Heard Island and McDonald Islands</option>
	                                                             <option value="HN">Honduras</option>
	                                                             <option value="HK">Hong Kong</option>
	                                                             <option value="HU">Hungary</option>
	                                                             <option value="IS">Iceland</option>
	                                                             <option value="IN">India</option>
	                                                             <option value="ID">Indonesia</option>
	                                                             <option value="IR">Iran</option>
	                                                             <option value="IQ">Iraq</option>
	                                                             <option value="IE">Ireland</option>
	                                                             <option value="IM">Isle of Man</option>
	                                                             <option value="IL">Israel</option>
	                                                             <option value="IT">Italy</option>
	                                                             <option value="CI">Ivory Coast</option>
	                                                             <option value="JM">Jamaica</option>
	                                                             <option value="JP">Japan</option>
	                                                             <option value="JE">Jersey</option>
	                                                             <option value="JO">Jordan</option>
	                                                             <option value="KZ">Kazakhstan</option>
	                                                             <option value="KE">Kenya</option>
	                                                             <option value="KI">Kiribati</option>
	                                                             <option value="KW">Kuwait</option>
	                                                             <option value="KG">Kyrgyzstan</option>
	                                                             <option value="LA">Laos</option>
	                                                             <option value="LV">Latvia</option>
	                                                             <option value="LB">Lebanon</option>
	                                                             <option value="LS">Lesotho</option>
	                                                             <option value="LR">Liberia</option>
	                                                             <option value="LY">Libya</option>
	                                                             <option value="LI">Liechtenstein</option>
	                                                             <option value="LT">Lithuania</option>
	                                                             <option value="LU">Luxembourg</option>
	                                                             <option value="MO">Macao</option>
	                                                             <option value="MG">Madagascar</option>
	                                                             <option value="MW">Malawi</option>
	                                                             <option value="MY">Malaysia</option>
	                                                             <option value="MV">Maldives</option>
	                                                             <option value="ML">Mali</option>
	                                                             <option value="MT">Malta</option>
	                                                             <option value="MH">Marshall Islands</option>
	                                                             <option value="MQ">Martinique</option>
	                                                             <option value="MR">Mauritania</option>
	                                                             <option value="MU">Mauritius</option>
	                                                             <option value="YT">Mayotte</option>
	                                                             <option value="MX">Mexico</option>
	                                                             <option value="FM">Micronesia</option>
	                                                             <option value="MD">Moldova</option>
	                                                             <option value="MC">Monaco</option>
	                                                             <option value="MN">Mongolia</option>
	                                                             <option value="ME">Montenegro</option>
	                                                             <option value="MS">Montserrat</option>
	                                                             <option value="MA">Morocco</option>
	                                                             <option value="MZ">Mozambique</option>
	                                                             <option value="MM">Myanmar</option>
	                                                             <option value="NA">Namibia</option>
	                                                             <option value="NR">Nauru</option>
	                                                             <option value="NP">Nepal</option>
	                                                             <option value="NL">Netherlands</option>
	                                                             <option value="NC">New Caledonia</option>
	                                                             <option value="NZ">New Zealand</option>
	                                                             <option value="NI">Nicaragua</option>
	                                                             <option value="NE">Niger</option>
	                                                             <option value="NG">Nigeria</option>
	                                                             <option value="NU">Niue</option>
	                                                             <option value="NF">Norfolk Island</option>
	                                                             <option value="KP">North Korea</option>
	                                                             <option value="MK">North Macedonia</option>
	                                                             <option value="MP">Northern Mariana Islands</option>
	                                                             <option value="NO">Norway</option>
	                                                             <option value="OM">Oman</option>
	                                                             <option value="PK">Pakistan</option>
	                                                             <option value="PS">Palestinian Territory</option>
	                                                             <option value="PA">Panama</option>
	                                                             <option value="PG">Papua New Guinea</option>
	                                                             <option value="PY">Paraguay</option>
	                                                             <option value="PE">Peru</option>
	                                                             <option value="PH">Philippines</option>
	                                                             <option value="PN">Pitcairn</option>
	                                                             <option value="PL">Poland</option>
	                                                             <option value="PT">Portugal</option>
	                                                             <option value="PR">Puerto Rico</option>
	                                                             <option value="QA">Qatar</option>
	                                                             <option value="RE">Reunion</option>
	                                                             <option value="RO">Romania</option>
	                                                             <option value="RU">Russia</option>
	                                                             <option value="RW">Rwanda</option>
	                                                             <option value="ST">S&atilde;o Tom&eacute; and Pr&iacute;ncipe</option>
	                                                             <option value="BL">Saint Barth&eacute;lemy</option>
	                                                             <option value="SH">Saint Helena</option>
	                                                             <option value="KN">Saint Kitts and Nevis</option>
	                                                             <option value="LC">Saint Lucia</option>
	                                                             <option value="SX">Saint Martin (Dutch part)</option>
	                                                             <option value="MF">Saint Martin (French part)</option>
	                                                             <option value="PM">Saint Pierre and Miquelon</option>
	                                                             <option value="VC">Saint Vincent and the Grenadines</option>
	                                                             <option value="WS">Samoa</option>
	                                                             <option value="SM">San Marino</option>
	                                                             <option value="SA">Saudi Arabia</option>
	                                                             <option value="SN">Senegal</option>
	                                                             <option value="RS">Serbia</option>
	                                                             <option value="SC">Seychelles</option>
	                                                             <option value="SL">Sierra Leone</option>
	                                                             <option value="SG">Singapore</option>
	                                                             <option value="SK">Slovakia</option>
	                                                             <option value="SI">Slovenia</option>
	                                                             <option value="SB">Solomon Islands</option>
	                                                             <option value="SO">Somalia</option>
	                                                             <option value="ZA">South Africa</option>
	                                                             <option value="GS">South Georgia/Sandwich Islands</option>
	                                                             <option value="KR">South Korea</option>
	                                                             <option value="SS">South Sudan</option>
	                                                             <option value="ES">Spain</option>
	                                                             <option value="LK">Sri Lanka</option>
	                                                             <option value="SD">Sudan</option>
	                                                             <option value="SR">Suriname</option>
	                                                             <option value="SJ">Svalbard and Jan Mayen</option>
	                                                             <option value="SE">Sweden</option>
	                                                             <option value="CH">Switzerland</option>
	                                                             <option value="SY">Syria</option>
	                                                             <option value="TW">Taiwan</option>
	                                                             <option value="TJ">Tajikistan</option>
	                                                             <option value="TZ">Tanzania</option>
	                                                             <option value="TH">Thailand</option>
	                                                             <option value="TL">Timor-Leste</option>
	                                                             <option value="TG">Togo</option>
	                                                             <option value="TK">Tokelau</option>
	                                                             <option value="TO">Tonga</option>
	                                                             <option value="TT">Trinidad and Tobago</option>
	                                                             <option value="TN">Tunisia</option>
	                                                             <option value="TR">Turkey</option>
	                                                             <option value="TM">Turkmenistan</option>
	                                                             <option value="TC">Turks and Caicos Islands</option>
	                                                             <option value="TV">Tuvalu</option>
	                                                             <option value="UG">Uganda</option>
	                                                             <option value="UA">Ukraine</option>
	                                                             <option value="AE">United Arab Emirates</option>
	                                                             <option value="GB" selected='selected'>United Kingdom (UK)</option>
	                                                             <option value="US">United States (US)</option>
	                                                             <option value="UM">United States (US) Minor Outlying Islands</option>
	                                                             <option value="UY">Uruguay</option>
	                                                             <option value="UZ">Uzbekistan</option>
	                                                             <option value="VU">Vanuatu</option>
	                                                             <option value="VA">Vatican</option>
	                                                             <option value="VE">Venezuela</option>
	                                                             <option value="VN">Vietnam</option>
	                                                             <option value="VG">Virgin Islands (British)</option>
	                                                             <option value="VI">Virgin Islands (US)</option>
	                                                             <option value="WF">Wallis and Futuna</option>
	                                                             <option value="EH">Western Sahara</option>
	                                                             <option value="YE">Yemen</option>
	                                                             <option value="ZM">Zambia</option>
	                                                             <option value="ZW">Zimbabwe</option>&nbsp;<span class="required" aria-hidden="true">*</span>
	                                                         </select><noscript><button type="submit" name="woocommerce_checkout_update_totals" value="Update country / region">Update country / region</button></noscript></span></p>
	                                                 <p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field" data-priority="50"><label for="billing_address_1" class="required_field">Street address&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_address_1" id="billing_address_1" placeholder="House number and street name" value="" rows="5" aria-required="true" autocomplete="address-line1" /></span></p>
	                                                 <p class="form-row form-row-wide address-field" id="billing_address_2_field" data-priority="60"><label for="billing_address_2" class="screen-reader-text">Apartment, suite, unit, etc.&nbsp;<span class="optional">(optional)</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_address_2" id="billing_address_2" placeholder="Apartment, suite, unit, etc. (optional)" value="" rows="5" autocomplete="address-line2" /></span></p>
	                                                 <p class="form-row form-row-first address-field validate-required" id="billing_city_field" data-priority="70"><label for="billing_city" class="required_field">Town / City&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_city" id="billing_city" placeholder="" value="" rows="5" aria-required="true" autocomplete="address-level2" /></span></p>
	                                                 <p class="form-row form-row-last address-field validate-state" id="billing_state_field" data-priority="80"><label for="billing_state" class="">County&nbsp;<span class="optional">(optional)</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " value="" placeholder="" name="billing_state" id="billing_state" rows="5" autocomplete="address-level1" data-input-classes="" /></span></p>
	                                                 <p class="form-row form-row-first address-field validate-required validate-postcode" id="billing_postcode_field" data-priority="90"><label for="billing_postcode" class="required_field">Postcode&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_postcode" id="billing_postcode" placeholder="" value="" rows="5" aria-required="true" autocomplete="postal-code" /></span></p>
	                                                 <p class="form-row form-row-last validate-required validate-phone" id="billing_phone_field" data-priority="100"><label for="billing_phone" class="required_field">Phone&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><input type="tel" class="input-text " name="billing_phone" id="billing_phone" placeholder="" value="" rows="5" aria-required="true" autocomplete="tel" /></span></p>
	                                                 <p class="form-row form-row-wide validate-required validate-email" id="billing_email_field" data-priority="110"><label for="billing_email" class="required_field">Email address&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><input type="email" class="input-text " name="billing_email" id="billing_email" placeholder="" value="" rows="5" aria-required="true" autocomplete="email" /></span></p>
	                                             </div>

	                                         </div>

	                                         <div class="woocommerce-shipping-fields">

	                                             <h3 id="ship-to-different-address">
	                                                 <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox custom-input">
	                                                     <input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" type="checkbox" name="ship_to_different_address" value="1" /> <span>Ship to a different address?</span>
	                                                 </label>
	                                             </h3>

	                                             <div class="shipping_address">


	                                                 <div class="woocommerce-shipping-fields__field-wrapper row">
	                                                     <p class="form-row form-row-first validate-required" id="shipping_first_name_field" data-priority="10"><label for="shipping_first_name" class="required_field">First name&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_first_name" id="shipping_first_name" placeholder="" value="" rows="5" aria-required="true" autocomplete="given-name" /></span></p>
	                                                     <p class="form-row form-row-last validate-required" id="shipping_last_name_field" data-priority="20"><label for="shipping_last_name" class="required_field">Last name&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_last_name" id="shipping_last_name" placeholder="" value="" rows="5" aria-required="true" autocomplete="family-name" /></span></p>
	                                                     <p class="form-row form-row-wide" id="shipping_company_field" data-priority="30"><label for="shipping_company" class="">Company name&nbsp;<span class="optional">(optional)</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_company" id="shipping_company" placeholder="" value="" rows="5" autocomplete="organization" /></span></p>
	                                                     <p class="form-row form-row-wide address-field update_totals_on_change validate-required" id="shipping_country_field" data-priority="40"><label for="shipping_country" class="required_field">Country / Region&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><select name="shipping_country" id="shipping_country" class="country_to_state country_select " rows="5" aria-required="true" autocomplete="country" data-placeholder="Select a country / region&hellip;" data-label="Country / Region">
	                                                                 <option value="">Select a country / region&hellip;</option>
	                                                                 <option value="AF">Afghanistan</option>
	                                                                 <option value="AX">Åland Islands</option>
	                                                                 <option value="AL">Albania</option>
	                                                                 <option value="DZ">Algeria</option>
	                                                                 <option value="AS">American Samoa</option>
	                                                                 <option value="AD">Andorra</option>
	                                                                 <option value="AO">Angola</option>
	                                                                 <option value="AI">Anguilla</option>
	                                                                 <option value="AQ">Antarctica</option>
	                                                                 <option value="AG">Antigua and Barbuda</option>
	                                                                 <option value="AR">Argentina</option>
	                                                                 <option value="AM">Armenia</option>
	                                                                 <option value="AW">Aruba</option>
	                                                                 <option value="AU">Australia</option>
	                                                                 <option value="AT">Austria</option>
	                                                                 <option value="AZ">Azerbaijan</option>
	                                                                 <option value="BS">Bahamas</option>
	                                                                 <option value="BH">Bahrain</option>
	                                                                 <option value="BD">Bangladesh</option>
	                                                                 <option value="BB">Barbados</option>
	                                                                 <option value="BY">Belarus</option>
	                                                                 <option value="PW">Belau</option>
	                                                                 <option value="BE">Belgium</option>
	                                                                 <option value="BZ">Belize</option>
	                                                                 <option value="BJ">Benin</option>
	                                                                 <option value="BM">Bermuda</option>
	                                                                 <option value="BT">Bhutan</option>
	                                                                 <option value="BO">Bolivia</option>
	                                                                 <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
	                                                                 <option value="BA">Bosnia and Herzegovina</option>
	                                                                 <option value="BW">Botswana</option>
	                                                                 <option value="BV">Bouvet Island</option>
	                                                                 <option value="BR">Brazil</option>
	                                                                 <option value="IO">British Indian Ocean Territory</option>
	                                                                 <option value="BN">Brunei</option>
	                                                                 <option value="BG">Bulgaria</option>
	                                                                 <option value="BF">Burkina Faso</option>
	                                                                 <option value="BI">Burundi</option>
	                                                                 <option value="KH">Cambodia</option>
	                                                                 <option value="CM">Cameroon</option>
	                                                                 <option value="CA">Canada</option>
	                                                                 <option value="CV">Cape Verde</option>
	                                                                 <option value="KY">Cayman Islands</option>
	                                                                 <option value="CF">Central African Republic</option>
	                                                                 <option value="TD">Chad</option>
	                                                                 <option value="CL">Chile</option>
	                                                                 <option value="CN">China</option>
	                                                                 <option value="CX">Christmas Island</option>
	                                                                 <option value="CC">Cocos (Keeling) Islands</option>
	                                                                 <option value="CO">Colombia</option>
	                                                                 <option value="KM">Comoros</option>
	                                                                 <option value="CG">Congo (Brazzaville)</option>
	                                                                 <option value="CD">Congo (Kinshasa)</option>
	                                                                 <option value="CK">Cook Islands</option>
	                                                                 <option value="CR">Costa Rica</option>
	                                                                 <option value="HR">Croatia</option>
	                                                                 <option value="CU">Cuba</option>
	                                                                 <option value="CW">Cura&ccedil;ao</option>
	                                                                 <option value="CY">Cyprus</option>
	                                                                 <option value="CZ">Czech Republic</option>
	                                                                 <option value="DK">Denmark</option>
	                                                                 <option value="DJ">Djibouti</option>
	                                                                 <option value="DM">Dominica</option>
	                                                                 <option value="DO">Dominican Republic</option>
	                                                                 <option value="EC">Ecuador</option>
	                                                                 <option value="EG">Egypt</option>
	                                                                 <option value="SV">El Salvador</option>
	                                                                 <option value="GQ">Equatorial Guinea</option>
	                                                                 <option value="ER">Eritrea</option>
	                                                                 <option value="EE">Estonia</option>
	                                                                 <option value="SZ">Eswatini</option>
	                                                                 <option value="ET">Ethiopia</option>
	                                                                 <option value="FK">Falkland Islands</option>
	                                                                 <option value="FO">Faroe Islands</option>
	                                                                 <option value="FJ">Fiji</option>
	                                                                 <option value="FI">Finland</option>
	                                                                 <option value="FR">France</option>
	                                                                 <option value="GF">French Guiana</option>
	                                                                 <option value="PF">French Polynesia</option>
	                                                                 <option value="TF">French Southern Territories</option>
	                                                                 <option value="GA">Gabon</option>
	                                                                 <option value="GM">Gambia</option>
	                                                                 <option value="GE">Georgia</option>
	                                                                 <option value="DE">Germany</option>
	                                                                 <option value="GH">Ghana</option>
	                                                                 <option value="GI">Gibraltar</option>
	                                                                 <option value="GR">Greece</option>
	                                                                 <option value="GL">Greenland</option>
	                                                                 <option value="GD">Grenada</option>
	                                                                 <option value="GP">Guadeloupe</option>
	                                                                 <option value="GU">Guam</option>
	                                                                 <option value="GT">Guatemala</option>
	                                                                 <option value="GG">Guernsey</option>
	                                                                 <option value="GN">Guinea</option>
	                                                                 <option value="GW">Guinea-Bissau</option>
	                                                                 <option value="GY">Guyana</option>
	                                                                 <option value="HT">Haiti</option>
	                                                                 <option value="HM">Heard Island and McDonald Islands</option>
	                                                                 <option value="HN">Honduras</option>
	                                                                 <option value="HK">Hong Kong</option>
	                                                                 <option value="HU">Hungary</option>
	                                                                 <option value="IS">Iceland</option>
	                                                                 <option value="IN">India</option>
	                                                                 <option value="ID">Indonesia</option>
	                                                                 <option value="IR">Iran</option>
	                                                                 <option value="IQ">Iraq</option>
	                                                                 <option value="IE">Ireland</option>
	                                                                 <option value="IM">Isle of Man</option>
	                                                                 <option value="IL">Israel</option>
	                                                                 <option value="IT">Italy</option>
	                                                                 <option value="CI">Ivory Coast</option>
	                                                                 <option value="JM">Jamaica</option>
	                                                                 <option value="JP">Japan</option>
	                                                                 <option value="JE">Jersey</option>
	                                                                 <option value="JO">Jordan</option>
	                                                                 <option value="KZ">Kazakhstan</option>
	                                                                 <option value="KE">Kenya</option>
	                                                                 <option value="KI">Kiribati</option>
	                                                                 <option value="KW">Kuwait</option>
	                                                                 <option value="KG">Kyrgyzstan</option>
	                                                                 <option value="LA">Laos</option>
	                                                                 <option value="LV">Latvia</option>
	                                                                 <option value="LB">Lebanon</option>
	                                                                 <option value="LS">Lesotho</option>
	                                                                 <option value="LR">Liberia</option>
	                                                                 <option value="LY">Libya</option>
	                                                                 <option value="LI">Liechtenstein</option>
	                                                                 <option value="LT">Lithuania</option>
	                                                                 <option value="LU">Luxembourg</option>
	                                                                 <option value="MO">Macao</option>
	                                                                 <option value="MG">Madagascar</option>
	                                                                 <option value="MW">Malawi</option>
	                                                                 <option value="MY">Malaysia</option>
	                                                                 <option value="MV">Maldives</option>
	                                                                 <option value="ML">Mali</option>
	                                                                 <option value="MT">Malta</option>
	                                                                 <option value="MH">Marshall Islands</option>
	                                                                 <option value="MQ">Martinique</option>
	                                                                 <option value="MR">Mauritania</option>
	                                                                 <option value="MU">Mauritius</option>
	                                                                 <option value="YT">Mayotte</option>
	                                                                 <option value="MX">Mexico</option>
	                                                                 <option value="FM">Micronesia</option>
	                                                                 <option value="MD">Moldova</option>
	                                                                 <option value="MC">Monaco</option>
	                                                                 <option value="MN">Mongolia</option>
	                                                                 <option value="ME">Montenegro</option>
	                                                                 <option value="MS">Montserrat</option>
	                                                                 <option value="MA">Morocco</option>
	                                                                 <option value="MZ">Mozambique</option>
	                                                                 <option value="MM">Myanmar</option>
	                                                                 <option value="NA">Namibia</option>
	                                                                 <option value="NR">Nauru</option>
	                                                                 <option value="NP">Nepal</option>
	                                                                 <option value="NL">Netherlands</option>
	                                                                 <option value="NC">New Caledonia</option>
	                                                                 <option value="NZ">New Zealand</option>
	                                                                 <option value="NI">Nicaragua</option>
	                                                                 <option value="NE">Niger</option>
	                                                                 <option value="NG">Nigeria</option>
	                                                                 <option value="NU">Niue</option>
	                                                                 <option value="NF">Norfolk Island</option>
	                                                                 <option value="KP">North Korea</option>
	                                                                 <option value="MK">North Macedonia</option>
	                                                                 <option value="MP">Northern Mariana Islands</option>
	                                                                 <option value="NO">Norway</option>
	                                                                 <option value="OM">Oman</option>
	                                                                 <option value="PK">Pakistan</option>
	                                                                 <option value="PS">Palestinian Territory</option>
	                                                                 <option value="PA">Panama</option>
	                                                                 <option value="PG">Papua New Guinea</option>
	                                                                 <option value="PY">Paraguay</option>
	                                                                 <option value="PE">Peru</option>
	                                                                 <option value="PH">Philippines</option>
	                                                                 <option value="PN">Pitcairn</option>
	                                                                 <option value="PL">Poland</option>
	                                                                 <option value="PT">Portugal</option>
	                                                                 <option value="PR">Puerto Rico</option>
	                                                                 <option value="QA">Qatar</option>
	                                                                 <option value="RE">Reunion</option>
	                                                                 <option value="RO">Romania</option>
	                                                                 <option value="RU">Russia</option>
	                                                                 <option value="RW">Rwanda</option>
	                                                                 <option value="ST">S&atilde;o Tom&eacute; and Pr&iacute;ncipe</option>
	                                                                 <option value="BL">Saint Barth&eacute;lemy</option>
	                                                                 <option value="SH">Saint Helena</option>
	                                                                 <option value="KN">Saint Kitts and Nevis</option>
	                                                                 <option value="LC">Saint Lucia</option>
	                                                                 <option value="SX">Saint Martin (Dutch part)</option>
	                                                                 <option value="MF">Saint Martin (French part)</option>
	                                                                 <option value="PM">Saint Pierre and Miquelon</option>
	                                                                 <option value="VC">Saint Vincent and the Grenadines</option>
	                                                                 <option value="WS">Samoa</option>
	                                                                 <option value="SM">San Marino</option>
	                                                                 <option value="SA">Saudi Arabia</option>
	                                                                 <option value="SN">Senegal</option>
	                                                                 <option value="RS">Serbia</option>
	                                                                 <option value="SC">Seychelles</option>
	                                                                 <option value="SL">Sierra Leone</option>
	                                                                 <option value="SG">Singapore</option>
	                                                                 <option value="SK">Slovakia</option>
	                                                                 <option value="SI">Slovenia</option>
	                                                                 <option value="SB">Solomon Islands</option>
	                                                                 <option value="SO">Somalia</option>
	                                                                 <option value="ZA">South Africa</option>
	                                                                 <option value="GS">South Georgia/Sandwich Islands</option>
	                                                                 <option value="KR">South Korea</option>
	                                                                 <option value="SS">South Sudan</option>
	                                                                 <option value="ES">Spain</option>
	                                                                 <option value="LK">Sri Lanka</option>
	                                                                 <option value="SD">Sudan</option>
	                                                                 <option value="SR">Suriname</option>
	                                                                 <option value="SJ">Svalbard and Jan Mayen</option>
	                                                                 <option value="SE">Sweden</option>
	                                                                 <option value="CH">Switzerland</option>
	                                                                 <option value="SY">Syria</option>
	                                                                 <option value="TW">Taiwan</option>
	                                                                 <option value="TJ">Tajikistan</option>
	                                                                 <option value="TZ">Tanzania</option>
	                                                                 <option value="TH">Thailand</option>
	                                                                 <option value="TL">Timor-Leste</option>
	                                                                 <option value="TG">Togo</option>
	                                                                 <option value="TK">Tokelau</option>
	                                                                 <option value="TO">Tonga</option>
	                                                                 <option value="TT">Trinidad and Tobago</option>
	                                                                 <option value="TN">Tunisia</option>
	                                                                 <option value="TR">Turkey</option>
	                                                                 <option value="TM">Turkmenistan</option>
	                                                                 <option value="TC">Turks and Caicos Islands</option>
	                                                                 <option value="TV">Tuvalu</option>
	                                                                 <option value="UG">Uganda</option>
	                                                                 <option value="UA">Ukraine</option>
	                                                                 <option value="AE">United Arab Emirates</option>
	                                                                 <option value="GB" selected='selected'>United Kingdom (UK)</option>
	                                                                 <option value="US">United States (US)</option>
	                                                                 <option value="UM">United States (US) Minor Outlying Islands</option>
	                                                                 <option value="UY">Uruguay</option>
	                                                                 <option value="UZ">Uzbekistan</option>
	                                                                 <option value="VU">Vanuatu</option>
	                                                                 <option value="VA">Vatican</option>
	                                                                 <option value="VE">Venezuela</option>
	                                                                 <option value="VN">Vietnam</option>
	                                                                 <option value="VG">Virgin Islands (British)</option>
	                                                                 <option value="VI">Virgin Islands (US)</option>
	                                                                 <option value="WF">Wallis and Futuna</option>
	                                                                 <option value="EH">Western Sahara</option>
	                                                                 <option value="YE">Yemen</option>
	                                                                 <option value="ZM">Zambia</option>
	                                                                 <option value="ZW">Zimbabwe</option>&nbsp;<span class="required" aria-hidden="true">*</span>
	                                                             </select><noscript><button type="submit" name="woocommerce_checkout_update_totals" value="Update country / region">Update country / region</button></noscript></span></p>
	                                                     <p class="form-row form-row-wide address-field validate-required" id="shipping_address_1_field" data-priority="50"><label for="shipping_address_1" class="required_field">Street address&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_address_1" id="shipping_address_1" placeholder="House number and street name" value="" rows="5" aria-required="true" autocomplete="address-line1" /></span></p>
	                                                     <p class="form-row form-row-wide address-field" id="shipping_address_2_field" data-priority="60"><label for="shipping_address_2" class="screen-reader-text">Apartment, suite, unit, etc.&nbsp;<span class="optional">(optional)</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_address_2" id="shipping_address_2" placeholder="Apartment, suite, unit, etc. (optional)" value="" rows="5" autocomplete="address-line2" /></span></p>
	                                                     <p class="form-row form-row-first address-field validate-required" id="shipping_city_field" data-priority="70"><label for="shipping_city" class="required_field">Town / City&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_city" id="shipping_city" placeholder="" value="" rows="5" aria-required="true" autocomplete="address-level2" /></span></p>
	                                                     <p class="form-row form-row-last address-field validate-state" id="shipping_state_field" data-priority="80"><label for="shipping_state" class="">County&nbsp;<span class="optional">(optional)</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " value="" placeholder="" name="shipping_state" id="shipping_state" rows="5" autocomplete="address-level1" data-input-classes="" /></span></p>
	                                                     <p class="form-row form-row-first address-field validate-required validate-postcode" id="shipping_postcode_field" data-priority="90"><label for="shipping_postcode" class="required_field">Postcode&nbsp;<span class="required" aria-hidden="true">*</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="shipping_postcode" id="shipping_postcode" placeholder="" value="" rows="5" aria-required="true" autocomplete="postal-code" /></span></p>
	                                                 </div>


	                                             </div>

	                                         </div>
	                                         <div class="woocommerce-additional-fields">



	                                             <div class="woocommerce-additional-fields__field-wrapper">
	                                                 <p class="form-row notes" id="order_comments_field" data-priority=""><label for="order_comments" class="">Order notes&nbsp;<span class="optional">(optional)</span></label><span class="woocommerce-input-wrapper"><textarea name="order_comments" class="input-text " id="order_comments" placeholder="Notes about your order, e.g. special notes for delivery." cols="5" rows="5"></textarea></span></p>
	                                             </div>


	                                         </div>
	                                     </div>


	                                 </div>
	                                 <div class="col-lg-5 mb-6">


	                                     <div id="order_review" class="woocommerce-checkout-review-order">
	                                         <h3 id="order_review_heading">Your order</h3>
	                                         <table class="shop_table woocommerce-checkout-review-order-table">
	                                             <thead>
	                                                 <tr>
	                                                     <th class="product-name">Product</th>
	                                                     <th class="product-total">Subtotal</th>
	                                                 </tr>
	                                             </thead>
	                                             <tbody>
	                                                 <tr class="cart_item">
	                                                     <td class="product-name">
	                                                         <span>Coat Pool Comfort Jacket - Extra Large</span>&nbsp; <strong class="product-quantity">&times;&nbsp;1</strong>
	                                                         <dl class="variation">
	                                                             <dt class="variation-Vendor">Vendor:</dt>
	                                                             <dd class="variation-Vendor">
	                                                                 <p>Vendor 1</p>
	                                                             </dd>
	                                                         </dl>
	                                                     </td>
	                                                     <td class="product-total">
	                                                         <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#36;</span>180.00</bdi></span>
	                                                     </td>
	                                                 </tr>
	                                             </tbody>
	                                             <tfoot>

	                                                 <tr class="cart-subtotal">
	                                                     <th>Subtotal</th>
	                                                     <td><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#36;</span>180.00</bdi></span></td>
	                                                 </tr>




	                                                 <tr class="woocommerce-shipping-totals shipping">
	                                                     <th class="d-none">Shipping: </th>
	                                                     <td data-title="Shipping:  " colspan="2">
	                                                         Enter your address to view shipping options.

	                                                     </td>
	                                                 </tr>






	                                                 <tr class="order-total">
	                                                     <th>Total</th>
	                                                     <td><strong><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#36;</span>180.00</bdi></span></strong> </td>
	                                                 </tr>


	                                             </tfoot>
	                                         </table>
	                                         <div id="payment" class="woocommerce-checkout-payment">
	                                             <div class="wolmart-free-shipping">
	                                                 <div class="wolmart-free-shipping-notice">
	                                                     <label>
	                                                         Add <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#36;</span>2,820.00</bdi></span> to cart and get free shipping! </label>
	                                                 </div>
	                                                 <progress class="wolmart-free-shipping-bar wolmart-scroll-progress" max="100" value="6"></progress>
	                                             </div>
	                                             <h4>Payment Methods</h4>

	                                             <ul class="wc_payment_methods payment_methods methods">
	                                                 <li class="wc_payment_method payment_method_bacs">
	                                                     <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" checked='checked' data-order_button_text="" />

	                                                     <label for="payment_method_bacs">
	                                                         Direct bank transfer </label>
	                                                     <div class="payment_box payment_method_bacs">
	                                                         <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
	                                                     </div>
	                                                 </li>
	                                                 <li class="wc_payment_method payment_method_cheque">
	                                                     <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="cheque" data-order_button_text="" />

	                                                     <label for="payment_method_cheque">
	                                                         Check payments </label>
	                                                     <div class="payment_box payment_method_cheque" style="display:none;">
	                                                         <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
	                                                     </div>
	                                                 </li>
	                                                 <li class="wc_payment_method payment_method_cod">
	                                                     <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" data-order_button_text="" />

	                                                     <label for="payment_method_cod">
	                                                         Cash on delivery </label>
	                                                     <div class="payment_box payment_method_cod" style="display:none;">
	                                                         <p>Pay with cash upon delivery.</p>
	                                                     </div>
	                                                 </li>
	                                                 <li class="wc_payment_method payment_method_paypal">
	                                                     <input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method" value="paypal" data-order_button_text="Proceed to PayPal" />

	                                                     <label for="payment_method_paypal">
	                                                         PayPal <img decoding="async" src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png" alt="PayPal acceptance mark" /><a href="https://www.paypal.com/gb/webapps/mpp/paypal-popup" class="about_paypal" onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;">What is PayPal?</a> </label>
	                                                     <div class="payment_box payment_method_paypal" style="display:none;">
	                                                         <p>Pay via PayPal; you can pay with your credit card if you don&#8217;t have a PayPal account.</p>
	                                                     </div>
	                                                 </li>
	                                             </ul>
	                                             <div class="form-row place-order">
	                                                 <noscript>
	                                                     Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so. <br /><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals">Update totals</button>
	                                                 </noscript>

	                                                 <div class="woocommerce-terms-and-conditions-wrapper pt-6">

	                                                 </div>


	                                                 <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order">Place order</button>

	                                                 <input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="1fea78bb35" /><input type="hidden" name="_wp_http_referer" value="/wordpress/wolmart/demo-1/checkout/" />
	                                             </div>
	                                         </div>
	                                     </div>

	                                 </div>
	                             </div>

	                         </form>

	                     </div>
	                 </div>
	             </div>
	         </div>
	     </div>

	 </main>
	 @endsection