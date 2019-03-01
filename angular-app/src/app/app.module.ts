import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';

import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {GcCoreModule, GcRouteService, NAMED_ROUTES} from "@golden-codes/core";
import {RouteService} from "./root-api/services/route/route.service";
import {app_routes} from "./root-api/services/route/routes";
import {RootApiModule} from "./root-api/root-api.module";
import {HttpClientModule} from "@angular/common/http";
import {BrowserAnimationsModule} from "@angular/platform-browser/animations";
import {NotFoundComponent} from "./page-not-found/not-found.component";

@NgModule({
    declarations: [
        AppComponent,
        NotFoundComponent
    ],
    imports: [
        BrowserAnimationsModule,
        BrowserModule,
        GcCoreModule,
        RootApiModule,
        HttpClientModule,
        AppRoutingModule,
    ],
    providers: [
        {
            provide: GcRouteService,
            useClass: RouteService,
        },
        {
            provide: NAMED_ROUTES,
            useValue: app_routes,
        }
    ],
    bootstrap: [AppComponent]
})
export class AppModule {
}
