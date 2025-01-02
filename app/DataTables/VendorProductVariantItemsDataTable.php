<?php

namespace App\DataTables;

use App\Models\ProductVariantIem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductVariantItemsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editUrl = route('vendor.variant.items.edit', ['variant_id' => $query->productVariant->id, 'variant_item_id' => $query->id]);
                $destroyUrl = route('vendor.variant.items.delete', ['variant_id' => $query->productVariant->id, 'variant_item_id' => $query->id]);
                return "                        
        <a href='{$editUrl}' class='btn btn-info btn-sm'>Edit</a>            
        <a href='{$destroyUrl}' 
           class='btn btn-danger btn-sm delete-item'>
           Delete
        </a>                                
    ";
            })
            ->addColumn('is_default', function ($query) {
                if ($query->is_default) return "<span class='badge bg-danger'>No</span>";
                return "<span class='badge bg-success'>No</span>";
            })
            ->addColumn('status', function ($query) {
                $checked = $query->status == '1' ? 'checked' : '';
                return
                    "<div class='form-check form-switch'>
                    <input class='form-check-input custom-switch-input' type='checkbox' role='switch' $checked data-id='{$query->id}' name='custom-switch-checkbox' id='flexSwitchCheckDefault'>
                </div>";
            })
            ->rawColumns(['is_default', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariantIem $model): QueryBuilder
    {
        return $model->where('product_variant_id', request()->variant_id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorproductvariantitems-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->width(20),
            Column::make('name'),
            Column::make('is_default'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProductVariantItems_' . date('YmdHis');
    }
}
