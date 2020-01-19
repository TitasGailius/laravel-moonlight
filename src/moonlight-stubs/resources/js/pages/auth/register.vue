<template>
    <form class="max-w-lg bg-white rounded-lg shadow mx-auto p-8" @submit.prevent="submit">
        <h1 class="text-2xl font-bold">Create a New Account</h1>

        <h3 class="text-gray-600 text-sm mb-6">
            Already have an account?
            <inertia-link :href="$route('login')" class="text-gray-700 text-sm font-semibold">Sign In</inertia-link>
        </h3>

        <form-input class="mb-6"
                label="Name"
                placeholder="Your Name"
                v-model="form.name"
                :errors="$page.errors.name"
                autocomplete="name"
                required
                autofocus />

        <form-input class="mb-6"
                label="Email"
                placeholder="Your Email Address"
                v-model="form.email"
                :errors="$page.errors.email"
                autocomplete="email"
                required />

        <form-input class="mb-6"
                label="Password"
                placeholder="Your Password"
                type="password"
                v-model="form.password"
                :errors="$page.errors.password"
                autocomplete="new-password"
                required />

        <form-input class="mb-8"
                label="Confirm Password"
                placeholder="Confirm Your Password"
                type="password"
                v-model="form.password_confirmation"
                :errors="$page.errors.password_confirmation"
                autocomplete="new-password"
                required />

        <button class="w-full bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded focus:outline-none focus:shadow-outline py-3">Sign Up</button>
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
                    this.$route('register'), { ...this.form }
                )

                this.form.password = ''
                this.form.password_confirmation = ''
            }
        }
    }
</script>