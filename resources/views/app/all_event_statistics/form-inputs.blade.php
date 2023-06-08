@php $editing = isset($eventStatistics) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="games_id" label="Games" required>
            @php $selected = old('games_id', ($editing ? $eventStatistics->games_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Games</option>
            @foreach($allGames as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="players_id" label="Players" required>
            @php $selected = old('players_id', ($editing ? $eventStatistics->players_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Players</option>
            @foreach($allPlayers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="points"
            label="Points"
            :value="old('points', ($editing ? $eventStatistics->points : ''))"
            max="255"
            placeholder="Points"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="rebounds"
            label="Rebounds"
            :value="old('rebounds', ($editing ? $eventStatistics->rebounds : ''))"
            max="255"
            placeholder="Rebounds"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="assists"
            label="Assists"
            :value="old('assists', ($editing ? $eventStatistics->assists : ''))"
            max="255"
            placeholder="Assists"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="blocks"
            label="Blocks"
            :value="old('blocks', ($editing ? $eventStatistics->blocks : ''))"
            max="255"
            placeholder="Blocks"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="steals"
            label="Steals"
            :value="old('steals', ($editing ? $eventStatistics->steals : ''))"
            max="255"
            placeholder="Steals"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
