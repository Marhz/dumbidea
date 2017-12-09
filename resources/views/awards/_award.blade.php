<v-award inline-template :award="{{ $award->toJson() }}">
    <div class="card award mb-5">
        <div class="card-header award__title flex">
            <div class="award__title-infos mr-3">
                <a href="{{ $award->path() }}">
                    <h4 class="no-margin"><strong>{{ $award->title }}</strong></h4>
                </a>
                <em>by {{ $award->owner->name }}</em>
            </div>
            <div class="award_title-controls flex">
                <button class="btn mr-2" :class="upvoteBtnClass" @click="upvote"><i class="fa fa-arrow-up"></i></button>
                <button class="btn" :class="downvoteBtnClass" @click="downvote"><i class="fa fa-arrow-down"></i></button>
            </div>
        </div>
        <div class="card- award__image flex">
            <async-img src="{{ asset($award->image) }}" alt="{{ $award->title }}" />
        </div>
        <div class="card-footer flex award__title">
            <div>
                <em class="h5" v-cloak>Score: @{{ score }}</em>
                <ul class="list-inline mb-0">
                    @foreach($award->tags as $tag)
                        <li class="list-inline-item mr-0 mt-2">
                            <a href="{{ $tag->path() }}" class="badge badge-info tag">{{ $tag->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="award__title-controls flex align-self-end">
                <button class="btn" :class="upvoteBtnClass" @click="upvote"><i class="fa fa-arrow-up"></i></button>
                <button class="btn" :class="downvoteBtnClass" @click="downvote"><i class="fa fa-arrow-down"></i></button>
                <a href="{{ $award->path() }}#comment">
                    <button class="btn"><i class="fa fa-comment"></i></button>
                </a>
            </div>
        </div>
    </div>
</v-award>
