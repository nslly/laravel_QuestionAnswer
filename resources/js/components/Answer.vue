<template>
    <div>
        <hr>
        <div class="flex flex-col" id="fade">
            <form v-if="editing" @submit.prevent="update" class="p-4">
                <textarea required v-model="body" class="bg-gray-800  text-white w-full leading-tight shadow-sm focus:border-white focus:ring-blue appearance-none focus:outline-none focus:shadow-outline" rows="10"></textarea>
                <button :disabled="isInvalid"  class="bg-cyan-500 cursor-pointer text-white border-2 mr-2 py-2 mt-2 px-4 border-cyan-500" type="submit">Update</button>
                <button type="button"  class="text-white font-bold cursor-pointer bg-red-500  border-2 py-2 px-3 border-red-500" @click="cancel">Cancel</button>
            </form>
            <div v-else>
                
                <div v-if="canAccept" class="flex justify-end items-center mt-6 mr-4">
                        <a @click="edit" >
                            <div class="bg-cyan-500 cursor-pointer text-white border-2 mr-2 py-2 px-4 border-cyan-500">
                                <span >Edit</span>
                            </div>
                        </a>
                        <div>
                            <button @click="destroy" class="text-white cursor-pointer font-bold bg-red-500  border-2 py-2 px-3 border-red-500">X</button>
                        </div>

                </div>
                <div class="mt-6 flex px-4">

                    <!-- Component for VOTE vue -->
                    <vote :model="answer" :name="'answer'"></vote>

                    <div class="p-5 text-white bg-gray-700">
                        <p v-html="bodyHtml"></p>
                    </div>
                </div>

                <!-- Component for UserInfo vue -->
                <div class="flex flex-col ml-6 py-6">
                    <user-info label='Answered' :model="answer"></user-info>
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
        name: 'Answer',
        props: ['answer'],
        inject: ['authorize'],
        mixins: [modification],
        components: {
            Vote,
            UserInfo
        },
        data() {
            return {
                body: this.answer.body,
                id: this.answer.id,
                questionId: this.answer.question.slug,
                bodyHtml: this.answer.body_html,
                beforeEditCache: null,
            }
        },
        methods: {
            setEditCache() {
                this.beforeEditCache = this.body;
            },
            restoreFromCache() {
                this.body = this.beforeEditCache;
            },
            payload() {
                return {
                    body: this.body
                }
            },
            delete() {
                axios.delete(this.endPoint)
                    .then(res => {
                        this.$emit('delete');
                });
            },
            
        },
        computed: {
            model() {
                return this.answer;
            },
            
            
            isInvalid() {
                return this.body.length < 10;
            },
            endPoint () {
                return `/questions/${this.questionId}/answers/${this.id}`;
            },
            
        }
    }
</script>

<style lang="scss" scoped>

</style>