<script setup>
import {useCommentStore} from '@/store/CommentStore.js';

const commentStore = useCommentStore()

const sortBy = (field) => {

    if (field === commentStore.params.order_by) {
        commentStore.params.direction = commentStore.params.direction === 'asc' ? 'desc' : 'asc'
    }
    commentStore.params.order_by = field
    commentStore.getCommentsWithParams(commentStore.params)

}

const getClassNames = (fieldName) => {
    return {
        'comment-sorted--asc': commentStore.params.order_by === fieldName && commentStore.params.direction === 'asc',
        'comment-sorted--desc': commentStore.params.order_by === fieldName && commentStore.params.direction === 'desc',
        'comment-sorted': commentStore.params.order_by !== fieldName &&
            commentStore.params.direction === 'asc' || commentStore.params.direction === 'desc'
    }
}

</script>

<template>
    <div class="comment-sort">
        <div
            :class="[getClassNames('users.name'), 'comment-sort__label']"
            @click="sortBy('users.name')">Name
        </div>
        <div
            :class="[getClassNames('users.email'), 'comment-sort__label']"
            @click="sortBy('users.email')">Email
        </div>
        <div
            :class="[getClassNames('created_at'), 'comment-sort__label']"
            @click="sortBy('created_at')">Created
        </div>
    </div>
</template>

<style scoped>
.comment-sort {
    display: flex;
    justify-content: space-between;
    padding: 1.6rem;
    font-weight: 500;
    background-color: var(--sky-100);
    border-radius: 0.8rem;
    box-shadow: 5px 3px 10px rgba(0, 0, 0, 0.1);
}

.comment-sort__label {
    cursor: pointer;
}

.comment-sorted:after,
.comment-sorted--desc:after {
    content: '';
    display: inline-block;
    margin-left: 8px;
    width: 6px;
    height: 6px;
    border-left: 2px solid var(--gray);
    border-top: 2px solid var(--gray);
    transform: rotate(-135deg);
    transform-origin: center;
    vertical-align: middle;
}

.comment-sorted--asc:after {
    content: '';
    display: inline-block;
    margin-left: 8px;
    width: 6px;
    height: 6px;
    border-left: 2px solid var(--gray);
    border-top: 2px solid var(--gray);
    transform: rotate(45deg);
    transform-origin: center;
    vertical-align: middle;
}
</style>
