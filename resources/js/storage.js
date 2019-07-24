import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        points: [],
        categories: []
    },
    mutations: {
        initData(state, data) {
            state.points = data.points
            state.categories = data.categories
        },
        addPoint(state, point) {
            state.points.push(point)
        }
    }
})
