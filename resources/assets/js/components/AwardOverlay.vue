<template>
<div class="card- award__image flex t">
    <async-img :src="imgSrc" :alt="alt" @imgLoaded="onImgLoad"/>
    <img 
        v-for="image in overlayedImages" 
        :src="image.src" 
        :key="image.key" 
        :style="{bottom: image.y + 'px', right: image.x + 'px'}"
        class="canvas"
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
                imagesSrc: [
                    'https://placeimg.com/100/100/any'
                ],
                lastKey: 0
            }
        },
        methods: {
            addImg() {
                this.overlayedImages.push({
                    src: this.imagesSrc[0]+ '?' + this.lastKey,
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
        mounted() {
        }
    }
</script>

<style>
    .t {
        position: relative;
    }
    .canvas {
        position: absolute;
    }
</style>
