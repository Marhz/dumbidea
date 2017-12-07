<div class="card mt-5 award__latest-list">
    <div class="card-header">Trending</div>
    <div class="card-body p-0">
        @foreach($awards as $award)
            @include('awards._miniature', ['award' => $award])
        @endforeach    
    </div>
</div>
