<template>
    <div>
        <div class="bg-gray-700 m-16 mt-20" v-cloak v-if="count">
            <div class="mx-auto p-4 flex justify-between">
                <h2 class="font-semibold p-3 text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ countTitle }}
                </h2>
            </div>
        
            <hr>

            <answer v-for="answer in answers" :key="answer.id" :answer="answer"></answer>
        
            <!-- @foreach ($answers as $answer)
                @include('answers._answer', [
                    'answer'    => $answer,
                ])
                <hr>
            @endforeach -->
        </div>
    </div>
</template>

<script>
import Answer from './Answer.vue';
    export default {
        name: 'Answers',
        components: { Answer },
        props: ['answers', 'count'],
        computed: {
            countTitle() {
                return this.count + " " + (this.count <= 1 ? "Answer" : "Answers");
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>