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
            }
            img.src = this.src;    
        }
    }
</script>

<style scoped>
    img, div {
        width: 100%;
        height: 100%;
    }
</style>
