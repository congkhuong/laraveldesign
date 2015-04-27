DesignerApp.module("NodeEntities", function(NodeEntities, DesignerApp, Backbone, Marionette, $, _) {
    // Private
    // -------------------------
    //todo parameter .......

    // Public
    // -------------------------
    //
    //    1.NodeCanvas (col)
    //        *NodeContainer (model) -> composite view
    //          1.NodeCollection (col) -> NodeModel
    //          2.RelationCollection (col) -> RelationModel
    //          .....
    //

    /* NodeModel
	{
	  "name" : "id",
	  "type" : "increments",
	  "length" : 30,
	  "order" : 0,
	  "defaultvalue" : "",
	  "enumvalue" : ""
	}
	*/
    var NodeModel = Backbone.Model.extend({
        defaults: {
            name: '',
            type: '',
            length: '',
            defaultvalue: '',
            enumvalue: ''
        },
        initialize: function(param) {
            if (typeof param !== 'undefined') {
                if (!param.colid) this.set("colid", this.cid);
            }
            //console.log(this.get("cid"));
        },
        validate: function(attrs, options) {
            return {
                error: "Wew"
            };
            //console.log("wew");
        }
    });

    var NodeCollection = Backbone.Collection.extend({
        model: NodeModel,
        comparator: "order"
    });

    /* RelationModel
	{
	  "extramethods" : "",
	  "foreignkeys" : "user_id",
	  "name" : "machines",
	  "relatedmodel" : "Roles",
	  "relationtype" : "hasMany",
	  "usenamespace" : ""
	}
	*/
    var RelationModel = Backbone.Model.extend({
        defaults: {
            name: '',
            relationtype: '',
            usenamespace: '',
            relatedmodel: '',
            foreignkeys: '',
            extramethods: ''
        },
        validate: function(attrs, options) {
            var errors = {};
            if (!attrs.name) {
                errors.name = "cant be blank";
            }
            if (!attrs.relationtype) {
                errors.relationtype = "cant be blank";
            }

            if (!attrs.relatedmodel) {
                errors.relatedmodel = "cant be blank";
            }

            if (!_.isEmpty(errors)) {
                return errors;
            }

        }

    });

    var RelationCollection = Backbone.Collection.extend({
        model: RelationModel
    });


    //
    //  Name
    //  Color
    //  position (x,y)
    //  NodeCollection*
    //  RelationCollection*
    //

    var NodeContainer = Backbone.Model.extend({
        defaults: {
            name: "",
            classname: "",
            namespace: "",
            color: "",
            increment: "",
            timestamp: "",
            softdelete: ""
        },
        getSeeding: function() {

            var newseeding = new NodeEntities.Seeding();

            var nodeSeeding = this.get("seeding");
            var nodeItem = this.get("column");

            nodeSeeding.each(function(seed) {

                var seedItem = new DesignerApp.NodeEntities.SeedTableCollection();

                nodeItem.each(function(nodecolumn) {
                    var newseed = {};

                    //console.log(nodecolumn.get("colid"));
                    var r = (seed.get("column").findWhere({
                        colid: nodecolumn.get("colid")
                    }));

                    //console.log(seed);

                    if (r) {
                        newseed.colid = r.get("colid");
                        newseed.content = r.get("content");
                        seedItem.get("column").add(newseed);
                    } else {
                        //console.log(nodecolumn);
                        newseed.colid = nodecolumn.get("colid");
                        newseed.content = "";
                        seedItem.get("column").add(newseed);
                    }
                });
                newseeding.add(seedItem);
            });
            return newseeding;
        },
        validate: function(attrs, options) {
            var errors = {};
            if (!attrs.name) {
                errors.name = "cant be blank";
            }
            if (!attrs.classname) {
                errors.classname = "cant be blank";
            }
            //if (!attrs.namespace) {
            //    errors.namespace = "cant be blank";
            //}
            if (!attrs.color) {
                errors.color = "cant be blank";
            }
            /*
            if (!attrs.increment) {
                errors.increment = "cant be blank";
            }
            if (!attrs.timestamp) {
                errors.timestamp = "cant be blank";
            }
            if (!attrs.softdelete) {
                errors.softdelete = "cant be blank";
            }
            */
            if (!_.isEmpty(errors)) {
                console.log(errors);
                return errors;
            }

        }
    });

    var NodeCanvas = Backbone.Collection.extend({
        model: NodeContainer
    });


    NodeEntities.SeedColumn = Backbone.Model.extend({
        defaults: {
            colid: "",
            content: ""
        }
    });

    NodeEntities.SeedTable = Backbone.Collection.extend({
        collection: NodeEntities.SeedColumn
    });

    NodeEntities.SeedTableCollection = Backbone.Model.extend({
        initialize: function() {
            this.set("column", new NodeEntities.SeedTable());
        }
    });

    NodeEntities.Seeding = Backbone.Collection.extend({
        model: NodeEntities.SeedTableCollection
    });



    var nodeCanvas = new NodeCanvas();

    NodeEntities.CurrentNodeCanvas = nodeCanvas;

    NodeEntities.getNewNodeContainer = function() {
        return new NodeContainer();
    };

    NodeEntities.getNewNodeModel = function() {
        return new NodeModel();
    };

    NodeEntities.getNewRelationModel = function() {
        return new RelationModel();
    };


    NodeEntities.getNodeCanvas = function() {
        return nodeCanvas;
    };

    NodeEntities.getNodeContainerFromNodeCid = function(modelcid) {
        return nodeCanvas.get(modelcid);
    };

    NodeEntities.getNodeContainerFromClassName = function(modelname) {
        return nodeCanvas.where({
            classname: modelname
        })[0];
    };

    NodeEntities.getNodeContainerFromName = function(modelname) {
        return nodeCanvas.where({
            name: modelname
        })[0];
    };


    NodeEntities.AddNewNode = function(param) {
        var nodeContainer = new NodeContainer(param);
        var col = nodeContainer.get("column"); //NodeCollection
        var rel = nodeContainer.get("relation"); //RelationCollection

        nodeContainer.set("column", new NodeCollection(col));
        nodeContainer.set("relation", new RelationCollection(rel));
        nodeContainer.set("seeding", new NodeEntities.Seeding());

        nodeContainer.set("seeding", nodeContainer.getSeeding());
        nodeCanvas.add(nodeContainer);
        //console.log(param);

        _.each(param.seeding, function(seedItem) {
            var seed = new NodeEntities.SeedTableCollection();
            nodeContainer.get("column").each(function(columnItem) {
                _.each(seedItem, function(seedEntity) {
                    if (seedEntity.colid === columnItem.get("colid")) {
                        seed.get("column").add({
                            colid: seedEntity.colid,
                            content: seedEntity.content
                        });
                    }

                });
            });
            nodeContainer.get("seeding").add(seed);
        });

        //_.each(param.seeding, function(seedItem) {
        //    var seed = new NodeEntities.SeedTableCollection();
        //    _.each(seedItem, function(Item){
        //            seed.get("column").add({
        //                cid: Item.cid,
        //                content: Item.content
        //            });
        //            console.log(Item);
        //    }); 
        //    nodeContainer.get("seeding").add(seed);             
        //});



    };

    NodeEntities.AddNewRelation = function(nodeCanvasParam) {
        nodeCanvas.each(function(node) {
            var relations = node.get("relation");
            relations.each(function(relation) {
                NodeEntities.AddRelation(node, relation);
            });
        });
    };

    NodeEntities.AddNodeCanvas = function(nodeCanvasParam) {
        for (var node in nodeCanvasParam) {
            NodeEntities.AddNewNode(nodeCanvasParam[node]);

        }
        NodeEntities.AddNewRelation();
    };

    NodeEntities.AddRelation = function(node, relation) {
        //console.log(relation);
        var sourceNodeContainer = node;
        var targetNodeContainer = NodeEntities.getNodeContainerFromClassName(relation.get("relatedmodel"));
        var destinationRelationModel = relation;

        var raiseVent = function(evName) {
            DesignerApp.vent.trigger("noderelation:" + evName, {
                srcNodeContainer: sourceNodeContainer,
                dstRelation: destinationRelationModel
            });
            //console.log(evName);
        };
        //on delete node also delte referenced relation

        relation.on('change:relatedmodel', function(relationModel) {
            relation.stopListening();

            //console.log(relationModel);

            var targetModel = NodeEntities.getNodeContainerFromName(relation.get("name"));
            relation.listenTo(targetModel, "destroy", function() {
                raiseVent("destroyme");
                relation.destroy();
            });
            raiseVent("change");
        });

        //on relation type change update overlay
        relation.on("change:relationtype", function() {
            raiseVent("redraw");
        });

        //on target table destroy, destroy our relation
        relation.listenTo(targetNodeContainer, "destroy", function() {
            raiseVent("destroy");
            relation.destroy();
        });

        //on target table relation rename, change our reference and update overlay
        relation.listenTo(targetNodeContainer, "change:classname", function(targetNode) {
            relation.set("relatedmodel", targetNode.get("classname"), {
                silent: true
            });
            raiseVent("rename");
        });

        //on our table rename update overlay
        relation.listenTo(sourceNodeContainer, "change:name", function(targetNode) {
            raiseVent("rename");
        });


        //on our table rename update overlay
        relation.listenTo(sourceNodeContainer, "change:classname", function(targetNode) {
            raiseVent("rename");
        });

        //on destroy clean up
        relation.on("destroy", function() {
            raiseVent("destroy");
            relation.stopListening();
            relation.off();
            relation.destroy();
        });

        raiseVent("add");

    };


    NodeEntities.ExportToJSON = function() {
        var varNodeCanvas = nodeCanvas;

        var nodes = [];

        varNodeCanvas.each(function(nodeContainer) {

            var nodetmp = {
                name: nodeContainer.get('name'),
                color: nodeContainer.get('color'),
                position: nodeContainer.get('position'),
                classname: nodeContainer.get('classname'),
                namespace: nodeContainer.get('namespace'),
                
                increment: nodeContainer.get('increment'),
                timestamp: nodeContainer.get('timestamp'),
                softdelete: nodeContainer.get('softdelete'),
                column: [],
                relation: [],
                seeding: [],
            };

            nodeContainer.get('column').each(function(columnItem) {
                var col = columnItem.toJSON();
                var tmp = {
                    colid: col.colid,
                    name: col.name,
                    type: col.type,
                    length: col.length,
                    order: col.order,
                    defaultvalue: col.defaultvalue,
                    enumvalue: col.enumvalue
                };
                nodetmp.column.push(col);
            });

            nodeContainer.get('relation').each(function(relationItem) {
                var rel = relationItem.toJSON();
                var tmp = {
                    extramethods: rel.extramethods,
                    foreignkeys: rel.foreignkeys,
                    name: rel.name,
                    relatedmodel: rel.relatedmodel,
                    relationtype: rel.relationtype,
                    usenamespace: rel.usenamespace
                };
                nodetmp.relation.push(tmp);
            });

            var seeding = nodeContainer.getSeeding();
            seeding.each(function(seedItem) {
                nodetmp.seeding.push(seedItem.get("column").toJSON());
            });

            nodes.push(nodetmp);
        });
        //console.log(JSON.stringify(nodes));
        return (nodes);
    };


    var CreateTableCommand = function(TableParam) {
      
        var field_options = {
            "ai": "autoincrements",
            "pk": "primarykey",
            "nu": "nullable",
            "ui": "unsigned",
            "in": "index",
            "un": "unique",
            "integer": "integer",
            //"guarded": "guarded",
            //"fillable": "fillable",
            //"visible": "visible",
            //"hidden": "hidden",
        };

        var set_default_txt = function(col)
        {
                if (col.defaultvalue) {
                    return (":default('" + col.defaultvalue +  "')"); 
                }else{
                    return "";
                }
        };

        //php artisan generate:migration create_posts_table --fields="title:string, body:text"
        //console.log(TableParam.name);

        var table_cmd = "";

        for (var col in TableParam.column) {
            //console.log(TableParam.column[col]);
            var field_cmd = "";

            var column = TableParam.column[col];

            field_cmd += column.name;

            //console.log(column);
            //options
            switch(column.type)
            {
                case "string":
                //length
                //defaultvalue
                field_cmd += ":string";
                field_cmd += set_default_txt(column);
                if (column.length) field_cmd += (":length('" + column.length +  "')");                 
                break;
                case "text":
                //defaultvalue
                field_cmd += ":text";
                field_cmd += set_default_txt(column);
                break; 
                case "tinyInteger":
                field_cmd += ":tinyinteger";
                field_cmd += set_default_txt(column);
                break;                 
                case "smallInteger":
                field_cmd += ":smallinteger";
                field_cmd += set_default_txt(column);
                break;                 
                case "mediumInteger":
                field_cmd += ":mediuminteger";
                field_cmd += set_default_txt(column);
                break;                 
                case "integer":
                field_cmd += ":integer";
                field_cmd += set_default_txt(column);
                break;                 
                case "bigInteger":
                field_cmd += ":biginteger";
                field_cmd += set_default_txt(column);
                break; 
                case "float":
                field_cmd += ":float";
                field_cmd += set_default_txt(column);
                break;                 
                case "decimal":
                field_cmd += ":decimal";
                field_cmd += set_default_txt(column);
                break;                 
                case "boolean":                
                //default value
                field_cmd += set_default_txt(column);
                break;
                case "enum":                
                //enum value
                field_cmd +=(column.enumvalue);                                
                break;                           
                case "timestamps":
                field_cmd += ":timestamps";                                
                break; 
                case "increments":
                field_cmd += ":increments";                                
                break; 
                case "bigIncrements":
                field_cmd += ":bigIncrements";                                
                break;    
                case "softDeletes":
                field_cmd += ":softDeletes";                                
                break;                                                            
            }


            for (var options in field_options)
            {
                if (column[options]) field_cmd +=  ":" +(  field_options[options]  );
            }

            if (field_cmd) {
                table_cmd += "" + (field_cmd) + ",";
            }

        }

        return ('php artisan generate:migration ' + 'create_' + TableParam.name.toLowerCase() + '_table' + ' --fields="' + table_cmd + '"');
    };


    NodeEntities.GenerateCode = function() {

        var all_table_command  = "";

        var json_data = NodeEntities.ExportToJSON();

        _.each(json_data, function(table) {


            all_table_command += CreateTableCommand(table) + "\n\n";
            // _.each(table.relation, function(rel){
            //     console.log("  create relation function " + rel.name + "() related model: " + rel.relatedmodel + " type: "  + rel.relationtype);
            // });

        });

        return all_table_command;
    };

    NodeEntities.ClearNodeCanvas = function(nodeCanvasParam) {

        var node;
        while (node = nodeCanvasParam.first()) {
            //console.log("destroy " + node.get("name"));
            var column;
            while (column = node.get("column").first()) {
                column.destroy();
                //console.log("destroy col: " + column.get("name"));
            }

            var relation;
            while (relation = node.get("relation").first()) {
                relation.destroy();
                //console.log("destroy rel: " + relation.get("name"));
            }

            var seeding;
            while (seeding = node.get("seeding").first()) {
                var seedtable;
                while (seedtable = seeding.get("column").first()) {
                    //console.log(seedtable);
                    seedtable.destroy();
                }
                seeding.destroy();
                //console.log("destroy seed: " + seeding.cid);
            }

            node.destroy();
        }

    };

    // Initializers
    // -------------------------



});