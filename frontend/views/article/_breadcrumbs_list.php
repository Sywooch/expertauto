<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\models\Tag;

    $links = [];

    if(Yii::$app->request->get('category') && $first) {
        if($first['maincategory_name']) {
            $links[] = ['label' => $first['maincategory_name']];
        } 
        if($first['category_name']) {
            $links[] = ['label' => $first['category_name']];
        }

    } elseif($search = Yii::$app->request->get('search')) { 
        $links[] = ['label' => 'Поиск по фразе'];
        $links[] = ['label' => trim($search)];

    } elseif(Yii::$app->request->get('author')) { 
        $links[] = ['label' => 'Авторы'];
        $links[] = ['label' => $first['lastname']];

    } elseif($tagSlug = Yii::$app->request->get('tag')) { 

        $tagName = Tag::findOne(['slug' => $tagSlug])['name'];
        $tagName = $tagName ? $tagName : '';
        $links[] = ['label' => 'Тэги'];
        $links[] = ['label' => $tagName];
    }       


    echo Breadcrumbs::widget([
      'homeLink' => ['label' => 'Главная', 'url' => Yii::$app->homeUrl],
      'links' => $links,    
    ]); 
?>



