let mutations = {

    CREATE_TASK(state, task) {
        state.tasks.unshift(task)
    },
    FETCH_TASKS(state, tasks) {
        return state.tasks = tasks
    },
    DELETE_TASK(state, task) {
        let index = state.tasks.findIndex(item => item.id === task.id)
        state.tasks.splice(index, 1)
    }
}
export default mutations