'use strict';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var BookmarkModel = Backbone.Model.extend({
	urlRoot: '/api/bookmarks/',
	idAttribute: 'id',
});

var TagModel = Backbone.Model.extend({
	urlRoot: '/api/tags/',
	idAttribute: 'id'
});

var BookmarksCollection = Backbone.Collection.extend({
	url: '/api/bookmarks/',
	model: BookmarkModel
});

var TagsCollection = Backbone.Collection.extend({
	url: '/api/tags/',
	model: TagModel
});

var BookmarkItemView = Backbone.View.extend({
	el:'<li class="hello"></li>',

	template: _.template('<h2><%= bookmark.get("title") %></h2>'),

	events: {
		'click h2': function(e) {
			this.model.destroy();
		}
	},

	initialize: function() {
		// this.listenTo(this.model, 'all', function() {
		// 	console.log(arguments);
		// });
		this.listenTo(this.model, 'sync', this.render);
	},

	render: function() {
		this.$el.html(this.template({ bookmark: this.model }));
	}
});

var BookmarksListView = Backbone.View.extend({
	el: '<ul></ul>',

	template: undefined,

	initialize: function() {
		this.listenTo(this.collection, 'all', function(event) {
			console.log(event);
		});
		this.listenTo(this.collection, 'sync update', this.render);
	},

	render: function() {
		var that = this;
		this.$el.html('');
		this.collection.each(function(bookmarkModel) {
			var bookmarkItemView = new BookmarkItemView({ model: bookmarkModel });
			bookmarkItemView.render();
			that.$el.append(bookmarkItemView.el);
		});
		return this;
	}
});

var bookmarks = new BookmarksCollection();

bookmarks.fetch();

var bookmarksListView = new BookmarksListView({collection: bookmarks});
bookmarksListView.render();

$('#content').html(bookmarksListView.el);
console.log('view inserted!');