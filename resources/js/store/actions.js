let actions = {
    fetchTasks({commit}, tasks) {
        axios.get('/api/tasks', tasks)
            .then(res => {
                commit('FETCH_TASKS', res.data)
            }).catch(err => {
            console.log(err)
        })
    },
    createTask({commit}) {
        axios.post('/api/tasks')
            .then(res => {
                commit('CREATE_TASK', res.data)
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