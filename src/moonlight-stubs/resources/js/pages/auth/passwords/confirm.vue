<template>
    <form class="max-w-lg bg-white rounded-lg shadow mx-auto p-8" @submit.prevent="submit">
        <h1 class="text-2xl font-bold">Confirm Password</h1>

        <h3 class="text-gray-600 text-sm mb-6">Please confirm your password before continuing.</h3>

        <form-input class="mb-2"
                label="Password"
                placeholder="Your Password"
                type="password"
                v-model="form.password"
                :errors="$page.errors.password"
                required
                autocomplete="current-password" />

        <div class="text-right mb-8">
            <inertia-link class="text-sm text-gray-600 hover:text-gray-800" :href="$route('password.request')">Forgot Password?</inertia-link>
        </div>

        <button class="w-full bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded focus:outline-none focus:shadow-outline py-3">
            Confirm Password
        </button>
    </form>
</template>

<script>
    import axios from "axios"

    export default {
        /**
         * Layout of the page.
         *
         * @type {Object}
         */
        layout: require('../../../layouts/app').default,

        /**
         * Component properties.
         *
         * @type {Object}
         */
        props: {
            email: String,
            token: String,
        },

        /**
         * Component reactive data.
         *
         * @return {Object}
         */
        data() {
            return {
                form: {
                    password: '',
                },
            }
        },

        /**
         * Component methods.
         *
         * @type {Object}
         */
        methods: {
            /**
             * Submit the form.
             *
             * @return {void}
             */
            submit() {
                this.$page.errors = {}

                this.$inertia.post(
                    this.$route('password.confirm'), { ...this.form }
                )

                this.form.password = ''
            },
        }
    }
</script>