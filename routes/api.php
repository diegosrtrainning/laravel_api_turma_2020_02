<?php


Route::prefix('v1')->group(function () {
    Route::get('/produtos', 'Api\ProdutosController@index')->name('produtos.index');
    Route::get('/produtos/{id}', 'Api\ProdutosController@show')->name('produtos.show');
    Route::get('/produtos/create', 'Api\ProdutosController@create')->name('produtos.create');
    Route::post('/produtos', 'Api\ProdutosController@store')->name('produtos.store');
    Route::get('/produtos/{id}/edit', 'Api\ProdutosController@edit')->name('produtos.edit');
    Route::put('/produtos/{id}', 'Api\ProdutosController@update')->name('produtos.update');
    Route::delete('/produtos/{id}', 'Api\ProdutosController@destroy')->name('produtos.destroy');
});
