import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {ProductApiModule} from "./product-api/product-api.module";
import {ProductRoutingModule} from "./product-routing.module";
import {ProductComponent} from "./list/product.component";
import {SharedModule} from "../../_shared/shared.module";
import {EditProductComponent} from "./edit/edit-product.component";

@NgModule({
    imports: [
        CommonModule,
        ProductRoutingModule,
        ProductApiModule,
        SharedModule
    ],
    declarations: [
        ProductComponent,
        EditProductComponent
    ],
    providers: [],
    entryComponents: []
})
export class ProductModule {}
