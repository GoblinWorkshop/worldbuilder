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


function getSpells(query) {
    let spells = ["Acid Splash","Alarm","Animal Friendship","Bane","Blade Ward","Bless","Burning Hands","Charm Person","Chill Touch","Chromatic Orb","Color Spray","Command","Compelled Duel","Comprehend Languages","Create or Destroy Water","Cure Wounds","Dancing Lights","Detect Evil and Good","Detect Magic","Detect Poison or Disease","Disguise Self","Divine Favor","Dissonant Whispers","Druidcraft","Eldritch Blast","Ensnaring Strike","Entangle","Faerie Fire","Expeditious Retreat","False Life","Feather Fall","Find Familiar","Fire Bolt","Fog Cloud","Friends","Goodberry","Grease","Guidance","Guiding Bolt","Hail of Thorns","Healing Word","Hellish Rebuke","Hex","Heroism","Hunter's Mark","Identify","Illusory Script","Inflict Wounds","Jump","Light","Longstrider","Mage Armor","Mage Hand","Magic Missile","Mending","Message","Minor Illusion","Poison Spray","Prestidigitation","Produce Flame","Protection from Evil and Good","Purify Food and Drink","Ray of Frost","Ray of Sickness","Remove Curse","Resistance","Sacred Flame","Sanctuary","Shield of Faith","Searing Smite","Shield","Shillelagh","Shocking Grasp","Silent Image","Sleep","Spare the Dying","Speak with Animals","Thaumaturgy","Thorn Whip","Thunderous Smite","Thunderwave","True Strike","Unseen Servant","Vicious Mockery","Witch Bolt","Wrathful Smite","Aid","Animal Messenger","Blindness\/Deafness","Augury","Calm Emotions","Hold Person","Lesser Restoration","Prayer of Healing","Silence","Spiritual Weapon","Warding Bond","Animate Dead","Arcane Eye","Aura of Life","Aura of Purity","Aura Of Vitality","Banishment","Beacon of Hope","Blight","Bestow Curse","Blinding Smite","Blink","Call Lightning","Clairvoyance","Cloud of Daggers","Compulsion","Conjure Animals","Conjure Barrage","Counterspell","Create Food and Water","Crusader's Mantle","Daylight","Dispel Magic","Elemental Weapon","Fear","Feign Death","Fireball","Fly","Gaseous Form","Haste","Hypnotic Pattern","Lightning Arrow","Magic Circle","Major Image","Mass Healing Word","Alter Self","Arcane Lock","Barkskin","Nondetection","Meld Into Stone","Phantom Steed","Plant Growth","Protection from Energy","Revivify","Sending","Sleet Storm","Slow","Speak with Dead","Speak with Plants","Spirit Guardians","Stinking Cloud","Confusion","Conjure Minor Elementals","Control Water","Conjure Woodland Beings","Death Ward","Tongues","Beast Sense","Blur","Branding Smite","Cordon Of Arrows","Crown of Madness","Darkness","Darkvision","Detect Thoughts","Animal Shapes","Antimagic Field","Antipathy\/Sympathy","Astral Projection","Clone","Control Weather","Demiplane","Dominate Monster","Earthquake","Feeblemind","Foresight","Gate","Glibness","Holy Aura","Imprisonment","Incendiary Cloud","Mass Heal","Maze","Meteor Swarm","Mind Blank","Power Word Heal","Power Word Kill","Power Word Stun","Prismatic Wall","Shapechange","Storm of Vengeance","Telepathy","Sunburst","Time Stop","True Polymorph","Tsunami","True Resurrection","Weird","Wish","Conjure Celestial","Delayed Blast Fireball","Dimension Door","Divine Word","Etherealness","Finger of Death","Fire Storm","Forcecage","Mirage Arcane","Prismatic Spray","Project Image","Plane Shift","Regenerate","Resurrection","Reverse Gravity","Sequester","Simulacrum","Symbol","Teleport","Suggestion","Invisibility","Animate Objects","Antilife Shell","Arcane Gate","Awaken","Banishing Smite","Chain Lightning","Blade Barrier","Circle of Death","Circle of Power","Cloudkill","Commune with Nature","Commune","Cone of Cold","Conjure Elemental","Conjure Fey","Conjure Volley","Contact Other Plane","Contagion","Contingency","Create Undead","Continual Flame","Creation","Destructive Wave","Disintegrate","Divination","Dispel Evil and Good","Dominate Beast","Dominate Person","Dream","Enhance Ability","Enlarge\/Reduce","Enthrall","Fabricate","Eyebite","Find Steed","Find the Path","Find Traps","Fire Shield","Flame Blade","Flame Strike","Flaming Sphere","Flesh to Stone","Forbiddance","Freedom of Movement","Geas","Gentle Repose","Giant Insect","Globe of Invulnerability","Glyph of Warding","Grasping Vine","Greater Invisibility","Greater Restoration","Guardian of Faith","Guards and Wards","Gust of Wind","Hallucinatory Terrain","Hallow","Harm","Heat Metal","Heal","Heroes' Feast","Hold Monster","Ice Storm","Insect Plague","Knock","Legend Lore","Levitate","Locate Animals or Plants","Lightning Bolt","Locate Creature","Locate Object","Magic Jar","Magic Weapon","Magic Mouth","Mass Cure Wounds","Mass Suggestion","Mirror Image","Mislead","Misty Step","Modify Memory","Moonbeam","Move Earth","Pass Without Trace","Passwall","Phantasmal Killer","Phantasmal Force","Planar Ally","Planar Binding","Polymorph","Programmed Illusion","Raise Dead","Protection from Poison","Ray of Enfeeblement","Reincarnate","Rope Trick","Scorching Ray","Scrying","Seeming","See Invisibility","Shatter","Spider Climb","Spike Growth","Staggering Smite","Stone Shape","Sunbeam","Stoneskin","Swift Quiver","Telekinesis","Teleportation Circle","Transport via Plants","Tree Stride","True Seeing","Vampiric Touch","Wall of Fire","Wall of Ice","Wall of Force","Wall of Stone","Wall of Thorns","Water Breathing","Water Walk","Web","Wind Walk","Wind Wall","Word of Recall","Zone of Truth","Earth Tremor","Pyrotechnics","Skywrite","Thunderclap","Warding Wind","Control Flames","Create Bonfire","Frostbite","Gust","Magic Stone","Mold Earth","Shape Water","Absorb Elements","Beast Bond","Ice Knife","Earthbind","Dust Devil","Catapult","Control Winds","Bones of the Earth","Erupting Earth","Elemental Bane","Flame Arrows","Investiture of Flame","Investiture of Ice","Investiture of Stone","Investiture of Wind","Maelstrom","Primordial Ward","Tidal Wave","Transmute Rock","Wall of Water","Watery Sphere","Whirlwind","Immolation","Storm Sphere","Vitriolic Sphere","Wall of Sand"];
    let filteredItems = spells
    // Filter out the full list of all items to only those matching the query text.
        .filter( function(spell) {
            return spell.toLowerCase().includes(query.toLowerCase())
        } )
        .slice(0, 10);

    let items = [];
    for (let i = 0; i < filteredItems.length; i++) {
        items.push({
            entityType: 'spell_block',
            entityLink: '/spells/' + filteredItems[i],
            entityId: filteredItems[i],
            id: '!' + filteredItems[i],
            name: filteredItems[i]
        });
    }
    return items;
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
                },
                {
                    marker: '!',
                    feed: getSpells,
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
