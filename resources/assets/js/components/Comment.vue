<template>
    <div class="comment mb-3">
        <div class="media">
            <img src="http://via.placeholder.com/64x64" alt="" class="d-flex mr-2">
            <div class="media-body">
                <p class="comment__author mb-0">
                    <a href="" v-text="comment.author.name" class="mr-1"></a>
                    {{ ago }}
                </p>
                <hr class="mb-1 mt-1">
                <p v-text="comment.content" class="comment__content mb-1"></p>
                <div class="comment__footer">
                    <i class="fa fa-arrow-up mr-1"></i>
                    <i class="fa fa-arrow-down"></i>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    export default {
        props: ['comment'],
        computed: {
            ago() {
                return moment(this.comment.created_at).fromNow();
            }
        }
    }
</script>
