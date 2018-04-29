<div class="card fixed">
    <div class="card-header">
        Top
    </div>
    <div class="card-body award__latest-list">
        @foreach($awards as $award)
            @include('awards._miniature', ['award' => $award])
            @if (! $loop->last)
                <hr>
            @endif
        @endforeach        
    </div>
</div>

{{-- <div class="card fixed">
    <div class="card-header">
        Popular awards
    </div>
    <div class="card-body tags">
        <ul class="list-group tags-list">
            @foreach($awards as $award)
                <li class="tag-item justify-content-between">
                    <a href="{{ $award->path }}" class="badge badge-info tag">{{ $award->title }}</a>
                    <span class="badge-pill badge-warning award-count">{{ $award->db_score }}</span>
                </li>
            @endforeach            
        </ul>
    </div>
</div> --}}
