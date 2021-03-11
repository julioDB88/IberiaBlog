<div class="m-2 flex items-end">
    @if($show)
    <img src="{{asset('storage/logos')}}/{{$icon}}" alt="" class="h-8 mr-4">
    <a target="_blank" href="{{$url}}" class="mr-4 hover:text-red-500">{{ucfirst($name)}}</a>
    <label class="mr-4" ><input type="checkbox" wire:model="active" wire:click="switchActive" style="margin-right:7px;">Visible</label>
    <button wire:click="delete" class="ml-4"><i class="fas text-red-500 fa-trash" aria-hidden="true"></i></button>
@endif
</div>
