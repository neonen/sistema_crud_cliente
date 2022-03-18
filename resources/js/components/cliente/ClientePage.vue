<template>
  <div>
      <v-card>
          <v-card-title>Clientes</v-card-title>
          
          <v-card-text>
              <v-row>
                  <v-col cols="12" md="6">
                      <v-text-field
                        label="Nome"
                        v-model="cliente.nome"
                        :error-messages="erros.nome"
                      ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="6">
                      <v-text-field
                        label="Cpf"
                        v-model="cliente.cpf"
                        :error-messages="erros.cpf"
                      ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="6">
                      <v-text-field
                        label="Contato"
                        v-model="cliente.contato"
                        :error-messages="erros.contato"
                      ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="6">
                      <v-text-field
                        label="Email"
                        v-model="cliente.email"
                        :error-messages="erros.email"
                      ></v-text-field>
                  </v-col>
              </v-row>
          </v-card-text>
          <v-card-actions>
              <v-btn color="success" @click="salvar">Salvar</v-btn>
              <v-btn color="primary" @click="listar">Pesquisar</v-btn>
              <v-btn color="error" @click="limpar">Cancelar</v-btn>
          </v-card-actions>

          <v-card-text>
              <v-simple-table>
                  <thead>
                      <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Contato</th>
                        <th>Email</th>
                        <th>Ação</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr v-for="cliente in clientes" :key="cliente.id">
                          <td>{{cliente.id}}</td>
                          <td>{{cliente.nome}}</td>
                          <td>{{cliente.cpf}}</td>
                          <td>{{cliente.contato}}</td>
                          <td>{{cliente.email}}</td>
                          <td>
                              <v-btn icon @click="selecionar(cliente)"><v-icon>mdi-pencil</v-icon></v-btn>
                              <v-btn icon @click="deletar(cliente.id)"><v-icon>mdi-delete</v-icon></v-btn>
                          </td>
                      </tr>
                  </tbody>
              </v-simple-table>
          </v-card-text>
      </v-card>

  </div>
</template>

<script>
import Cliente from './Cliente';
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    data(){
        return {
            cliente: new Cliente(),
            // clientePesquisa: new Cliente(),
            clientes: [],
            base_url: window.location.origin,
            erros:{},
        }
    },
    created(){
        this.listar();
    },
    methods:{
        limpar(){
            this.cliente = new Cliente();
            this.erros = {};
            this.listar();
        },
        salvar(){
            if(this.cliente.id){
                axios.put(`${this.base_url}/cliente/update`,this.cliente)
                        .then(res => {
                            Swal.fire("Alterado com sucesso!",'','success');
                            this.limpar();
                        })
                        .catch(erro =>{
                            console.error(erro.response)
                            this.erros = erro.response.data.errors;
                        })
            }else{
                axios.post(`${this.base_url}/cliente/create`,this.cliente)
                        .then(res => {
                            Swal.fire("Inserido com sucesso!",'','success');
                            this.limpar();
                        })
                        .catch(erro =>{
                            console.error(erro.response)
                            this.erros = erro.response.data.errors;
                        })
            }
        },
        listar(){
            let params = this.cliente;
            axios.get(`${this.base_url}/cliente/read`,{params})
                    .then(res => {
                        this.clientes = res.data;
                    });
        },
        selecionar(dado){
            this.cliente = dado;
        },
        deletar(id){
             let params = {id};
                axios.delete(`${this.base_url}/cliente/delete`,{params})
                        .then(res => {
                            this.listar();
                        });
        },
    }
}
</script>

<style>

</style>