<template>
    <div class="container-fluid">
        <component :is="layout + '-layout'" v-if="layout"></component>
    </div>
</template>

<script>
import MainLayout from './layout/MainLayout'
import AuthLayout from './layout/AuthLayout'
import {useRoute} from 'vue-router'
import {computed} from 'vue'
export default {
    setup() {
        const route = useRoute()

        return {
            layout: computed(()=> route.meta.layout)
        }
    },
    components: {MainLayout, AuthLayout}
}
</script>

<style scoped>
* {
    margin: 0;
    padding: 0;
}
</style>
