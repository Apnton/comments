<script setup>
import {defineProps} from 'vue';
import {useCommentStore} from '@/store/CommentStore.js';

const commentStore = useCommentStore()

const props = defineProps({
    comment: {
        type: Object,
        required: true
    }
})

const reply = (id) => {
    commentStore.form.parent_id = id
    commentStore.dialogVisible = true
}

</script>

<template>

    <div>
        <div class="user">
            <p class="user__name">{{ comment.user.name }}</p>
            <p class="user__email">{{ comment.user.email }}</p>
            <p class="user__published">{{ comment.created_at }}</p>
        </div>

        <div class="comment">
            <div class="comment__content">
            <div v-html="comment.message" ></div>
                <div v-if="comment.file" class="comment__file">
                    <a class="comment__file-link" :href="comment.file" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="800" height="800" viewBox="0 0 548.291 548.291"><path d="M486.201 196.124h-13.166V132.59c0-.396-.062-.795-.115-1.196-.021-2.523-.825-5-2.552-6.963L364.657 3.677c-.033-.031-.064-.042-.085-.075-.63-.704-1.364-1.29-2.143-1.796-.229-.154-.461-.283-.702-.418a11.22 11.22 0 0 0-2.121-.892c-.2-.055-.379-.134-.577-.188A10.684 10.684 0 0 0 356.562 0H96.757C84.894 0 75.256 9.649 75.256 21.502v174.616H62.09c-16.968 0-30.729 13.753-30.729 30.73V386.66c0 16.961 13.761 30.731 30.729 30.731h13.166V526.79c0 11.854 9.638 21.501 21.501 21.501h354.776c11.853 0 21.501-9.647 21.501-21.501V417.392H486.2c16.966 0 30.729-13.764 30.729-30.731V226.854c.001-16.982-13.762-30.73-30.728-30.73zM96.757 21.502h249.054v110.006c0 5.943 4.817 10.751 10.751 10.751h94.972v53.864H96.757V21.502zm106.057 203.54h41.68l14.063 29.3c4.756 9.756 8.336 17.622 12.147 26.676h.48c3.798-10.242 6.9-17.392 10.95-26.676l13.587-29.3h41.449l-45.261 78.363 47.638 82.185H297.62l-14.525-29.06c-5.956-11.197-9.771-19.528-14.299-28.825h-.478c-3.334 9.297-7.381 17.628-12.381 28.825l-13.336 29.06h-41.455l46.455-81.224-44.787-79.324zM66.08 255.532v-30.489h123.382v30.489h-43.828v130.049H109.2V255.532H66.08zm385.454 265.43H96.757v-103.57h354.776v103.57zm20.23-265.43h-43.831v130.049h-36.442V255.532h-43.119v-30.489h123.393v30.489z"/></svg>
                    </a>
                </div>

            </div>
            <div class="comment__actions">
                <button class="comment__reply" @click="reply(comment.id)">
                    Reply
                </button>
            </div>

            <div class="comment__replies">
                <comment
                    v-for="reply in comment.replies"
                    :key="reply.id"
                    :comment="reply"
                />
            </div>
        </div>
    </div>

</template>

<style scoped>

.comment {
    margin-bottom: 1.6rem;
    margin-left: 2rem;
}

.user {
    margin-bottom: 0.8rem;
    padding: 1.6rem;
    border-radius: 0.8rem;
    background-color: var(--white);
    box-shadow: 5px 3px 10px rgba(0, 0, 0, 0.1);
}

.user__name {
    margin-bottom: 0.6rem;
    font-weight: 500;
}

.user__email {
    font-size: 1.4rem;
}

.user__published {
    text-align: right;
    font-weight: 300;
    font-size: 1.4rem;
}

.comment__content {
    margin-bottom: 1.6rem;
    padding: 3.2rem 1.6rem;
    border-radius: 0.8rem;
    background-color: var(--white);
    box-shadow: 5px 3px 10px rgba(0, 0, 0, 0.1);
}

.comment__actions {
    text-align: right;
}

.comment__replies {
    margin-left: 1rem;
    margin-top: 1.6rem;

}

.comment__reply {
    opacity: 0.7;
    cursor: pointer;
    border: none;
    background-color: transparent;
    transition: linear 0.2s;
}

.comment__reply:hover {
    opacity: 1;
    color: var(--sky);
}

.comment__file {
    margin-top: 1rem;
}

.comment__file-link svg {
    width: 30px;
    height: 30px;
    cursor: pointer;
}
</style>
