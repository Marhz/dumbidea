<template>
    <div>
        <v-comment v-for="comment in comments" :key="comment.id" :comment="comment"></v-comment>
    </div>
</template>

<script>
    export default {
        props: ['awardId'],
        data() {
            return {
                comments: []
            }
        },
        created() {
            axios.get(`/api/awards/${awardId}/comments`)
                .then(({comments}) => this.comments = comments)
        }
    }
</script>
