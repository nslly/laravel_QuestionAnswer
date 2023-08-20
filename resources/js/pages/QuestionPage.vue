<template>
    <div>
        <question :question="question"></question>
        <answers :question="question"></answers>
    </div>
</template>

<script>
import Question from '../components/Question.vue'
import Answers from '../components/Answers.vue'
    export default {
        name: "QuestionPage",
        props: ['question'],
        components: {
            Answers,
            Question
        }
    }
</script>

<style lang="scss" scoped>

</style>