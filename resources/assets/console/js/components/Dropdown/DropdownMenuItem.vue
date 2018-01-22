<template>
    <li class="d-flex justify-content-between" :class="{active: isActive()}" @click="clickHandler">
        <slot>
            {{ label }}
        </slot>
        <template v-if="activeIcon && isActive()">
            <i class="align-self-center ml-3" :class="activeIconClass"></i>
        </template>
    </li>
</template>

<script>
    export default {
        name: "dropdown-menu-item",
        props: {
            active: {
                type: Boolean,
                required: false,
                default: false
            },
            label: {
                type: String,
                required: false
            },
            value: {
                type: String,
                required: false
            }
        },
        data: function () {
            return {
                innerText: null
            };
        },
        computed: {
            isAutoActive() {
                return this.$parent.$parent.hasOwnProperty('isAutoActiveMenuItem')
                    ? this.$parent.$parent.isAutoActiveMenuItem()
                    : false;
            },
            activeIcon() {
                return this.$parent.$parent.menuItemActiveIcon;
            },
            activeIconClass() {
                return this.$parent.$parent.menuItemActiveIconClass;
            },
            activeText() {
                return this.$parent.$parent.text;
            },
            computeLabel() {
                return this.label ? this.label : this.innerText;
            },
        },
        methods: {
            isActive() {
                return this.active || (this.isAutoActive && this.activeText === this.computeLabel)
            },
            clickHandler() {
                if (this.$parent.$parent.hasOwnProperty('emitCommandEvent')) {
                    this.$parent.$parent.emitCommandEvent(this.computeLabel, this.value);
                }
            }
        },
        mounted() {
            this.innerText = this.$el.innerText
        }
    }
</script>

<style lang="scss" scoped>
    li {
        cursor: pointer;
        padding: 5px 0;
        color: inherit;
        text-decoration: none;
        &:hover {
            color: #ef5285;
        }
    }
    .active {
        color: #ef5285;
    }
</style>