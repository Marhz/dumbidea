<script>
    export default {
        props: ['award'],
        data() {
            return {
                upvoted: this.award.user_vote === 1,
                downvoted: this.award.user_vote === -1
            }
        },
        methods: {
            upvote() {
                axios.post(`${this.award.path}/upvote`)
                    .then(res => {
                        this.upvoted = !this.upvoted;
                        this.downvoted = false;
                    });
            },
            downvote() {
                axios.post(`${this.award.path}/downvote`)
                    .then(res => {
                        this.downvoted = !this.downvoted;
                        this.upvoted = false;
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
