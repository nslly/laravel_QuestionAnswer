<template>
    <div>
        <div class="bg-gray-700 m-16 mt-20" v-cloak v-if="count">
            <div class="mx-auto p-4 flex justify-between">
                <h2 class="font-semibold p-3 text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ countTitle }}
                </h2>
            </div>
        
            <hr>

            <!-- Component for Answer vue -->
            <answer @delete="remove(index)" v-for="(answer, index) in answers" :key="answer.id" :answer="answer"></answer>

            <hr>

            <!-- Load more answer  -->
            <div class="p-4 flex justify-center" v-if="nextUrl">
                <a @click.prevent=" fetch(nextUrl) " class="text-md  cursor-pointer border-gray-900 bg-gray-900 shadow-md rounded-lg p-2 text-gray-800 dark:text-gray-200">LOAD MORE QUESTIONS</a>
            </div>

        
        </div>

        <!-- Component for CreateAnswer vue -->
        <create-answer @created="add" :question-id="question.slug"></create-answer>

    </div>
</template>

<script>
import Answer from './Answer.vue';
import CreateAnswer from './CreateAnswer.vue'
    export default {
        name: 'Answers',
        components: { Answer, CreateAnswer },
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
            },
            remove(index) {
                this.answers.splice(index,1);
                this.count--;
            },
            add(answer) {
                this.answers.push(answer);
                this.count++;
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