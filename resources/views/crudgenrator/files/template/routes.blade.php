

    {{-- Crud Routes Start--}}

    Route::group(['middleware' => ['can:{{$data['permissions']['view']}}'],@if($data['controller_namespace'] != null)'namespace' => 'App\Http\Controllers\{{ $data['controller_namespace'] }}',@endif 'prefix' => '{{ $prefix }}','as' =>'{{$as}}.'], function () {
        Route::get('', ['uses' => '{{ $data['model'] }}Controller@index', 'as' => 'index']);
        Route::any('/print', ['uses' => '{{ $data['model'] }}Controller@print', 'as' => 'print']);
        Route::get('create', ['uses' => '{{ $data['model'] }}Controller@create', 'as' => 'create']);
        Route::post('store', ['uses' => '{{ $data['model'] }}Controller@store', 'as' => 'store']);
        Route::get('edit/{{'{'.substr($variable, 1).'}'}}', ['uses' => '{{ $data['model'] }}Controller@edit', 'as' => 'edit']);
        Route::post('update/{{'{'. substr($variable, 1) .'}'}}', ['uses' => '{{ $data['model'] }}Controller@update', 'as' => 'update']);
        Route::post('more-action', ['uses' => '{{ $data['model'] }}Controller@moreAction', 'as' => 'more-action']);
        Route::get('delete/{{'{'. substr($variable, 1).'}' }}', ['uses' => '{{ $data['model'] }}Controller@destroy', 'as' => 'destroy']);@isset($data['softdelete'])

        Route::get('restore/{id}', ['uses' => '{{ $data['model'] }}Controller@restore', 'as' => 'restore']);@endisset @isset($data['export_btn'])

        Route::get('export', ['uses' => '{{ $data['model'] }}Controller@export', 'as' => 'export']);  @endisset @isset($data['import_btn'])

        Route::post('import', ['uses' => '{{ $data['model'] }}Controller@import', 'as' => 'import']); @endisset

        Route::get('/{{'{'.substr($variable, 1).'}'}}', ['uses' => '{{ $data['model'] }}Controller@show', 'as' => 'show']);
    }); 
    
    {{-- Crud Routes End--}}

