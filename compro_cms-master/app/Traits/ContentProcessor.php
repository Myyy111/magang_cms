<?php

namespace App\Traits;

use File;
use Image;

trait ContentProcessor
{
    /**
     * Process content from rich text editor, converting base64 images to files.
     * 
     * @param string $content
     * @return string
     */
    public function processInnerImages($content)
    {
        if (empty($content)) {
            return $content;
        }

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        
        // Handle UTF-8 encoding properly
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            
            // if the img source is 'data-url' (base64)
            if (preg_match('/data:image/', $src)) {                
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];                
                
                // Generating a random filename
                $filename = uniqid() . '_' . time();

                // Create Folder Location
                $path = public_path('uploads/media/');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $filepath = "/uploads/media/$filename.$mimetype";    
                
                if (extension_loaded('gd') || extension_loaded('imagick')) {
                    Image::make($src)
                        ->resize(800, null, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })
                        ->encode($mimetype, 100)
                        ->save(public_path($filepath));
                } else {
                    $data = explode(',', $src);
                    file_put_contents(public_path($filepath), base64_decode($data[1]));
                }

                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }

        // Save only inner HTML to avoid xml tags
        return $dom->saveHTML($dom->documentElement);
    }
}
