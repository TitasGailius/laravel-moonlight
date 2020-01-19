<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow py-4 mb-6">
            <div class="container flex justify-between mx-auto">
                <inertia-link href="/" class="text-lg">Laravel</inertia-link>

                <button v-if="$page.user" type="button" class="text-gray-600 text-sm px-2" @click="$inertia.post($route('logout'))">Logout</button>
                <div v-else>
                    <inertia-link class="text-gray-600 text-sm px-2" :href="$route('login')">Login</inertia-link>
                    <inertia-link class="text-gray-600 text-sm px-2" :href="$route('register')">Register</inertia-link>
                </div>
            </div>
        </nav>

        <div class="container">
            <slot></slot>
        </div>
    </div>
</template>


<script>
    export default {
        //
    }
</script>
