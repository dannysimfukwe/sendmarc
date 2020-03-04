let actions = {
    fetchTasks({commit}, tasks) {
        axios.get('/api/tasks', tasks)
            .then(res => {
                commit('FETCH_TASKS', res.data)
            }).catch(err => {
            console.log(err)
        })
    },
    createTask({commit}, task) {
        axios.post('/api/tasks', task)
            .then(res => {
                //we can't update the state since we get "created" as the response and not the tasks json
                //commit('CREATE_TASK', res.data)

                // so we reload the page to show the new created task
                if (res.data === 'created'){
                    window.location.reload();
                }
            }).catch(err => {
            console.log(err)
        })
    },
    deleteTask({commit}, task) {
        axios.delete(`/api/tasks/${task.id}`)
            .then(res => {
                if (res.data === 'deleted')
                    commit('DELETE_TASK', task)
            }).catch(err => {
            console.log(err)
        })
    },
    listTick() {
        axios.get(`/api/list/tick`)
            .then(res => {
                if (res.data === 'tick')
                    window.location.reload();
            }).catch(err => {
            console.log(err)
        })
    }
}
export default actions