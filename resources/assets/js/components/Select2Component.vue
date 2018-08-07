<template>
    <div>
        <select  multiple="multiple">
            <slot></slot>
        </select>
    </div>
</template>

<script>

    export default {
        props: ['options', 'value'],
        name: "Select2Component",
        data() {
            return {
            }
        },
        mounted: function () {
            var vm = this;
            $(this.$el)
            // init select2
                .select2({
                    data: this.options,
                    width: null,
                    tags: true
                })
                .val(this.value)
                .trigger('change')
                // emit event on change.
                .on('change', function () {
                    vm.$emit('input', this.value)
                })
        },
        watch: {
            value: function (value) {
                // update value
                $(this.$el)
                    .val(value)
                    .trigger('change')
            },
            options: function (options) {
                // update options
                $(this.$el).empty().select2({ data: options })
            }
        },
        destroyed: function () {
            $(this.$el).off().select2('destroy')
        }
    }
</script>

<style scoped>
    select, span {
        width: 40px;
    }
</style>