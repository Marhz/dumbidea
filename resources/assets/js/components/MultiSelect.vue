<template>
    <div>
        <multiselect 
            :options="options" 
            :multiple="true" 
            :taggable="true"
            @tag="newTag"
            v-model="selected" 
        ></multiselect>
        <input type="hidden" name="tags[]" v-for="item in selected" :value="item" :key="item">
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    export default {
        components: {
            Multiselect
        },
        name: "multi-select",
        props: ['options'],
        data() {
            return {
                selected: [],
            }
        },
        methods: {
            newTag(tag) {
                this.selected.push(tag)
                this.options.push(tag)
                this.$children[0].optionKeys.push(tag)
            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
