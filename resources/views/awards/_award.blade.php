<div class="card award mb-5">
    <div class="card-header award__title flex">
        <div class="award__title-infos">
            <h4 class="no-margin">{{ $award->title }}</h4>
            <em>by {{ $award->owner->name }}</em>
        </div>
        <div class="award_title-controls">
            <button>test</button>
        </div>
    </div>
    <div class="card-body award__image flex">
        <img src="{{ asset($award->image) }}" alt="{{ $award->title }}">
    </div>
    <div class="card-footer">
        <ul class="list-inline mb-0">
            @foreach($award->tags as $tag)
                <li class="h4 list-inline-item">
                    <a href="{{ $tag->path() }}" class="badge badge-info">{{ $tag->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
