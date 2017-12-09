<template>
    <div class="flash-container">
        <transition-group name="slide-fade">
            <div v-for="message in messages" :key="message.time">
                <div class="alert alert-flash" :class="'alert-'+message.level" role="alert">
                    <i class="mr-3 fa " :class="icon(message)"></i> {{ message.message }}
                    <i class="fa fa-close close" @click="hide(message)"></i>
                </div>
            </div>
        </transition-group>
    </div>
</template>

<script>
    export default {
        props: ['message'],
        data() {
            return {
                messages: [],
            }
        },
        methods: {
            flash(data) {
                data.time = Date.now();
                this.messages.unshift(data);
                setTimeout(() => {
                    this.hide(data)
                }, 8000);
            },
            hide({ time }) {
                this.messages = this.messages.filter(message => message.time !== time);
            },
            icon(message) {
                switch (message.level) {
                    case 'success': return 'fa-check-circle-o';
                    case 'warning': return 'fa-warning';
                    case 'danger': return 'fa-window-close';
                    case 'primary': return 'fa-envelope-o';
                }
            }
        },
        computed: {
        },
        mounted() {
            if (this.message) {
                this.flash(this.message);
            }
            window.events.$on('flash', (data) => this.flash(data));
        }
    }
</script>

<style scoped>
    .flash-container {
        position: fixed;
        bottom: 25px;
        right:25px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }
    .alert-flash {
        font-size: 1.7rem;
        font-weight: 100;
        display: flex;
        align-items: center;
    }
    i {
        font-size: 3rem;
    }
    .close {
        font-size: 1.5rem;
        margin-left: .5rem;
    }
    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateX(100%);
        opacity: 0;
    }
</style>

