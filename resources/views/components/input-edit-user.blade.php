<div class="form-group row">
    <label for="{{$name}}"
           class="{{$labelclass}}">{{$labelname}}</label>
    <div class="{{$grid}}">
        <div class="input-group input-group-lg input-group-solid">
            @if($name == "email")
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="la la-at"></i></span>
                </div>
            @endif
            <input
                type="{{$type}}" id="{{$id}}" name="{{$name}}" placeholder="{{$placeholder}}"
                class="{{$class}}" value="{{$value}}"/>
        </div>

    </div>
</div>
