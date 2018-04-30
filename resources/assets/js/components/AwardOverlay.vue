<template>
<div class="card- award__image flex t">
    <async-img :src="imgSrc" :alt="alt" @imgLoaded="onImgLoad"/>
    <img 
        v-for="image in overlayedImages" 
        :src="image.src" 
        :key="image.key" 
        :style="{bottom: image.y + 'px', right: image.x + 'px'}"
        class="moar"
    />
</div>
</template>

<script>
    export default {
        props: ['width', 'height', 'imgSrc', 'alt'],
        data() {
            return {
                showCanvas: false,
                canvasHeight: 0,
                canvasWidth: 0,
                overlayedImages: [],
                lastKey: 0
            }
        },
        methods: {
            addImg() {
                console.log(Math.floor(Math.random() * window.App.moar.length));
                this.overlayedImages.push({
                    src: window.App.moar[Math.floor(Math.random() * window.App.moar.length)],
                    // src: this.window.App.moar[0]+ '?' + this.lastKey,
                    key: this.lastKey,
                    x: Math.random() * (this.$el.clientWidth - 100),
                    y: Math.random() * (this.$el.clientHeight - 100),
                })
                this.lastKey++
            },
            onImgLoad() {
                this.canvasHeight = this.$el.clientHeight
                this.canvasWidth = this.$el.clientWidth
                this.showCanvas = true;
            }
        },
    }
</script>

<style scoped>
    
    .t {
        position: relative;
    }
    .moar {
        width: 100px;
        position: absolute;
    }
</style>
