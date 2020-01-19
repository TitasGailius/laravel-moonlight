<template>
    <form class="max-w-lg bg-white rounded-lg shadow overflow-hidden mx-auto p-8" @submit.prevent="submit">
        <h3 v-if="success" class="rounded bg-green-100 text-green-800 text-sm px-4 py-3 mb-6">
            We have e-mailed your password reset link!
        </h3>

        <h1 class="text-2xl font-bold">Reset Password</h1>

        <h3 class="text-gray-600 text-sm mb-6">
            Remembered Your Password?
            <inertia-link :href="$route('login')" class="text-gray-700 text-sm font-semibold">Sign In</inertia-link>
        </h3>

        <form-input class="mb-8"
                label="Email"
                placeholder="Your Email Address"
                v-model="form.email"
                :errors="$page.errors.email"
                required
                autofocus
                autocomplete="email" />

        <button class="w-full bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded focus:outline-none focus:shadow-outline py-3">
            Send Password Reset Link
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
         * Component reactive data.
         *
         * @return {Object}
         */
        data() {
            return {
                form: {
                    email: '',
                },
                success: false,
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
            async submit() {
                this.success = false
                this.$page.errors = {}

                await this.$inertia.post(
                    this.$route('password.email'), { ...this.form }
                )

                if (!this.$page.errors.email) {
                    this.form = {}
                    this.success = true
                }
            },
        }
    }
</script>