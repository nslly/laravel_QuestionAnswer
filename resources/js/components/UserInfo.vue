<template>
    <div>
        <div>
            <span class="block text-xl py-1 text-gray-500 dark:text-gray-400 font-bold leading-snug">
                {{ postDate }}
            </span>
        </div>
        <div class="flex">
            <img class="rounded-full w-9 h-9" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/karen-nelson.png" alt="profile picture">
            <span class="text-md mt-1 ml-2 py-1 text-gray-500 dark:text-gray-500 font-bold leading-snug">
                {{ user.name }}
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['label', 'modelUser', 'model'],
        data() {
            return {
                user: this.modelUser
            }
        },
        computed: {
            postDate() {
                return this.label + " " + this.model.created_date;
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>