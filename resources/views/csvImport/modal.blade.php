<div class="modal fade" id="csvImportModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">@lang('global.app_csvImport')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col-md-12'>

                        <form method="POST" action="{{ route($route, ['model' => $model]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="mb-3">
                                <label for="csv_file" class="form-label">@lang('global.app_csv_file_to_import')</label>
                                <input id="csv_file" type="file" class="form-control {{ $errors->has('csv_file') ? 'is-invalid' : '' }}" name="csv_file" required>

                                @if($errors->has('csv_file'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('csv_file') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="header" id="header" checked>
                                    <label class="form-check-label" for="header">
                                        @lang('global.app_file_contains_header_row')
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">
                                    @lang('global.app_parse_csv')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
