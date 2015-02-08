<?php
namespace common\behaviors;

use Yii;
use yii\base\Behavior;

/**
 * Class TransliterateBehavior
 * Данное поведение позволяет транслировать атрибуты с кирилицы на латынь.
 * Обыно используется для алиасов модели.
 * 
 * Пример использования:
 * ```
 * ...
 * 'transliterate' => [
 *     'class' => 'common\behaviors\TransliterateBehavior',
 *     'attributes' => [
 *         ActiveRecord::EVENT_BEFORE_INSERT => [
 *             'title' => 'alias'
 *         ],
 *         ActiveRecord::EVENT_BEFORE_UPDATE => [
 *             'title' => 'alias'
 *         ]
 *     ]
 * ]
 * ...
 * ```
 * 
 * @property array $attributes Массив атрибутов которые нужно обработать.
 */
class TransliterateBehavior extends Behavior
{
    /**
     * @var array Массив аттрибутов которые должны быть обработаны.
     */
    public $attributes = [];

    /**
     * @var boolean true для того чтобы привести строку в нижний регистр.
     */
    public $toLowCase = true;

    /**
     * Назначаем обработчик для [[owner]] событий.
     * @return array события (array keys) с назначеными им обработчиками (array values).
     */
    public function events()
    {
        $events = $this->attributes;
        foreach ($events as $i => $event) {
            $events[$i] = 'transliterate';
        }
        return $events;
    }

    /**
     * Очищаем атрибуты.
     * Срабатывает только при не пустой строке (add Oleg): 
     * if(empty($this->owner->$attribute)) { ... }
     * @param Event $event Текущее событие.
     */
    public function transliterate($event)
    {
        $attributes = isset($this->attributes[$event->name]) ? (array)$this->attributes[$event->name] : [];
        if (!empty($attributes)) {
            foreach ($attributes as $source => $attribute) {
                if(empty($this->owner->$attribute)) {
                    $this->owner->$attribute = static::cyrillicToLatin($this->owner->$source);
                }
            }
        }
    }


    public static function cyrillicToLatin($text, $maxLength = 120, $toLowCase = true)
    {      
        
        $text = mb_substr(trim($text), 0, $maxLength,  'utf-8');
        $letters = [
                    "А" => "A",
                    "Б" => "B",
                    "В" => "V",
                    "Г" => "G",
                    "Д" => "D",
                    "Е" => "E",
                    "Ё" => "E",
                    "Ж" => "J",
                    "З" => "Z",
                    "И" => "I",
                    "Й" => "Y",
                    "К" => "K",
                    "Л" => "L",
                    "М" => "M",
                    "Н" => "N",
                    "О" => "O",
                    "П" => "P",
                    "Р" => "R",
                    "С" => "S",
                    "Т" => "T",
                    "У" => "U",
                    "Ф" => "F",
                    "Х" => "H",
                    "Ц" => "TS",
                    "Ч" => "CH",
                    "Ш" => "SH",
                    "Щ" => "SCH",
                    "Ъ" => "",
                    "Ы" => "I",
                    "Ь" => "J",
                    "Э" => "E",
                    "Ю" => "YU",
                    "Я" => "YA",
                    "а" => "a",
                    "б" => "b",
                    "в" => "v",
                    "г" => "g",
                    "д" => "d",
                    "е" => "e",
                    "ё" => "e",
                    "ж" => "j",
                    "з" => "z",
                    "и" => "i",
                    "й" => "y",
                    "к" => "k",
                    "л" => "l",
                    "м" => "m",
                    "н" => "n",
                    "о" => "o",
                    "п" => "p",
                    "р" => "r",
                    "с" => "s",
                    "т" => "t",
                    "у" => "u",
                    "ф" => "f",
                    "х" => "h",
                    "ц" => "ts",
                    "ч" => "ch",
                    "ш" => "sh",
                    "щ" => "sch",
                    "ъ" => "y",
                    "ы" => "i",
                    "ь" => "j",
                    "э" => "e",
                    "ю" => "yu",
                    "я" => "ya", 
                    " " => "-",
                    "." => "",
                    "/" => "",
                    "," => "",
                    "-" => "-",
                    "(" => "",
                    ")" => "",
                    "[" => "",
                    "]" => "",
                    "{" => "",
                    "}" => "",
                    "=" => "",
                    "+" => "",
                    "*" => "",
                    "?" => "",
                    "\"" => "",
                    "'" => "",
                    "$" => "",
                    "&" => "",
                    "%" => "",
                    "#" => "",
                    "@" => "",
                    "!" => "",
                    ";" => "",
                    "№" => "",
                    "^" => "",
                    ":" => "",
                    "`" => "",
                    "~" => "",
                    "\\" => "",
                    "<" => "",
                    ">" => "",
                    "_" => "_",
                    "|" => "",
                ];

        $translit = strtr(trim($text), $letters);
        
        if ($toLowCase) {
            $translit = strtolower($translit);
        }
        
        return $translit;
    }

}