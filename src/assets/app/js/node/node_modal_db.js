DesignerApp.module("NodeModule.Modal", function(Modal, DesignerApp, Backbone, Marionette, $, _) {



    Modal.DbLoad = Modal.BaseModal.extend({
        template: _.template($("#dbload-template").html()),
        initialize: function(param)
        {
            this.content = param.content;
            this.listenTo(this, "listDbFiles", this.listDbFiles);            
        },
        events: {
            "click .ok": "okClicked",
            "click .list-group-item" : "listClicked"
        },
        listClicked: function(e)
        {
            var dbid = (this.$(e.currentTarget).attr("tag"));
            this.trigger("okClicked", dbid);
        },
        listDbFiles: function(data)
        {
			console.log(data);
            var db_file_list = _.template($("#dbfile-template").html());
            this.$("#dbfiles").html(db_file_list({dblist: data[0]}));
        },
        okClicked: function()
        {
            var file = this.$("#filename").val();
            this.trigger("okClicked", file);
        },
        render: function() {
            //console.log(view.render().el);
            this.$el.html(this.template({
                content: this.content
            }));
            return this.el;
        }
    });


    Modal.DbLoadId = Modal.BaseModal.extend({
        template: _.template($("#dbloadid-template").html()),
        initialize: function(param)
        {
            this.content = param.content;
            this.listenTo(this, "listDbFiles", this.listDbFiles);            
        },
        events: {
            "click .ok": "okClicked",
        },
        okClicked: function()
        {
            var file = this.$("#filename").val();
            this.trigger("okClicked", file);
        },
        render: function() {
            this.$el.html(this.template());
            return this.el;
        }
    });



    Modal.DbSaveAs = Modal.BaseModal.extend({
        template: _.template($("#dbsave-template").html()),
        initialize: function(param)
        {
            this.content = param.content;
        },
        events: {
            "click .ok": "okClicked",
        },
        okClicked: function()
        {
            var file = this.$("#filename").val();
            var desc = this.$("#description").val();
            this.trigger("okClicked", {filename: file, description: desc});
        },

        render: function() {
            //console.log(view.render().el);
            this.$el.html(this.template({
                content: this.content
            }));
            return this.el;
        }
    });    

});