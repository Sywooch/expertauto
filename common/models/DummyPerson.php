<?php

namespace common\models;

use Yii;
use common\models\Person;
use common\models\Image;
use common\models\Utilities;


class DummyPerson extends \yii\db\ActiveRecord
{   
    private static $_avatars = [];
    private $rusFamilyAndNameArray = [
        'Забиров Богдан',
        'Беломестнов Андрей',
        'Миков Владислав',
        'Бубенцов Моисей',
        'Набокин Филимон',
        'Фарышев Вячеслав ',
        'Яблонцев Ефим',
        'Лапидус Иван',
        'Мигунов Мирослав',
        'Сияница Вячеслав',
        'Черных Богдан',
        'Чиркаш Эдуард',
        'Тетерин Дементий',
        'Кудров Кирилл',
        'Ермилов Андрей',
        'Глускин Александр',
        'Разуваев Леонид',
        'Ульянин Виктор',
        'Луков Ярослав',
        'Гарф Роман',
        'Яматин Дмитрий',
        'Чумаков Глеб',
        'Рязанов Евграф',
        'Каретников Фока',
        'Медведев Кир',
        'Непеин Кирилл',
        'Рогачeв Никон',
        'Данькин Тихон',
        'Шимякин Харитон',
        'Полыгалов Илья',
        'Борзилов Леонид',
        'Цветаев Игорь',
        'Чуркин Владислав',
        'Яранцев Александр',
        'Маслюк Лаврентий',
        'Миров Харитон',
        'Крылов Прокофий',
        'Бессонов Борислав',
        'Мичурин Самуил',
        'Мерзляков Адриан',
        'Пончиков Артем',
        'Селезнев Леонид',
        'Кондратенко Владислав',
        'Самсонов Кондрат',
        'Карданов Мир',
        'Титов Станислав',
        'Губанов Максим',
        'Каравашкин Анатолий',
        'Свечников Матвей',
        'Михайличенко Егор',
        'Мухаметов Александр',
        'Потемкин Егор',
        'Корзоватых Денис',
        'Яшихин Евгений',
        'Бершов Андрей',
        'Эрнет Роман',
        'Никаев Егор',
        'Яклашкин Артем ',
        'Леонидов Владислав',
        'Глен Андрей',
        'Шурша Артур',
        'Горохин Бронислав',
        'Лызлов Яков',
        'Брагин Демьян',
        'Терехов Владислав',
        'Каунайте Мартын',
        'Путятин Андрей',
        'Дубинкин ﻿Август',
        'Пугин Иннокентий',
        'Щепетинников Владислав',
        'Смышляев Степан',
        'Коржев Лев',
        'Костиков Никита',
        'Гребенщиков Никита',
        'Явид Никон',
        'Поветников Руслан',
        'елшин Михаил',
        'Ширинов Владислав',
        'Жабкин Вячеслав ',
        'Чичеров Руслан',
        'Орлов Евдоким',
        'Запорожец Измаил',
        'Будников Юлиан',
        'Досаев Виктор',
        'Салтыков Виктор',
        'Кузик Руслан',
        'Щенин Семен',
        'Пушменков Матвей',
        'Буклин Павел',
        'Валевач Аким',
        'Ванзин Глеб',
        'Цыцын Петр',
        'Мазурин Константин',
        'Аристархов Степан',
        'Сайбаталов Константин',
        'Сияница Кондратий',
        'Астахов Илья',
        'Лаврентьев Григорий',
        'Кудряшов Николай',
        'Шаповалов Василий',
        'Сычев Мартын',
        'Летов Глеб',
        'Белоглазов Вацлав',
        'Эрдниев Евдоким',
        'Шкиряк Андриян',
        'Гусельников Артур',
        'Сухарев Агафон',
        'Кидирбаев Иосиф',
        'Созыкин Радислав',
        'Яглинцев Рюрик',
        'Жаглин Богдан',
        'Посохов Мартын',
        'Оборин Афанасий',
        'Кувардин Евгений',
        'Сиянковский Максим',
        'Безбородов Феликс',
        'Натаров Илья',
        'Бегичев Денис',
        'Пирогов Семен',
        'Трунин Ян',
        'Ярушин Роман',
        'Лосев Степан',
        'Янаев Павел',
        'Ягеман Кирилл',
        'Головкин Алексей ',
        'Бабанин Серафим',
        'Листунов Максим',
        'Сагунов Алексей',
        'Соколов Валерий',
        'Абоимов Степан',
        'Клепахов Борис',
        'Черкашин Семен',
        'Осенных Руслан',
        'Лясковец Егор',
        'Шамило Кондрат',
        'Родиков Никита',
        'Гусляков Владислав',
        'Никаноров Григорий',
        'Энтин Юрий',
        'Характеров Борис',
        'Карибжанов Алексей ',
        'Легкодимов Роман',
        'Машарин Всеслав',
        'Францев Иннокентий',
        'Дарюшин Степан',
        'Помельников Константин',
        'Шапошников Чеслав',
        'Круглов Феофан',
        'Клименко Богдан',
        'Погребнов Игнатий',
        'Васенин Кузьма',
        'Арефьев Мстислав',
        'Козырев Кирилл',
        'Кушнарев Леонид',
        'Балакин Кондратий',
        'Карчагин Радислав',
        'Богоявленский Сергей',
        'Воейков Алексей ',
        'Шубин Кирилл',
        'Федоров Вадим',
        'Суворкин Соломон',
        'Петрухин Иван',
        'Чужинов Вадим',
        'Алексеев Ефрем',
        'Широких Богдан',
        'Коротков Николай',
        'Шашков Терентий',
        'Казаков Ипполит',
        'Ясырев Николай',
        'Луковников Аристарх',
        'Янушко Константин',
        'Красноперов Артем',
        'Николаенко Богдан',
        'Пыжалов Филимон',
        'Лившиц Тихон',
        'Мерзлов Ефрем',
        'Хуртин Виссарион',
        'Турбин Дмитрий',
        'Бочко Владислав',
        'Чугунов Богдан',
        'Крестьянинов Карл',
        'Янаслов Лукьян',
        'Райков Кузьма',
        'Люба Павел',
        'Янютин Сергей',
        'Рязанцев Андрей',
        'Суворов Афанасий',
        'Ясин Мефодий',
        'Панькив Семен',
        'Солодских Аркадий',
        'Апевалов Ипполит',
        'ежов Иван',
        'Карданов Николай',
        'Мигунов Степан',
        'Тычкин Потап',
        'Кононов Евстигней',
        'Орлов Онуфрий',
        'Куприянов Иннокентий',
        'Ожгибесов Леонид',
        'Чапаев Степан',
        'Чигиркин Никита',
        'Лягушов Артем ',
        'Некрасов Эрнст',
        'Чкалов Геннадий',
        'Бехтерев Артур',
        'Горохов Владилен',
        'Тычкин Святослав',
        'Якущенко Василий',
        'Корбылев Эдуард',
        'Малкин Данила',
        'Халимдаров Михаил',
        'Карасевич Руслан',
        'Грядкин Вадим',
        'Ошурков Дмитрий',
        'Разуваев Тарас',
        'Кабанов Ян',
        'Щередин Иван',
        'Ахвледиани Филипп',
        'Евдокимов Вячеслав ',
        'Нусуев Михей',
        'Петраков Филипп',
        'Бубенцов Наум',
        'Снегирев Руслан',
        'Шалушкин Нестор',
        'Путятин Николай',
        'Адоратский Радислав',
        'Тамаркин Пимен',
        'Перевалов Алексей ',
        'Чуличков Владислав',
        'Яимов Юрий',
        'Щавлев Леонид',
        'Огарков Сергей',
        'Филиппов Антип',
        'Тихоненко Илья',
        'Якупов Родион',
        'Якубович Степан',
        'Хабибуллин Аристарх',
        'Чечин Михаил',
        'Амбражевич Владислав',
        'Храмов Игорь',
        'Минеев Вадим',
        'Авдошкин Лавр',
        'Горелов Роман',
        'Юферев Агафон',
        'Казаков Егор',
        'Оропай Емельян',
        'Онипченко Давид',
        'Орехов Родион',
        'Грузинский Онуфрий',
        'Енин Гаврила',
        'Серпионов Евсей',
        'Рыжов Дмитрий',
        'Дремин Алексей ',
        'Яфаров Карл',
        'Дарбинян Глеб',
        'Шибалов Владислав',
        'Пустохин Семен',
        'Якубов Семен',
        'Лукьянов Сергей',
        'Фукин Иван',
        'Смешной Рубен',
        'Якобсон Мартын',
        'Митин Роман',
        'Рашет Денис',
        'Черепанов Илья',
        'Хватов Владислав',
        'Анюков Эрнст',
        'Аверин Кирилл',
        'Ямлиханов Вадим',
        'Лещев Давид',
        'Хабенский Онуфрий',
        'Чепурин Фадей',
        'Домышев Денис',
        'Дугин Алексей ',
        'Пыжалов Агап',
        'Курбатов Парфен',
        'Корнейчук Роман',
        'Покалюк Степан',
        'Шихин Константин',
        'Орехов Павел',
        'Буркин Савелий',
        'Ермишин Глеб',
        'Черномырдин Клавдий',
        'Кондратенко Семен',
        'Ерофеев Вадим',
        'Ядренников Андрей',
        'Гареев Андрей',
        'Лекомцев Порфирий',
        'Надервель Никита',
        'Алексеев Евсей',
        'Сальников Фома',
        'Махов Артемий',
        'Хмельнов Владлен',
        'Язов Сергей',
        'Ковальчук Михаил',
        'Кошляк Эдуард',
        'Шубин Вячеслав ',
        'Паршиков Руслан',
        'Шаломенцев Ярослав',
        'Мирзoян Венедикт',
        'Уланов Филипп',
        'Валеев Дмитрий',
        'Домаш Артем ',
        'Зюганов Вадим',
        'Еремеев Мирон',
        'Элиашев Виктор',
        'Суворкин Сократ',
        'Якуничев Павел',
        'Маюров Константин',
        'Дыховичный Иван',
        'Королев Владислав',
        'Калугин Лукьян',
        'Енин Вячеслав ',
        'Ярошенко Василий',
        'Черенчиков Дмитрий',
        'Горохов Владимир',
        'Ягнятев Мефодий',
        'Мысляев Гавриил',
        'Чичканов Павел',
        'Шандаров Валентин',
        'Богатырев Иван',
        'Янцев Руслан',
        'Глоба Вадим',
        'Клим Артем ',
        'Утесов Артур',
        'Мацовкин Евграф',
        'Гольц Вячеслав ',
        'Кулагин Святослав',
        'Сахаровский Соломон',
        'Лосев Роман',
        'Шульц Евгений',
        'Васнецов Виктор',
        'Ювелев Вадим',
        'Ядрищенский Кирилл',
        'Лаптев Константин',
        'Цитников Константин',
        'Некрестьянов Семен',
        'Кемоклидзе Владимир',
        'Скворцов Алексей ',
        'Кодица Максим',
        'Елагин Иван',
        'Решетилов Самсон',
        'Рекунов Борис',
        'Турчанинов Никифор',
        'Лобан Кирилл',
        'Цуканов Поликарп',
        'Шевцов Михаил',
        'Глускин Роман',
        'Паулкин Вацлав',
        'Мосенцов Андрей',
        'Шибалкин Поликарп',
        'Никольский Тимофей',
        'Волобуев Вячеслав ',
        'Бурцев Александр',
        'Никитаев Эмиль',
        'Каргин Роман',
        'Канаш Илья',
        'Глинка Михаил',
        'Акинфеев Дмитрий',
        'Закиров Яков',
        'Глушаков Валерьян',
        'Царско Андриян',
        'Алимкин Павел',
        'Федосов Ярослав',
        'Барков Никита',
        'Райков Дмитрий',
        'Рытин Захар',
        'Кириленко Семен',
        'Берия Фока',
        'Приходько Вячеслав ',
        'Щередин Алексей ',
        'Кошелев Игорь',
        'Шостенко Евгений',
        'Вольваков Евгений',
        'Логутенко Семен',
        'Комолов Богдан',
        'Ломовцев Ефим',
        'Разумов Максим',
        'Гик Фадей',
        'Бок Илья',
        'Суходолин Руслан',
        'Винокуров Семен',
        'Эристов Эрнест',
        'Грош Степан',
        'Экземплярский Вячеслав ',
        'Пермяков Вячеслав ',
        'Стрельцов Руслан',
        'Ясько Ярослав',
        'Мосин Геннадий',
        'Махов Леонид',
        'Митрохов Денис',
        'Погребнов Глеб',
        'Бабат Клавдий',
        'Ли Иван',
        'Рябец Глеб',
        'Красенков Семен',
        'Земин Владимир',
        'Умаметев Евдоким',
        'Яруллин Ярослав',
        'Вотяков Богдан',
        'Теребов Артур',
        'Сарайкин Яков',
        'Солдатов Дмитрий',
        'Благово Кирилл',
        'Фаммус Александр',
        'Дябин Моисей',
        'Курсалин Игорь',
        'Ивашкин Ян',
        'Барндык Николай',
        'Сагадеев Павел',
        'Зюганов Богдан',
        'Буданов Семен',
        'Павленко Семен',
        'Силин Игорь',
        'Цызырев Артем ',
        'Кушкин Александр',
        'Новожилов Владислав',
        'Бабинов Максим',
        'Убейсобакин Вячеслав',
        'Машлыкин Артур',
        ];

