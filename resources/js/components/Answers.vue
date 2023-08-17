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

            <hr>

            <div class="p-4 flex justify-center" v-if="nextUrl">
                <a @click.prevent=" fetch(nextUrl) " class="text-md  cursor-pointer border-gray-900 bg-gray-900 shadow-md rounded-lg p-2 text-gray-800 dark:text-gray-200">LOAD MORE QUESTIONS</a>
            </div>

        
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
        props: ['question'],
        data() {
            return {
                questionId: this.question.slug,
                answers: [],
                count: this.question.answers,
                nextUrl: null,
            }
        },
        created() {
            this.fetch(`/questions/${this.questionId}/answers`);
        },
        methods: {
            fetch(endpoint) {
                axios.get(endpoint)
                .then(({ data }) => {
                    this.answers.push(...data.data);
                    this.nextUrl = data.next_page_url;
                })
            }
        },
        computed: {
            countTitle() {
                return this.count + " " + (this.count <= 1 ? "Answer" : "Answers");
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>