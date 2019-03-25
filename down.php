<?php
    class getInCssImage
    {
        /**
         *  图片保存下来
         * @param $cssUrl css的url地址
         * @param $dir 保存图片的目录
         * @return void
         */
        static public function saveImage($cssUrl, $dir)
        {
            $content = file_get_contents($cssUrl);
            $patterns = '/imgs(.*).(jpg|gif|png)/'; //正则根据不同地址需要变换
            preg_match_all($patterns, $content, $matches);
            $imagesUrls = $matches[0];

            if (!is_dir($dir)) {
                mkdir(dirname(__FILE__) . '/' . $dir, 0777);
            }

            foreach($imagesUrls as $image) {
                ob_start();
                $imageUrl = "http://partner.chuangjiangx.com/wp-content/themes/mytheme/static/".$image; //这个地址填入你想要抓取的地址
                //echo $imageUrl;
                //echo "<br>";
                readfile($imageUrl);
                $img  = ob_get_contents();
                ob_end_clean();
                $size = strlen($img);

                $localImage = substr($image, strripos($image, '/')+1);

                $localImage = $dir.'/'.$localImage; //存到本地的图片地址
                //echo $localImage;
                //echo "<br>";
                $fp = fopen($localImage, 'a');
                fwrite($fp, $img);
                fclose($fp);
            }
        }
    }

set_time_limit(0);
$content = getInCssImage::saveImage(__DIR__.'/pos_files/poslakala.css', 'image');
?>
