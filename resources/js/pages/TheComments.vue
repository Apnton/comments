<script setup>
import {onMounted} from 'vue';
import Comment from '@/Components/Comment.vue';
import CommentForm from '@/components/CommentForm.vue';
import CommentSort from '@/components/CommentSort.vue';
import {useCommentStore} from '@/store/CommentStore.js';

const commentStore = useCommentStore()

const createComment = () => {
    commentStore.dialogVisible = true
}

const hideDialog = (isVisible) => {
    commentStore.dialogVisible = isVisible
}

window.Echo.channel('store_comment')
    .listen('.store_comment', res => {
        commentStore.getCommentsWithParams(commentStore.params)
    })

onMounted(async () => {
    commentStore.getCommentsWithParams(commentStore.params)
})
</script>

<template>
    <div>
        <div class="row row--comment">
            <MyButton @click="createComment">
                Create new comment
            </MyButton>
        </div>
        <div class="row" v-if="commentStore.comments.length">
            <CommentSort />
        </div>
        <div class="row">
            <Comment
                v-for="comment in commentStore.comments"
                :comment="comment"
            />
        </div>
        <Dialog
            @hideDialog="hideDialog"
            :visible="commentStore.dialogVisible"
        >
            <CommentForm/>
        </Dialog>
    </div>
</template>

<style scoped>
.row {
    margin-bottom: 1.6rem;
}

.row--comment {
    text-align: right;
}

.row--no-comments {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 250px;
    text-align: center;
    padding: 3rem;
    font-size: 3rem;
    font-weight: 300;
    opacity: 0.3;

}
</style>
