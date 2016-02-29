<input type="hidden" name="_token" value="{{ csrf_token() }}"/>

<div class="form-group @if($errors->has('title')) has-error @endif">
    <label for="title">{{ trans('Forum::messages.title') }}</label>
    <input type="text" name="title" class="form-control"/>
    @if($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
</div>

<div class="form-group @if($errors->has('topic_id')) has-error @endif">
    <label for="title">{{ trans('Forum::messages.topic') }}</label>
    <select name="topic_id" class="form-control">

        @foreach(config('forum.topics') as $key => $topic)
            <option value="{{ $key }}">{{ $topic['name'] }}</option>
        @endforeach

    </select>
    @if($errors->has('title')) <p class="help-block">{{ $errors->first('topic_id') }}</p> @endif
</div>

<div class="form-group @if($errors->has('message')) has-error @endif">
    <label for="message">{{ trans('Forum::messages.message') }}</label>
    <textarea class="form-control"  cols="30" rows="14" style="resize:none" name="message"></textarea>
    @include('Forum::Partials.markdown-supported')
    @if($errors->has('title')) <p class="help-block">{{ $errors->first('message') }}</p> @endif
</div>
