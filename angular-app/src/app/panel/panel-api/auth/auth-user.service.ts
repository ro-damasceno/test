import {Injectable} from "@angular/core";
import {GcAuthService} from "@golden-codes/core";
import {HttpRootService} from "../../../root-api/services/http/http-root.service";
import {PanelApiModule} from "../panel-api.module";

@Injectable({
    providedIn: PanelApiModule
})
export class AuthUserService extends GcAuthService{

    constructor (protected http: HttpRootService) {
        super(http);
    }

    getLoginUrl() {
        return '/login';
    }

    getRetrieveUserUrl() {
        return '/details'
    }
}