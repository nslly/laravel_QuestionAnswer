<template>
    <div>
        <div class="flex flex-col px-2 justify-evenly items-center">
            <a title="This helps to my question"
                @click.prevent="voteUp"
                class="cursor-pointer"
            >
                <i class="fa fa-3x fa-caret-up "></i>
            </a>
            <span class="text-white">
                {{ count }}
            </span>
            <a title="This not helps to my question" 
                @click.prevent="voteDown"
                class="cursor-pointer"
            >
                <i class="fa fa-3x fa-caret-down"></i>
            </a>
            <favorite v-if="name === 'question'" :question="model"></favorite>
            <accept  v-else :answer="model" :question="model.question"></accept>
            
            

        </div>
    </div>
</template>

<script>
import Favorite from './Favorite.vue';
import Accept from './Accept.vue';
    export default {
        name: 'Vote',
        props: ['name', 'model'],
        components: {
            Favorite,
            Accept
        },
        data() {
            return {
                id: this.name === 'question' ? this.model.slug : this.model.id,
                count: this.name === 'question' ? this.model.votes : this.model.votes_count,
            }
        },
        computed: {
            endPoint() {
                return `/${this.name}s/${this.id}/vote`;
            },
            signedIn () {
                return window.Auth.signedIn;
            },
        },
        methods: {
            voteUp() {
                this._vote(1);
            },

            voteDown() {
                this._vote(-1);
            },

            _vote(vote) {
                if(!this.signedIn) {
                    alert(`You need to login first before you vote to ${this.name}`);
                }
                axios.post(this.endPoint, {
                    vote
                }).then(res => {
                    alert(res.data.message);
                    this.count = res.data.votesCount;
                });
            }

        }
    }
</script>

<style lang="scss" scoped>

</style>