import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import {ProductComponent} from "./list/product.component";
import {EditProductComponent} from "./edit/edit-product.component";

let routes = [
    {
        path: '',
        pathMatch: 'full',
        component: ProductComponent
    },
    {
        path: 'create',
        pathMatch: 'full',
        component: EditProductComponent
    },
    {
        path: 'edit/:id',
        pathMatch: 'full',
        component: EditProductComponent
    }
];

@NgModule({
    imports: [RouterModule.forChild(routes)],
    exports: [RouterModule],
    providers: []
})
export class ProductRoutingModule {}
