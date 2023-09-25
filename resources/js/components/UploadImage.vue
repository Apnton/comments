<script setup>
import {defineEmits, ref} from 'vue';

const image = ref(null);
const emit = defineEmits(['uploadImage']);

const selectedImage = async (event) => {
    const reader = new FileReader();
    reader.onload = () => {
        image.value = reader.result;
        emit('uploadImage', event.target.files[0]);
    };
    reader.readAsDataURL(event.target.files[0]);
};

</script>

<template>
    <div class="image">
        <img
            v-if="image"
            class="image__preview"
            :src="image" alt="Image"
        >
        <label
            class="image__input"
            for="image-input">
            UploadImage
        </label>

        <input
            id="image-input"
            @input="selectedImage"
            type="file"
            placeholder="Image"
        >
    </div>
</template>

<style scoped>
.image__preview {
    width: 200px;
}

.image__preview {
    display: block;
    margin-bottom: 1.6rem;
}

.image__input {
    display: inline-block;
    padding: 1rem;
    border: 1px solid var(--gray);
    border-radius: 1.6rem;
    opacity: 0.8;
    cursor: pointer;
}

input[type="file"] {
    display: none;
}
</style>
