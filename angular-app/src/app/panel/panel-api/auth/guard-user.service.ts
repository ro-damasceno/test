import {Injectable} from "@angular/core";
import {ActivatedRouteSnapshot, RouterStateSnapshot} from "@angular/router";
import {
    GcGuardService,
    GcLocationService,
    GcRouteService,
    GcStorageService
} from "@golden-codes/core";
import {Observable} from "rxjs/Rx";

import {AuthUserService} from "./auth-user.service";
import {PanelApiModule} from "../panel-api.module";

@Injectable({
    providedIn: PanelApiModule
})
export class GuardUserService extends GcGuardService{

    constructor (
        protected router: GcRouteService,
        protected authService: AuthUserService,
        protected localStorageService: GcStorageService,
        protected locationService: GcLocationService
    ) {
        super(router, authService, localStorageService, locationService);
    }

    protected getTokenStorageKey(): string{
        return 'token';
    }

    protected afterLogin(): void {
        this.router.navigate('panel.products');
    }

    /**
     * Ação tomada após logout.
     *
     * @return void
     * */
    protected afterLogout(): void{
        this.router.navigate('panel.login');
    }

    canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {

        return Observable.create(observer => {

            let isUnauthenticatedUrl = this.isUnauthenticatedUrl(state.url);

            if (this.authenticated && isUnauthenticatedUrl) {
                this.router.navigate('panel');

            } else if (!this.authenticated && !isUnauthenticatedUrl) {
                this.router.navigate('panel.login');
            }

            observer.next(true);
            observer.complete();
        });
    }
}