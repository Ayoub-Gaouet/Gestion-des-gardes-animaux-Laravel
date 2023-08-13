<div class="{{$grid}}">
    <div class="input-group date" id="{{ $blockid }}"
         data-target-input="nearest">

        <input type="text" class="form-control datetimepicker-input"
               placeholder="{{ $placeholder }}" data-target="#kt_datetimepicker_7_1"
               id="{{$id}}" name="{{$name}}" value="{{$value}}"/>
        <div class="input-group-append" data-target="#kt_datetimepicker_7_1"
             data-toggle="datetimepicker">
            <span class="input-group-text"><i class="ki ki-calendar"></i></span>
        </div>
    </div>
</div>
