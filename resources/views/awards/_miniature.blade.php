<a href="{{ $award->path }}">
    <p>Score : {{ $award->db_score }}</p>
    <div class="group-list-item award__latest">
        <div class="award__latest-img flex">
            <async-img src="{{ $award->image }}" class="" />
        </div>
        <p class="award__latest-title">{{ $award->title }}</p>     
    </div>                
</a>
