<template>
    <div>
        <div class="flex justify-center items-center flex-col">
            <a title="Click to mark as a favorite question" class="cursor-pointer" @click.prevent="toggle">
                <i :class="classes"></i>
            </a>
            <span class="text-white mt-2">
                {{ favoritesCount }}
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Favorite',
        props: ['question'],
        data() {
            return {
                isFavorited: this.question.is_favorited,
                favoritesCount: this.question.favorites_count,
                questionSlug: this.question.slug
            }
        },
        computed: {
            signedIn () {
                return window.Auth.signedIn;
            },
            classes () {
                if(this.signedIn && this.isFavorited) {
                    return [
                        'fa fa-2x fa-solid fa-star',
                        'text-yellow-500'
                    ]
                } else {
                    return [
                        'fa fa-2x fa-solid fa-star',
                        'text-gray-900'
                    ]
                }
            },
            endPoint() {
                return `/questions/${this.questionSlug}/favorites`;
            },
        },
        methods: {
            toggle() {
                if(!this.signedIn) {
                    alert("You need to login first");
                    return;
                }
                this.isFavorited ? this.destroy() : this.create();
            },
            destroy() {
                axios.delete(this.endPoint)
                .then(res => {
                    this.favoritesCount--;
                    this.isFavorited = false;
                })
            },
            create() {
                axios.post(this.endPoint)
                .then(res => {
                    this.favoritesCount++;
                    this.isFavorited = true;
                })
                
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>