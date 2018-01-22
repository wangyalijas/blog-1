<template>
    <div class="dropdown-container">
        <button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle"><slot name="left"/>{{ text }}<slot name="right"/><span class="caret"></span></button>
        <slot/>
    </div>
</template>

<script>
    export default {
        name: "dropdown",
        props: {
            text: {
                type: String,
                required: true
            },
            autoActiveMenuItem: {
                type: Boolean,
                required: false,
                default: false
            },
            menuItemActiveIcon: {
                type: Boolean,
                required: false,
                default: false
            },
            menuItemActiveIconClass: {
                type: String,
                required: false,
                default: 'fa fa-check'
            },
        },
        methods: {
            isAutoActiveMenuItem() {
                return this.autoActiveMenuItem;
            },
            emitCommandEvent(...parameters) {
                this.$emit('command', ...parameters);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .dropdown-container {
        .dropdown-toggle {
            /*background: #ef5285;*/
            color: #fff;
        }
    }
</style>