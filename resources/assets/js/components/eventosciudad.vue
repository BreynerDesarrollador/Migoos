<template>
    <div>
        {{tipo}}<br>
        {{ciudad}}<br>
        {{buscar}}<br>
        {{fecha}}<br>

    </div>
</template>
<script>
    import axios from 'axios'

    export default {
        mounted() {
            this.tipo=this.$route.params.tipo;
            this.ciudad=this.$route.params.ciudad;
            this.buscar=this.$route.query.buscar;
            this.fecha=this.$route.query.fecha;
        },
        data: function () {
            return{
                tipo:'',
                ciudad:'',
                buscar:'',
                fecha:''
            }
        },
        methods: {
            buscareventosciudad() {

            }
        }
    }
</script>