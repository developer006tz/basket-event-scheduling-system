@php $editing = isset($practices) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="team_id" label="Teams" required>
            @php $selected = old('team_id', ($editing ? $practices->team_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Teams</option>
            @foreach($allTeams as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="location"
            label="Location"
            :value="old('location', ($editing ? $practices->location : ''))"
            maxlength="255"
            placeholder="Location"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($practices->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="start_time"
            label="Start Time"
            :value="old('start_time', ($editing ? $practices->start_time : ''))"
            maxlength="255"
            placeholder="Start Time"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="end_time"
            label="End Time"
            :value="old('end_time', ($editing ? $practices->end_time : ''))"
            maxlength="255"
            placeholder="End Time"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
