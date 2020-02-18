<?php


Route::prefix('v1')->group(function () {
    Route::post('auth', 'Auth\AuthApiController@authenticate')->name('api.v1.auth');
    Route::post('refresh', 'Auth\AuthApiController@refresh')->name('api.v1.refresh');
    Route::post('logout', 'Auth\AuthApiController@logout')->name('api.v1.logout');
    Route::get('me', 'Auth\AuthApiController@me')->name('api.v1.me');

    Route::group(['middleware' => ['auth:api','jwt.refresh'], 'namespace' => 'Api', 'as' => 'api.v1.'], function () {
        Route::get('/produtos', 'ProdutosController@index')->name('produtos.index');
        Route::get('/produtos/{produto}', 'ProdutosController@show')->name('produtos.show');
        Route::get('/produtos/create', 'ProdutosController@create')->name('produtos.create');
        Route::post('/produtos', 'ProdutosController@store')->name('produtos.store');
        Route::get('/produtos/{produto}/edit', 'ProdutosController@edit')->name('produtos.edit');
        Route::put('/produtos/{produto}', 'ProdutosController@update')->name('produtos.update');
        Route::delete('/produtos/{produto}', 'ProdutosController@destroy')->name('produtos.destroy');
   });
});
