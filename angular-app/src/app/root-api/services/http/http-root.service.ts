import {Injectable} from "@angular/core";
import {HttpClient, HttpErrorResponse} from "@angular/common/http";
import {RootApiModule} from "../../root-api.module";
import {GcDialogService, GcHttpService} from '@golden-codes/core';
import {environment} from "../../../../environments/environment";

@Injectable({
    providedIn: RootApiModule
})
export class HttpRootService extends GcHttpService {

    protected apiUrl = 'http://'+environment.api.domain;

    constructor(public httpService: HttpClient, public dialog: GcDialogService) {
        super(httpService, dialog);
    }

    onError400(httpError: HttpErrorResponse): void {

        let title = 'Something went wrong';
        let html  = '';

        if (httpError.error) {
            title = httpError.error.error || httpError.error.message;

            if (httpError.error.messages) {
                html = `<ul class="text-left small">`;

                Object.keys(httpError.error.messages).forEach((key) => {
                    html+= `<dt>`+key+`</dt>`;
                    httpError.error.messages[key].forEach((value) => {
                        html+= `<dd>`+value+`</dd>`;
                    })
                });

                html += `</ul>`;
            }
        }

        this.dialog
            .alert({
                title: title,
                html: html,
                type: 'error'
            })
            .then(
                () => {},
                () => {}
            );
    }

    onError404(httpError: HttpErrorResponse): void {
        this.dialog
            .error('Ops!', httpError.error.error)
            .then(
                () => {},
                () => {}
            );
    }
}