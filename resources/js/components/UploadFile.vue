<script setup>
import {defineEmits, ref} from 'vue';

const fileName = ref(null);
const emit = defineEmits(['uploadImage']);

const selectedImage = async (event) => {
    const reader = new FileReader();
    reader.onload = () => {

        fileName.value = event.target.files[0].name
        emit('uploadFile', event.target.files[0]);
    };
    reader.readAsDataURL(event.target.files[0]);
};

</script>

<template>
    <div class="file">
        <label
            class="file__input"
            for="file-input">
            UploadFile
        </label>
        <div class="file__name">{{ fileName}}</div>

        <input
            id="file-input"
            @input="selectedImage"
            type="file"
            placeholder="Image"
        >
    </div>
</template>

<style scoped>
.file {
    display: flex;
    align-items: center;

}

.file__input {
    display: inline-block;
    padding: 1rem;
    margin-right: 1rem;
    border: 1px solid var(--gray);
    border-radius: 1.6rem;
    opacity: 0.8;
    cursor: pointer;
}

.file__name {
    font-size: 1.4rem;
}

input[type="file"] {
    display: none;
}
</style>
