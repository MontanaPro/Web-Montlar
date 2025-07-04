@extends('backend.layouts.app')

@section('content')

        <div class="aiz-titlebar text-left mt-2 mb-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3">{{translate('Set Translations')}}</h1>
                </div>

            </div>
            <div class="my-2 text-left">
                @if($language->code != 'en')
                    <button onclick="makeTranslations({{ $language->id }})"
                        class="btn btn-soft-primary btn-sm" id="translate-btn-{{ $language->id }}"
                        title="{{ translate('Translate With Google') }}">
                        
                        <i class="las la-language" id="icon-{{ $language->id }}"></i>
                        <img src="{{ static_asset('assets/img/aiz-loader.gif') }}" width="20" height="20"
                            alt="Loading" class="d-none" id="loader-{{ $language->id }}">
                        <span>{{ translate('Translate By Google') }}</span>
                    </button>
                @endif
                <a class="btn btn-soft-info   btn-sm" href="{{route('app-translations.sync', $language->id)}}" title="{{ translate('All translaion will copy for app') }}">
                    <i class="las la-sync"></i>
                    
                    <span>{{ translate('Sync Translation For App') }}</span>
                </a>
                <a class="btn btn-soft-success  btn-sm" href="{{route('app-translations.export', $language->id)}}" title="{{ translate('Download ARB file For App') }}" download>
                    <i class="las la-download"></i>
                    <span>{{ translate('Export arb File') }}</span>
                </a>
            </div>

            <div class="alert alert-info my-2 text-center">
               Please wait until the Google translation process is complete. It may take some time, so do not close the tab during this process.
            </div>

        </div>

    <div class="card">
        <div class="card-header row gutters-5">
         <div class="col text-center text-md-left">
           <h5 class="mb-md-0 h6">{{ $language->name }}</h5>
         </div>
         <div class="col-md-4">
           <form class="" id="sort_keys" action="" method="GET">
             <div class="input-group input-group-sm">
                 <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type key & Enter') }}">
             </div>
           </form>
         </div>
       </div>
        <form class="form-horizontal" action="{{ route('languages.key_value_store') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $language->id }}">
            <div class="card-body">
                <table class="table table-striped table-bordered demo-dt-basic" id="tranlation-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="45%">{{translate('Key')}}</th>
                            <th width="45%">{{translate('Value')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lang_keys as $key => $translation)
                            <tr>
                                <td>{{ ($key+1) + ($lang_keys->currentPage() - 1)*$lang_keys->perPage() }}</td>
                                <td class="key">{{ $translation->lang_value }}</td>
                                <td>
                                    <input type="text" class="form-control value" style="width:100%" name="values[{{ $translation->lang_key }}]" @if (($traslate_lang = \App\Models\Translation::where('lang', $language->code)->where('lang_key', $translation->lang_key)->latest()->first()) != null)
                                        value="{{ $traslate_lang->lang_value }}"
                                    @endif>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                   {{ $lang_keys->appends(request()->input())->links() }}
                </div>

                <div class="form-group mb-0 text-right">
                    <button type="button" class="btn btn-primary" onclick="copyTranslation()">{{ translate('Copy Translations') }}</button>
                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        //translate in one click
        function copyTranslation() {
            $('#tranlation-table > tbody  > tr').each(function (index, tr) {
                $(tr).find('.value').val($(tr).find('.key').text());
            });
        }

        function sort_keys(el){
            $('#sort_keys').submit();
        }

        function makeTranslations(id){
            const btn = document.getElementById(`translate-btn-${id}`);
            const icon = document.getElementById(`icon-${id}`);
            const loader = document.getElementById(`loader-${id}`);
            btn.classList.remove('btn-soft-primary');
            btn.classList.add('btn-primary');
            // Show loader, hide icon
            icon.classList.add('d-none');
            loader.classList.remove('d-none');

            fetch(`{{ url('/admin/languages/translations/google/') }}/${id}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.result) {
                    AIZ.plugins.notify('success', data.message);
                     location.reload()
                } else {
                    AIZ.plugins.notify('danger', data.message);
                }
            })
            .catch(error => {
                console.error('Translation failed', error);
                alert('Something went wrong during translation.');
            })
            .finally(() => {
                // Hide loader, show icon again
                icon.classList.remove('d-none');
                loader.classList.add('d-none');
            });
        }
    </script>
@endsection
