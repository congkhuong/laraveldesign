<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Laravel Database Designer 0.1</title>
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('vendor/congkhuong/bower_components/bootstrap/dist/css/bootstrap.css') }} " rel="stylesheet">
        <!-- Custom styles for this template -->

        <link href="{{ asset('vendor/congkhuong/css/jumbotron.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/congkhuong/css/app.css') }}" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <input style="display:none;" id="fileSaveDialog" type="file" nwsaveas />
        <input style="display:none;" id="fileOpenDialog" type="file" />
        <!-- Dialog Region
        ================================================== -->
        <div class="modals-container"></div>
        <!-- Container Region
        ================================================== -->
        <div id="apps">
            <div id="biodesign-logo">
                <img src="asset/img/biodesign-logo-web.png" alt="">
            </div>
        </div>
        <!-- Template
        ================================================== -->
        <script type="text/template" id="generate-template">

        <form class="form-horizontal">
        <fieldset>

        <!-- Form Name -->
        <legend>Generate Table</legend>
        <!-- Textarea -->
        <div class="form-group">
          <div class="col-md-4">                     
            <textarea style="width: 563px; height: 359px" class="form-control" id="txtcommand" name="txtcommand"><%=content%></textarea>
          </div>
        </div>


        </fieldset>
        </form>

        </script>        
        <!-- Template
        ================================================== -->
        <script type="text/template" id="nodemodel-template">
        <form class="form-horizontal">
            <fieldset>
                <!-- Form Name -->
                <legend>Create a Column</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="name">Column Name</label>
                    <div class="col-md-4">
                        <input id="name" name="name" type="text" placeholder="Column Name" class="form-control input-md" value="<%=name%>">
                        
                    </div>
                </div>
                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="type">Type</label>
                    <div class="col-md-4">
                        <select id="type" name="type" class="form-control">
                            <optgroup label="LARAVEL TYPES">
                                <option value="increments">INCREMENTS</option>
                                <option value="bigIncrements">BIG INCREMENTS</option>
                                <option value="timestamps">TIME STAMPS</option>
                                <option value="softDeletes">SOFT DELETES</option>
                                <option disabled="disabled">-</option>
                                <option value="string">STRING (VARCHAR)</option>
                                <option value="text">TEXT</option>
                                <option disabled="disabled">-</option>
                                <option value="tinyInteger">TINY INTEGER</option>
                                <option value="smallInteger">SMALL INTEGER</option>
                                <option value="mediumInteger">MEDIUM INTEGER</option>
                                <option value="integer">INTEGER</option>
                                <option value="bigInteger">BIG INTEGER</option>
                                <option disabled="disabled">-</option>
                                <option value="float">FLOAT</option>
                                <option value="decimal">DECIMAL</option>
                                <option value="boolean">BOOLEAN</option>
                                <option disabled="disabled">-</option>
                                <option value="enum">ENUM</option>
                                <option disabled="disabled">-</option>
                                <option value="date">DATE</option>
                                <option value="datetime">DATETIME</option>
                                <option value="time">TIME</option>
                                <option value="timestamp">TIMESTAMP</option>
                                <option disabled="disabled">-</option>
                                <option value="binary">BINARY</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="length">Length</label>
                    <div class="col-md-4">
                        <input id="length" name="length" type="text" placeholder="Length" class="form-control input-md" value="<%=length%>">
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="defaultvalue">Default Value</label>
                    <div class="col-md-4">
                        <input id="defaultvalue" name="defaultvalue" type="text" placeholder="Default Value" class="form-control input-md" value="<%=defaultvalue%>">
                        
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="enumvalue">Enum Value</label>
                    <div class="col-md-4">
                        <input id="enumvalue" name="enumvalue" type="text" placeholder="Enum Value" class="form-control input-md" value="<%=enumvalue%>">
                        
                    </div>
                </div>
                <!-- Multiple Checkboxes -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="columnOption">Option</label>
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label for="ai">
                                <input type="checkbox" name="ai" id="ai" value="Auto Incremental">
                                Auto Incremental
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="pk">
                                <input type="checkbox" name="pk" id="pk" value="Primary Key">
                                Primary Key
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="nu">
                                <input type="checkbox" name="nu" id="nu" value="Nullable">
                                Nullable
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="ui">
                                <input type="checkbox" name="ui" id="ui" value="Unsigned Integer">
                                Unsigned Integer
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="in">
                                <input type="checkbox" name="in" id="in" value="Index">
                                Index
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="un">
                                <input type="checkbox" name="un" id="un" value="Unique Index">
                                Unique Index
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="fillable">
                                <input type="checkbox" name="fillable" id="fillable" value="Fillable">
                                Fillable
                            </label>
                        </div>

                        <div class="checkbox">
                            <label for="guarded">
                                <input type="checkbox" name="guarded" id="guarded" value="Guarded">
                                Guarded
                            </label>
                        </div>
                                                <div class="checkbox">
                            <label for="visible">
                                <input type="checkbox" name="visible" id="visible" value="Visible">
                                Visible
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="hidden">
                                <input type="checkbox" name="hidden" id="hidden" value="Hidden">
                                Hidden
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="button1id"></label>
                    <div class="col-md-8">
                        <button id="button1id" name="button1id" class="ok btn btn-success">Save</button>
                        <button id="button2id" name="button2id" class="cancel btn btn-danger">Cancel</button>
                    </div>
                </div>
            </fieldset>
        </form>
        </script>
        <!-- Template
        ================================================== -->

        <!-- Template
        ================================================== -->
        <script type="text/template" id="nodecanvas-template">
        <div class="btn-group toolbox" style="padding: 10px; position: fixed; z-index: 100;">
            <button type="button" class="btn btn-default btn-xs addcontainer"><span style="margin-right: 2px" class="glyphicon glyphicon-plus "></span>new table</button>
            <button type="button" class="btn btn-default btn-xs generate"><span style="margin-right: 2px" class="glyphicon  glyphicon-cutlery "></span>generate</button>
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                File <span class="caret "></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a class="save" href="#">Save</a></li>
                    <li><a class="open" href="#">Open</a></li>

                    <li><a class="saveas" href="#">Save As</a></li>
                    <li class="divider"></li>                    
                    <li><a class="opengist" href="#">Open from Gist</a></li>
                    <li><a class="opengistid" href="#">Open Gist ID</a></li>
                    <li><a class="savecurrentgis" href="#">Save current Gist</a></li>
                    <li><a class="saveasgist" href="#">Save as Gist</a></li>
                    <li class="divider"></li>
                    <li><a class="loadexample" href="#">Load Example</a></li>                    
                    <li><a class="clearcanvas" href="#">Clear Canvas</a></li>
                </ul>
            </div>
        </div>
        </script>
        <!-- Template
        ================================================== -->
        <script type="text/template" id="nodeitem-template">
        <b><%=name%></b> <i><%=type%></i> (<%=length%>)

        <div style="float: right">
        <a href="#" class="btn edit btn-xs btn-container"><span class="glyphicon glyphicon-edit"></span></a>
        <a href="#" class="btn delete btn-xs btn-container"><span class="glyphicon glyphicon-remove"></span></a>
        </div>
        </script>
        <!-- Template
        ================================================== -->
        <script type="text/template" id="nodecontainer-template">
        <div>
        <p> <b><%=name%>:<%=classname%></b>
        <a href="#" style="display: none;" class="btn relationadd btn-xs btn-container"><span class="glyphicon glyphicon-plus"></span> r</a>
        <a href="#" class="btn seeding btn-xs btn-container"><span class="glyphicon glyphicon-eye-open"></span> s</a>        
        <a href="#" class="btn relation btn-xs btn-container"><span class="glyphicon glyphicon-eye-open"></span> r</a>
        <a href="#" class="btn edit btn-xs btn-container"><span class="glyphicon glyphicon-edit"></span> </a>        
        <a href="#" class="btn delete btn-xs btn-container"><span class="glyphicon glyphicon-remove-circle"></span> </a>
        
        <ul class="nodecollection-container">
        </ul>        <a href="#" class="btn add add-column btn-xs btn-container"><span class="glyphicon glyphicon-plus"></span>add new column</a>

                <div id="conn-<%=name%>" style="" tag="<%=name%>" class="conn"></div>
        </div>
        </script>
        <!-- Template
        ================================================== -->
        <script type="text/template" id="createnode-template">
        <form class="form-horizontal">
            <fieldset>
                <!-- Form Name -->
                <legend>Create Table</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="container-name">Table Name</label>
                    <div class="col-md-4">
                        <input id="container-name" value="<%=name%>" name="name" type="text" placeholder="Table1" class="form-control input-md">
                        
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="container-classname">Model Class Name</label>
                    <div class="col-md-4">
                        <input id="container-classname" value="<%=classname%>" name="classname" type="text" placeholder="Model Class Name" class="form-control input-md">
                        
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="container-namespace">Namespace</label>
                    <div class="col-md-4">
                        <input id="container-namespace" value="<%=namespace%>" name="namespace" type="text" placeholder="Namespace" class="form-control input-md">
                        
                    </div>
                </div>
                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="container-color">Color</label>
                    <div class="col-md-4">
                        <select id="container-color" name="color" class="form-control">
                            <option value="Grey">Grey</option>                        
                            <option value="Red">Red</option>
                            <option value="Green">Green</option>
                            <option value="Blue">Blue</option>
                            <option value="Yellow">Yellow</option>
                        </select>
                    </div>
                </div>
                <!-- Multiple Checkboxes -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="tableOptions">Options</label>
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label for="container-increment">
                                <input type="checkbox" name="increment" id="container-increment" value="increment">
                                Add Laravel ID increments column.
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="container-timestamp">
                                <input type="checkbox" name="timestamp" id="container-timestamp" value="timestamp">
                                Add Laravel timestamps.
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="container-softdelete">
                                <input type="checkbox" name="softdelete" id="container-softdelete" value="softdelete">
                                Add Laravel soft delete.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8" style="float: right">
                        <button id="button1id" name="button1id" class="ok addnode btn btn-success">Save</button>
                        <button id="button2id" name="button2id" class="cancel btn btn-danger">Cancel</button>
                    </div>
                </div>
            </fieldset>
        </form>
        </script>
        <!-- Template
        ================================================== -->
        <script type="text/template" id="relationcreate-template">
        <form class="form-horizontal">
            <fieldset>
                <!-- Form Name -->
                <legend><%=title%></legend>
                <!-- Select Basic -->
                <div class="form-group classoption">
                    <label class="col-md-4 control-label" for="relation-relatedmodel">Related Model</label>
                    <div class="col-md-4">
                        <select id="relation-relatedmodel" name="relatedmodel" class="form-control">
                            <% _.each(relatedmodel, function(related) { %>
                            <option value="<%=related.classname%>" > <%=related.classname%></option>
                            <% }); %>
                        </select>
                    </div>
                </div>
                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="relation-relationtype">Relation Type</label>
                    <div class="col-md-4">
                        <select id="relation-relationtype" name="relationtype" class="form-control">
                            <option value="hasOne">hasOne</option><option value="belongsTo">belongsTo</option><option value="hasMany">hasMany</option><option value="belongsToMany">belongsToMany</option><option value="hasManyThrough">hasManyThrough</option><option value="morphOne">morphOne</option><option value="morphTo">morphTo</option><option value="morphMany">morphMany</option><option value="morphedByMany">morphedByMany</option><option value="morphToMany">morphToMany</option>                        </select>
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="relation-name">Function Name</label>
                        <div class="col-md-4">
                            <input id="relation-name" name="name" type="text" placeholder="Function Name" value="<%=relationship.name%>" class="form-control input-md">
                            
                        </div>
                    </div>
                    
                    <!-- Prepended checkbox -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="relation-usenamespace">Use Namespace</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                <input type="checkbox">
                                </span>
                                <input id="relation-usenamespace" name="usenamespace" class="form-control" type="text" placeholder="Enable">
                            </div>
                            
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="relation-foreignkeys">Foreign Key</label>
                        <div class="col-md-4">
                            <input id="relation-foreignkeys" name="foreignkeys" type="text" value="<%=relationship.foreignkeys%>" placeholder="Use Comma if multiple" class="form-control input-md">
                            
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="relation-extramethods">Extra Method</label>
                        <div class="col-md-4">
                            <input id="relation-extramethods" name="extramethods" value="<%=relationship.extramethods%>"  type="text" placeholder="ex.. ->withPivot('foo')" class="form-control input-md">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8" style="float: right">
                            <button id="btnsave" name="button1id" class="ok save btn btn-success">Save</button>
                            <button id="btndelete" name="button2id" class="ok delete btn btn-danger">Delete</button>
                            <button id="btncancel" name="button2id" class="cancel btn btn-primary">Cancel</button>
                        </div>
                    </div>
                </fieldset>
            </form>
            </script>
            <!-- Template
            ================================================== -->
            <script type="text/template" id="relationitem-template">
            <td><%=name %></td>
            <td><%=relationtype %></td>
            <td><%=relatedmodel %></td>
            <td><%=foreignkeys %></td>
            <td colspan="2" style="text-align: right;">
                <div class="btn-group">
                    <a href="#" class="btn edit btn-xs btn-warning"><span class=""></span>Edit</a>
                    <a href="#" class="btn delete btn-xs btn-danger"><span class=""></span>Delete</a>
                </div>
            </td>
            </script>
            <!-- Template
            ================================================== -->
            <script type="text/template" id="relationcollection-template">
            <legend>Relation List Model: <%=classname%> </legend>
            <table class="table">
                <thead>
                    <tr>
                        <th>Function</th>
                        <th>Relation</th>
                        <th>Model</th>
                        <th>Foreign key</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            <div class="modal-footer">
                <a href="#" class="btn ok btn-primary">Add New Relation</a>
                <a href="#" class="btn btn-primary cancel">Cancel</a>
            </div>
            </script>
            <!-- Template
            ================================================== -->
            <script type="text/template" id="seeditem-template">
            

             <input  type="text" value="<%=content%>" class="form-control input-md editvalue">

            </script>

            <!-- Template
            ================================================== -->
            <script type="text/template" id="seeding-template">
            <legend>Add Seed </legend>            
            <form class="form-horizontal">            
                <fieldset>
                <table class="table">
                    <thead>
                        <tr class="headerSeedRow">
                            <% _.each(column, function(col) { %>
                            <th><%=col.name%></th>
                            <% }); %>
                            <th></th>
                        </tr>
                                          <tr class="addSeedRow">
                            <% _.each(column, function(col) { %>
                            <td><input id="<%=col.name%>" name="<%=col.name%>" type="text"  class="form-control input-md"></td>
                            <% }); %>
                            <td><button id="btnsave" name="button1id" class="ok save btn btn-success">add</button></td>
                        </tr>

                    </thead>
    
                </table>

                </fieldset>
            </form>
            </script>               
            <!-- Template
            ================================================== -->
            <script type="text/template" id="gistfile-template">
            <div class="list-group">
            <% _.each(gistlist, function(item) { %>
            <a href="#" class="list-group-item" tag="<%=item.id%>" >
                <h4 class="list-group-item-heading"><%= item.description%></h4>
                <p class="list-group-item-text"><%= item.filename %></p>
            </a>
            <% }); %>
            </div>            
            </script>               
            <!-- Template
            ================================================== -->
            <script type="text/template" id="gistsave-template">
            <form class="form-horizontal">
            <fieldset>

            <!-- Form Name -->
            <legend>Save as Gist</legend>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="filename">Filename</label>  
              <div class="col-md-4">
              <input id="filename" name="filename" type="text" placeholder="" class="form-control input-md">
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="description">Description</label>  
              <div class="col-md-4">
              <input id="description" name="description" type="text" placeholder="" class="form-control input-md">
                
              </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="button1id"></label>
              <div class="col-md-8">
                <button id="button1id" name="button1id" class="btn ok btn-success">Ok</button>
                <button id="button2id" name="button2id" class="btn cancel btn-danger">Cancel</button>
              </div>
            </div>

            </fieldset>
            </form>

            </script>
            <!-- Template
            ================================================== -->
            <script type="text/template" id="gistload-template">
            <legend>Load file From Gist</legend>
            <div id="gistfiles">
            <div class="progress">
      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only">Loading..</span></div>
    </div>
            </div>
            </script>
            <!-- Template
            ================================================== -->
            <script type="text/template" id="gistloadid-template">
                <form class="form-horizontal">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Load file From Gist</legend>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Gist ID</label>
                            <div class="col-md-4">
                                <input id="filename" name="filename" type="text" placeholder="" class="form-control input-md">
                                
                            </div>
                        </div>
                        <!-- Button (Double) -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="button1id"></label>
                            <div class="col-md-8">
                                <button id="button1id" name="button1id" class="btn ok btn-success">Open</button>
                                <button id="button2id" name="button2id" class="btn cancel btn-danger">Cancel</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
             </script>
            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="{{ asset('vendor/congkhuong/bower_components/jquery/jquery.js') }}"></script>


            <script src="{{ asset('vendor/congkhuong/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

            <script src="{{ asset('vendor/congkhuong/bower_components/jsplumb/dist/js/jquery.jsPlumb-1.6.4.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/bower_components/underscore/underscore.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/bower_components/backbone/backbone.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/bower_components/marionette/lib/backbone.marionette.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/bower_components/backbone.syphon/lib/backbone.syphon.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/bower_components/backbone.bootstrap-modal/src/backbone.bootstrap-modal.js') }} "></script>
            <script src="{{ asset('vendor/congkhuong/bower_components/hello/dist/hello.all.min.js') }} "></script>
            <!-- region -->
            <script src="{{ asset('vendor/congkhuong/app/js/app.js') }}"></script>
            <!-- schema entity -->            
            <script src="{{ asset('vendor/congkhuong/app/js/entities/node_entities.js') }}"></script>
            <!-- node -->
            <script src="{{ asset('vendor/congkhuong/app/js/node/node_view.js') }} "></script>            
            <script src="{{ asset('vendor/congkhuong/app/js/node/node_modal_base.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/app/js/node/node_modal_container.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/app/js/node/node_modal_generate.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/app/js/node/node_modal_item.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/app/js/node/node_modal_relation.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/app/js/node/node_modal_seed.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/app/js/node/node_modal_gist.js') }}"></script>            
            <script src="{{ asset('vendor/congkhuong/app/js/node/node_controller.js') }}"></script>            
            <!-- canvas -->
            <script src="{{ asset('vendor/congkhuong/app/js/canvas/nodecanvas_view.js') }}"></script>        
            <script src="{{ asset('vendor/congkhuong/app/js/canvas/nodecanvas_controller_base.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/app/js/canvas/nodecanvas_controller_canvas.js') }}"></script>
            <script src="{{ asset('vendor/congkhuong/app/js/canvas/nodecanvas_controller_child.js') }}"></script>
            <!-- main startup -->
            <script src="{{ asset('vendor/congkhuong/app/js/main.js')}}"></script>
            <script src="{{ asset('vendor/congkhuong/app/js/node-webkit/node.js') }}"></script>

        </body>
    </html>