<template>
    <div>
        <h3>{{ comments.length }} Comments</h3>
        <hr>
        <div class="comment__new mb-5 flex">
            <div class="is64x64 img-container mr-2">
                <async-img :src="getAvatar" alt="" class="mr-2"/>
            </div>
            <div class="comment__new-input" id="comment">
                <textarea 
                    v-model="newComment"
                    placeholder="Write your comment"
                    rows="3"
                ></textarea>
                <button class="btn btn-primary m-1 pull-right comment__new-button" @click="createComment">Post</button>
            </div>
        </div>
        <v-comment 
            v-for="comment in comments" 
            :key="comment.id"
            :comment="comment" 
            @deleted="removeComment(comment)"
        ></v-comment>
    </div>
</template>

<script>
    export default {
        props: ['awardId'],
        data() {
            return {
                comments: [],
                newComment: ''
            }
        },
        methods: {
            createComment() {
                axios.post(`/api/awards/${this.awardId}/comments`, { content: this.newComment })
                    .then(({data}) => {
                        data.focused = true;
                        this.comments.push(data);
                        this.newComment = '';
                    });
            },
            removeComment(comment) {
                this.comments = this.comments.filter(c => c.id !== comment.id)
            }
        },
        computed: {
            getAvatar() {
                return App.guest ? "http://via.placeholder.com/64x64" : App.user.avatar;
            }
        },
        created() {
            axios.get(`/api/awards/${this.awardId}/comments`)
                .then(({data}) => {
                    this.comments = data;
                    let href = window.location.hash;
                    if(href) {
                        const id = href.replace('#comment-', '');
                        let comment = this.comments.find(comment => comment.id == id);
                        if (comment) {
                            comment.focused = true;
                        }
                    }
                });
        }
    }
</script>
