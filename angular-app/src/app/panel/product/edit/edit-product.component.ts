import {Component, OnDestroy, OnInit} from "@angular/core";
import {ActivatedRoute} from "@angular/router";
import {GcDialogService, GcRouteService} from "@golden-codes/core";
import {UserLayoutService} from "../../layout/user-layout-service";
import {ProductModel} from "../models/product.model";
import {ProductRepositoryService} from "../product-api/services/product.repository";
import {FormControl, FormGroup, Validators} from "@angular/forms";

@Component({
    selector: 'app-panel-product-edit',
    templateUrl: './edit-product.component.html',
    styleUrls: ['./edit-product.component.scss']
})

export class EditProductComponent implements OnInit, OnDestroy {

    product: ProductModel;
    activeRoute;
    isLoading: boolean;
    productForm: FormGroup;

    constructor(
        private productRepo: ProductRepositoryService,
        private userLayoutService: UserLayoutService,
        private activatedRoute: ActivatedRoute,
        private gcDialog: GcDialogService,
        private route: GcRouteService
    ) {}

    ngOnInit() {

        this.userLayoutService.startLoading();
        this.userLayoutService.setActiveMenu('products');
        
        this.activeRoute = this.activatedRoute.params.subscribe(params => {
            if (params && params.id) {
                this.loadProduct(params.id)

            } else {
                this.product = new ProductModel();
                this.userLayoutService.stopLoading();
            }
        });

        this.productForm = new FormGroup({
            sku:         new FormControl('', Validators.required),
            name:        new FormControl('', Validators.required),
            description: new FormControl('', Validators.required),
            price:       new FormControl('', [
                Validators.required,
                Validators.min(0),
                Validators.pattern(/\d+/)
            ])
        });
    }

    ngOnDestroy() {
        if (this.activeRoute) {
            this.activeRoute.unsubscribe();
        }
    }

    loadProduct(id): void {
        this.productRepo.findOne(id)
            .success(res => {
                this.product = res;
            })
            .complete(res => {
                this.userLayoutService.stopLoading();
            });
    }

    save(): void {
        this.userLayoutService.startLoading();
        this.productRepo
            .save(this.product)
            .success(res => {
                this.gcDialog.success(
                    '',
                    'Product successfully saved'
                );
                this.route.navigate('panel.products');
            })
            .complete(() => {
                this.userLayoutService.stopLoading();
            });
    }

    remove(): void {
        this.gcDialog
            .question('', 'Are you sure you want to remove this product?', true)
            .then(res => {
                    this.userLayoutService.startLoading();
                    this.productRepo
                        .delete(this.product.getKey())
                        .success(res => {
                            this.product = new ProductModel();
                            this.gcDialog.success('', 'Loja removida com sucesso!');
                            this.route.navigate('panel.products');
                        })
                        .complete(res => {
                            this.userLayoutService.stopLoading();
                        })
                },
                () => {}
            );
    }
}