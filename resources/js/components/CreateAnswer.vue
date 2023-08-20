<template>
    <div>
        <div class="bg-gray-700 m-16 mt-20">
            <div class="mx-auto p-4 flex justify-between">
                <h2 class="font-semibold p-3 text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Your Answer
                </h2>
            </div>
            <hr>
            <form @submit.prevent="create">
                <div class="w-full p-2 bg-gray-700">
                    <textarea required v-model="body" class="bg-gray-800 mt-4 text-white w-full leading-tight shadow-sm focus:border-white focus:ring-blue appearance-none focus:outline-none focus:shadow-outline" rows="10" placeholder="Enter your answer here"  ></textarea>
                </div>

                <div class="mt-2 p-2">
                    <button type="submit" :disabled="isInvalid" class="text-white rounded-md border p-3 shadow-sm cursor-pointer text-base font-medium transition border-gray-900 bg-gray-900 dark:text-gray-200 ">Submit</button>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
    export default {
        name: "CreateAnswer",
        props: ['questionId'],
        data() {
            return {
                body: ''
            }
        },
        methods: {
            create () {
                axios.post(this.endPoint, {
                    body: this.body
                })
                .then( ({data})  => {
                    alert(data.message);
                    this.$emit('created', data.answer);
                    this.body = "";
                })
                .catch(err => {
                    alert(err);
                })
                
            }
        },
        computed: {
            signedIn () {
                return window.Auth.signedIn;
            },
            isInvalid () {
                return !this.signedIn || this.body.length < 10;
            },
            endPoint () {
                return `/questions/${this.questionId}/answers`;
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>