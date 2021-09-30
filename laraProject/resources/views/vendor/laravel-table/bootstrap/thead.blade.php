<thead>
    {{-- rows number / search --}}
    <tr{{ classTag($table->trClasses) }}>
        <td{{ classTag('bg-light', $table->tdClasses) }}{{ htmlAttributes($table->columnsCount() > 1 ? ['colspan' => $table->columnsCount()] : null) }}>
            <div class="flex-v-center table-head-container">
                {{-- table title --}}
                @if(!is_null($table->title))
                    <h2 class="table-title">{{ $table->title }}</h2>
                @endif
                @if($table->rowsNumberSelectionActivation || ! $table->searchableColumns->isEmpty())
                    {{-- searching --}}
                    @if(count($table->searchableColumns))
                        <div class="flex-fill px-3 searching">
                            <form role="form" method="GET" action="{{ $table->route('index') }}">
                                <input type="hidden" name="{{ $table->rowsField }}" value="{{ $table->request->get($table->rowsField) }}">
                                <input type="hidden" name="{{ $table->sortByField }}" value="{{ $table->request->get($table->sortByField) }}">
                                <input type="hidden" name="{{ $table->sortDirField }}" value="{{ $table->request->get($table->sortDirField) }}">
                                @foreach($table->appendedHiddenFields as $appendedKey => $appendedValue)
                                    <input type="hidden" name="{{ $appendedKey }}" value="{{ $appendedValue }}">
                                @endforeach
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-secondary">
                                            {!! config('laravel-table.icon.search') !!}
                                        </span>
                                    </div>
                                    <input class="form-control"
                                           type="text"
                                           name="{{ $table->searchField }}"
                                           value="{{ $table->request->get($table->searchField) }}"
                                           placeholder="@lang('laravel-table::laravel-table.search') {{ $table->searchableTitles() }}"
                                           aria-label="@lang('laravel-table::laravel-table.search') {{ $table->searchableTitles() }}">
                                    @if($table->request->get($table->searchField))
                                        <div class="input-group-append">
                                            <a class="input-group-text btn btn-link text-danger cancel-search"
                                               href="{{ $table->route('index', array_merge([
                                                    $table->searchField    => null,
                                                    $table->rowsField      => $table->request->get($table->rowsField),
                                                    $table->sortByField    => $table->request->get($table->sortByField),
                                                    $table->sortDirField   => $table->request->get($table->sortDirField)
                                                ], $table->appendedValues)) }}"
                                               title="@lang('laravel-table::laravel-table.cancelSearch')">
                                                <span>{!! config('laravel-table.icon.cancel') !!}</span>
                                            </a>
                                        </div>
                                    @else
                                        <div class="input-group-append">
                                            <span class="input-group-text py-0">
                                                <button class="btn btn-link p-0 text-primary" type="submit">
                                                    {!! config('laravel-table.icon.validate') !!}
                                                </button>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    @endif
                    {{-- rows number selection --}}
                    @if($table->rowsNumberSelectionActivation)
                        <div class="px-1 rows-number-selection">
                            <form role="form" method="GET" action="{{ $table->route('index') }}">
                                <input type="hidden" name="{{ $table->searchField }}" value="{{ $table->request->get($table->searchField) }}">
                                <input type="hidden" name="{{ $table->sortByField }}" value="{{ $table->request->get($table->sortByField) }}">
                                <input type="hidden" name="{{ $table->sortDirField }}" value="{{ $table->request->get($table->sortDirField) }}">
                                @foreach($table->appendedHiddenFields as $appendedKey => $appendedValue)
                                    <input type="hidden" name="{{ $appendedKey }}" value="{{ $appendedValue }}">
                                @endforeach
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {!! config('laravel-table.icon.rowsNumber') !!}
                                        </span>
                                    </div>
                                    <input class="form-control"
                                           type="number"
                                           name="{{ $table->rowsField }}"
                                           value="{{ $table->request->get($table->rowsField) }}"
                                           placeholder="@lang('laravel-table::laravel-table.rowsNumber')"
                                           aria-label="@lang('laravel-table::laravel-table.rowsNumber')"
                                           max="10"
                                           min="1">
                                    <div class="input-group-append">
                                        <div class="input-group-text py-0">
                                            <button class="btn btn-link p-0 text-primary" type="submit">
                                                {!! config('laravel-table.icon.validate') !!}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                    @if(array_key_exists('bulk-destroy', $table->routes))
                        <div class="d-flex align-items-center px-1 creation-container">
                            {{ Form::open(array('route'=> $table->routes['bulk-destroy']['name'],'method' => 'DELETE',
                                'id'=>'delete-selected-form', 'data-confirm' => 'Sei sicuro di voler eliminare :items elementi?'))}}
                                <input name="items" type="hidden" id="selectedRows" value="">
                                {!! Form::submit('Elimina selezionati', ['class' => "button", 'id'=> "bulkActionBtn"]) !!}
                            {{ Form::close()}}
                        </div>
                    @endif
                    {{-- create button --}}
                    @if($table->isRouteDefined('create'))
                        <div class="d-flex align-items-center px-1 creation-container">
                            <a href="{{ $table->route('create') }}"
                               class="button btn-create"
                               title="{{ __('laravel-table::laravel-table.create') }}">
                                {!! config('laravel-table.icon.create') !!}
                                {{ __('laravel-table::laravel-table.create') }}
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </td>
    </tr>
    {{-- column titles --}}
    <tr{{ classTag($table->trClasses, 'columns-title') }}>
        {{-- selector rows --}}
        @if($table->rowsSelection->has('closure'))
            <th>{!! Form::checkbox('select-all', '', false, ['id' => 'selector-all']) !!}</th>
        @endif
        @foreach($table->columns as $column)
            <th{{ classTag($table->thClasses) }} scope="col">
                @if($column->isSortable)
                    <a class="d-flex"
                       href="{{ $table->route('index', array_merge([
                            $table->rowsField      => $table->request->get($table->rowsField),
                            $table->searchField    => $table->request->get($table->searchField),
                            $table->sortByField    => $column->databaseDefaultColumn,
                            $table->sortDirField   => $table->request->get($table->sortDirField) === 'desc' ? 'asc' : 'desc',
                        ], $table->appendedValues)) }}"
                       title="{{ $column->title }}">
                        <span>
                            {!! str_replace(' ', '&nbsp;', $column->title) !!}
                        </span>
                        @if($table->request->get($table->sortByField) === $column->databaseDefaultColumn
                            && $table->request->get($table->sortDirField) === 'asc')
                            <span class="sort asc">{!! config('laravel-table.icon.sortAsc') !!}</span>
                        @elseif($table->request->get($table->sortByField) === $column->databaseDefaultColumn
                            && $table->request->get($table->sortDirField) === 'desc')
                            <span class="sort desc">{!! config('laravel-table.icon.sortDesc') !!}</span>
                        @else
                            <span class="sort">{!! config('laravel-table.icon.sort') !!}</span>
                        @endif
                    </a>
                @else
                    {!! str_replace(' ', '&nbsp;', $column->title) !!}
                @endif
            </th>
        @endforeach
        @if($table->isRouteDefined('show') || $table->isRouteDefined('edit') || $table->isRouteDefined('destroy'))
            <th{{ classTag($table->thClasses) }} scope="col">
                @lang('laravel-table::laravel-table.actions')
            </th>
        @endif
    </tr>
</thead>