<?php

    function Parse($p1, $p2, $p3) {
        $num1 = strpos($p1, $p2);
        if ($num1 === false) return 0;
        $num2 = substr($p1, $num1);
        return substr($num2, 0, strpos($num2, $p3));
    }

    $parts = parse_url($_SERVER['REQUEST_URI']);
    $output = [];
    @parse_str($parts['query'], $output);

    $i = 0;
    if ($_POST && !empty($_POST['text']))
        $html = $_POST['text'];
    else
    {
        if (@$output['preset'] == '1')
        {
            $url = "https://ru.wikipedia.org/wiki/%D0%9A%D0%B8%D0%BD%D0%BE%D1%80%D0%B8%D0%BD%D1%85%D0%B8";
            $html = file_get_contents($url);
        }
        else if (@$output['preset'] == '2')
        {
            $url = "https://echo.msk.ru/programs/sorokina/2917870-echo/";
            $html = file_get_contents($url);
            $html = Parse($html,'<div class="mmplayer">','</div>');
        }
        else if (@$output['preset'] == '3')
        {
            $url = "https://mishka-knizhka.ru/skazki-dlay-detey/zarubezhnye-skazochniki/skazki-alana-milna/vinni-puh-i-vse-vse-vse/#glava-pervaya-v-kotoroj-my-znakomimsya-s-vinni-puhom-i-neskolkimi-pchy";
            $html = file_get_contents($url);
            preg_match( '/<article id=post-1153 class="post-1153 post type-post status-publish format-standard has-post-thumbnail hentry category-skazki-alana-milna tag-skazki-dlya-detej-4-5-6-let tag-skazki-pro-detej tag-skazki-pro-zhivotnyh tag-skazki-pro-zajcev" itemscope itemtype=http:\/\/schema.org\/Article itemprop=mainEntity>(.*?)<\\/div><footer/is' , $html , $title );
            $html = $title[1];

        }
    }

    if (isset($html))
    {
        // Пятый пункт
        $html = str_replace(" - ","&ndash;", $html);
        $html = str_replace(" -- ","&mdash;", $html);

        // Шестой пункт
        $html = str_replace(" a",",a", $html);
        $html = str_replace(" но"," ,но", $html);
        $html = str_replace("...","&hellip;", $html);

        $html = str_replace(",alt"," alt", $html);

        // Тринадцатый пункт
        $dom = new \DOMDocument();
        @$dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        $images_array = array(array());
        foreach ($images as $image) {
            $images_array[$i]['src'] = $image->getAttribute('src');
            $images_array[$i]['alt'] = $image->getAttribute('alt');
            $i++;
        }

        if (@$output['preset'] == '3')
        {
            $html = str_replace(" src=","src=\"", $html);
            $html = str_replace(" alt","\" alt", $html);
        }

        // Семнадцатый пункт
    }