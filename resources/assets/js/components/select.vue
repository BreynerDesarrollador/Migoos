<template>
    <select :name="name" :id="name" class="select2 validate[required] form-control">
        <option v-if="option" :value="option.id" selected>{{option.text}}</option>
        <option v-for="da in datos" :value="da.id">{{da.text}}</option>
    </select>
</template>

<script>
    import $ from 'jquery'
    import 'select2'
    //import 'select2/dist/css/select2.min.css'

    var idselect=0;

    export default {
        name: 'select2',
        props: ['url','name','opcion','buscar','option','datos','array'],
        data: () => ({
        dato:this.datos,
    }),
    mounted () {
        var opcion=this.opcion;
        var id=this.name;
        var buscar=this.buscar;
        //$(this.$el).ready(() => {
        if(!this.array){
            $('#'+id).select2(
                {
                    ajax: {
                        url: '/cargarcombos',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            var opcion1=$(this).attr('name')
                            return {
                                buscar: params.term,
                                operacion: opcion1
                            }
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            return {
                                results: data,
                                pagination: {
                                    more: (params.page * 30) < data.length
                                }
                            };
                        },
                        cache: true
                    },
                    //placeholder: 'Buscar...',
                    theme: "bootstrap4",
                    minimumResultsForSearch: buscar ? 1: -1,
                    width:'100%',
                    escapeMarkup: function (markup) { return markup; }
                });
            $(".select-wrapper").css("display",'none');
            //})
        }else{
            $('#'+id).select2({
                //data:datos,
                //placeholder: 'Buscar...',
                theme: "bootstrap4",
                minimumResultsForSearch: buscar ? 1: -1,
                width:'100%',
                escapeMarkup: function (markup) { return markup; }
            });
        }
    },

    }
</script>