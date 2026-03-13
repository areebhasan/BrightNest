import './bootstrap'

import Alpine from 'alpinejs'
import { createApp } from 'vue'

import DashboardApp from './components/DashboardApp.vue'
import RoomsApp from './components/RoomsApp.vue'
import ChildrenApp from './components/ChildrenApp.vue'

window.Alpine = Alpine
Alpine.start()

const dashboardEl = document.getElementById('dashboard-app')
if (dashboardEl) {
    createApp(DashboardApp).mount('#dashboard-app')
}

const roomsEl = document.getElementById('rooms-app')
if (roomsEl) {
    createApp(RoomsApp).mount('#rooms-app')
}

const childrenEl = document.getElementById('children-app')
if (childrenEl) {
    createApp(ChildrenApp).mount('#children-app')
}