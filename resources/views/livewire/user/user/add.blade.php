<div class="row">
    <div class="col-md-12">
        <div class="card card-lightblue">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-plus-circle"></i> &nbsp;Add User</h3>
            </div>
            <form wire:submit.prevent="store" style="margin-bottom:0px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" wire:model.lazy="name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" wire:model.lazy="phone">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" wire:model.lazy="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" wire:model.lazy="password">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" wire:model.lazy="designation">
                                @error('designation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Language</label>
                                <select class="form-control" wire:model="language">
                                    <option value="ENGLISH">English</option>
                                    <option value="BANGLA">Bangla</option>
                                </select>
                                @error('language')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" wire:model="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-right pd-b-10">
                        <div class="btn btn-light btn-sm">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="1" onclick="check_uncheck_all()">
                                <label for="customCheckbox1" class="custom-control-label pointer" style="padding-top:4px">Check All</label>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-width-expense table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-gradient-olive">
                                <th class="th-13p th-100px">Role</th>
                                <th class="text-center th-13p th-200px">Read</th>
                                <th class="text-center th-13p th-200px">Add</th>
                                <th class="text-center th-13p th-100px">Update</th>
                                <th class="text-center th-13p th-100px">Delete</th>
                                <th class="text-center th-13p th-100px">Export</th>
                                <th class="text-center th-13p th-100px">Print</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td><label>Dashboard</label></td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="dashboard_read" id="checkboxSuccess1" class="roles_checkbox">
                                        <label for="checkboxSuccess1"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td><label>Company</label></td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="company_read" id="checkboxSuccess2" class="roles_checkbox">
                                        <label for="checkboxSuccess2"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="company_update" id="checkboxSuccess3" class="roles_checkbox">
                                        <label for="checkboxSuccess3"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td><label>Product</label></td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="product_read" id="checkboxSuccess4" class="roles_checkbox">
                                        <label for="checkboxSuccess4"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="product_add" id="checkboxSuccess5" class="roles_checkbox">
                                        <label for="checkboxSuccess5"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="product_update" id="checkboxSuccess6" class="roles_checkbox">
                                        <label for="checkboxSuccess6"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="product_delete" id="checkboxSuccess7" class="roles_checkbox">
                                        <label for="checkboxSuccess7"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="product_export" id="checkboxSuccess8" class="roles_checkbox">
                                        <label for="checkboxSuccess8"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td><label>Barcode</label></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="barcode_print" id="checkboxSuccess10" class="roles_checkbox">
                                        <label for="checkboxSuccess10"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Purchase</label></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="purchase" id="checkboxSuccess11" class="roles_checkbox">
                                        <label for="checkboxSuccess11"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td><label>Sales</label></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="sales" id="checkboxSuccess12" class="roles_checkbox">
                                        <label for="checkboxSuccess12"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td><label>Return</label></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="return" id="checkboxSuccess13" class="roles_checkbox">
                                        <label for="checkboxSuccess13"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td><label>Customer</label></td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="customer_read" id="checkboxSuccess14" class="roles_checkbox">
                                        <label for="checkboxSuccess14"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="customer_add" id="checkboxSuccess15" class="roles_checkbox">
                                        <label for="checkboxSuccess15"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="customer_update" id="checkboxSuccess16" class="roles_checkbox">
                                        <label for="checkboxSuccess16"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="customer_delete" id="checkboxSuccess17" class="roles_checkbox">
                                        <label for="checkboxSuccess17"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="customer_export" id="checkboxSuccess18" class="roles_checkbox">
                                        <label for="checkboxSuccess18"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td><label>Supplier</label></td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="supplier_read" id="checkboxSuccess20" class="roles_checkbox">
                                        <label for="checkboxSuccess20"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="supplier_add" id="checkboxSuccess21" class="roles_checkbox">
                                        <label for="checkboxSuccess21"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="supplier_update" id="checkboxSuccess22" class="roles_checkbox">
                                        <label for="checkboxSuccess22"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="supplier_delete" id="checkboxSuccess23" class="roles_checkbox">
                                        <label for="checkboxSuccess23"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="supplier_export" id="checkboxSuccess24" class="roles_checkbox">
                                        <label for="checkboxSuccess24"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td><label>Expense</label></td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="expense_read" id="checkboxSuccess26" class="roles_checkbox">
                                        <label for="checkboxSuccess26"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="expense_add" id="checkboxSuccess27" class="roles_checkbox">
                                        <label for="checkboxSuccess27"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="expense_update" id="checkboxSuccess28" class="roles_checkbox">
                                        <label for="checkboxSuccess28"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="expense_delete" id="checkboxSuccess29" class="roles_checkbox">
                                        <label for="checkboxSuccess29"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="expense_export" id="checkboxSuccess30" class="roles_checkbox">
                                        <label for="checkboxSuccess30"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td><label>SMS Campaign</label></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="sms_campaign_add" id="checkboxSuccess32" class="roles_checkbox">
                                        <label for="checkboxSuccess32"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td><label>User</label></td>
                                <td class="text-center text-gray">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="user_read" id="checkboxSuccess33" class="roles_checkbox">
                                        <label for="checkboxSuccess33"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="user_add" id="checkboxSuccess34" class="roles_checkbox">
                                        <label for="checkboxSuccess34"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="user_update" id="checkboxSuccess35" class="roles_checkbox">
                                        <label for="checkboxSuccess35"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="user_delete" id="checkboxSuccess36" class="roles_checkbox">
                                        <label for="checkboxSuccess36"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                            </tr>
                            <tr>
                                <td><label>Settings</label></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="settings_update" id="checkboxSuccess37" class="roles_checkbox">
                                        <label for="checkboxSuccess37"></label>
                                    </div>
                                </td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                                <td class="text-center text-gray"><i class="fa fa-ban" aria-hidden="true"></i></td>
                            </tr>


                            </tbody>
                        </table>
                    </div>

                    <br>
                    <div class="table-responsive">
                        <table class="table-width-expense table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-gradient-olive">
                                <th class="th-13p th-100px" colspan="7">Report</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="purchase_report" id="checkboxSuccess38" class="roles_checkbox">
                                        <label for="checkboxSuccess38">Purchase Report</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="sales_report" id="checkboxSuccess39" class="roles_checkbox">
                                        <label for="checkboxSuccess39">Sales Report</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="return_report" id="checkboxSuccess40" class="roles_checkbox">
                                        <label for="checkboxSuccess40">Return Report</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="purchase_summary_report" id="checkboxSuccess41" class="roles_checkbox">
                                        <label for="checkboxSuccess41">Purchase Summary Report</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="sales_summary_report" id="checkboxSuccess42" class="roles_checkbox">
                                        <label for="checkboxSuccess42">Sales Summary Report</label>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="supplier_transaction_report" id="checkboxSuccess43" class="roles_checkbox">
                                        <label for="checkboxSuccess43">Supplier Transaction Report</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="customer_transaction_report" id="checkboxSuccess44" class="roles_checkbox">
                                        <label for="checkboxSuccess44">Customer Transaction Report</label>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="invoice_report" id="checkboxSuccess45" class="roles_checkbox">
                                        <label for="checkboxSuccess45">Invoice Report</label>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="vat_report" id="checkboxSuccess46" class="roles_checkbox">
                                        <label for="checkboxSuccess46">VAT Report</label>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="profit_report" id="checkboxSuccess47" class="roles_checkbox">
                                        <label for="checkboxSuccess47">Profit Report</label>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="top_selling_products" id="checkboxSuccess48" class="roles_checkbox">
                                        <label for="checkboxSuccess48">Top Selling Products</label>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr class="bg-gradient-light">
                                <td colspan="3">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="report_export" id="checkboxSuccess49" class="roles_checkbox">
                                        <label for="checkboxSuccess49">Report Export</label>
                                    </div>&nbsp;&nbsp;

                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" value="1" wire:model="report_print" id="checkboxSuccess50" class="roles_checkbox">
                                        <label for="checkboxSuccess50">Report Print</label>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="float-left">
                        <a href="/user" class="btn btn-warning"><i class="fa fa-chevron-left tx-14"></i> Back</a>
                    </div>

                    <div class="float-right">
                        <input type="submit" class="btn btn-primary wd-100" value="Submit"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function check_uncheck_all(){
        if($('#customCheckbox1').is(':checked')) {
            @this.set('dashboard_read', 1);
            @this.set('company_read', 1);
            @this.set('company_update', 1);
            @this.set('product_read', 1);
            @this.set('product_add', 1);
            @this.set('product_update', 1);
            @this.set('product_delete', 1);
            @this.set('product_export', 1);
            @this.set('product_print', 1);
            @this.set('barcode_print', 1);
            @this.set('purchase', 1);
            @this.set('sales', 1);
            @this.set('return', 1);
            @this.set('customer_read', 1);
            @this.set('customer_add', 1);
            @this.set('customer_update', 1);
            @this.set('customer_delete', 1);
            @this.set('customer_export', 1);
            @this.set('customer_print', 1);
            @this.set('supplier_read', 1);
            @this.set('supplier_add', 1);
            @this.set('supplier_update', 1);
            @this.set('supplier_delete', 1);
            @this.set('supplier_export', 1);
            @this.set('supplier_print', 1);
            @this.set('expense_read', 1);
            @this.set('expense_add', 1);
            @this.set('expense_update', 1);
            @this.set('expense_delete', 1);
            @this.set('expense_export', 1);
            @this.set('expense_print', 1);
            @this.set('sms_campaign_add', 1);
            @this.set('user_read', 1);
            @this.set('user_add', 1);
            @this.set('user_update', 1);
            @this.set('user_delete', 1);
            @this.set('settings_update', 1);
            @this.set('purchase_report', 1);
            @this.set('sales_report', 1);
            @this.set('return_report', 1);
            @this.set('purchase_summary_report', 1);
            @this.set('sales_summary_report', 1);
            @this.set('supplier_transaction_report', 1);
            @this.set('customer_transaction_report', 1);
            @this.set('invoice_report', 1);
            @this.set('vat_report', 1);
            @this.set('profit_report', 1);
            @this.set('top_selling_products', 1);
            @this.set('report_export', 1);
            @this.set('report_print', 1);
        }else {
            @this.set('dashboard_read', 0);
            @this.set('company_read', 0);
            @this.set('company_update', 0);
            @this.set('product_read', 0);
            @this.set('product_add', 0);
            @this.set('product_update', 0);
            @this.set('product_delete', 0);
            @this.set('product_export', 0);
            @this.set('product_print', 0);
            @this.set('barcode_print', 0);
            @this.set('purchase', 0);
            @this.set('sales', 0);
            @this.set('return', 0);
            @this.set('customer_read', 0);
            @this.set('customer_add', 0);
            @this.set('customer_update', 0);
            @this.set('customer_delete', 0);
            @this.set('customer_export', 0);
            @this.set('customer_print', 0);
            @this.set('supplier_read', 0);
            @this.set('supplier_add', 0);
            @this.set('supplier_update', 0);
            @this.set('supplier_delete', 0);
            @this.set('supplier_export', 0);
            @this.set('supplier_print', 0);
            @this.set('expense_read', 0);
            @this.set('expense_add', 0);
            @this.set('expense_update', 0);
            @this.set('expense_delete', 0);
            @this.set('expense_export', 0);
            @this.set('expense_print', 0);
            @this.set('sms_campaign_add', 0);
            @this.set('user_read', 0);
            @this.set('user_add', 0);
            @this.set('user_update', 0);
            @this.set('user_delete', 0);
            @this.set('settings_update', 0);
            @this.set('purchase_report', 0);
            @this.set('sales_report', 0);
            @this.set('return_report', 0);
            @this.set('purchase_summary_report', 0);
            @this.set('sales_summary_report', 0);
            @this.set('supplier_transaction_report', 0);
            @this.set('customer_transaction_report', 0);
            @this.set('invoice_report', 0);
            @this.set('vat_report', 0);
            @this.set('profit_report', 0);
            @this.set('top_selling_products', 0);
            @this.set('report_export', 0);
            @this.set('report_print', 0);
        }
    }
</script>
