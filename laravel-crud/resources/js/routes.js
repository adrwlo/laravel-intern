const Welcome = () => import('./components/Welcome.vue');
const ClientList = () => import('./components/clients/List.vue');
const ClientCreate = () => import('./components/clients/Add.vue');
const ClientEdit = () => import('./components/clients/Edit.vue');

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'clientList',
        path: '/client',
        component: ClientList
    },
    {
        name: 'clientEdit',
        path: '/client/:id/edit',
        component: ClientEdit
    },
    {
        name: 'clientAdd',
        path: '/client/add',
        component: ClientCreate
    },
]