    public function createManyPersons()
    {
        $sourceDir = Yii::getAlias('@img/avatar/src/');
        self::$_avatars = glob($sourceDir. '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        shuffle(self::$_avatars);
        $avatarPattern = [['crop' => true, 'width' => 100, 'height' => 100, 'sharpen'   => 4 ]];

        $ar = $this->rusFamilyAndNameArray;

        foreach($ar as $k => $fullName) {
            // if($k == 6) break; // testmode

            $firstName = explode(' ', $fullName)[0];
            $latinFirstName = $this->cyrillicToLatin($firstName);
            if(rand(1, 5) == 1)  {  // every 4-th add digital suffix
                $digitalSuffix = rand(11, 3999);
                $latinFirstName .= $digitalSuffix;
            }

            $dummy = new Person;
            $dummy->username = $latinFirstName;
            $dummy->nickname = $fullName;
            $dummy->email = $latinFirstName . '@ya.ru';
            $dummy->password_hash = '$2y$13$1279VoGviKT8MihTq25XmOCQyDWcyN3IkbSfr/rN5OgAvF8888888';
            $dummy->created_at = '1422789599';
            $dummy->updated_at = '1422789599';
            $dummy->role = 10;
            $dummy->status = 1;
            $dummy->is_dummy = 1;

            // ..........create avatar .................
            $sourceFile = array_pop(self::$_avatars); 
            $targetDir = Yii::getAlias('@img/avatar/');
            $info = pathinfo($sourceFile);
            $ext = $info['extension'];
            $dummy->avatar_src  = 'zzzz' .Utilities::createRandomName(8) .'.' .$ext;
            Image::createImageByPattern($sourceFile, $targetDir, $dummy->avatar_src, $avatarPattern);
            // .........................................

            $dummy->save();
            echo 'create dummy person ' .$dummy->username .'<br>';
        }
        echo '<br>READY'; 
        exit;
    }

    private function cyrillicToLatin($string)
    {      
        $letters = array( "А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Д" => "D", "Е" => "E", "Ё" => "E", "Ж" => "J", "З" => "Z", "И" => "I", "Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N", "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T", "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH", "Ш" => "SH", "Щ" => "SCH", "Ъ" => "", "Ы" => "I", "Ь" => "J", "Э" => "E", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ё" => "e", "ж" => "j", "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l", "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h", "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y", "ы" => "i", "ь" => "j", "э" => "e", "ю" => "yu", "я" => "ya",  " " => "-", "." => "", "/" => "", "," => "", "-" => "-", "(" => "", ")" => "", "[" => "", "]" => "", "{" => "", "}" => "", "=" => "", "+" => "", "*" => "", "?" => "", "\"" => "", "'" => "", "$" => "", "&" => "", "%" => "", "#" => "", "@" => "", "!" => "", ";" => "", "№" => "", "^" => "", ":" => "", "`" => "", "~" => "", "\\" => "", "<" => "", ">" => "", "_" => "_", "|" => "",
                );

        $translit = strtr($string, $letters);
        // if ($toLowCase) {
            $translit = strtolower($translit);
        // }
        $translit = preg_replace('/[^A-Za-z0-9_\-]/', '', $translit);
        return $translit;
    }


    public static function getRandomDummy()
    {
        return Person::find()->where(['is_dummy'=>1])->orderBy('rand()')->one();
    }



           

}
