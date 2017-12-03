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
                <textarea class="form-control mb-1" v-model="edit" rows="3" v-if="editing"></textarea>
                <p v-html="content" class="comment__content mb-1" v-else></p>
                <div class="comment__footer">
                    <i class="fa fa-arrow-up mr-1"></i>
                    <i class="fa fa-arrow-down mr-1"></i>
                    <i class="fa fa-edit mr-1" @click="editComment"></i>
                    <i class="fa fa-trash-o mr-1" @click="deleteComment"></i>
                    <div class="pull-right" v-if="editing">
                        <button class="btn btn-primary" @click="updateComment">Edit</button>
                        <button class="btn btn-default" @click="cancelEdit">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    export default {
        props: ['comment'],
        data() {
            return {
                content: this.comment.content,
                edit: this.comment.content,
                editing: false
            }
        },
        methods: {
            editComment() {
                this.editing = true;
            },
            cancelEdit() {
                this.editing = false;
                this.edit = this.comment.content;
            },
            updateComment() {
                axios.patch(`/api/comments/${this.comment.id}/edit`, { content: this.edit })
                    .then(res => {
                        this.content = this.edit;
                        this.editing = false;
                    });
            },
            deleteComment() {
                axios.delete(`/api/comments/${this.comment.id}/delete`)
                    .then(res => {
                        this.$emit('deleted', this.comment.id);
                    });
            }
        },
        computed: {
            ago() {
                return moment(this.comment.created_at).fromNow();
            }
        }
    }
</script>
