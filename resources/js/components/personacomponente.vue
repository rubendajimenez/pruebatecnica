<template>
<main class="main">
            <!-- Breadcrumb -->
  
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Categorías
                        <button @click="abrirModal('persona','guardar')" type="button" class="btn btn-secondary" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                     
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Apellido paterno</th>
                                    <th>Apellido materno</th>
                                    <th>CI</th>
                                    <th>Direccion</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="persona in arrayPersona" :key="persona.idpersona">
                                    <td>
                                        <button @click="abrirModal('persona','actualizar',persona)" type="button" class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button @click="eliminarPersona(persona.idpersona)" type="button" class="btn btn-danger btn-sm" >
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="persona.nombre"></td>
                                    <td v-text="persona.apellidopaterno"></td>
                                    <td v-text="persona.apellidomaterno"></td>
                                    <td v-text="persona.ci"></td>
                                    <td v-text="persona.direccion"></td>
                             
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
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese el nombre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Apellido paterno</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellidopaterno" class="form-control" placeholder="Ingrese apaellido paterno">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Apellido materno</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellidomaterno" class="form-control" placeholder="Ingrese apellido materno">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Ci</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="ci" class="form-control" placeholder="Ingrese ci">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Direccion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="direccion" class="form-control" placeholder="Ingrese la direccion">
                                    </div>
                                </div>

                                <div v-show="errorpersona" class="form-group row div-error">
                                      <div class="text-center text-error">
                                         <div v-for="error in errorMostarMsg" :key="error" v-text="error">

                                         </div>
                                      </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button @click="registrarPersona()"  type="button" v-if="tipoaccion == 1" class="btn btn-primary">Guardar</button>
                            <button @click="actualizarPersona()" type="button" v-if="tipoaccion == 2" class="btn btn-primary">Actualizar</button>
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
        name:'personacomponente',
        data(){
            return {
                idpersona : 0,
                nombre:'',
                apellidopaterno:'',
                apellidomaterno:'',
                ci:'',
                direccion:'',
                arrayPersona:[],
                modal : 0,
                tituloModal : '',
                tipoaccion : 0,

                errorpersona : 0,
                errorMostarMsg:[]
            }
        },
        mounted() {
            this.listarPersona();
        },
        methods:{
            listarPersona(){
                let me = this;
                axios.get('/persona').then(function(response){
                    console.log(response);
                   me.arrayPersona = response.data;
                }).catch(function (error){
                  console.log(error);
                });
            },
            registrarPersona(){
                if(this.validarPersona()){
                    return;
                }
              let me = this;
                axios.post('/persona/registrar',{
                   
                    'nombre':this.nombre,
                    'apellidopaterno':this.apellidopaterno,
                    'apellidomaterno':this.apellidomaterno,
                    'ci':this.ci,
                    'direccion':this.direccion
                }).then(function(response){
                    me.cerrarModal();
                    me.listarPersona();
                }).catch(function (error){
                  console.log(error);
                });
            },

            actualizarPersona(){
                         if(this.validarPersona()){
                    return;
                }
              let me = this;
                axios.put('/persona/actualizar',{
                    'nombre':this.nombre,
                    'apellidopaterno':this.apellidopaterno,
                    'apellidomaterno':this.apellidomaterno,
                    'ci':this.ci,
                    'direccion':this.direccion,
                    'idpersona':this.idpersona
                }).then(function(response){
                    me.cerrarModal();
                    me.listarPersona();
                }).catch(function (error){
                  console.log(error);
                });
            },
            eliminarPersona(idpersona){
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
                            axios.put('/persona/eliminar',{
                                'idpersona':idpersona
                            }).then(function(response){
                                       Swal.fire(
                                        'Deleted!',
                                        'Fue eliminado.',
                                        'success'
                                        )

                                me.listarPersona();
                            }).catch(function (error){
                            console.log(error);
                            });

                 

                    }
                    })
            },
            validarPersona(){
                this.errorpersona = 0;
                this.errorMostarMsg=[];
                if(!this.nombre) this.errorMostarMsg.push("Nombre no puede estar vacia");
                if(!this.apellidopaterno)this.errorMostarMsg.push("Apellido paterno no puede estar vacia");
                if(!this.apellidopaterno)this.errorMostarMsg.push("apellido materno no puede estar vacia");
                if(!this.ci)this.errorMostarMsg.push("Ci no puede estar vacia");
                if(!this.direccion)this.errorMostarMsg.push("Direccion no puede estar vacia");
         
                if(this.errorMostarMsg.length) this.errorPersona = 1;
                return this.errorPersona;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.apellidopaterno= '';
                this.apellidomaterno= '';
                this.ci= '';
                this.direccion= '';
            },
            abrirModal(modelo,accion,data=[]){
                console.log(accion);
               switch(modelo){
                  case "persona":
                      {
                          

                              if('actualizar'==accion)
                                  {
                                      console.log("esta accion"+accion);
                                      this.modal = 1;
                                      this.tipoaccion = 2;
                                      this.tituloModal = "Actualizar persona";
                                        this.idpersona = data['idpersona'];
                                        this.nombre = data['nombre'];
                                        this.apellidopaterno = data['apellidopaterno'];
                                        this.apellidomaterno = data['apellidomaterno'];
                                        this.ci = data['ci'];
                                        this.direccion = data['direccion'];
                                  }
                              if('guardar'==accion)
                                  {
                                      console.log("esta "+accion);
                                      this.tituloModal = "Registrar Persona"
                                     this.modal = 1;
                                                     this.nombre = '';
                                    this.apellidopaterno= '';
                                    this.apellidomaterno= '';
                                    this.ci= '';
                                    this.direccion= '';
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
