<template>
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">{{ title }}</h2>
        </div>
    </header>
</template>

<script>
    export default {
        name: "page-header",
        props: {
            title: {
                type: String,
                required: true
            }
        }
    }
</script>