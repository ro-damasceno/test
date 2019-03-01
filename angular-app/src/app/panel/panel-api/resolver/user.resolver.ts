import {Injectable} from "@angular/core";
import {ActivatedRouteSnapshot, Resolve, RouterStateSnapshot} from "@angular/router";
import {Observable} from "rxjs/Rx";

import {UserModel} from "../../../_models/user.model";
import {AuthUserService} from "../auth/auth-user.service";
import {GuardUserService} from "../auth/guard-user.service";

import {ConfigService} from "../../../root-api/services/config/config.service";
import {AppLoaderService} from "../../../root-api/services/loader/app-loader.service";
import {PanelApiModule} from "../panel-api.module";

@Injectable({
    providedIn: PanelApiModule
})
export class UserResolver implements Resolve<UserModel> {

    constructor(
        private authService: AuthUserService,
        private guardService: GuardUserService,
        private appLoaderService: AppLoaderService,
        private config: ConfigService
    ) {}

    resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<any> {
        return Observable.create(observer => {

            if (this.guardService.authenticated) {
                this.appLoaderService.startLoading();
                this.authService
                    .getUser(this.guardService.token, {}, { onError:  () => {} })
                    .success((body: any) => {
                        this.config.setConfig('user', new UserModel(body.data));
                        observer.next(true);
                    })
                    .error(() => {
                        this.guardService.logout();
                        observer.next(false);
                    })
                    .complete(() => {
                        this.appLoaderService.stopLoading();
                        observer.complete();
                    });

            } else {
                observer.next(null);
                observer.complete();
            }
        });
    }
}