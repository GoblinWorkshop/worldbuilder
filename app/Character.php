<?php

namespace App;

use App\Traits\ArticleTrait;
use App\Traits\ThumbnailTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Character extends Model
{
    use SoftDeletes;
    use ArticleTrait;
    use ThumbnailTrait;

    protected $fillable = [
        'race_id',
        'name',
        'type',
        'location_id',
        'class',
        'alignment',
        'size',
        'armor_class',
        'hit_points',
        'speed',
        'speed_burrow',
        'speed_climb',
        'speed_fly',
        'speed_swim',
        'ability_str',
        'ability_dex',
        'ability_con',
        'ability_int',
        'ability_wis',
        'ability_cha',
        'saving_throws',
        'skills',
        'damage_vulnerabilities',
        'damage_resistances',
        'damage_immunities',
        'condition_resistances',
        'condition_immunities',
        'senses',
        'languages',
        'xp',
        'special_traits',
        'actions',
        'reactions',
        'legendary_actions'
    ];

    public function getAlignmentsAttribute()
    {
        return [
            'A' => __('Any alignment'),
            'LG' => __('Lawful good'),
            'NG' => __('Neutral good'),
            'CG' => __('Chaotic good'),
            'LN' => __('Lawful neutral'),
            'N' => __('Neutral'),
            'CN' => __('Chaotic neutral'),
            'LE' => __('Lawful evil'),
            'NE' => __('Neutral evil'),
            'CE' => __('Chaotic evil')
        ];
    }

    public function getChallengesAttribute()
    {
        return [
            10 => __('0 (10 XP)'),
            25 => __('1/8 (25 XP)'),
            50 => __('1/4 (50 XP)'),
            100 => __('1/2 (100 XP)'),
            200 => __('1 (200 XP)'),
            450 => __('2 (450 XP)'),
            700 => __('3 (700 XP)'),
            1100 => __('4 (1,100 XP)'),
            1800 => __('5 (1,800 XP)'),
            2300 => __('6 (2,300 XP)'),
            2900 => __('7 (2,900 XP)'),
            3900 => __('8 (3,900 XP)'),
            5000 => __('9 (5,000 XP)'),
            5900 => __('10 (5,900 XP)'),
            7200 => __('11 (7,200 XP)'),
            8400 => __('12 (8,400 XP)'),
            10000 => __('13 (10,000 XP)'),
            11500 => __('14 (11,500 XP)'),
            13000 => __('15 (13,000 XP)'),
            15000 => __('16 (15,000 XP)'),
            18000 => __('17 (18,000 XP)'),
            20000 => __('18 (20,000 XP)'),
            22000 => __('19 (22,000 XP)'),
            25000 => __('20 (25,000 XP)'),
            33000 => __('21 (33,000 XP)'),
            41000 => __('22 (41,000 XP)'),
            50000 => __('23 (50,000 XP)'),
            62000 => __('24 (62,000 XP)'),
            75000 => __('25 (75,000 XP)'),
            90000 => __('26 (90,000 XP)'),
            105000 => __('27 (105,000 XP)'),
            120000 => __('28 (120,000 XP)'),
            135000 => __('29 (135,000 XP)'),
            155000 => __('30 (155,000 XP)')
        ];
    }

    public function getSizesAttribute()
    {
        return [
            'tiny' => __('Tiny'),
            'small' => __('Small'),
            'medium' => __('Medium'),
            'large' => __('Large'),
            'huge' => __('Huge'),
            'gargantuan' => __('Gargantuan')
        ];
    }

    public function getTypesAttribute()
    {
        return [
            'aberration' => __('Aberration'),
            'beast' => __('Beast'),
            'celestial' => __('Celestial'),
            'construct' => __('Construct'),
            'dragon' => __('Dragon'),
            'element' => __('Element'),
            'fey' => __('Fey'),
            'fiend' => __('Fiend'),
            'giant' => __('Giant'),
            'humanoid' => __('Humanoid'),
            'monstrosity' => __('Monstrosity'),
            'ooze' => __('Ooze'),
            'plant' => __('Plant'),
            'undead' => __('Undead')
        ];
    }

    public function getSubheadingLabelAttribute()
    {
        $heading = '';
        if (isset($this->getSizesAttribute()[$this->size])) {
            $heading .= $this->getSizesAttribute()[$this->size];
        }
        if (isset($this->getTypesAttribute()[$this->type])) {
            $heading .= ' ' . $this->getTypesAttribute()[$this->type];
        }
        $heading = trim($heading);
        if (isset($this->getAlignmentsAttribute()[$this->alignment])) {
            if (!empty($heading)) {
                $heading .= ', ';
            }
            $heading .= $this->getAlignmentsAttribute()[$this->alignment];
        }
        return $heading;
    }

    public function getSpeedLabelsAttribute()
    {
        $speed = '';
        if (!empty($this->speed)) {
            $speed .= $this->speed . 'ft.';
        }
        if (!empty($this->speed_burrow)) {
            if (!empty($speed)) {
                $speed .= ', ';
            }
            $speed .= __('burrow') . ' ' . $this->speed_burrow . 'ft.';
        }
        if (!empty($this->speed_climb)) {
            if (!empty($speed)) {
                $speed .= ', ';
            }
            $speed .= __('climb') . ' ' . $this->speed_climb . 'ft.';
        }
        if (!empty($this->speed_fly)) {
            if (!empty($speed)) {
                $speed .= ', ';
            }
            $speed .= __('fly') . ' ' . $this->speed_fly . 'ft.';
        }
        if (!empty($this->speed_swim)) {
            if (!empty($speed)) {
                $speed .= ', ';
            }
            $speed .= __('swim') . ' ' . $this->speed_swim . 'ft.';
        }
        return $speed;
    }

    private function abilityLabel($abilityScore)
    {
        if (empty($abilityScore)) {
            return '';
        }
        return $abilityScore . ' (' . $this->calcAbilityModifier($abilityScore) . ')';
    }

    public function getAbilityStrLabelAttribute()
    {
        return $this->abilityLabel($this->ability_str);
    }

    public function getAbilityDexLabelAttribute()
    {
        return $this->abilityLabel($this->ability_dex);
    }

    public function getAbilityConLabelAttribute()
    {
        return $this->abilityLabel($this->ability_con);
    }

    public function getAbilityIntLabelAttribute()
    {
        return $this->abilityLabel($this->ability_int);
    }

    public function getAbilityWisLabelAttribute()
    {
        return $this->abilityLabel($this->ability_wis);
    }

    public function getAbilityChaLabelAttribute()
    {
        return $this->abilityLabel($this->ability_cha);
    }

    /**
     * Calculate 5e ability modifier
     * @param $score
     * @return float
     */
    public function calcAbilityModifier($score)
    {
        $modifier = floor(($score - 10) / 2);
        if ($modifier < 0) {
            return $modifier;
        }
        return '+' . $modifier;
    }

    public function getChallengeLabelAttribute() {
        if (isset($this->getChallengesAttribute()[$this->xp])) {
            return $this->getChallengesAttribute()[$this->xp];
        }
        return '';
    }

    public function getUrlAttribute($value)
    {
        return Storage::url($this->attributes['filename']);
    }

    public function getImageAttribute($value)
    {
        if (empty($this->attributes['filename'])) {
            return '';
        }
        return '<img src="' . asset($this->getUrlAttribute('url')) . '" class="img img-fluid" />';
    }

    public function organisations()
    {
        return $this->belongsToMany('App\Organisation');
    }

    public function relations()
    {
        return $this->hasMany('App\Relation', 'character_1_id');
    }

    public function characters()
    {
        return $this->belongsToMany('App\Character', 'relation', 'character_1_id', 'character_2_id');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function race()
    {
        return $this->belongsTo('App\Race');
    }

    public function locations()
    {
        return $this->belongsToMany('App\Location');
    }
}