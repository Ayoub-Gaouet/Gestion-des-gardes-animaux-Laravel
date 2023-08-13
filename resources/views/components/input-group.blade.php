<div class="{{$grid}}">
    <div class="form-group">
        <label for="{{$name}}" class="{{$labelclass}}">{{$labelname}}</label>


        <input type="{{$type}}" id="{{$id}}" name="{{$name}}" class="{{$class}}"
               @isset($placeholder) placeholder="{{$placeholder}}" @endisset
               @isset($value) value="{{$value}}" @endisset
               @isset($step){{$step!=null ? 'step='.$step:""}} @endisset
               @isset($max){{$max!=null ? 'max='.$max:""}}@endisset
               @isset($min){{$min!=null ? 'min='.$min:""}}@endisset
               @isset($maxlength){{$maxlength!=null ? 'maxlength='.$maxlength:""}}@endisset
               @isset($minlength){{$minlength!=null ? 'minlength='.$minlength:""}}@endisset
               data-error=".error{{$id}}"
               @isset($disabled) disabled="{{$disabled}}" @endisset
               @isset($required) required="{{$required}}" @endisset
               @isset($read) readonly="{{$read}}" @endisset/>

    </div>
</div>
