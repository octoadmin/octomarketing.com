/// <reference path="../../../js/knockout.d.ts" />
/// <reference path="../../../js/lodash-3.10.d.ts" />
/// <reference path="dashboard-widget-editor.ts" />
/// <reference path="../../../js/common.d.ts" />
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var AmeDashboardWidget = (function () {
    function AmeDashboardWidget(settings, widgetEditor) {
        var _this = this;
        this.isPresent = true;
        this.missingWidgetTooltip = "N/A";
        this.canBeDeleted = false;
        this.canChangePriority = false;
        this.propertyTemplate = '';
        this.widgetType = null;
        this.rawProperties = settings;
        this.widgetEditor = widgetEditor;
        this.id = settings['id'];
        this.isPresent = !!(settings['isPresent']);
        this.canBeDeleted = !this.isPresent;
        var self = this;
        this.safeTitle = ko.computed({
            read: function () {
                return AmeDashboardWidget.stripAllTags(self.title());
            },
            deferEvaluation: true //this.title might not be initialised at this point, so skip it until later.
        });
        this.isOpen = ko.observable(false);
        this.grantAccess = new AmeActorAccessDictionary(settings.hasOwnProperty('grantAccess') ? settings['grantAccess'] : {});
        //Indeterminate checkbox state: when the widget is enabled for some roles and disabled for others.
        var _isIndeterminate = ko.observable(false);
        this.isIndeterminate = ko.computed(function () {
            if (widgetEditor.selectedActor() !== null) {
                return false;
            }
            return _isIndeterminate();
        });
        //Is the widget enabled for the selected actor?
        this.isEnabled = ko.computed({
            read: function () {
                var actor = widgetEditor.selectedActor();
                if (actor !== null) {
                    return _this.actorHasAccess(actor);
                }
                else {
                    //Check if any actors have this widget enabled.
                    //We only care about visible actors. There might be some users that are loaded but not visible.
                    var actors = widgetEditor.actorSelector.getVisibleActors();
                    var areAnyActorsEnabled = false, areAnyActorsDisabled = false;
                    for (var index = 0; index < actors.length; index++) {
                        var hasAccess = _this.actorHasAccess(actors[index].id, actors[index]);
                        if (hasAccess) {
                            areAnyActorsEnabled = true;
                        }
                        else if (hasAccess === false) {
                            areAnyActorsDisabled = true;
                        }
                    }
                    _isIndeterminate(areAnyActorsEnabled && areAnyActorsDisabled);
                    return areAnyActorsEnabled;
                }
            },
            write: function (enabled) {
                var actor = widgetEditor.selectedActor();
                if (actor !== null) {
                    _this.grantAccess.set(actor, enabled);
                }
                else {
                    //Enable/disable all.
                    var actors = widgetEditor.actorSelector.getVisibleActors();
                    for (var index = 0; index < actors.length; index++) {
                        _this.grantAccess.set(actors[index].id, enabled);
                    }
                }
            }
        });
    }
    AmeDashboardWidget.stripAllTags = function (input) {
        //Based on: http://phpjs.org/functions/strip_tags/
        var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi, commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
        return input.replace(commentsAndPhpTags, '').replace(tags, '');
    };
    AmeDashboardWidget.prototype.createObservableWithDefault = function (customValue, defaultValue, writeCallback) {
        //Sentinel value: '' (the empty string). Null is also accepted and automatically converted to ''.
        var sentinel = '';
        customValue = writeCallback(customValue, sentinel);
        if ((customValue === defaultValue) || (customValue === null)) {
            customValue = sentinel;
        }
        var _customValue = ko.observable(customValue);
        var observable = ko.computed({
            read: function () {
                var customValue = _customValue();
                if (customValue === sentinel) {
                    return defaultValue;
                }
                else {
                    return customValue;
                }
            },
            write: function (newValue) {
                var oldValue = _customValue();
                var valueToWrite = writeCallback(newValue, oldValue);
                if ((valueToWrite === defaultValue) || (valueToWrite === null)) {
                    valueToWrite = sentinel;
                }
                if (valueToWrite !== oldValue) {
                    _customValue(valueToWrite);
                }
                else if ((valueToWrite !== newValue) || (valueToWrite === sentinel)) {
                    observable.notifySubscribers();
                }
            }
        });
        observable.resetToDefault = function () {
            _customValue(sentinel);
        };
        observable.getCustomValue = function () {
            return _customValue();
        };
        return observable;
    };
    AmeDashboardWidget.prototype.toggle = function () {
        this.isOpen(!this.isOpen());
    };
    AmeDashboardWidget.prototype.toPropertyMap = function () {
        var properties = {
            'id': this.id,
            'title': this.title(),
            'location': this.location(),
            'priority': this.priority(),
            'grantAccess': this.grantAccess.getAll()
        };
        properties = AmeDashboardWidget._.merge({}, this.rawProperties, properties);
        if (this.widgetType !== null) {
            properties['widgetType'] = this.widgetType;
        }
        return properties;
    };
    AmeDashboardWidget.prototype.actorHasAccess = function (actorId, actor) {
        //Is there a setting for this actor specifically?
        var hasAccess = this.grantAccess.get(actorId, null);
        if (hasAccess !== null) {
            return hasAccess;
        }
        if (!actor) {
            actor = AmeActors.getActor(actorId);
        }
        if (actor instanceof AmeUser) {
            //The Super Admin has access to everything by default, and it takes priority over roles.
            if (actor.isSuperAdmin) {
                return this.grantAccess.get('special:super_admin', true);
            }
            //Allow access if at least one role has access.
            var result = false;
            for (var index = 0; index < actor.roles.length; index++) {
                var roleActor = 'role:' + actor.roles[index], roleHasAccess = this.grantAccess.get(roleActor, true);
                result = result || roleHasAccess;
            }
            return result;
        }
        //By default, all widgets are visible to everyone.
        return true;
    };
    AmeDashboardWidget._ = wsAmeLodash;
    return AmeDashboardWidget;
}());
var AmeActorAccessDictionary = (function () {
    function AmeActorAccessDictionary(initialData) {
        this.items = {};
        this.numberOfObservables = ko.observable(0);
        if (initialData) {
            this.setAll(initialData);
        }
    }
    AmeActorAccessDictionary.prototype.get = function (actor, defaultValue) {
        if (defaultValue === void 0) { defaultValue = null; }
        if (this.items.hasOwnProperty(actor)) {
            return this.items[actor]();
        }
        this.numberOfObservables(); //Establish a dependency.
        return defaultValue;
    };
    AmeActorAccessDictionary.prototype.set = function (actor, value) {
        if (!this.items.hasOwnProperty(actor)) {
            this.items[actor] = ko.observable(value);
            this.numberOfObservables(this.numberOfObservables() + 1);
        }
        else {
            this.items[actor](value);
        }
    };
    AmeActorAccessDictionary.prototype.getAll = function () {
        var result = {};
        for (var actorId in this.items) {
            if (this.items.hasOwnProperty(actorId)) {
                result[actorId] = this.items[actorId]();
            }
        }
        return result;
    };
    AmeActorAccessDictionary.prototype.setAll = function (values) {
        for (var actorId in values) {
            if (values.hasOwnProperty(actorId)) {
                this.set(actorId, values[actorId]);
            }
        }
    };
    return AmeActorAccessDictionary;
}());
var AmeStandardWidgetWrapper = (function (_super) {
    __extends(AmeStandardWidgetWrapper, _super);
    function AmeStandardWidgetWrapper(settings, widgetEditor) {
        _super.call(this, settings, widgetEditor);
        this.wrappedWidget = settings['wrappedWidget'];
        this.title = this.createObservableWithDefault(settings['title'], this.wrappedWidget.title, function (value) {
            //Trim leading and trailing whitespace.
            value = value.replace(/^\s+|\s+$/g, "");
            if (value === '') {
                return null;
            }
            return value;
        });
        this.location = this.createObservableWithDefault(settings['location'], this.wrappedWidget.location, function () {
            return null;
        });
        this.priority = this.createObservableWithDefault(settings['priority'], this.wrappedWidget.priority, function () {
            return null;
        });
        if (!this.isPresent) {
            //Note: This is not intended to be perfectly accurate.
            var wasCreatedByTheme = this.rawProperties.hasOwnProperty('callbackFileName')
                && this.rawProperties['callbackFileName'].match(/[/\\]wp-content[/\\]themes[/\\]/);
            this.missingWidgetTooltip = (wasCreatedByTheme ? 'The theme' : 'The plugin')
                + ' that created this widget is not active.'
                + '\nTo remove the widget, open it and click "Delete".';
        }
    }
    AmeStandardWidgetWrapper.prototype.toPropertyMap = function () {
        var properties = _super.prototype.toPropertyMap.call(this);
        properties['wrappedWidget'] = this.wrappedWidget;
        properties['title'] = this.title.getCustomValue();
        properties['location'] = this.location.getCustomValue();
        properties['priority'] = this.priority.getCustomValue();
        return properties;
    };
    return AmeStandardWidgetWrapper;
}(AmeDashboardWidget));
var AmeCustomHtmlWidget = (function (_super) {
    __extends(AmeCustomHtmlWidget, _super);
    function AmeCustomHtmlWidget(settings, widgetEditor) {
        var _ = AmeDashboardWidget._;
        settings = _.merge({
            id: 'new-untitled-widget',
            isPresent: true,
            grantAccess: {}
        }, settings);
        _super.call(this, settings, widgetEditor);
        this.widgetType = 'custom-html';
        this.canChangePriority = true;
        this.title = ko.observable(_.get(settings, 'title', 'New Widget'));
        this.location = ko.observable(_.get(settings, 'location', 'normal'));
        this.priority = ko.observable(_.get(settings, 'priority', 'high'));
        this.content = ko.observable(_.get(settings, 'content', ''));
        this.filtersEnabled = ko.observable(_.get(settings, 'filtersEnabled', true));
        //Custom widgets are always present and can always be deleted.
        this.isPresent = true;
        this.canBeDeleted = true;
        this.propertyTemplate = 'ame-custom-html-widget-template';
    }
    AmeCustomHtmlWidget.prototype.toPropertyMap = function () {
        var properties = _super.prototype.toPropertyMap.call(this);
        properties['content'] = this.content();
        properties['filtersEnabled'] = this.filtersEnabled();
        return properties;
    };
    return AmeCustomHtmlWidget;
}(AmeDashboardWidget));
var AmeWidgetPropertyComponent = (function () {
    function AmeWidgetPropertyComponent(params) {
        this.widget = params['widget'];
        this.label = params['label'] || '';
    }
    return AmeWidgetPropertyComponent;
}());
//Custom element: <ame-widget-property>
ko.components.register('ame-widget-property', {
    viewModel: AmeWidgetPropertyComponent,
    template: {
        element: 'ame-widget-property-template'
    }
});
//# sourceMappingURL=dashboard-widget.js.map