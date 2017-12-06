<div class="card award__latest-list w-100">
    <div class="card-header">
        <h3>Latest</h3>
    </div>
    <div class="card-body p-0">
        <ul class="group-list p-0 mb-0">
            @foreach($awards as $award)
                @include('awards._miniature', $award)
            @endforeach        
        </ul>
    </div>
</div>
