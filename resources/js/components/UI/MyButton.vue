<script setup>

</script>

<template>
    <button class="button">
        <slot></slot>
    </button>
</template>

<style scoped>
.button {
    min-width: 120px;
    padding: 1.2rem;
    border: 1px solid var(--sky);
    border-radius: 1.6rem;
    background-color: var(--sky);
    color: var(--white);
    cursor: pointer;
    transition: ease-in-out 0.2s;
}

.button:hover {
    background-color: transparent;
    color: inherit;
}
</style>
