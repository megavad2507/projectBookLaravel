<form enctype='multipart/form-data' action="{{ route('addReview',[$sku]) }}" method="POST"
    @if(!$errors->any() && !session()->has('success_add_review_message'))
        style="display: none"
    @endif
    id="review_add_form"
>
    @csrf
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
    @if(session()->has('success_add_review_message'))
        <div class="alert alert-success">{{ session()->get('success_add_review_message') }}</div>
    @endif
    <div class="form-group row">
        <label for="author_name" class="col-md-3 col-form-label">@lang('review_add.input_name')*</label>
        <div class="col-md-6">
            <input required type="text" name="author_name" value="{{ old('author_name') }}">
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-md-3 col-form-label">@lang('review_add.input_text')*</label>
        <div class="col-md-6">
            <textarea name="text" cols="30" rows="10">{{ old('text') }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="grade" class="col-md-3 col-form-label">@lang('review_add.grade_input')*</label>
        <div class="col-md-6">
            <ul class="review-grade">
                @for($i = 1;$i <= 5;$i++)
                    <li>
                        <input type="radio" id="rating-{{ $i }}" name="grade" value="{{ $i }}" @if($i == old('grade')) checked="checked" @endif/>
                        <label for="rating-{{ $i }}">Rate {{ $i }} star</label>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
    <div class="form-group row">
        <label for="attachments" class="col-md-3 col-form-label">@lang('review_add.input_photos')</label>
        <div class="col-md-6">
            <input type="file" name="attachments[]" value="{{ old('enclosure') }}" multiple>
        </div>
    </div>
    @auth
        <button class="btn theme-btn--dark1 btn--md" type="submit">@lang('review_add.submit')</button>
    @else
        Для того, чтобы оставить отзыв вам не необходимо зарегистрироваться
    @endauth
</form>
