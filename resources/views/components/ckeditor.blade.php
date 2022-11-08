
<div wire:ignore class="form-group row" style="padding: unset; margin: unset">
        <textarea wire:model="{{$attributes['model']}}" class="form-control required"
                  name="{{ $attributes['name'] }}" id="{{ $attributes['id'] }}"></textarea>
</div>
<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>

<script>
    var editor = CKEDITOR.replace("{{ $attributes['id'] }}");

    editor.on('change', function(event){
        console.log(event.editor.getData())
    @this.set("{{ $attributes['model'] }}", event.editor.getData());
    })
</script>
