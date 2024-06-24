@isset($errors)
@if ($errors->any())
<div class="container error-container" style="background:rgb(213 179 182);">
    <row class="col-sm-10 d-flex flex-row justify-content-start align-items-center">
        <ul class="list">
            @foreach ($errors->all() as $error)
                <li class="text-danger p-2 mb-1">{{ $error }}</li>
            @endforeach
        </ul>
    </row>
</div>
@endif
@endisset
