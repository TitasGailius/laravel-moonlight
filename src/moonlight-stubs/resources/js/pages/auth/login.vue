<template>
    <form class="max-w-lg bg-white rounded-lg shadow mx-auto p-8" @submit.prevent="submit">
        <h1 class="text-2xl font-bold">Sign In To Your Account</h1>

        <h3 class="text-gray-600 text-sm mb-6">
            Don't have an account?
            <inertia-link :href="$route('register')" class="text-gray-700 text-sm font-semibold">Sign Up</inertia-link>
        </h3>

        <form-input class="mb-6"
                label="Email"
                placeholder="Your Email Address"
                v-model="form.email"
                :errors="$page.errors.email"
                required
                autofocus
                autocomplete="email" />

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

        <button class="w-full bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded focus:outline-none focus:shadow-outline py-3">Sign In</button>
    </form>
</template>

<script>
    export default {
        /**
         * Layout of the page.
         *
         * @type {Object}
         */
        layout: require('../../layouts/app').default,

        /**
         * Component reactive data.
         *
         * @return {Object}
         */
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                    remember: false,
                }
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
                    this.$route('login'), { ...this.form }
                )

                this.form.password = ''
            }
        }
    }
</script>