<template>
  <div>
      <h3>Task Manager</h3>
    <b-table striped hover :items="tasks" :fields="fields" :tbody-tr-class="rowClass" caption-top>
        <template v-slot:table-caption>
            <b-button size="sm" @click="listTick()" class="mr-1 btn btn-success">
                Tick
            </b-button>
        </template>
        <template v-slot:cell(id)="data">
            {{ data.item.id }}
        </template>

         <template v-slot:cell(name)="data">
            {{ data.item.name }}
        </template>

         <template v-slot:cell(priority)="data">
            {{ data.item.priority }}
        </template>

         <template v-slot:cell(dueIn)="data">
            {{ data.item.dueIn }}
        </template>

        <template v-slot:cell()="row">
            <b-button size="sm" @click="deleteTask(row.item)" class="btn btn-danger">
                Delete
            </b-button>
        </template>

    </b-table>
  </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        name: "task",
         components: {
        
        },
        data() {
            return {
                fields: ['id','name','priority', 'dueIn', 'Delete'],
            }
        },
        mounted() {
            this.$store.dispatch('fetchTasks')
        },
        methods: {
            deleteTask(task) {
                this.$store.dispatch('deleteTask', task)
              
            },
            listTick() {
                this.$store.dispatch('listTick')
              
            }
        },
        computed: {
            ...mapGetters([
                'tasks'
            ])
        }
    }
</script>