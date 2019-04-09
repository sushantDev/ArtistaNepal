<?php

namespace App;

use Image as InterventionImage;

class ImageManipulator
{
    const THUMB_PATH = 'thumbnails/';

    /**
     * @param $width
     * @param $height
     * @param $image
     * @param $thumbPath
     * @param string $prefix
     * @return string
     */
    public static function getThumbnail($width, $height, $image, $thumbPath = null, $prefix = 'T')
    {
        $location = explode( '/', $image );

        $name  = $prefix.'-'.$width.'-'.$height.'-'.array_pop($location);

        $thumbnail = self::thumbnailLocation($thumbPath).$name;

        if(!file_exists( $thumbnail ))
            self::makeThumbnail( $width, $height, $image, $thumbnail );

        return $thumbnail;
    }

    /**
     * @param null $thumbPath
     * @return null|string
     */
    public static function thumbnailLocation($thumbPath = null)
    {
        return is_null($thumbPath) ? self::THUMB_PATH : $thumbPath;
    }


    /**
     * @param $width
     * @param $height
     * @param $image
     * @param $thumbName
     */
    private static function makeThumbnail($width, $height, $image, $thumbName)
    {
        $image = InterventionImage::make($image);

        $wh = self::getRatio($width, $height, $image);

        $image->resize($wh['width'],$wh['height'])->crop($width,$height,$wh['cropX'],$wh['cropY'])->save($thumbName);
    }

    /**
     * @param $width
     * @param $height
     * @param $image
     * @return array
     */
    private static function getRatio($width, $height, $image)
    {
        $sourceWidth = $image->width();
        $sourceHeight = $image->height();

        $targetWidth = $width;
        $targetHeight = $height;

        $sourceRatio = $sourceWidth / $sourceHeight;
        $targetRatio = $targetWidth / $targetHeight;

        if ( $sourceRatio < $targetRatio )
            $scale = $sourceWidth / $targetWidth;
        else
            $scale = $sourceHeight / $targetHeight;

        $resizeWidth = (int)($sourceWidth / $scale);
        $resizeHeight = (int)($sourceHeight / $scale);

        $cropTop = (int)(($resizeHeight - $targetHeight) / 2);
        $cropLeft = (int)(($resizeWidth - $targetWidth) / 2);

        return ['height'=>$resizeHeight,'width'=>$resizeWidth,'cropX'=>$cropLeft,'cropY'=>$cropTop];
    }

    /**
     * @param null $location
     */
    public static function clear($location = null)
    {
        $location = is_null($location) ? self::THUMB_PATH : $location;

        $files = glob($location); // get all file names

        // iterate files
        foreach( $files as $file ) {
            if( is_file( $file ) ) unlink( $file ); // delete file
        }
    }

    public static function resize($width, $height, $image, $thumbPath, $prefix = 'T')
    {
        $location = explode('/', $image);

        $name  = $prefix.'-'.$width.'-'.$height.'-'.array_pop($location);

        $fileLocation = self::thumbnailLocation($thumbPath).$name;

        if( !file_exists($fileLocation) ) {

            if( ( $width==null && $height==null ) || $image==null ) return;

            // create instance
            $img = InterventionImage::make($image);

            // resize the image to a width of 300 and constrain aspect ratio (auto height)
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->save($fileLocation);

        }

        return $fileLocation;
    }
}