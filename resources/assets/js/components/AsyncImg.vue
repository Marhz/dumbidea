<template>
    <div v-if="!loaded"></div>
    <img :src=url :alt="alt" v-else/>	
</template>

<script>
    export default {
        props: ['src', 'alt'],
        data() {
            return {
                url: '',
                loaded: false
            }
        },
        mounted() {
            const img = new Image();
            img.onload = () => {
                this.url = this.src;
                this.loaded = true;
                this.$nextTick(() => {
                    this.$emit('imgLoaded');  
                    
                });
            }
            img.src = this.src;
        }
    }
</script>

<style scoped>
    img, div {
        max-width: 100%;
        max-height: 100%;
    }
</style>
