<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Animal\BulkDestroyAnimal;
use App\Http\Requests\Admin\Animal\DestroyAnimal;
use App\Http\Requests\Admin\Animal\IndexAnimal;
use App\Http\Requests\Admin\Animal\StoreAnimal;
use App\Http\Requests\Admin\Animal\UpdateAnimal;
use App\Models\Animal;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AnimalsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexAnimal $request
     * @return array|Factory|View
     */
    public function index(IndexAnimal $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Animal::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.animal.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.animal.create');

        return view('admin.animal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAnimal $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreAnimal $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Animal
        $animal = Animal::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/animals'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/animals');
    }

    /**
     * Display the specified resource.
     *
     * @param Animal $animal
     * @throws AuthorizationException
     * @return void
     */
    public function show(Animal $animal)
    {
        $this->authorize('admin.animal.show', $animal);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Animal $animal
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Animal $animal)
    {
        $this->authorize('admin.animal.edit', $animal);


        return view('admin.animal.edit', [
            'animal' => $animal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAnimal $request
     * @param Animal $animal
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateAnimal $request, Animal $animal)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Animal
        $animal->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/animals'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/animals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyAnimal $request
     * @param Animal $animal
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyAnimal $request, Animal $animal)
    {
        $animal->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyAnimal $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyAnimal $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Animal::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
