import {NgModule} from '@angular/core';

import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {CommonModule} from "@angular/common";
import {MaterialModule} from "../_core/material/material.module";

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        ReactiveFormsModule,
        MaterialModule
    ],
    declarations: [

    ],
    exports: [
        FormsModule,
        ReactiveFormsModule,
        MaterialModule
    ],
    providers: [
    ],
    bootstrap: []
})
export class SharedModule {}
