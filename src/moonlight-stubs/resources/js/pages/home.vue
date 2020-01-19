<template>
    <div class="max-w-md lg:max-w-3xl bg-white rounded-lg shadow mx-auto p-8">
        <h1 class="text-2xl font-bold text-gray-600">Welcome, {{ user.name }}!</h1>
        <h1 class="text-xl font-bold text-gray-700">Build something incredible.</h1>
    </div>
</template>

<script>
    export default {
        /**
         * Layout of the page.
         *
         * @type {Object}
         */
        layout: require('../layouts/app').default,

        /**
         * Component properties.
         *
         * @type {Object}
         */
        props: {
            user: Object,
        }
    }
</script>
