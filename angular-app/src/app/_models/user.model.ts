import {GcModel} from "@golden-codes/core";

export class UserModel extends GcModel {

    protected static _resource = 'users';

    getAttributesSchema() {
        return {
            id: undefined,
            name: undefined,
            email: undefined,
            password: undefined,
            created_at: undefined,
            deleted_at: undefined,
            updated_at: undefined
        };
    }
}
