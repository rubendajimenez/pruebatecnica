<template>
<main class="main">
            <!-- Breadcrumb -->
    
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Categorías
                        <button @click="abrirModal('tipotelefono','guardar')" type="button" class="btn btn-secondary" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                      
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Descripción</th>
                                 
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="tipotelefono in arraytipotelefono" :key="tipotelefono.idtipotelefono">
                                    <td>
                                        <button @click="abrirModal('tipotelefono','actualizar',tipotelefono)" type="button" class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button @click="eliminarTipoTelefono(tipotelefono.idtipotelefono)" type="button" class="btn btn-danger btn-sm" >
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                   
                                    <td v-text="tipotelefono.descripcion"></td>
                               
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade"  tabindex="-1" :class="{'mostrar': modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Nombre de categoría">
                                        <span class="help-block">Ingrese descripcion</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="email" id="descripcion" name="descripcion" class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>

                                <div v-show="errortipotelefono" class="form-group row div-error">
                                      <div class="text-center text-error">
                                         <div v-for="error in errorMostarMsgTipofelefon" :key="error" v-text="error">

                                         </div>
                                      </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button @click="registrarTipoTelefono()"  type="button" v-if="tipoaccion == 1" class="btn btn-primary">Guardar</button>
                            <button @click="actualizarTipoTelefono()" type="button" v-if="tipoaccion == 2" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
 
            <!-- Fin del modal Eliminar -->
            
        </main>
</template>

<script>
    export default {
        name:'tipotelefono',
        data(){
            return {
                idtipotelefono : 0,
                descripcion :'',
                arraytipotelefono:[],
                modal : 0,
                tituloModal : '',
                tipoaccion : 0,

                errortipotelefono : 0,
                errorMostarMsgTipofelefon:[]
            }
        },
        mounted() {
            this.listarTipoTelefono();
        },
        methods:{
            listarTipoTelefono(){
                let me = this;
                axios.get('/tipotelefono').then(function(response){
                   me.arraytipotelefono = response.data;
                }).catch(function (error){
                  console.log(error);
                });
            },
            registrarTipoTelefono(){
                if(this.validarTipoTelefono()){
                    return;
                }
              let me = this;
                axios.post('/tipotelefono/registrar',{
                    'descripcion':this.descripcion
                }).then(function(response){
                    me.cerrarModal();
                    me.listarTipoTelefono();
                }).catch(function (error){
                  console.log(error);
                });
            },
            actualizarTipoTelefono(){
                         if(this.validarTipoTelefono()){
                    return;
                }
              let me = this;
                axios.put('/tipotelefono/actualizar',{
                    'descripcion':this.descripcion,
                    'idtipotelefono':this.idtipotelefono
                }).then(function(response){
                    me.cerrarModal();
                    me.listarTipoTelefono();
                }).catch(function (error){
                  console.log(error);
                });
            },
            eliminarTipoTelefono(idtipotelefono){
                Swal.fire({
                    title: 'Esta seguro?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si eliminar!'
                    }).then((result) => {
                    if (result.isConfirmed) {

                        let me = this;
                            axios.put('/tipotelefono/eliminar',{
                                'idtipotelefono':idtipotelefono
                            }).then(function(response){
                                       Swal.fire(
                                        'Deleted!',
                                        'Fue eliminado.',
                                        'success'
                                        )

                                me.listarTipoTelefono();
                            }).catch(function (error){
                            console.log(error);
                            });

                 

                    }
                    })
            },
            validarTipoTelefono(){
                this.errortipotelefono = 0;
                this.errorMostarMsgTipofelefon=[];
                if(!this.descripcion) this.errorMostarMsgTipofelefon.push("La descripcion no puede estar vacia");
                if(this.errorMostarMsgTipofelefon.length) this.errortipotelefono = 1;
                return this.errortipotelefono;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.descripcion = '';
            },
            abrirModal(modelo,accion,data=[]){
                console.log(accion);
               switch(modelo){
                  case "tipotelefono":
                      {
                          

                              if('actualizar'==accion)
                                  {
                                      console.log("esta accion"+accion);
                                      this.modal = 1;
                                      this.tipoaccion = 2;
                                      this.tituloModal = "Actualizar Telefono";
                                      this.idtipotelefono = data['idtipotelefono'];
                                      this.descripcion = data['descripcion'];
                                  }
                              if('guardar'==accion)
                                  {
                                      console.log("esta "+accion);
                                      this.tituloModal = "Registrar Telefono"
                                     this.modal = 1;
                                     this.descripcion = '';
                                     this.tipoaccion = 1
                                  }
                          
                      }
               }
            }
        }
    }
</script>

<style scoped>
 
   .modal-content{
       width: 100% !important;
       position :  absolute  !important;
   }
 
   .mostrar{
     display: list-item  !important;
     opacity: 1 !important;
     position: absolute !important;
     background-color: #3c29297a !important;
   }
   .div-error{
       color: red !important;
       font-weight: bold;
   }
</style>
