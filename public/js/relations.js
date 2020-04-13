/**
 Simple relation chart for characters
 **/
var Relation = {
    _characterPositions: {},
    canvas: document.createElement('canvas'),
    _centerX: 1024,
    _centerY: 1024,
    settings: {
        element: document.body,
        width: 2048,
        height: 2048,
        /**
         * List with names
         */
        characters: [],
        relations: []
    },

    init: function (settings) {
        settings = settings || {};
        this.settings = Object.assign(this.settings, settings);
        this.canvas.width = this.settings.width + 100; // 100 for size of thumbs
        this.canvas.height = this.settings.height + 100;
        this.render();
    },

    /**
     * @todo calculate from and to relations (not all from the same starting point)
     * @todo add images instead of names (or both)
     * @todo add multiple colors
     */
    render: function () {
        this.settings.element.appendChild(this.canvas);
        var ctx = this.canvas.getContext('2d');
        ctx.font = "12px 'Open Sans', Arial";
        ctx.fillStyle = "#ff9900";
        ctx.textBaseline = "middle";
        var steps = this.settings.characters.length;
        var radius = (this.settings.width / 2);
        this._centerX = this._centerY = radius;
        for (var i = 0; i < steps; i++) {
            var character = this.settings.characters[i];
            var x = (radius + radius * Math.cos(2 * Math.PI * i / steps)); // Math.floor(Math.random() * (canvas.width - 100)),
            var y = (radius + radius * Math.sin(2 * Math.PI * i / steps)); //Math.floor(Math.random() * (canvas.height - 50)),
            this._characterPositions['character_' + character.id] = {
                x: (x + 50),
                y: (y + 50)
            };
        }

        for (var i = 0; i < this.settings.relations.length; i++) {
            var relation = this.settings.relations[i];
            var color = this._getColor(relation.type);
            ctx.strokeStyle = color;
            ctx.beginPath();
            var locationChar = this._characterPositions['character_' + relation.character_1_id];
            var locationCharTo = this._characterPositions['character_' + relation.character_2_id];
            ctx.moveTo(locationChar.x, locationChar.y);
            // generating randomness to avoid double lines
            var centerRandomX = this._randomNumber((this._centerX + 25), (this._centerX - 25));
            var centerRandomY = this._randomNumber((this._centerY + 25), (this._centerY - 25));
            ctx.bezierCurveTo(centerRandomX, centerRandomY, centerRandomX, centerRandomY, locationCharTo.x, locationCharTo.y);
            ctx.stroke();
        }

        for (var i = 0; i < steps; i++) {
            var character = this.settings.characters[i];
            var x = (radius + radius * Math.cos(2 * Math.PI * i / steps)); // Math.floor(Math.random() * (canvas.width - 100)),
            var y = (radius + radius * Math.sin(2 * Math.PI * i / steps)); //Math.floor(Math.random() * (canvas.height - 50)),
            this._characterPositions['character_' + character.id] = {
                x: (x + 50),
                y: (y + 50)
            };
            ctx.drawImage(document.getElementById('thumbnail-' + character.id), x, y, 100, 100);
            ctx.fillText(character.name, x, (y + 110));
        }
    },

    _randomNumber: function (min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    },

    /**
     * Get the color based on the relation type
     *
     'acquaintance' => 'Acquaintance',
     'lover' => 'Lover',
     'friend' => 'Friend',
     'enemy' => 'Enemy',
     'brother' => 'Brother',
     'sister' => 'Sister',
     'mother' => 'Mother',
     'father' => 'Father',
     'son' => 'Son',
     'daughter' => 'Daughter',
     * @param type
     * @returns {string}
     * @private
     */
    _getColor: function (type) {
        var color = '#ff9900';
        switch (type) {
            case 'acquaintance':
                color = '#999999';
                break;
            case 'friend':
                color = '#376420';
                break;
            case 'lover':
                color = '#99448a';
                break;
            case 'enemy':
                color = '#642020';
                break;
            case 'brother':
            case 'sister':
            case 'mother':
            case 'father':
            case 'son':
            case 'daughter':
                color = '#204d64';
                break;
            default:
        }
        return color;
    }
};