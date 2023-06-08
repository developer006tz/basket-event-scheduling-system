@php $editing = isset($eventTypes) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="type" label="Type">
            @php $selected = old('type', ($editing ? $eventTypes->type : 'game')) @endphp
            <option value="game" {{ $selected == 'game' ? 'selected' : '' }} >Game</option>
            <option value="practise" {{ $selected == 'practise' ? 'selected' : '' }} >Practise</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $eventTypes->name : ''))"
            maxlength="255"
            placeholder="Name"
        ></x-inputs.text>
    </x-inputs.group>
</div>
