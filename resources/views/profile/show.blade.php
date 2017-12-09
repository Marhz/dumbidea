@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex">
        <div class="is64x64 profile__avatar mr-3" style="border: 1px dotted red">
            <async-img src=""></async-img>
        </div>
        <h3>{{ $user->name }}'s profile</h3>        
    </div>
    <div class="flex">
        <v-tabs class="profile__infos" v-cloak>
            <v-tab name="Awards" class="row" :selected="{{ json_encode(request()->has('awardsPage')) }}">
                @forelse($awards as $award)
                    <div class="col-12 col-lg-6 d-flex align-item-stretch">
                        <div class="d-flex flex-column profile__awards">
                            <div class="d-flex">
                                <div class="col-7 col-md-5 profile__awards-image p-0 pr-3">
                                    <async-img src="{{ $award->image }}" class="" />
                                </div>
                                <div class="col-5 col-md-7 profile__awards-info p-0">
                                    <h4 class="h4 mb-0">{{ $award->title }}</h4>
                                    <em class="mb-4">
                                        {{ $award->created_at->toFormattedDateString() }}
                                    </em>                                
                                </div>
                            </div>                        
                            <div class="d-flex align-items-end h5 profile__awards-footer mb-0">
                                <div class="d-flex flex-wrap justify-content-around w-100 mr-2">
                                    <span>Score: {{ $award->score() }}</span>
                                    <span>
                                        <i class="fa fa-arrow-up"></i>{{ $award->totalUpvotes() }}
                                    </span> 
                                    <span>
                                        <i class="fa fa-arrow-down"></i>{{ $award->totalDownvotes() }}
                                    </span>
                                    <span>
                                        <i class="fa fa-comment"></i>{{$award->commentsCount}}                            
                                    </span>                                
                                </div>
                                <a href="{{ $award->path() }}" class="ml-auto">
                                    <button class="btn btn-primary pull-right align-self-end">View award</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="profile__missing col-12">
                        <h3>You haven't created any awards yet</h3>
                    </div>
                @endforelse
                <div class="col-12 flex h3">
                    {{ $awards->links() }}            
                </div>
            </v-tab>
            <v-tab name="Comments" class="row" :selected="{{ json_encode(request()->has('commentsPage')) }}">
                @forelse($comments as $comment)
                    <div class="col-12 col-lg-6 d-flex align-item-stretch">
                        <div class="d-flex flex-column profile__awards">
                            <div class="d-flex">
                                <div class="col-7 col-md-5 profile__awards-image p-0 pr-3">
                                    <async-img src="{{ $comment->award->image }}" class="" />
                                </div>
                                <div class="col-5 col-md-7 profile__awards-info p-0">
                                    <h4 class="h4">{{ $comment->content }}</h4>
                                    <em class="mb-4">
                                        {{ $comment->created_at->toFormattedDateString() }}
                                    </em>                                
                                    <h4 class="h5 mb-0">
                                        in <a href="{{ $comment->award->path() }}">{{ $comment->award->title }}</a>
                                    </h4>
                                </div>
                            </div>                        
                            <div class="d-flex mt-auto align-items-end h5 profile__awards-footer mb-0">
                                <div class="d-flex flex-wrap justify-content-around w-100 mr-2">
                                    <span>Score: {{ $comment->score() }}</span>
                                    <span>
                                        <i class="fa fa-arrow-up"></i>{{ $comment->totalUpvotes() }}
                                    </span> 
                                    <span>
                                        <i class="fa fa-arrow-down"></i>{{ $comment->totalDownvotes() }}
                                    </span>
                                </div>
                                <a href="{{ $comment->path() }}" class="ml-auto">
                                    <button class="btn btn-primary pull-right align-self-end">View comment</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="profile__missing col-12">
                        <h3>You haven't commented yet</h3>
                    </div>
                @endforelse
                <div class="col-12 flex h3">
                    {{ $comments->links() }}            
                </div>
            </v-tab>
            <v-tab name="Upvotes" class="row" :selected="{{ json_encode(request()->has('upvotesPage')) }}">
                @foreach($awardsVotes as $vote)
                    <div class="profile__votes col-3">
                        @include('awards._miniature', ['award' => $vote])                    
                        <p>
                            {{ $vote->created_at->toFormattedDateString() }}
                        </p>
                    </div>
                @endforeach
                <div class="col-12 flex h3">
                    {{ $awardsVotes->links() }}            
                </div>
            </v-tab>
        </v-tabs>
    </div>
</div>
@endsection
