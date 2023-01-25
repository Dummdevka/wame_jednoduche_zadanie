<div class="w-25 mb-2">
    <label for="{{$name}}"
    class="form-control-label @error($name) text-danger @enderror">{{ucfirst($name)}}:</label>
    <input type="text" name="{{$name}}" id="{{$name}}"
    value="{{$value ?? ''}}" @if(isset($show)) disabled @endif
    class="form-control w-100 border-none @error($name)) border border-danger @enderror">
</div>