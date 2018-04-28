<div class="card fixed">
    <div class="card-header">
        Popular tags
    </div>
    <div class="card-body tags">
        <ul class="list-group tags-list">
            @foreach($tags as $tag)
                <li class="tag-item justify-content-between">
                    <a href="{{ $tag->path }}" class="badge badge-info tag">{{ $tag->name }}</a>
                    <span class="badge-pill badge-warning tag-count">{{ $tag->_score }}</span>
                </li>
            @endforeach            
        </ul>
    </div>
</div>
