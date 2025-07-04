@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <!-- Sytem Settings -->
        <div class="card">
            <div class="card-header">
                <h1 class="mb-0 h6">{{translate('Sytem Settings')}}</h1>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- System Name -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label">{{translate('System Name')}}</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="types[]" value="site_name">
                            <input type="text" name="site_name" class="form-control" placeholder="{{ translate('System Name') }}" value="{{ get_setting('site_name') }}">
                        </div>
                    </div>
                    <!-- Frontend Website Name -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{translate('Frontend Website Name')}}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="website_name">
                            <input type="text" name="website_name" class="form-control" placeholder="{{ translate('Website Name') }}" value="{{ get_setting('website_name') }}">
                        </div>
                    </div>
                    <!-- Site Motto -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{translate('Site Motto')}}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="site_motto">
                            <input type="text" name="site_motto" class="form-control" placeholder="{{ translate('Best eCommerce Website') }}" value="{{  get_setting('site_motto') }}">
                        </div>
                    </div>
                    <!-- Site Icon -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Site Icon') }}</label>
                        <div class="col-md-8">
                            <div class="input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="types[]" value="site_icon">
                                <input type="hidden" name="site_icon" value="{{ get_setting('site_icon') }}" class="selected-files">
                            </div>
                            <div class="file-preview box"></div>
                            <small class="text-muted">{{ translate('Minimum dimensions required: 32px width X 32px height.') }}</small>
                        </div>
                    </div>
                    <!-- System Logo - White -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label">{{translate('System Logo - White')}}</label>
                        <div class="col-sm-8">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose Files') }}</div>
                                <input type="hidden" name="types[]" value="system_logo_white">
                                <input type="hidden" name="system_logo_white" value="{{ get_setting('system_logo_white') }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm"></div>
                            <small class="text-muted">{{ translate('Will be used in admin panel side menu. Minimum dimensions required: 189px width X 31px height.') }}</small>
                        </div>
                    </div>
                    <!-- System Logo - Black -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label">{{translate('System Logo - Black')}}</label>
                        <div class="col-sm-8">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose Files') }}</div>
                                <input type="hidden" name="types[]" value="system_logo_black">
                                <input type="hidden" name="system_logo_black" value="{{ get_setting('system_logo_black') }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm"></div>
                            <small class="text-muted">{{ translate('Will be used in Admin login page, Seller login page & Delivery Boy login page. Minimum dimensions required: 189px width X 31px height.') }}</small>
                        </div>
                    </div>
                    <!-- System Timezone -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label">{{translate('System Timezone')}}</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="types[]" value="timezone">
                            <select name="timezone" class="form-control aiz-selectpicker" data-live-search="true">
                                @foreach (timezones() as $key => $value)
                                <option value="{{ $value }}" @if (app_timezone()==$value)
                                    selected
                                    @endif>{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Uploaded image format -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label">{{translate('Uploaded image format')}}</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="types[]" value="uploaded_image_format">
                            <select name="uploaded_image_format" class="form-control aiz-selectpicker" data-live-search="true" data-selected="{{ get_setting('uploaded_image_format') }}">
                                <option value="default">{{ translate('default') }}</option>
                                <option value="png">{{ translate('PNG') }}</option>
                                <option value="jpg">{{ translate('JPEG') }}</option>
                                <option value="webp">{{ translate('WebP') }}</option>
                            </select>
                            <small class="text-muted">{{ translate('"svg" image will not be converted.') }}</small>
                        </div>
                    </div>
                    <!-- Update Button -->
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- General Settings -->
        <div class="card">
            <div class="card-header">
                <h6 class="fw-600 mb-0">{{ translate('General Settings') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('business_settings.update') }}" method="POST">
                    @csrf
                    <!-- Website Base Color -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{translate('Website Base Color')}}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="base_color">
                            <input type="text" name="base_color" class="form-control" placeholder="#377dff" value="{{ get_setting('base_color') }}">
                            <small class="text-muted">{{ translate('Hex Color Code') }}</small>
                        </div>
                    </div>
                    <!-- Website Base Hover Color -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{translate('Website Base Hover Color')}}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="base_hov_color">
                            <input type="text" name="base_hov_color" class="form-control" placeholder="#377dff" value="{{  get_setting('base_hov_color') }}">
                            <small class="text-muted">{{ translate('Hex Color Code') }}</small>
                        </div>
                    </div>
                    <!-- Website Secondary Base Color -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{translate('Website Secondary Base Color')}}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="secondary_base_color">
                            <input type="text" name="secondary_base_color" class="form-control" placeholder="#ffc519" value="{{ get_setting('secondary_base_color') }}">
                            <small class="text-muted">{{ translate('Hex Color Code') }}</small>
                        </div>
                    </div>
                    <!-- Website Secondary Base Hover Color -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{translate('Website Secondary Base Hover Color')}}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="secondary_base_hov_color">
                            <input type="text" name="secondary_base_hov_color" class="form-control" placeholder="#dbaa17" value="{{  get_setting('secondary_base_hov_color') }}">
                            <small class="text-muted">{{ translate('Hex Color Code') }}</small>
                        </div>
                    </div>
                    <!-- Flash Deal Page Banner - Large -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Flash Deal Page Banner - Large') }}</label>
                        <div class="col-md-8">
                            <div class="input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="types[]" value="flash_deal_banner">
                                <input type="hidden" name="flash_deal_banner" value="{{ get_setting('flash_deal_banner') }}" class="selected-files">
                            </div>
                            <div class="file-preview box"></div>
                            <small class="text-muted">{{ translate('Will be shown in large device. Minimum dimensions required: 1370px width X 242px height.') }}</small>
                        </div>
                    </div>
                    <!-- Flash Deal Page Banner - Small -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Flash Deal Page Banner - Small') }}</label>
                        <div class="col-md-8">
                            <div class="input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="types[]" value="flash_deal_banner_small">
                                <input type="hidden" name="flash_deal_banner_small" value="{{ get_setting('flash_deal_banner_small') }}" class="selected-files">
                            </div>
                            <div class="file-preview box"></div>
                            <small class="text-muted">{{ translate('Will be shown in small device. Minimum dimensions required: 400px width X 184px height.') }}</small>
                        </div>
                    </div>
                    <!-- Update Button -->
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Image Watermark -->
        <div class="card">
            <div class="card-header">
                <h6 class="fw-600 mb-0">{{ translate('Image Watermark') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Use Image Watermark (During Upload) -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{translate('Use Image Watermark (During Upload)')}}</label>
                        <div class="col-md-8">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="hidden" name="types[]" value="use_image_watermark">
                                <input type="checkbox" name="use_image_watermark" @if( get_setting('use_image_watermark')=='on' ) checked @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <!-- Watermark Type -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Watermark Type') }}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="image_watermark_type">
                            <select name="image_watermark_type" class="form-control aiz-selectpicker">
                                <option value="image" @if (get_setting('image_watermark_type')=="image" ) selected @endif>{{ translate('Image') }}</option>
                                <option value="text" @if (get_setting('image_watermark_type')=="text" ) selected @endif>{{ translate('Text') }}</option>
                            </select>
                        </div>
                    </div>
                    <!-- Watermark Image -->
                    <div class="form-group row @if (get_setting('image_watermark_type') == " text") d-none @endif" id="watermark_image">
                        <label class="col-md-3 col-from-label">{{ translate('Watermark Image') }}</label>
                        <div class="col-md-8">
                            <div class="input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="types[]" value="watermark_image">
                                <input type="hidden" name="watermark_image" value="{{ get_setting('watermark_image') }}" class="selected-files">
                            </div>
                            <div class="file-preview box"></div>
                            <small class="text-muted">{{ translate('Do not use "svg" image.') }}</small>
                        </div>
                    </div>
                    <div class="@if (in_array(get_setting('image_watermark_type'), [" image", null])) d-none @endif" id="watermark_text">
                        <!-- Watermark Text -->
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{translate('Watermark Text')}}</label>
                            <div class="col-md-8">
                                <input type="hidden" name="types[]" value="watermark_text">
                                <input type="text" name="watermark_text" class="form-control" placeholder="Watermark Text" value="{{  get_setting('watermark_text') }}">
                            </div>
                        </div>
                        <!-- Watermark Text Size -->
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{translate('Watermark Text Size')}}</label>
                            <div class="col-md-8">
                                <input type="hidden" name="types[]" value="watermark_text_size">
                                <input type="number" name="watermark_text_size" class="form-control" placeholder="Ex: 20" value="{{  get_setting('watermark_text_size') }}">
                            </div>
                        </div>
                        <!-- Watermark Text Color -->
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{translate('Watermark Text Color')}}</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="hidden" name="types[]" value="watermark_text_color">
                                    <input type="text" class="form-control aiz-color-input" placeholder="Ex: #e1e1e1" name="watermark_text_color" value="{{ get_setting('watermark_text_color') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text p-0">
                                            <input class="aiz-color-picker border-0 size-40px" type="color" value="{{ get_setting('watermark_text_color') }}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Watermark Position -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{translate('Watermark Position')}}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="watermark_position">
                            <select name="watermark_position" class="form-control aiz-selectpicker" data-selected="{{ get_setting('watermark_position') }}">
                                <option value="top-left">{{ translate('Top-Left') }}</option>
                                <option value="top-right">{{ translate('Top-Right') }}</option>
                                <option value="bottom-left">{{ translate('Bottom-Left') }}</option>
                                <option value="bottom-right">{{ translate('Bottom-Right') }}</option>
                                <option value="center">{{ translate('Center') }}</option>
                            </select>
                        </div>
                    </div>
                    <!-- Update Button -->
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Global SEO -->
        <div class="card">
            <div class="card-header">
                <h6 class="fw-600 mb-0">{{ translate('Global SEO') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Meta Title -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Meta Title') }}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="meta_title">
                            <input type="text" class="form-control" placeholder="{{translate('Title')}}" name="meta_title" value="{{ get_setting('meta_title') }}">
                        </div>
                    </div>
                    <!-- Meta description -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Meta description') }}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="meta_description">
                            <textarea class="resize-off form-control" placeholder="{{translate('Description')}}" name="meta_description">{{ get_setting('meta_description') }}</textarea>
                        </div>
                    </div>
                    <!-- Keywords -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Keywords') }}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="meta_keywords">
                            <textarea class="resize-off form-control" placeholder="{{translate('Keyword, Keyword')}}" name="meta_keywords">{{ get_setting('meta_keywords') }}</textarea>
                            <small class="text-muted">{{ translate('Separate with coma') }}</small>
                        </div>
                    </div>
                    <!-- Meta Image -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Meta Image') }}</label>
                        <div class="col-md-8">
                            <div class="input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="types[]" value="meta_image">
                                <input type="hidden" name="meta_image" value="{{ get_setting('meta_image') }}" class="selected-files">
                            </div>
                            <div class="file-preview box"></div>
                        </div>
                    </div>
                    <!-- Update Button -->
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Custom Script -->
        <div class="card">
            <div class="card-header">
                <h6 class="fw-600 mb-0">{{ translate('Custom Script') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Header custom script -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Header custom script - before </head>') }}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="header_script">
                            <textarea name="header_script" rows="4" class="form-control" placeholder="<script>&#10;...&#10;</script>">{{ get_setting('header_script') }}</textarea>
                            <small>{{ translate('Write script with <script> tag') }}</small>
                        </div>
                    </div>
                    <!-- Footer custom script -->
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Footer custom script - before </body>') }}</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="footer_script">
                            <textarea name="footer_script" rows="4" class="form-control" placeholder="<script>&#10;...&#10;</script>">{{ get_setting('footer_script') }}</textarea>
                            <small>{{ translate('Write script with <script> tag') }}</small>
                        </div>
                    </div>
                    <!-- Update Button -->
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $('select[name="image_watermark_type"]').on('change', function() {
        let val = $(this).val();
        if (val == 'image') {
            $('#watermark_image').removeClass('d-none');
            $('#watermark_text').addClass('d-none');
        } else {
            $('#watermark_text').removeClass('d-none');
            $('#watermark_image').addClass('d-none');
        }
    });
</script>
@endsection