@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.etudiant.actions.create'))

@section('body')

    <div class="container-xl">

                <div class="card">
        
        <etudiant-form
            :action="'{{ route('admin/etudiants/store') }}'"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" method="POST" @submit.prevent="onSubmit" :action="action" novalidate>
                
                {{method_field('POST') }}
                @csrf

                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('admin.etudiant.actions.create') }}
                </div>

                <div class="card-body">
                    @include('admin.etudiant.components.form-elements')
                </div>
                                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                        {{ trans('brackets/admin-ui::admin.btn.save') }}
                    </button>
                </div>
                
            </form>

        </etudiant-form>

        </div>

        </div>

    
@endsection