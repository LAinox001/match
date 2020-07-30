@extends('brackets/admin-ui::admin.layout.default')

@section('title', 'Match')

@section('body')

        <div class="card">
            <div class="card-header">
                Filtres pour les matchs
            </div>
            <match-form
                :action="'{{ route('admin/match/match') }}'"
                :locales="{{ json_encode($locales) }}"
                :send-empty-locales="false"
                inline-template>

                <form :action="'{{ route('admin/match/match') }}'" class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action" novalidate>

                {{-- {{method_field('post') }} --}}
                @csrf

                    <div class="card-body">
                        <div class="form-group row align-items-center" :class="{'has-danger': errors.has('nom'), 'has-success': fields.nom && fields.nom.valid }">
                            <label for="number">Nombre de champs a matcher:</label> 
                                <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                                <input type="number" name="number" step="1" class="form-control" placeholder="Nombre">
                                <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('number') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            Matcher
                        </button>
                    </div>

                </form>
            </match-form>
        </div>


@endsection