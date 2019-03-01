import {GcBaseRestfulRepository, GcModel, GcRequestHandler} from "@golden-codes/core";
import {Injectable} from "@angular/core";
import {ProductModel} from "../../models/product.model";
import {ProductApiModule} from "../product-api.module";
import {HttpService} from "../../../panel-api/http/http.service";

@Injectable({
    providedIn: ProductApiModule
})
export class ProductRepositoryService extends GcBaseRestfulRepository {

    protected _model: GcModel = <any>ProductModel;

    constructor(protected httpService: HttpService) {
        super(httpService);
    }

    makeFakeItems (): GcRequestHandler<any> {
        return this.getHttpService()
            .post(
                this._model.getResource()+'/make-fake-items',
                {}
            );
    }
}
