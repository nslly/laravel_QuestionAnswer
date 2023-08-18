<template>
    <div>
        <!-- @can ('accept-best-answer', $answer) -->
        <a v-if="canAccept" title="Mark as best answer"  
            class="cursor-pointer" @click.prevent="create">
            <i :class="classes"></i>
        </a>
        <a v-if="accepted"
            title="This is the best answer"
            class="cursor-pointer">
            <i :class="classes"></i>
        </a>
        
            <!-- @endif
        @endcan -->
    </div>
</template>

<script>


    export default {
        name: 'Accept',
        props: ['answer'],
        inject: ['authorize'],
        data() {
            return {
                isBest: this.answer.best_answer,
                id: this.answer.id,
            }
        },
        created() {
            this.emitter.on('accept', id => {   // *Listen* for event
                this.isBest = (id === this.id)
            });
        },
        methods: {
            create() {
                axios.post(this.endPoint)
                .then(res => {
                    alert(res.data.message);
                    this.isBest = true;
                    this.emitter.emit('accept', this.id); //setting up events
                });
                // location.reload();
                
            }
        },
        computed: {
            endPoint () {
                return `/answers/${this.id}/best_answer`;
            },
            canAccept() {
                return this.authorize('accept', this.answer)
            },

            accepted() {
                return !this.canAccept && this.isBest;
            },
            // cc() {
            //     console.log(this.isBest);
            // },

            classes() {
                return [
                    "fa fa-2x fa-solid fa-check ",
                    this.isBest ? 'text-green-500' : ''  
                ]
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>