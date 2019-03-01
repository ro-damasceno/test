import {GcModel} from "@golden-codes/core";

export class ProductModel extends GcModel {

    protected static _resource = 'products';

    getAttributesSchema() {
        return {
            id: undefined,
            sku: undefined,
            name: undefined,
            description: undefined,
            price: undefined,
            created_at: undefined,
            deleted_at: undefined,
            updated_at: undefined
        };
    }

    setPriceAttribute (value) {
        //@todo validar valor do produto.
        this.__attributes['price'] = value;
    }
}
