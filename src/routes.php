<?php
Route::get('laravel5designer', 'Congkhuong\LaravelDesign\Controllers\DesignerController@index');

Route::get('/databases', [
    'as' => 'databases.index', 'uses' => 'Congkhuong\LaravelDesign\Controllers\DatabasesController@index'
]);
Route::post('/databases/save', [
    'as' => 'databases.save', 'uses' => 'Congkhuong\LaravelDesign\Controllers\DatabasesController@save'
]);
Route::post('/databases/update', [
    'as' => 'databases.update', 'uses' => 'Congkhuong\LaravelDesign\Controllers\DatabasesController@update'
]);
Route::get('/databases/getdbs',[
    'as' => 'databases.dbs', 'uses' => 'Congkhuong\LaravelDesign\Controllers\DatabasesController@dbs'
]);
Route::post('/databases/ajax', [
    'as' => 'databases.ajax', 'uses' => 'Congkhuong\LaravelDesign\Controllers\DatabasesController@ajax'
]);
Route::get('/databases/ajax', function() {
	return json_encode(
		[
			"description"=> "bbb",
			"files"=> [
				"aaa.skema"=> [
					"content"=> [
						[
							"name"=>"BlogUsers",
							"color"=>"Red",
							"position"=>["x"=>93,"y"=>126],
							"classname"=>"BlogUser",
							"namespace"=>"",
							"increment"=>false,
							"timestamp"=>true,
							"softdelete"=>false,
							"column"=>[
								[
									"name"=>"id",
									"type"=>"increments",
									"length"=>"",
									"defaultvalue"=>"",
									"enumvalue"=>"",
									"ai"=>false,
									"pk"=>false,
									"nu"=>false,
									"ui"=>false,
									"in"=>false,
									"un"=>false,
									"fillable"=>false,
									"guarded"=>false,
									"visible"=>false,
									"hidden"=>false,
									"colid"=>"c87",
									"order"=>0
								],
								[
									"name"=>"username",
									"type"=>"string",
									"length"=>"",
									"defaultvalue"=>"bogus",
									"enumvalue"=>"",
									"ai"=>false,
									"pk"=>false,
									"nu"=>false,
									"ui"=>false,
									"in"=>false,
									"un"=>false,
									"fillable"=>false,
									"guarded"=>false,
									"visible"=>false,
									"hidden"=>false,
									"colid"=>"c185",
									"order"=>1
								],
								[
									"name"=>"password",
									"type"=>"string",
									"length"=>"",
									"defaultvalue"=>"",
									"enumvalue"=>"",
									"ai"=>false,
									"pk"=>false,
									"nu"=>false,
									"ui"=>false,
									"in"=>false,
									"un"=>false,
									"fillable"=>false,
									"guarded"=>false,
									"visible"=>false,
									"hidden"=>false,
									"colid"=>"c193",
									"order"=>2
								],
								[
									"name"=>"profile",
									"type"=>"text",
									"length"=>"",
									"defaultvalue"=>"",
									"enumvalue"=>"",
									"ai"=>false,
									"pk"=>false,
									"nu"=>false,
									"ui"=>false,
									"in"=>false,
									"un"=>false,
									"fillable"=>false,
									"guarded"=>false,
									"visible"=>false,
									"hidden"=>false,
									"colid"=>"c201",
									"order"=>3
								]
							],
							"relation"=>[
								["extramethods"=>"",
								"foreignkeys"=>"",
								"name"=>"Posts",
								"relatedmodel"=>"Post",
								"relationtype"=>"hasMany",
								"usenamespace"=>""]
							],
							"seeding"=>[
								[
									["colid"=>"c87","content"=>"0"],
									["colid"=>"c185","content"=>"badgeek"],
									["colid"=>"c193","content"=>"test123"],
									["colid"=>"c201","content"=>"profile 0"]
								],
								[
									["colid"=>"c87","content"=>"1"],
									["colid"=>"c185","content"=>"hello"],
									["colid"=>"c193","content"=>"test123"],
									["colid"=>"c201","content"=>"profile 1"]
								],
								[
									["colid"=>"c87","content"=>"2"],
									["colid"=>"c185","content"=>"void"],
									["colid"=>"c193","content"=>"test123"],
									["colid"=>"c201","content"=>"profile 2"]
								],
								[
									["colid"=>"c87","content"=>"3"],
									["colid"=>"c185","content"=>"john"],
									["colid"=>"c193","content"=>"john123"],
									["colid"=>"c201","content"=>"profile 3"]
								]
							]
						],
						["name"=>"Posts","color"=>"Green","position"=>["x"=>660,"y"=>231],"classname"=>"Post","namespace"=>"","increment"=>false,"timestamp"=>false,"softdelete"=>false,"column"=>[["name"=>"id","type"=>"increments","length"=>"","defaultvalue"=>"","enumvalue"=>"","ai"=>false,"pk"=>false,"nu"=>false,"ui"=>false,"in"=>false,"un"=>false,"fillable"=>false,"guarded"=>false,"visible"=>false,"hidden"=>false,"colid"=>"c95","order"=>0],["name"=>"title","type"=>"string","length"=>"","defaultvalue"=>"","enumvalue"=>"","ai"=>false,"pk"=>false,"nu"=>false,"ui"=>false,"in"=>false,"un"=>false,"fillable"=>false,"guarded"=>false,"visible"=>false,"hidden"=>false,"colid"=>"c218","order"=>1],["name"=>"content","type"=>"text","length"=>"","defaultvalue"=>"","enumvalue"=>"","ai"=>false,"pk"=>false,"nu"=>false,"ui"=>false,"in"=>false,"un"=>false,"fillable"=>false,"guarded"=>false,"visible"=>false,"hidden"=>false,"colid"=>"c226","order"=>2]],"relation"=>[["extramethods"=>"","foreignkeys"=>"","name"=>"Categories","relatedmodel"=>"Category","relationtype"=>"hasMany","usenamespace"=>""]],"seeding"=>[]],
						["name"=>"Categories","color"=>"Blue","position"=>["x"=>89,"y"=>349],"classname"=>"Category","namespace"=>"","increment"=>false,"timestamp"=>false,"softdelete"=>false,"column"=>[["name"=>"id","type"=>"increments","length"=>"","defaultvalue"=>"","enumvalue"=>"","ai"=>false,"pk"=>false,"nu"=>false,"ui"=>false,"in"=>false,"un"=>false,"fillable"=>false,"guarded"=>false,"visible"=>false,"hidden"=>false,"colid"=>"c111","order"=>0],["name"=>"name","type"=>"string","length"=>"100","defaultvalue"=>"","enumvalue"=>"","ai"=>false,"pk"=>false,"nu"=>false,"ui"=>false,"in"=>false,"un"=>false,"fillable"=>false,"guarded"=>false,"visible"=>false,"hidden"=>false,"colid"=>"c70","order"=>1]],"relation"=>[],"seeding"=>[]]
					]
				]
			],
			"public"=> true
		]
	);
});

?>