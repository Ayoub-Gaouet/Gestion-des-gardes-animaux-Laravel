@props(['id' => '', 'name' => '', 'content' => '', 'labelname' => '', 'class' => '', 'required' => '', 'multiple'=> '', 'grid' => ''])
<div class="{{$grid}}">
<div class="form-group">
    <label for="{{$id}}">{{$labelname}}</label>
    <select {{$required}} {{$multiple}} class="{{$class}}" id="{{$id}}" name="{{$name}}" data-theme="bootstrap4"
            data-language="fr"
            data-placeholder="Veuillez sélectionner une option" data-allow-clear="true">
        {{$content}}
    </select>
</div>
</div>
