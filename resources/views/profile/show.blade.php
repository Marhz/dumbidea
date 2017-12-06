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
            <v-tab name="Awards" class="row">
                @forelse($awards as $award)
                    <div class="col-6 ">
                        <div class="profile__awards d-flex">
                            <div class="col-5 profile__awards-image p-0 pr-3">
                                <async-img src="{{ $award->image }}" class="" />
                            </div>
                            <div class="col-7 profile__awards-info p-0">
                                <h4 class="h4 mb-0">{{ $award->title }}</h4>
                                <em class="mb-4">
                                    {{ $award->created_at->toFormattedDateString() }}
                                </em>                                
                                <div class="mr-2">Score: {{ $award->score() }}
                                    <i class="fa fa-arrow-up"></i>{{ $award->totalUpvotes() }} 
                                    <i class="fa fa-arrow-down ml-1"></i>{{ $award->totalDownvotes() }}
                                </div>
                                <div>
                                    <i class="fa fa-comment mr-2"></i>{{$award->commentsCount}}
                                </div>
                                <a href="{{ $award->path() }}">
                                    <button class="btn btn-primary pull-right">View award</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="profile__missing col-12">
                        <h3>You haven't created any awards yet</h3>
                    </div>
                @endforelse                    
            </v-tab>
            <v-tab name="Comments" class="row">
                @forelse($comments as $comment)
                    <div class="profile__comments col-6 d-flex mb-3">
                        <div class="col-5 profile__awards-image">
                            <async-img src="{{$comment->award->image }}"/>
                        </div>
                        <div class="col-7">
                            <p class="">"<i>{{ $comment->content }}</i>"</p>
                            <em>
                                in <a href="{{ $comment->award->path() }}#{{ $comment->id }}">{{ $comment->award->title }}</a>
                            </em>
                            <div>
                                <span class="mr-2">Score: {{ $comment->score() }}</span>
                                <i class="fa fa-arrow-up"></i>{{ $comment->totalUpvotes() }} 
                                <i class="fa fa-arrow-down ml-1"></i>{{ $comment->totalDownvotes() }} 
                                <div>{{ $comment->created_at->toFormattedDateString() }}</div>
                                <a href="{{ $comment->award->path }}#comment-{{ $comment->id }}">
                                    <button class="btn btn-primary pull-right">View comment</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="profile__missing col-12">
                        <h3>You haven't commented yet</h3>
                    </div>
                @endforelse
            </v-tab>
            <v-tab name="Upvotes" class="row">
                @foreach($awardsVotes as $vote)
                    <div class="profile__votes col-3">
                        @include('awards._miniature', ['award' => $vote])                    
                        <p>
                            {{ $vote->created_at->toFormattedDateString() }}
                        </p>
                    </div>
                @endforeach
            </v-tab>
            <v-tab name="test">
            
            </v-tab>
        </v-tabs>
    </div>
</div>
@endsection
