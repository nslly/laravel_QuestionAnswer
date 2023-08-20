<template>
    <div>
        <form class="bg-gray-700 m-16" v-if="editing" @submit.prevent="update">
            <div class="mx-auto p-4 flex justify-between">
                <input type="text" class="bg-gray-800 py-4 text-white w-full leading-tight shadow-sm focus:border-white focus:ring-blue appearance-none focus:outline-none focus:shadow-outline" v-model="title" />
            </div>

            <hr>
            <div class="flex flex-col py-12 ">
                <div class="px-4">
                    <textarea required v-model="body" class="bg-gray-800  text-white w-full leading-tight shadow-sm focus:border-white focus:ring-blue appearance-none focus:outline-none focus:shadow-outline" rows="10"></textarea>
                    <button :disabled="isInvalid"  class="bg-cyan-500 cursor-pointer text-white border-2 mr-2 py-2 mt-2 px-4 border-cyan-500" type="submit">Update</button>
                    <button type="button"  class="text-white font-bold cursor-pointer bg-red-500  border-2 py-2 px-3 border-red-500" @click="cancel">Cancel</button>
                </div>
            </div>
        </form>
        <div v-else class="bg-gray-700 m-16">
            <div class="mx-auto p-4 flex justify-between">
                <h2 class="font-semibold p-3 text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{title}}
                </h2>
                <a href="/questions" class="bg-gray-500 text-white rounded-md border p-3 shadow-sm cursor-pointer text-base font-medium transition hover:bg-gray-600  duration-0 hover:duration-450 ease-in-out focus:bg-gray-600 focus:ring-1 ">GO BACK TO QUESTIONS</a>
            </div>

            <hr>
            <div class="mt-12">
                <div class="flex justify-end items-center mt-6 mr-4">
                        <a v-if="canAccept" @click="edit" >
                            <div class="bg-cyan-500 cursor-pointer text-white border-2 mr-2 py-2 px-4 border-cyan-500">
                                <span >Edit</span>
                            </div>
                        </a>
                        <div>
                            <button v-if="deleteQuestion" @click="destroy" class="text-white cursor-pointer font-bold bg-red-500  border-2 py-2 px-3 border-red-500">X</button>
                        </div>

                </div>
                <div class="flex px-4">
                    <div class="flex flex-col px-2 justify-evenly items-center">


                        <vote :model="question" :name="'question'"></vote>

                    </div>
                    <div class="p-5 text-white bg-gray-700">
                        <p v-html="bodyHtml"></p>
                    </div>
                </div>
                <div class="flex flex-col ml-6 py-6">
                    <user-info label='Asked' :model= "question"></user-info>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vote from './Vote.vue';
import UserInfo from './UserInfo.vue';
import modification from '../mixins/modification.js';
    export default {
        name: "Question",
        props: ['question'],
        inject: ['authorize'],
        mixins: [modification],
        components: {
            Vote,
            UserInfo
        },
        data() {
            return {
                title: this.question.title,
                body: this.question.body,
                bodyHtml: this.question.body_html,
                
                id: this.question.slug,
                beforeEditCache: {}
            }
        },
        computed: {
            isInvalid() {
                return this.body.length < 10 || this.title.length < 10;
            },
            endPoint() {
                return `/questions/${this.id}`;
            },
            deleteQuestion() {
                return this.authorize('deleteQuestion', this.question);
            },
            model() {
                return this.question;
            }
        },
        methods: {
            setEditCache() {
                this.beforeEditCache = {
                    body: this.body,
                    title: this.title
                };
            },
            restoreFromCache() {
                this.body = this.beforeEditCache.body;
                this.title = this.beforeEditCache.title;
            },
            payload() {
                return {
                    body: this.body,
                    title: this.title
                }
            },
            delete() {
                axios.delete(this.endPoint)
                    .then(res => {
                        alert(res.data.message);
                });

                setTimeout(()=> {
                    window.location.href="/questions"
                }, 2000)

            }
        }
    }
</script>

<style lang="scss" scoped>

</style>