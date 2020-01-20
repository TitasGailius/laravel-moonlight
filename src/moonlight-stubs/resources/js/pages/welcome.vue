<template>
    <div>
        <div v-if="$route().check('login')" class="absolute" style="top: 18px; right: 10px">
            <inertia-link v-if="$page.user" class="uppercase tracking-widest font-semibold text-gray-600 text-sm px-6" href="/home">Home</inertia-link>
            <template v-else>
                <inertia-link class="uppercase tracking-widest font-semibold text-gray-600 text-sm px-6" href="/login">Login</inertia-link>
                <inertia-link class="uppercase tracking-widest font-semibold text-gray-600 text-sm px-6" href="/register">Register</inertia-link>
            </template>
        </div>

        <div class="h-screen flex flex-col justify-center items-center">
            <div class="text-gray-600 mb-8 font-thin" style="font-size: 5.375rem">Laravel Moonlight</div>

            <div class="links">
                <a class="text-sm text-gray-600 tracking-widest uppercase font-semibold px-6" href="https://laravel.com/docs">Docs</a>
                <a class="text-sm text-gray-600 tracking-widest uppercase font-semibold px-6" href="https://laracasts.com">Laracasts</a>
                <a class="text-sm text-gray-600 tracking-widest uppercase font-semibold px-6" href="https://laravel-news.com">News</a>
                <a class="text-sm text-gray-600 tracking-widest uppercase font-semibold px-6" href="https://blog.laravel.com">Blog</a>
                <a class="text-sm text-gray-600 tracking-widest uppercase font-semibold px-6" href="https://nova.laravel.com">Nova</a>
                <a class="text-sm text-gray-600 tracking-widest uppercase font-semibold px-6" href="https://forge.laravel.com">Forge</a>
                <a class="text-sm text-gray-600 tracking-widest uppercase font-semibold px-6" href="https://vapor.laravel.com">Vapor</a>
                <a class="text-sm text-gray-600 tracking-widest uppercase font-semibold px-6" href="https://github.com/laravel/laravel">GitHub</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        //
    }
</script>
