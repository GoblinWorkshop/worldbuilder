import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CkeditorUpload from './CkeditorUpload';

function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        // Configure the URL to the upload script in your back-end here!
        return new CkeditorUpload(loader);
    };
}

/**
 * Get the characters through Promise callback and add some attributes to the list
 * @param type either character or character_block
 * @param query
 */
function getCharacters(type, query) {
    type = type || 'character';
    let symbol = '@';
    if (type === 'character_block') {
        symbol = '+';
    }
    return $.ajax({
        url: '/api/characters?q=' + query,
        type: 'get',
        dataType: 'json',
    }).done(function (data, textStatus, jqXhr) {
        var newData = [];
        for (var i = 0; i < data.length; i++) {
            data[i].entityType = type;
            data[i].entityLink = '/characters/' + data[i].id;
            data[i].entityId = data[i].id;
            data[i].id = symbol + data[i].name; // https://ckeditor.com/docs/ckeditor5/latest/framework/guides/support/error-codes.html#error-mentioncommand-incorrect-id
            newData.push(data[i]);
        }
        return newData;
    })
        .then(function (data) {
            return data;
        });
}

/**
 * Get the locations through Promise callback and add some attributes to the list
 * @param query
 */
function getLocations(query) {
    return $.ajax({
        url: '/api/locations?q=' + query,
        type: 'get',
        dataType: 'json',
    }).done(function (data, textStatus, jqXhr) {
        var newData = [];
        for (var i = 0; i < data.length; i++) {
            data[i].entityType = 'location';
            data[i].entityLink = '/locations/' + data[i].id;
            data[i].entityId = data[i].id;
            data[i].id = '#' + data[i].name; // https://ckeditor.com/docs/ckeditor5/latest/framework/guides/support/error-codes.html#error-mentioncommand-incorrect-id
            newData.push(data[i]);
        }
        return newData;
    })
        .then(function (data) {
            return data;
        });
}

/**
 * Customize the mention output to
 * <a class="mention" data-mention="@Character" data-entity-id="1" href="/characters/1">@Character</a>
 * @param editor
 * @constructor
 * @link https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#customizing-the-output
 */
function MentionCustomization(editor) {
    // The upcast converter will convert view <a class="mention" href="" data-user-id="">
    // elements to the model 'mention' text attribute.
    editor.conversion.for('upcast').elementToAttribute({
        view: {
            name: 'a',
            key: 'data-mention',
            classes: 'mention',
            attributes: {
                href: true,
                'data-entity-id': true,
                'data-entity-type': true,
            }
        },
        model: {
            key: 'mention',
            value: viewItem => {
                // The mention feature expects that the mention attribute value
                // in the model is a plain object with a set of additional attributes.
                // In order to create a proper object use the toMentionAttribute() helper method:
                const mentionAttribute = editor.plugins.get('Mention').toMentionAttribute(viewItem, {
                    // Add any other properties that you need.
                    entityLink: viewItem.getAttribute('href'),
                    entityId: viewItem.getAttribute('data-entity-id'),
                    entityType: viewItem.getAttribute('data-entity-type')
                });

                return mentionAttribute;
            }
        },
        converterPriority: 'high'
    });

    // Downcast the model 'mention' text attribute to a view <a> element.
    editor.conversion.for('downcast').attributeToElement({
        model: 'mention',
        view: (modelAttributeValue, viewWriter) => {
            // Do not convert empty attributes (lack of value means no mention).
            if (!modelAttributeValue) {
                return;
            }
            return viewWriter.createAttributeElement('a', {
                class: 'mention',
                'data-mention': modelAttributeValue.id,
                'data-entity-id': modelAttributeValue.entityId,
                'data-entity-type': modelAttributeValue.entityType,
                'href': modelAttributeValue.entityLink
            });
        },
        converterPriority: 'high'
    });
}

var allRichEditors = document.querySelectorAll('textarea[editor=\'rich\']');
for (var i = 0; i < allRichEditors.length; ++i) {
    ClassicEditor.create(allRichEditors[i], {
        extraPlugins: [MyCustomUploadAdapterPlugin, MentionCustomization],
        mention: {
            feeds: [
                {
                    marker: '+',
                    feed: getCharacters.bind(this, 'character_block'),
                    minimumCharacters: 1,
                },
                {
                    marker: '@',
                    feed: getCharacters.bind(this, 'character'),
                    minimumCharacters: 1,
                },
                {
                    marker: '#',
                    feed: getLocations,
                    minimumCharacters: 1,
                }
            ]
        }
    });
}
var allSimpleEditors = document.querySelectorAll('textarea[editor=\'simple\']');
for (var i = 0; i < allSimpleEditors.length; ++i) {
    ClassicEditor.create(allSimpleEditors[i], {
        toolbar: ['bold', 'italic']
    });
}
