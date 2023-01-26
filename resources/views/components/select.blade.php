<?php $is_string = is_string($options[0])?>
<div class="w-25">
    <label for="{{$name}}" class="form-control-label" @error($name) text-danger @enderror>{{ucfirst($name)}}</label>
    <select name="{{$name}}" id="{{$name}}" class="form-select"
    @if(isset($show)) disabled @endif
    @error($name) border-danger @enderror>
        @foreach($options as $option)
            <option value="@if($is_string){{$option}} @else {{$option->$option_val}}@endif" 
                @if(isset($selected) && ((!$is_string &&$option->$option_val == $selected) || ($is_string && $option == $selected))) selected @endif>@if(!$is_string){{$option->$label}}@else{{$option}}@endif</option>
        @endforeach
    </select>
</div>