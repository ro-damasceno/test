import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {GcCoreModule} from "@golden-codes/core";
import {PanelRoutingModule} from "./panel-routing.module";
import {PanelComponent} from "./panel.component";
import {LoginComponent} from "./login/login.component";
import {SharedModule} from "../_shared/shared.module";
import {PanelApiModule} from "./panel-api/panel-api.module";
import {LayoutComponent} from "./layout/layout.component";
import {RegisterComponent} from "./register/register.component";

@NgModule({
    imports: [
        CommonModule,
        GcCoreModule,
        PanelApiModule,
        PanelRoutingModule,
        SharedModule
    ],
    declarations: [
        PanelComponent,
        LayoutComponent,
        LoginComponent,
        RegisterComponent
    ],
    entryComponents: []
})
export class PanelModule {}
