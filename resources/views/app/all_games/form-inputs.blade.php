@php $editing = isset($games) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="home_team_id"
            label="Home Team Id"
            :value="old('home_team_id', ($editing ? $games->home_team_id : ''))"
            maxlength="255"
            placeholder="Home Team Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="away_team_id"
            label="Away Team Id"
            :value="old('away_team_id', ($editing ? $games->away_team_id : ''))"
            maxlength="255"
            placeholder="Away Team Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="location"
            label="Location"
            :value="old('location', ($editing ? $games->location : ''))"
            maxlength="255"
            placeholder="Location"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($games->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="start_time"
            label="Start Time"
            :value="old('start_time', ($editing ? $games->start_time : ''))"
            maxlength="255"
            placeholder="Start Time"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="result"
            label="Result"
            :value="old('result', ($editing ? $games->result : ''))"
            maxlength="255"
            placeholder="Result"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="result_status" label="Result Status">
            @php $selected = old('result_status', ($editing ? $games->result_status : '')) @endphp
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >1</option>
            <option value="3" {{ $selected == '3' ? 'selected' : '' }} >3</option>
            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >2</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
