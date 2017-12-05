<script>
import Vote from '../mixins/vote';
export default {
    props: ['award'],
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
        }
    },
    computed: {
        upvoteBtnClass() {
            return this.upvoted ? 'btn-success ' : '';
        },
        downvoteBtnClass() {
            return this.downvoted ? 'btn-danger' : '';
        }
    }
}
</script>
