DesignerApp.module("NodeCanvas.Controller", function(Controller, DesignerApp, Backbone, Marionette, $, _) {

    var viewNodeCanvas = Controller.viewNodeCanvas;
	
    var loadGist = function(gistId) {
        var github = hello("github");
        github.api('/gists/' + gistId, 'get', {random : Math.random()}).then(function(resp) {

            var first_key = resp.files[Object.keys(resp.files)[0]]; //returns 'someVal'

            if (first_key.filename) {
                gistloadedid = gistId;
                gistfilename = first_key.filename;
                var jsonfile = (JSON.parse(first_key.content));
                DesignerApp.NodeEntities.ClearNodeCanvas(DesignerApp.NodeEntities.getNodeCanvas());
                DesignerApp.NodeEntities.AddNodeCanvas(jsonfile);
            }
        });
    };

    var loadDb = function(dbId) {
        $.ajax({
            url: "/databases/ajax", 
			data: { dbfilename: dbId }
            success: function(result){
				if(result) {
					//jsonResult = JSON.parse(result);
					jsonResult = $.parseJSON(result);
					dbfilename = dbId;
					data = jsonResult.files['aaa.skema'].content;
					//console.log(data);
					DesignerApp.NodeEntities.ClearNodeCanvas(DesignerApp.NodeEntities.getNodeCanvas());
					DesignerApp.NodeEntities.AddNodeCanvas(data);
				} else {
					alert("This file not exist");
				}
			},
			/*
            complete: function() {
                alert('complete');
            }
			*/
        })
    };

	/* Gist */
    var saveGist = function(fileName, description) {
        var json_post = {
            "description": description,
            "public": true,
            "files": {}
        };

        json_post.files[fileName] = {content: JSON.stringify(DesignerApp.NodeEntities.ExportToJSON())};

        var github = hello("github");
        github.api('/gists', 'post', json_post).then(function(resp) {
            console.log(resp);
        });

    };

    var updateGist = function(gistID) {
        var json_post = {
                          "description": "the description for this gist",
                          "files": {
                        }
                    };


        json_post.files[gistfilename] = {content: JSON.stringify(DesignerApp.NodeEntities.ExportToJSON())};

        var github = hello("github");
        github.api('/gists/' + gistID, 'patch', json_post).then(function(resp) {
            console.log(resp);
        });
    };
	/* End Gist */

	/* Save DB */
    var saveDb = function(fileName, description) {
        var json_post = {
            "description": description,
            "public": true,
            "files": {}
        };

        json_post.files[fileName] = {content: JSON.stringify(DesignerApp.NodeEntities.ExportToJSON())};

		$.ajax({
            url: "/databases/save", 
			data: { json_post: json_post }
            success: function(result){
				if(result) {
					//jsonResult = JSON.parse(result);
					//jsonResult = $.parseJSON(result);
					alert("Save successful!");
				} else {
					alert("Can't save this file!");
				}
			},
        });
    };

    var updateDb = function(gistID) {
        var json_post = {
                          "description": "the description for this gist",
                          "files": {
                        }
                    };

        json_post.files[gistfilename] = {content: JSON.stringify(DesignerApp.NodeEntities.ExportToJSON())};

		$.ajax({
            url: "/databases/save", 
			data: { dbid: dbid,  json_post: json_post }
            success: function(result){
				if(result) {
					//jsonResult = JSON.parse(result);
					//jsonResult = $.parseJSON(result);
					alert("Update successful!");
				} else {
					alert("Can't update "+dbid+" file");
				}
			},
        });
    };
	/* End DB */

    viewNodeCanvas.on("canvas:createcontainer", function() {

        var container = DesignerApp.NodeEntities.getNewNodeContainer();
        //console.log(container);
        var view = new DesignerApp.NodeModule.Modal.CreateNodeContainer({
            model: container
        });

        var modal = DesignerApp.NodeModule.Modal.CreateTestModal(view);

        view.on("okClicked", function(data) {
            if (container.set(data, {
                validate: true
            })) {
                data.position = {
                    x: 100,
                    y: 100
                };
                DesignerApp.NodeEntities.AddNewNode(data);
            } else {
                view.trigger("formDataInvalid", container.validationError);
                modal.preventClose();
            }
        });

    });


    viewNodeCanvas.on("canvas:open", function() {
        if (typeof process != 'undefined') {
            $("#fileOpenDialog").trigger("click");
        } else {

        }
    });

    viewNodeCanvas.on("canvas:opensavedbs", function() {
        var view = new DesignerApp.NodeModule.Modal.DbLoad({});
		view.listenTo(view, "okClicked", function(fileName) {
			loadDb(fileName);
		});
		var dbids = [];
		$.ajax({
            url: "/databases/getdbs", 
            success: function(result){
				dbs = $.parseJSON(result);
				
                for (var k in dbs) {
                    var db = dbs[k]; //returns 'someVal'
					dbids.push(db);
                }
                view.trigger("listDbFiles", dbids);
            }
		});
        var modal = DesignerApp.NodeModule.Modal.CreateTestModal(view);
    });
	
    viewNodeCanvas.on("canvas:opengist", function() {
        if (!authenticated) {
            hello.login("github", {
                scope: "gist"
            });
        } else {
            var view = new DesignerApp.NodeModule.Modal.GistLoad({});
            view.listenTo(view, "okClicked", function(fileName) {
                loadGist(fileName);
            });

            var gists = [];

            hello("github").api('/gists', 'get', function(gist_list) {
                for (var gist in gist_list.data) {
                    

                    var gist_files = gist_list.data[gist].files[Object.keys(gist_list.data[gist].files)[0]]; //returns 'someVal'
                    //console.log(gist_files.filename);

                    if (gist_files.filename.split('.').pop() === "skema"){
                        var tmp = {};
                        tmp.id = (gist_list.data[gist].id);
                        tmp.description = (gist_list.data[gist].description);
                        tmp.date = (gist_list.data[gist].created_at);
                        tmp.filename = gist_files.filename;
                        gists.push(tmp);
                    }

                }
                view.trigger("listGistFiles", gists);
            });


            var modal = DesignerApp.NodeModule.Modal.CreateTestModal(view);
        }

    });

    viewNodeCanvas.on("canvas:opengistid", function() {
        var view = new DesignerApp.NodeModule.Modal.GistLoadId({});
        var modal = DesignerApp.NodeModule.Modal.CreateTestModal(view);
        view.listenTo(view, "okClicked", function(fileName) {
            loadGist(fileName);
            modal.preventClose();
        });
    });

    viewNodeCanvas.on("canvas:opendbid", function() {
        var view = new DesignerApp.NodeModule.Modal.DbLoadId({});
        var modal = DesignerApp.NodeModule.Modal.CreateTestModal(view);
        view.listenTo(view, "okClicked", function(fileName) {
            loadDb(fileName);
            modal.preventClose();
        });
    });
	
    viewNodeCanvas.on("canvas:savecurrentgis", function() {
        updateGist(gistloadedid);
    });

    viewNodeCanvas.on("canvas:saveasgist", function() {
        var view = new DesignerApp.NodeModule.Modal.GistSaveAs({});
        var modal = DesignerApp.NodeModule.Modal.CreateTestModal(view);

        view.listenTo(view, "okClicked", function(data) {
            saveGist(data.filename + ".skema", data.description);
            modal.preventClose();
        });

    });

    viewNodeCanvas.on("canvas:save", function() {
        updateDb(dbloadedid);
		/*
        if (typeof process != 'undefined') {
            $("#fileSaveDialog").trigger("click");
        } else {

        }
		*/
    });

    viewNodeCanvas.on("canvas:saveas", function() {
        var view = new DesignerApp.NodeModule.Modal.DbSaveAs({});
        var modal = DesignerApp.NodeModule.Modal.CreateTestModal(view);

        view.listenTo(view, "okClicked", function(data) {
            saveGist(data.filename + ".skema", data.description);
            modal.preventClose();
        });
    });

    viewNodeCanvas.on("canvas:loadexample", function() {
        DesignerApp.NodeEntities.ClearNodeCanvas(DesignerApp.NodeEntities.CurrentNodeCanvas);
		console.log(node_data);
        DesignerApp.NodeEntities.AddNodeCanvas(node_data);
    });

    viewNodeCanvas.on("canvas:clearcanvas", function() {
        DesignerApp.NodeEntities.ClearNodeCanvas(DesignerApp.NodeEntities.CurrentNodeCanvas);
    });

    viewNodeCanvas.on("canvas:testcanvas", function() {
        DesignerApp.NodeEntities.ClearNodeCanvas(DesignerApp.NodeEntities.CurrentNodeCanvas);
        $.ajax({
            url: "/databases/ajax", 
            success: function(result){
				//jsonResult = JSON.parse(result);
				jsonResult = $.parseJSON(result);
                data = jsonResult.files['aaa.skema'].content;
				//console.log(data);
				DesignerApp.NodeEntities.AddNodeCanvas(data);
            },
			/*
            complete: function() {
                alert('complete');
            }
			*/
        })
		/*.done( function() {
                alert('done');
            });
		*/
    });
	
    viewNodeCanvas.on("canvas:loadsavedbs", function() {
        DesignerApp.NodeEntities.ClearNodeCanvas(DesignerApp.NodeEntities.CurrentNodeCanvas);
        $.ajax({
            url: "/databases/getdbs", 
            success: function(result){
				//jsonResult = JSON.parse(result);
				jsonResult = $.parseJSON(result);
				DesignerApp.NodeEntities.AddNodeDbCanvas(jsonResult);
            },
        })
    });

    viewNodeCanvas.on("canvas:generate", function() {
        var view = new DesignerApp.NodeModule.Modal.Generate({
            content: DesignerApp.NodeEntities.GenerateCode()
        });
        var modal = DesignerApp.NodeModule.Modal.CreateTestModal(view);
    });

});