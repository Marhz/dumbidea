export default {
    data() {
        return {
            upvoted: false,
            downvoted: false
        }
    },
    methods: {
        _upvote(url) {
            return axios.post(url)
                .then(res => {
                    this.upvoted = !this.upvoted;
                    this.downvoted = false;
                });
        },
        _downvote(url) {
            return axios.post(url)
                .then(res => {
                    this.downvoted = !this.downvoted;
                    this.upvoted = false;
                });
        }
    },
}
