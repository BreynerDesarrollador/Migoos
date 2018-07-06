<template>
    <div>
        <loader-spinner class="preloader-background" :loading="loading" :color="'#64dd17'"></loader-spinner>
        <transition>
            <router-view></router-view>
        </transition>
    </div>

</template>

<script>
    export default{
        mounted(){
            this.loading=false;
        },
        data: function () {
            return {
                loading:true
            }
        }
    }
</script>