<div class="slim"
     data-label="{{$dataLabel}}"
     data-size="{{$dataSize}}"
     data-instant-edit="true"
     data-ratio="{{$dataRatio}}"
     data-edit="false"
     data-button-edit-title="Modifier"
     data-button-remove-title="Supprimer"
     data-button-confirm-label="Confirmer"
     data-save-initial-image="false"
     data-button-cancel-label="Annuler"
     data-will-remove="{{$removeDate}}">
    @if(!str_ends_with($image, "logo") && !str_ends_with($image, "background") && !str_ends_with($image, "users")  && !str_ends_with($image, "clients"))
        <img src="{{$image}}" alt="" id="slimImg"/>
    @endif
    <input type="file" name="{{$name}}">
</div>
