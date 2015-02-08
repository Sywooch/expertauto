<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\ImageArticle;


class LabController extends Controller
{


    public function actionLoad($id)
    {   

        $connection_expert = \Yii::$app->db;
        $connection_abs = \Yii::$app->db2;

        $sourceDir = 'C:\xampp\htdocs\abs-magazine\photo\big';
        $targetDir = 'C:\xampp\htdocs\expertauto\frontend\web\photo\article';
        $subDirectory = 'article';
        $images = [];
        //............................
        
        $command = $connection_abs
            ->createCommand(
                "SELECT * FROM article 
                 WHERE id = $id"
            );

        $article = $command->queryOne();

        if(isset($article)) {
            
            // check, if not exsist
            $title = $article['title'];
            $command = $connection_expert
                ->createCommand(
                    "SELECT * FROM article 
                     WHERE title = '$title'"
                );
            $items = $command->queryAll();

            if(!$items) {
                 $connection_expert
                    ->createCommand()
                    ->insert('article', 
                        [
                            'title'      => $article['title'],
                            'content'    => $article['content'],
                            'created_at' => new \yii\db\Expression('NOW()'),
                            'updated_at' => new \yii\db\Expression('NOW()'),
                            'author_id'  => 1,
                            'category_id' => 3,
                            'state'      => 1,
                            'slug'       => $article['slug'],
                            'image_src'  => $article['photo_main'],
                        ]
                    )
                    ->execute();

                // get id saved article
                $command = $connection_expert
                    ->createCommand(
                        "SELECT id FROM article 
                         ORDER BY id DESC 
                         LIMIT 1"
                    );
                $row = $command->queryOne();
                $articleId = $row['id'];

                if(!empty($article['photo_main'])) {
                    $images[] = $article['photo_main'];
                }

                $command = $connection_abs
                    ->createCommand(
                        "SELECT * FROM photo 
                         WHERE article_id = $id"
                    );

                $photos = $command->queryAll();
                if($photos) {

                    foreach($photos as $photo) {

                        $layout = 1;
                        if($photo['float'] == 1 || $photo['is_mini'] == 1) {
                            $layout = 2;
                        }

                         $connection_expert
                            ->createCommand()
                            ->insert('image_article', 
                                [
                                'article_id' => $articleId,
                                'src'        => $photo['name'],
                                'caption'    => $photo['subscribe'],
                                'pos'        => $photo['pos'],
                                'subpos'     => $photo['subpos'],
                                'layout'     => $layout,
                                ]
                            )
                            ->execute();
                        $images[] = $photo['name'];
                    }
                }

                if(count($images) > 0) {
                    foreach($images as $image) {
                        $sourceFile = $sourceDir .DIRECTORY_SEPARATOR .$image; 
                         self::createImagesByPattern($sourceFile, $subDirectory, $image, ImageArticle::getStandardPattern());

                         echo 'add image ' . $image . '<br>';
                    }
                }
                echo 'Ready';
            } else {
                echo 'Article else exsist';
            }
        }
        exit;
    }



    public static function  createImagesByPattern($uploadedFile, $subDirectory, $imageName, $patternArray) 
    {
        $imageProcessor = new \yii\image\ImageDriver;

        foreach ($patternArray as $key => $property) {

            if(is_file($uploadedFile))  {
                $createdImage = $imageProcessor->load($uploadedFile);
                $target_w  = $property['width'];  
                $target_h  = $property['height'];

                if( !isset($property['crop'])) {
                    // уменьшить без crop, сохраняя пропорции 
                    $createdImage->resize($target_w, $target_h);
                } else { 
                    $target_hw_ratio  = $target_h / $target_w;
                    $originalSizes = getimagesize($uploadedFile);
                    $original_w  = $originalSizes[0];  
                    $original_h  = $originalSizes[1];
                    $original_hw_ratio = $original_h / $original_w;
                    // если по пропорции оригинал шире создаваемой миниатюры
                    if($original_hw_ratio <= $target_hw_ratio) { 
                        $ratio =  $target_h / $original_h;
                        $createdImage->resize(round($original_w * $ratio), $target_h, \yii\image\drivers\Image::HEIGHT);
                    }  else  { 
                        $ratio =  $target_w / $original_w;
                        $createdImage->resize($target_w, round($original_h * $ratio), \yii\image\drivers\Image::WIDTH);
                    }
                    $createdImage->crop($target_w, $target_h);
                }

                if(isset($property['sharpen'])) $createdImage->sharpen($property['sharpen']);

                if(isset($property['watermark'])) {
                    $watermark = \yii\image\drivers\Image::factory($property['watermark']['fileName']);
                    $opacity = $property['watermark']['opacity'];
                    $createdImage->watermark($watermark, $offset_x = NULL, $offset_y = NULL, $opacity);
                }
                

                // important!
                $createdImageName = 'D:\expertauto_photo' .DIRECTORY_SEPARATOR .$subDirectory .DIRECTORY_SEPARATOR .$key .DIRECTORY_SEPARATOR .$imageName;

             

                $quality = (isset($property['quality'])) ? $property['quality'] : 100;
                $createdImage->save($createdImageName, $quality); 
            }  //is_file
        }  //foreach patternArray
    }



}