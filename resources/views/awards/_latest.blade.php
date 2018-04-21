<div class="card award__latest-list w-100">
    <div class="card-header">
        Top
    </div>
    <div class="card-body p-0">
        @foreach($awards as $award)
            <p>Score : {{ $award->score }}</p>
            @include('awards._miniature', ['award' => $award])
        @endforeach        
    </div>
</div>
