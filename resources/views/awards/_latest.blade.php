<div class="card award__latest-list">
    <div class="card-header">
        <h3>Latest</h3>
    </div>
    <div class="card-body p-0">
        <ul class="group-list p-0 mb-0">
            @foreach($awards as $award)
                <a href="{{ $award->path() }}">
                    <li class="group-list-item">
                        <div class="award__latest-img">
                            <img src="{{ $award->image }}" alt="">
                        </div>
                        <p class="award__latest-title">{{ $award->title }}</p>            
                    </li>                
                </a>
            @endforeach        
        </ul>
    </div>
</div>
