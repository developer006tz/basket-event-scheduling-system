@php $editing = isset($notifications) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="games_id" label="Games">
            @php $selected = old('games_id', ($editing ? $notifications->games_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Games</option>
            @foreach($allGames as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="practices_id" label="Practices">
            @php $selected = old('practices_id', ($editing ? $notifications->practices_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Practices</option>
            @foreach($allPractices as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="event_types_id" label="Event Types" required>
            @php $selected = old('event_types_id', ($editing ? $notifications->event_types_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Event Types</option>
            @foreach($allEventTypes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $notifications->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="message"
            label="Message"
            maxlength="255"
            required
            >{{ old('message', ($editing ? $notifications->message : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.datetime
            name="sent_at"
            label="Sent At"
            value="{{ old('sent_at', ($editing ? optional($notifications->sent_at)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>
</div>
