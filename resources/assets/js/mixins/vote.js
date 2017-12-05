export default {
    data() {
        return {
            upvoted: false,
            downvoted: false,
            score: 0
        }
    },
    methods: {
        _upvote(url) {
            return axios.post(url)
                .then(res => {
                    this.updateScore(this.upvoted, this.downvoted, 1);
                    this.upvoted = !this.upvoted;
                    this.downvoted = false;
                    return Promise.resolve(res)
                });
        },
        _downvote(url) {
            return axios.post(url)
                .then(res => {
                    this.updateScore(this.downvoted, this.upvoted, -1);
                    this.downvoted = !this.downvoted;
                    this.upvoted = false;
                    return Promise.resolve(res)
                });
        },
        updateScore(sameVote, oppositeVote, value) {
            if (oppositeVote)
                this.score += 2 * value;
            else if (sameVote)
                this.score += - value;
            else
                this.score += value;
        }
    },
}
