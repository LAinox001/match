<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Plat;
use App\Models\Animal;
use App\Models\Couleur;
use App\Models\Parrain;
use App\Models\Filliere;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Brackets\AdminListing\Facades\AdminListing;
use App\Http\Requests\Admin\Parrain\IndexParrain;
use App\Http\Requests\Admin\Parrain\StoreParrain;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Requests\Admin\Parrain\UpdateParrain;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\Admin\Parrain\DestroyParrain;
use App\Http\Requests\Admin\Parrain\BulkDestroyParrain;

class ParrainsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexParrain $request
     * @return array|Factory|View
     */
    public function index(IndexParrain $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Parrain::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'nom', 'prenom', 'filliere_id', 'plat_id', 'couleur_id', 'animal_id', 'match'],

            // set columns to searchIn
            ['id', 'nom', 'prenom']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }
        foreach($data as $d){
            $d['filliere'] = $d->filliere->name;
            $d['plat'] = $d->plat->name;
            $d['couleur'] = $d->couleur->name;
            $d['animal'] = $d->animal->name;
        }

        return view('admin.parrain.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.parrain.create');

        $fillieres = Filliere::all()->pluck('name', 'id');
        $animals = Animal::all()->pluck('name', 'id');
        $couleurs = Couleur::all()->pluck('name', 'id');
        $plats = Plat::all()->pluck('name', 'id');

        return view('admin.parrain.create')->with([
            'fillieres' => $fillieres,
            'couleurs' => $couleurs,
            'animals' => $animals,
            'plats' => $plats
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreParrain $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreParrain $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Parrain
        $parrain = Parrain::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/parrains'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/parrains');
    }

    /**
     * Display the specified resource.
     *
     * @param Parrain $parrain
     * @throws AuthorizationException
     * @return void
     */
    public function show(Parrain $parrain)
    {
        $this->authorize('admin.parrain.show', $parrain);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Parrain $parrain
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Parrain $parrain)
    {
        $this->authorize('admin.parrain.edit', $parrain);

        $fillieres = Filliere::all()->pluck('name', 'id');
        $animals = Animal::all()->pluck('name', 'id');
        $couleurs = Couleur::all()->pluck('name', 'id');
        $plats = Plat::all()->pluck('name', 'id');


        return view('admin.parrain.edit', [
            'parrain' => $parrain,
            'fillieres' => $fillieres,
            'couleurs' => $couleurs,
            'animals' => $animals,
            'plats' => $plats
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateParrain $request
     * @param Parrain $parrain
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateParrain $request, Parrain $parrain)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Parrain
        $parrain->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/parrains'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/parrains');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyParrain $request
     * @param Parrain $parrain
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyParrain $request, Parrain $parrain)
    {
        $parrain->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyParrain $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyParrain $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Parrain::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
