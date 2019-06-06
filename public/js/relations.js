/**
 Simple relation chart for characters
 **/
var Relation = {
    _characterPositions: {},
    canvas: document.createElement('canvas'),
    _centerX: 512,
    _centerY: 512,
    settings: {
        element: document.body,
        width: 1024,
        height: 1024,
        /**
         * List with names
         */
        characters: [],
        relations: []
    },

    init: function (settings) {
        settings = settings || {};
        this.settings = Object.assign(this.settings, settings);
        this.canvas.width = this.settings.width + 150;
        this.canvas.height = this.settings.height + 150;
        this.render();
    },

    render: function () {
        this.settings.element.appendChild(this.canvas);
        var ctx = this.canvas.getContext('2d');
        ctx.font = "18px 'Open Sans', Arial";
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
                x: x,
                y: y
            };
            ctx.fillText(character.name, x, y);
        }
        for (var i = 0; i < this.settings.relations.length; i++) {
            var relation = this.settings.relations[i];

            var color = '#ff9900';
            switch (relation.type) {
                case 'brother':
                    color = '#00ffff';
                    break;
                default:
            }
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

    },

    _randomNumber: function (min, max) {
        return Math.floor(Math.random()*(max-min+1)+min);
    }
};