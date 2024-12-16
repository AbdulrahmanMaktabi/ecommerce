<?php

namespace App\DataTables;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
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
                $editUrl = route('admin.brand.edit', $query->id);
                $destroyUrl = route('admin.brand.destroy', $query->id);

                return "
        
        <a href='{$editUrl}' class='btn btn-info btn-sm'>Edit</a>
        <a href='{$destroyUrl}' 
           class='btn btn-danger btn-sm delete-item'>
           Delete
        </a>                       
    ";
            })
            ->addColumn('status', function ($query) {
                $checked = $query->status == '1' ? 'checked' : '';
                return "<label class='custom-switch mt-2'>
                            <input type='checkbox' data-name='{$query->slug}' $checked name='custom-switch-checkbox' class='custom-switch-input'>
                            <span class='custom-switch-indicator'></span>                        
                        </label>";
            })
            ->addColumn('featured', function ($query) {
                $checked = $query->featured == '1';
                if ($checked)
                    return "<p style='background-color:green;color:#fff;border-radius:15px; padding:10px; width:fit-content'>Yes</p>";
                return "<p style='background-color:red;color:#fff;border-radius:15px; padding:10px; width:fit-content'>No</p>";
            })
            ->addColumn('image', function ($query) {
                return "<img src='" . asset($query->image) . "' width='80px'></img>";
            })
            ->rawColumns(['action', 'status', 'featured', 'image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Brand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('brand-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
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
            Column::make('id'),
            Column::make('image'),
            Column::make('name'),
            Column::make('slug'),
            Column::make('status'),
            Column::make('featured'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Brand_' . date('YmdHis');
    }
}
