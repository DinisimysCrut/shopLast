@if(session('message'))
    <div class="bg-success">
        {{  session('message') }}
    </div>
@endif