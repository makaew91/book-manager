<template>
    <div class="container-fluid">
        <app-header></app-header>
        <router-view />
    </div>
</template>

<script>
import AppHeader from "./Components/AppHeader";
export default {
    components: {AppHeader}
}
</script>

<style scoped>
* {
    margin: 0;
    padding: 0;
}
</style>
