<div class="card mt-4 award__latest-list d-none d-md-block">
    <div class="card-header">Trending</div>
    <div class="card-body p-0">
        @foreach($awards as $award)
            @include('awards._miniature', ['award' => $award])
        @endforeach    
    </div>
</div>
