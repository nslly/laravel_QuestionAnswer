<template>
    <div>
        <div class="flex flex-col" id="fade">
            <form v-if="editing" @submit.prevent="update" class="p-4">
                <textarea required v-model="body" class="bg-gray-800  text-white w-full leading-tight shadow-sm focus:border-white focus:ring-blue appearance-none focus:outline-none focus:shadow-outline" rows="10"></textarea>
                <button :disabled="isInvalid"  class="bg-cyan-500 cursor-pointer text-white border-2 mr-2 py-2 mt-2 px-4 border-cyan-500" type="submit">Update</button>
                <button type="button"  class="text-white font-bold cursor-pointer bg-red-500  border-2 py-2 px-3 border-red-500" @click="cancel">Cancel</button>
            </form>
            <div v-else>
                
                <div class="flex justify-end items-center mt-6 mr-4">
                        <a @click="edit" >
                            <div class="bg-cyan-500 cursor-pointer text-white border-2 mr-2 py-2 px-4 border-cyan-500">
                                <span >Edit</span>
                            </div>
                        </a>

                        <div class="text-white cursor-pointer font-bold bg-red-500  border-2 py-2 px-3 border-red-500">
                            <button @click="destroy">X</button>
                        </div>
                    <!-- @endcan -->
                </div>
                <div class="mt-6 flex px-4">
                    <div class="flex flex-col px-2 justify-evenly items-center">
                        <a title="This helps to my question"
                        class="cursor-pointer"
                        onclick="event.preventDefault(); document.getElementById('answer-vote-up-{{ answer.id  }}').submit()">
                            <i class="fa fa-3x fa-caret-up "></i>
                        </a>
                        <span class="text-white">
                            {{ answer.votes_count }}
                        </span>
                        <a title="This not helps to my question" 
                            class="cursor-pointer"
                            onclick="event.preventDefault(); document.getElementById('answer-vote-down-{{ answer.id }}').submit()">
                            <i class="fa fa-3x fa-caret-down"></i>
                        </a>
                            <a title="Mark this answer as best answer"
                                class="cursor-pointer"
                                onclick="event.preventDefault(); document.getElementById('accept-answer-{{ answer.id }}').submit()">
                                <i class="fa fa-2x fa-solid fa-check {{ answer.question.best_answer_id === answer.id ? 'text-green-500' : ''  }} "></i>
                            </a>
                            <div v-if="answer.best_answer">
                                <a title="This is the best answer according to {{ question.user.name }}"
                                    class="cursor-pointer">
                                    <i class="fa fa-2x fa-solid fa-check {{ answer.question.best_answer_id === answer.id ? 'text-green-500' : ''  }} "></i>
                                </a>
                            </div>
                    </div>
                    <div class="p-5 text-white bg-gray-700">
                        <p v-html="bodyHtml"></p>
                    </div>
                </div>
                <div class="flex flex-col ml-6 py-6">
                    <user-info label='Answered' :model= "answer" :model-user="modelUser"></user-info>
                </div>
            </div>
        </div>   
    </div>
</template>

<script>
    export default {
        name: 'Answer',
        props: ['answer', 'question', 'modelUser'],
        data() {
            return {
                editing: false,
                body: this.answer.body,
                id: this.answer.id,
                questionId: this.question.slug,
                bodyHtml: this.answer.body_html,
                beforeEditCache: null
            }
        },
        methods: {
            edit() {
                this.beforeEditCache = this.body;
                this.editing = true;
            },
            cancel() {
                this.body = this.beforeEditCache;
                this.editing = false;
            },
            update() {
                axios.patch(this.endPoint, 
                {
                    body: this.body
                })
                .then(res => {
                    this.editing = false;
                    this.bodyHtml = res.data.body_html;
                    alert(res.data.message);
                })
                .catch(err => {
                    console.log("There something error", err);
                })
            },
            reloadPage() {
                location.reload;
            },
            destroy() {

                if(confirm("Are you sure you want to delete?")) {
                    axios.delete(this.endPoint)
                    .then(res => {
                        location.reload();
                    });
                }
            }
        },
        computed: {
            isInvalid() {
                return this.body.length < 10;
            },
            endPoint () {
                return `/questions/${this.questionId}/answers/${this.id}`;
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>