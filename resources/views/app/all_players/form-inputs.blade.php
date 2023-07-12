@php $editing = isset($players) @endphp
 @php $editing = isset($user) @endphp
<div class="row">
    <div class="col-sm-6">

        <div class="row">
           

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $user->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $user->email : ''))"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="phone"
            label="Phone"
            :value="old('phone', ($editing ? $user->phone : ''))"
            maxlength="255"
            placeholder="Phone"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="maritial_status" label="Maritial Status">
            @php $selected = old('maritial_status', ($editing ? $user->maritial_status : 'single')) @endphp
            <option value="single" {{ $selected == 'single' ? 'selected' : '' }} >Single</option>
            <option value="maried" {{ $selected == 'maried' ? 'selected' : '' }} >Maried</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $user->address : ''))"
            maxlength="255"
            placeholder="Address"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.password
            name="password"
            label="Password"
            maxlength="255"
            placeholder="Password"
            :required="!$editing"
        ></x-inputs.password>
    </x-inputs.group>

        </div>

    </div>
    <div class="col-sm-6">
<div class="row">

    <x-inputs.group class="col-sm-12 mb-2">
        <x-inputs.select name="team_id" label="Player Team" required>
            @php $selected = old('team_id', ($editing ? $players->team_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Teams</option>
            @foreach($allTeams as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 mb-2">
        <x-inputs.number
            name="jersey_number"
            label="Jersey Number"
            :value="old('jersey_number', ($editing ? $players->jersey_number : ''))"
            max="255"
            placeholder="Jersey Number"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 mb-2">
        <x-inputs.number
            name="height"
            label="Height in (ft)"
            :value="old('height', ($editing ? $players->height : ''))"
            max="255"
            step="0.01"
            placeholder="Height"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 mb-2">
        <x-inputs.number
            name="weight"
            label="Weight in (kg)"
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
            label="Age in (yrs)"
            :value="old('age', ($editing ? $players->age : ''))"
            max="255"
            placeholder="Age"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
    </div>
    
</div>
