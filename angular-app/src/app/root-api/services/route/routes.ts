export const app_routes = {
    'panel': {
        path: 'panel',
        children: {
            login: {
                path: 'login'
            },
            register: {
                path: 'register'
            },
            products: {
                path: 'products'
            },
            'products-create': {
                path: 'products/create'
            },
            'products-edit': {
                path: 'products/edit/:id'
            }
        }
    }
};