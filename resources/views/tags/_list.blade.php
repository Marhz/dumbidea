<div class="card fixed">
    <div class="card-header">
        Popular tags
    </div>
    <div class="card-body">
        <ul class="list-group">
            @foreach($tags as $tag)
                <li class="tag-list justify-content-between">
                    <a href="{{ $tag->path }}" class="badge badge-info tag">{{ $tag->name }}</a>
                    <span class="badge-pill badge-warning tag-count">{{ $tag->score }}</span>
                </li>
            @endforeach            
        </ul>
    </div>
</div>
