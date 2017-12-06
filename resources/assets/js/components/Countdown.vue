<script>
import moment from 'moment'
export default {
    props: ['timestamp'],
    data() {
        return {
            now: new Date(),
            isDone: false
        }
    },
    computed: {
        remaining() {
            let remaining = moment.duration(this.timestamp - this.now);
            if (remaining <= 0) {
                this.$emit('finished');
            }
            return {
                total: remaining,
                hours: remaining.hours(),
                minutes: remaining.minutes(),
                seconds: remaining.seconds()
            };
        },
        done() {
            return this.remaining.total <= 0
        }
    },
    methods: {
        format(int) {
            return int >= 10 ? int : '0' + int;
        }
    },
    created() {
        let interval = setInterval(() => {
            this.now = new Date()
        }, 1000)
        this.$on('finished', () => {
            clearInterval(interval);
            this.isDone = true;
        })
    }
}
</script>

<style scoped>
    .contained {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .countdown {
        font-size: 1.2rem;
        font-family: Arial;
    }
</style>
