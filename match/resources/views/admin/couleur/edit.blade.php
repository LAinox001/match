@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.couleur.actions.edit', ['name' => $couleur->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <couleur-form
                :action="'{{ $couleur->resource_url }}'"
                :data="{{ $couleur->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.couleur.actions.edit', ['name' => $couleur->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.couleur.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </couleur-form>

        </div>
    
</div>

@endsection