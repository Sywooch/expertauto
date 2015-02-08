<?php

namespace common\models;

use Yii;
use \yii\image\ImageDriver;
use \yii\image\drivers\Image as KohanaImage;

class Image
{
   
    // $targetDir ~ Yii::getAlias('@img/article/')
    public static function  createImageByPattern($sourceFile, $targetDir, $createdImageName, $patternArr) 
    {
        $imageProcessor = new ImageDriver;
        $normalizedArr = self::normalizePatternArray($patternArr);

        foreach ($normalizedArr as $prop) {
            if(is_file($sourceFile))  {
                $createdImage = $imageProcessor->load($sourceFile);
                $target_w  = $prop['width'];
                $target_h  = $prop['height'];

                if( !isset($prop['crop'])) {
                    // уменьшить без crop, сохраняя пропорции
                    $createdImage->resize($target_w, $target_h);
                } else {
                    $target_hw_ratio = $target_h / $target_w;
                    list($source_w, $source_h) = getimagesize($sourceFile);
                    $source_hw_ratio = $source_h / $source_w;
                    // оригинал шире создаваемого img
                    if($source_hw_ratio <= $target_hw_ratio) { 
                        $ratio = $target_h / $source_h;
                        $createdImage->resize(round($source_w * $ratio), $target_h, KohanaImage::HEIGHT);
                    }  else  {
                        $ratio =  $target_w / $source_w;
                        $createdImage->resize($target_w, round($source_h * $ratio), KohanaImage::WIDTH);
                    }
                    $createdImage->crop($target_w, $target_h);
                }

                if(isset($prop['sharpen'])) {
                    $createdImage->sharpen($prop['sharpen']);
                }
                if(isset($prop['watermark'])) {
                    $watermark = KohanaImage::factory($prop['watermark']['fileName']);
                    $opacity = $prop['watermark']['opacity'];
                    $createdImage->watermark($watermark, $offset_x = NULL, $offset_y = NULL, $opacity);
                }
                
                $targetDirectory = $targetDir;
                if(isset($prop['subdir'])) {
                    $targetDirectory .= (string)$prop['subdir'] .DIRECTORY_SEPARATOR;
                }
                $createdImageSrc = $targetDirectory .$createdImageName;

                $quality = isset($prop['quality']) ? $prop['quality'] : 100;
                $createdImage->save($createdImageSrc, $quality);
            }  //is_file
        }  //foreach
    }


    public static function deleteInDirs($imageName, $dir, $arraySubdirs = null)
    {
        if($arraySubdirs && count($arraySubdirs) > 0) {
            foreach ($arraySubdirs as $subdir) {
                @unlink($dir .$subdir .DIRECTORY_SEPARATOR .$imageName);
            }
        }  else {
            @unlink($dir .$imageName);
        }
    }
    
    public static function getArraySubdirsFromPattern(array $patternArray)
    {
        $arraySubdirs = [];
        foreach($patternArray as $val) {
            if(isset($val['subdir'])) {
                $arraySubdirs[] = $val['subdir'];
            }
        }
        return $arraySubdirs;
    }

    public static function deleteByPattern($imageName, $dir, $patternArray)
    {
        $arraySubdirs = self::getArraySubdirsFromPattern($patternArray);
        self::deleteInDirs($imageName, $dir, $arraySubdirs);
    }
    

    public static function getImageSrc($filePath, $blankImage = null)
    {   
        $imageFile = Yii::getAlias('@public') .$filePath;
        $imageFile = str_replace('\\', '/', $imageFile);
        // $imageFile = str_replace('/', DIRECTORY_SEPARATOR, $imageFile);
        if(is_file($imageFile)) {
            $imageSrc = Yii::$app->request->baseUrl . $filePath;
        }   elseif($blankImage) {
            $imageSrc = Yii::$app->request->baseUrl . $blankImage;
        }   else {
            $imageSrc = false;
        }
        return $imageSrc;
    } 


    // service ...............

    // convert any array to two-demenision
    private static function normalizePatternArray($arr) 
    {   
        if(isset($arr[0])) {
             return $arr;
        } else {
            $normalizedArr = [];
            $normalizedArr[] = $arr;
            return $normalizedArr;
        }
    }


}
