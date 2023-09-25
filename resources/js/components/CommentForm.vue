<script setup>
import {VueEditor} from 'vue3-editor';
import {useVuelidate} from '@vuelidate/core';
import UploadFile from '@/components/UploadFile.vue';
import {required, email} from '@vuelidate/validators';
import {useCommentStore} from '@/store/CommentStore.js';

const commentStore = useCommentStore()
const rules = {
    name: {required},
    email: {required, email},
    message: {required},
}

const v$ = useVuelidate(rules, commentStore.form)

const customToolbar = [
    [{'header': [1, 2, 3, 4, 5, 6, false]}],
    ['bold', 'italic'],
    ['code-block', 'link', 'image'],
]

const handleImageAdded = (file, Editor, cursorLocation, resetUploader) => {

    const formData = new FormData()
    formData.append('image', file)

    commentStore.uploadImage(formData).then(res => {
        Editor.insertEmbed(cursorLocation, 'image', res)
        resetUploader();
    })
}

const uploadFile = (fileForUpload) => {
    commentStore.form.file = fileForUpload
}

const storeComment = async () => {
    const result = await v$.value.$validate()

    if (result) {
        const formData = new FormData()

        formData.append('name', commentStore.form.name)
        formData.append('email', commentStore.form.email)
        formData.append('message', commentStore.form.message)

        if (commentStore.form.parent_id !== null) {
            formData.append('parent_id', commentStore.form.parent_id);
        }

        if (commentStore.form.file !== null) {
            formData.append('file', commentStore.form.file)
        }

        commentStore.storeComment(formData)
        commentStore.dialogVisible = false
    }

}

</script>

<template>
    <form @submit.prevent class="form">
        <div class="form__row">
            <input
                v-model="commentStore.form.name"
                class="input"
                type="text"
                placeholder="name"
            >
            <span
                class="form__error"
                v-for="error in v$.name.$errors">
                {{ error.$message }}
            </span>
        </div>

        <div class="form__row">
            <input
                v-model="commentStore.form.email"
                class="input"
                type="text"
                placeholder="email"
            >
            <span
                class="form__error"
                v-for="error in v$.email.$errors">
                {{ error.$message }}
            </span>
        </div>

        <div class="form__row">
            <UploadFile
                @uploadFile="uploadFile"
            />
        </div>

        <div class="form__row form__row--wrapper">
            <VueEditor
                :editorToolbar="customToolbar"
                useCustomImageHandler
                @image-added="handleImageAdded"
                v-model="commentStore.form.message"
            >
            </VueEditor>
        </div>

        <div class="form__row">
            <span
                class="form__error"
                v-for="error in v$.email.$errors">
                {{ error.$message }}
            </span>
        </div>

        <div class="centered">
            <MyButton @click="storeComment">
                Send
            </MyButton>
        </div>
    </form>

</template>

<style scoped>
.input {
    width: 93%;
    display: block;
    padding: 1.2rem;
    border-radius: 1.6rem;
    border: 1px solid var(--gray);
    outline: none;
}

.form__row {
    position: relative;
    width: 100%;
    margin-bottom: 1.6rem;
}

.form__error {
    display: block;
    margin-top: 5px;
    padding-left: 10px;
    font-size: 1.2rem;
    color: var(--rose);
}

.form__row--wrapper {
    max-height: 300px;
    overflow-y: scroll;
}
</style>
