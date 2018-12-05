<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="/nova/resources/assistants">Regresar al Panel</a>
                <div class="card card-default">
                    <label for="codigo">Ingrese el codigo del Asistente</label>
                    <input id="codigo" type="number" v-model="codigo">
                    <button @click="registrarAsistencia">Registrar</button>
                </div>
            </div>
        </div>
        <div>Estado: {{response}}</div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                codigo: '',
                response: '',
            }
        },
        watch: {
            codigo(){
                console.log('Codigo changes');
                this.debouncedAsistencia()
            }
        },
        created: function(){
            this.debouncedAsistencia = _.debounce(this.registrarAsistencia, 1000)
        },
        methods:{
            registrarAsistencia(){
                if(this.codigo.length > 0){
                    axios.post('/registrar', {codigo:this.codigo}).then(response =>  {
                        console.log(response);
                        this.response = response.data;
                        let self = this;
                        setTimeout(function(){
                            self.response = '';
                            self.codigo = '';
                        }, 1500)
                    }).catch(error => {
                        console.log(error);
                        this.response = error;
                    })
                }
            }
        }
    }
</script>
