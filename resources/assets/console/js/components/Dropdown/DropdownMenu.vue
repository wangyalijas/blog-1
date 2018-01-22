<template>
    <ul class="dropdown-menu">
        <slot/>
    </ul>
</template>

<script>
    export default {
        name: "dropdown-menu"
    }
</script>

<style lang="scss" scoped>
    ul.dropdown-menu {
        padding: 15px;
        color: #777;
        border-radius: 0;
    }
</style>