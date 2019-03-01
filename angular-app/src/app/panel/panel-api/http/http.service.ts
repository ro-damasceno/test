import {Injectable} from "@angular/core";
import {GcDialogService, GcHttpService, GcStorageService} from '@golden-codes/core';
import {HttpClient, HttpErrorResponse} from "@angular/common/http";
import {environment} from "../../../../environments/environment";
import {PanelApiModule} from "../panel-api.module";
import {ConfigService} from "../../../root-api/services/config/config.service";
import {GuardUserService} from "../auth/guard-user.service";

@Injectable({
    providedIn: PanelApiModule
})
export class HttpService extends GcHttpService {

    apiUrl: string = 'http://'+environment.api.domain;

    constructor(
        public http: HttpClient,
        public dialog: GcDialogService,
        private config: ConfigService,
        private storage: GcStorageService,
        private guard: GuardUserService
    ) {
        super(http, dialog);

        storage.subscribe('token', (token: string | null) => {
            this.setAuthorization(token);
        });
    }

    onError401(httpError: HttpErrorResponse) {
        this.guard.logout();
    }
}