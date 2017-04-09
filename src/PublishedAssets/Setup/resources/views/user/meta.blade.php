
    <div class="col-md-12 form-group">
        @input_maker_label(trans('siravel::modules.phone'))
        @input_maker_create('meta[phone]', ['type' => 'string'], $user)
    </div>

    <div class="col-md-12 form-group">
        @input_maker_create('meta[marketing]', ['type' => 'checkbox'], $user)
        @input_maker_label(trans('siravel::modules.agreeMarketingMaterials'))
    </div>

    <div class="col-md-12 form-group">
        <label>
            <input type="checkbox" name="meta[terms_and_cond]" value="1" @if ($user->meta->terms_and_cond) checked @endif>
            {!! trans('siravel::modules.iAgreeTerms', ['agree' => '<a href="'.url('page/terms-and-conditions').'">'.trans('siravel::modules.termsConditions').'</a>']) !!}
        </label>
    </div>