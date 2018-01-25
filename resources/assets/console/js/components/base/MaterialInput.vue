<template>
    <div class="form-group-material">
        <input :type="type"
               :class="computedInputClasses"
               v-model="internalValue"
               :required="required"
        >

        <label :class="computedLabelClasses" v-text="label"></label>

    </div>
</template>

<script>
    export default {
        name: "material-input",
        props: {
            value: {
                required: false
            },
            label: {
                type: String,
                required: true
            },
            type: {
                type: String,
                required: false,
                default: 'text'
            },
            required: {
                type: Boolean,
                required: false,
                default: false
            },
            classes: {
                type: [Object, Array],
                required: false,
            },
            labelClasses: {
                type: [Object, Array],
                required: false,
            }
        },
        data() {
            return {
                internalValue: null
            }
        },
        watch: {
            value: function () {
                this.initInternalValue();
            },
            internalValue(value, oldValue) {
                if (value !== oldValue) {
                    this.$emit('input', value)
                }
            }
        },
        computed: {
            hasValue() {
                return !!this.internalValue;
            },
            computedInputClasses() {
                let classes = {};

                if (Array.isArray(classes)) {
                    classes.forEach(className => {
                        classes[className] = true;
                    });
                } else {
                    for (let className in classes) {
                        if (classes.hasOwnProperty(className)) {
                            classes[className] = true;
                        }
                    }
                }
                classes['input-material'] = true;

                return classes;
            },
            computedLabelClasses() {
                let classes = {};

                if (Array.isArray(classes)) {
                    classes.forEach(className => {
                        classes[className] = true;
                    });
                } else {
                    for (let className in classes) {
                        if (classes.hasOwnProperty(className)) {
                            classes[className] = true;
                        }
                    }
                }

                classes['label-material'] = true;
                classes['active'] = this.hasValue;

                return classes;
            }
        },
        methods: {
            initInternalValue() {
                this.internalValue = this.value;
            }
        },
        created() {
            this.initInternalValue();
        }
    }
</script>

<style scoped>

</style>