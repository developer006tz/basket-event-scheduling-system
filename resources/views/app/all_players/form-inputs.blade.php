@php $editing = isset($players) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $players->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="teams_id" label="Teams" required>
            @php $selected = old('teams_id', ($editing ? $players->teams_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Teams</option>
            @foreach($allTeams as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="jersey_number"
            label="Jersey Number"
            :value="old('jersey_number', ($editing ? $players->jersey_number : ''))"
            max="255"
            placeholder="Jersey Number"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="height"
            label="Height"
            :value="old('height', ($editing ? $players->height : ''))"
            max="255"
            step="0.01"
            placeholder="Height"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="weight"
            label="Weight"
            :value="old('weight', ($editing ? $players->weight : ''))"
            max="255"
            step="0.01"
            placeholder="Weight"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="age"
            label="Age"
            :value="old('age', ($editing ? $players->age : ''))"
            max="255"
            placeholder="Age"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
