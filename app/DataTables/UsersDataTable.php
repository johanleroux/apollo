<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\DataTables\Engines\BaseEngine
     */
    public function dataTable(DataTables $dataTables, $query)
    {
        return $dataTables
            ->eloquent($query)
            ->addColumn('actions', function (User $user) {
                return view('user.datatable._actions', compact('user'));
            })
            ->editColumn('role', function (User $user) {
                $role = $user->role;
                if (count($role) < 1) {
                    return 'Has No Role';
                }
                return title_case($role['name']);
            })
            ->editColumn('status', function (User $user) {
                return $user->trashed() ? 'Deactive' : 'Active';
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = User::query()
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })
        ->withTrashed();

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters([
                        'dom'        => 'Bfrtip',
                        'pageLength' => '25',
                        'order'      => [[0, 'asc']],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id'      => ['title' => 'ID', 'width' => '50'],
            'name',
            'email',
            'role'    => ['searchable' => false, 'orderable' => false],
            'status'  => ['searchable' => false, 'orderable' => false],
            'actions' => ['searchable' => false, 'orderable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'user_' . time();
    }
}
