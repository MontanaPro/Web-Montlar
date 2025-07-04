@extends('backend.layouts.app')

@section('content')
    <h4 class="text-center text-muted">{{ translate('System') }}</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 text-center">{{ translate('HTTPS Activation') }}</h5>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'FORCE_HTTPS')" <?php if (env('FORCE_HTTPS') == 'On') {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Maintenance Mode Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'maintenance_mode')" <?php if (get_setting('maintenance_mode') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Disable image encoding?') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'disable_image_optimization')"
                            <?php if (get_setting('disable_image_optimization') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>


    <h4 class="text-center text-muted mt-4">{{ translate('Business Related') }}</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Vendor System Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'vendor_system_activation')"
                            <?php if (get_setting('vendor_system_activation') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Classified Product') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'classified_product')" <?php if (get_setting('classified_product') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Wallet System Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'wallet_system')" <?php if (get_setting('wallet_system') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Coupon System Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'coupon_system')" <?php if (get_setting('coupon_system') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Pickup Point Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'pickup_point')" <?php if (get_setting('pickup_point') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Conversation Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'conversation_system')" <?php if (get_setting('conversation_system') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Seller Product Manage By Admin') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'product_manage_by_admin')"
                            <?php if (\App\Models\BusinessSetting::where('type', 'product_manage_by_admin')->first() && get_setting('product_manage_by_admin') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                    <div class="alert"
                        style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                        {{ translate('After activate this option Cash On Delivery of Seller product will be managed by Admin') }}.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Admin Approval On Seller Product') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'product_approve_by_admin')"
                            <?php if (\App\Models\BusinessSetting::where('type', 'product_approve_by_admin')->first() && get_setting('product_approve_by_admin') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                    <div class="alert"
                        style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                        {{ translate('After activate this option, Admin approval need to seller product') }}.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Email Verification') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'email_verification')" <?php if (get_setting('email_verification') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                    <div class="alert"
                        style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                        {{ translate('You need to configure SMTP correctly to enable this feature.') }} <a
                            href="{{ route('smtp_settings.index') }}">{{ translate('Configure Now') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Product Query Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'product_query_activation')"
                            <?php if (get_setting('product_query_activation') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Product External Link for Seller') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'product_external_link_for_seller')"
                            <?php if (get_setting('product_external_link_for_seller') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Use Floating Buttons In Website') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'use_floating_buttons')"
                            <?php if (get_setting('use_floating_buttons') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Last Viewed Products Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'last_viewed_product_activation')"
                            <?php if (get_setting('last_viewed_product_activation') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Newsletter Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'newsletter_activation')"
                            <?php if (get_setting('newsletter_activation') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        
        @if (addon_is_activated('wholesale'))
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 h6 text-center">{{ translate('Wholesale Product for Seller') }}</h3>
                    </div>
                    <div class="card-body text-center">
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="checkbox" onchange="updateSettings(this, 'seller_wholesale_product')"
                                <?php if (get_setting('seller_wholesale_product') == 1) {
                                    echo 'checked';
                                } ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        @endif

        @if (addon_is_activated('auction'))
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 h6 text-center">{{ translate('Auction Product for Seller') }}</h3>
                    </div>
                    <div class="card-body text-center">
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="checkbox" onchange="updateSettings(this, 'seller_auction_product')"
                                <?php if (get_setting('seller_auction_product') == 1) {
                                    echo 'checked';
                                } ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Guest Checkout Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'guest_checkout_activation')"
                            <?php if (get_setting('guest_checkout_activation') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                    <div class="alert"
                        style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                        {{ translate('You need to configure SMTP correctly to enable this feature.') }}
                        <a href="{{ route('smtp_settings.index') }}">{{ translate('Configure Now') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Seller Registration Verification') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'seller_registration_verify')"
                            <?php if (get_setting('seller_registration_verify') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Customer Registration Verification') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'customer_registration_verify')"
                            <?php if (get_setting('customer_registration_verify') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Digital Product for Seller') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'digital_product_manage_by_seller')"
                            <?php if (get_setting('digital_product_manage_by_seller') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                    <div class="alert"
                        style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                        {{ translate('After activating this option, sellers can add digital products.') }}.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h4 class="text-center text-muted mt-4">{{ translate('Social Media Login') }}</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Facebook login') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'facebook_login')" <?php if (get_setting('facebook_login') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                    <div class="alert"
                        style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                        {{ translate('You need to configure Facebook Client correctly to enable this feature') }}. <a
                            href="{{ route('social_login.index') }}">{{ translate('Configure Now') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Google login') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'google_login')" <?php if (get_setting('google_login') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                    <div class="alert"
                        style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                        {{ translate('You need to configure Google Client correctly to enable this feature') }}. <a
                            href="{{ route('social_login.index') }}">{{ translate('Configure Now') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Twitter login') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'twitter_login')" <?php if (get_setting('twitter_login') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                    <div class="alert"
                        style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                        {{ translate('You need to configure Twitter Client correctly to enable this feature') }}. <a
                            href="{{ route('social_login.index') }}">{{ translate('Configure Now') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Apple login') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'apple_login')" <?php if (get_setting('apple_login') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                    <div class="alert"
                        style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                        {{ translate('You need to configure Apple Client correctly to enable this feature') }}. <a
                            href="{{ route('social_login.index') }}">{{ translate('Configure Now') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function updateSettings(el, type) {

            if('{{env('DEMO_MODE')}}' == 'On'){
                AIZ.plugins.notify('info', '{{ translate('Data can not change in demo mode.') }}');
                return;
            }

            if ($(el).is(':checked')) {
                var value = 1;
            } else {
                var value = 0;
            }

            $.post('{{ route('business_settings.update.activation') }}', {
                _token: '{{ csrf_token() }}',
                type: type,
                value: value
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Settings updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
