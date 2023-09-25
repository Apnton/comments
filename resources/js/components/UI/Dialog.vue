<script setup>
import {defineProps, defineEmits} from 'vue';
import {useCommentStore} from '@/store/CommentStore.js';

const commentStore = useCommentStore()
const emit = defineEmits(['hideDialog'])

const props = defineProps({
    visible: {
        type: Boolean,
        default: () => false
    }
})

const hideDialog = () => {
    emit('hideDialog', false)
}

</script>

<template>
    <div class="dialog" v-if="visible">
        <div class="dialog__overlay" @click="hideDialog">
            <div class="dialog__content" @click.stop>
                <div class="dialog__close" @click="hideDialog">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>

                </div>
                <slot></slot>
            </div>
        </div>
    </div>

</template>

<style scoped>
.dialog__overlay {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 100;
    background-color: rgba(0, 0, 0, 0.2);

}

.dialog__content {
    width: 100%;
    max-width: 500px;
    padding: 5rem 3rem 3rem 3rem;
    border-radius: 1.6rem;
    background-color: #ffffff;

    transform: translateY(-50px);
}

.dialog__close {
    margin-bottom: 1.6rem;
    position: absolute;
    right: 13px;
    top: 10px;
    text-align: right;
    cursor: pointer;
}

.dialog__close svg {
    width: 20px;
    height: 20px;
    display: inline-block;
}

@media (max-width: 600px) {
    .dialog__overlay {
        padding: 0 2rem;
    }
}
</style>
