<div class="card award__latest-list w-100">
    <div class="card-header">
        <h3>Latest</h3>
    </div>
    <div class="card-body p-0">
        @foreach($awards as $award)
            @include('awards._miniature', ['award' => $award])
        @endforeach        
    </div>
</div>