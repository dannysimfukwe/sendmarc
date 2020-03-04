<template>
  <div>
      <h3>Task Manager</h3>
    <b-table striped hover :items="tasks" :fields="fields" caption-top>
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
    <b-form inline>
        <label class="sr-only" for="inline-form-input-name">Name</label>
        <b-input
            id="inline-form-input-name"
            class="mb-2 mr-sm-2 mb-sm-0"
            placeholder="New Task"
            v-model="task_data.name"
        ></b-input>

        <label class="sr-only" for="inline-form-input-name">Priority</label>
        <b-input
            id="inline-form-input-name"
            class="mb-2 mr-sm-2 mb-sm-0"
            placeholder="Priority"
            v-model="task_data.priority"
            type="number"
        ></b-input>

          <label class="sr-only" for="inline-form-input-name">DueIn</label>
        <b-input
            id="inline-form-input-name"
            class="mb-2 mr-sm-2 mb-sm-0"
            placeholder="DueIn"
            v-model="task_data.dueIn"
            type="number"
        ></b-input>

        <b-button :disabled="!isValid" variant="primary" @click="createTask(task_data)">Create Task</b-button>
    </b-form>
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
                task_data: {
                    name: '',
                    priority: '',
                    dueIn: ''
                }
            }
        },
        mounted() {
            this.$store.dispatch('fetchTasks')
        },
        methods: {
            createTask(task_data) {
                this.$store.dispatch('createTask', task_data)
              
            },
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
            ]),
              isValid() {
                return this.task_data.name !== '' && this.task_data.priority !== '' && this.task_data.dueIn !== '';     
            }
        }
    }
</script>