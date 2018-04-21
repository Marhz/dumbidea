<template>
<div>
    <div class="card award mb-5">
        <div class="card-header award__title flex">
            <div class="award__title-infos mr-3">
                <a :href="award.path">
                    <h4 class="no-margin"><strong>{{ award.title }}</strong></h4>
                </a>
                <em>by {{ award.owner.name }}</em>
            </div>
            <div class="award_title-controls flex">
                <button class="btn mr-2" :class="upvoteBtnClass" @click="upvote"><i class="fa fa-arrow-up"></i></button>
                <button class="btn" :class="downvoteBtnClass" @click="downvote"><i class="fa fa-arrow-down"></i></button>
            </div>
        </div>
        <a :href="linkTarget">
            <award-overlay :imgSrc="award.image" :alt="award.title" ref="awardOverlay"></award-overlay>
        </a>
        <div class="card-footer flex award__title">
            <div>
                <em class="h5" v-cloak>Score: {{ score }}</em>
                <ul class="list-inline mb-0">
                    <li class="list-inline-item mr-0 mt-2" v-for="tag in award.tags" :key="tag.slug">
                        <a :href="tag.path" class="badge badge-info tag">{{ tag.name }}</a>
                    </li>
                </ul>
            </div>
            <div class="award__title-controls flex align-self-end">
                <button class="btn" :class="upvoteBtnClass" @click="upvote"><i class="fa fa-arrow-up"></i></button>
                <button class="btn" :class="downvoteBtnClass" @click="downvote"><i class="fa fa-arrow-down"></i></button>
                <a :href="award.path + '#comment'">
                    <button class="btn"><i class="fa fa-comment"></i></button>
                </a>
                <button class="btn btn-success" @click="addImg">Moar</button>
            </div>
        </div>
    </div>
</div>

</template>

<script>
import Vote from '../mixins/vote';
import AwardOverlay from './AwardOverlay.vue';

export default {
    components: { AwardOverlay },
    props: ['award', 'is-in-list'],
    mixins: [Vote],
    data() {
        return {
            score: this.award.score,
            upvoted: this.award.user_vote,
            downvoted: this.award.user_vote === false
        }
    },

    methods: {
        upvote() {
            this._upvote(`${this.award.path}/upvote`)
                .then((res) => {
                });
        },
        downvote() {
            this._downvote(`${this.award.path}/downvote`)
                .then(() => {
                });
        },
        addImg() {
            this.$refs.awardOverlay.addImg()
        }
    },
    computed: {
        upvoteBtnClass() {
            return this.upvoted ? 'btn-success ' : '';
        },
        downvoteBtnClass() {
            return this.downvoted ? 'btn-danger' : '';
        },
        linkTarget() {
            return this.isInList ? this.award.path : this.award.image
        }
    }
}
</script>
