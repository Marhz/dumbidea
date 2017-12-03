<template>
    <div>
        <div class="comment__new flex mb-5">
            <img src="http://via.placeholder.com/64x64" alt="" class="mr-2">
            <div class="comment__new-input">
                <textarea 
                    v-model="newComment"
                    placeholder="Write your comment"
                    rows="3"
                ></textarea>
                <button class="btn btn-primary pull-right m-2" @click="createComment">Post</button>
            </div>
        </div>
        <v-comment v-for="comment in comments" :key="comment.id" :comment="comment"></v-comment>
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
                        this.comments.push(data);
                        this.newComment = '';
                    });
            }
        },
        created() {
            axios.get(`/api/awards/${this.awardId}/comments`)
                .then(({data}) => this.comments = data);
        }
    }
</script>
