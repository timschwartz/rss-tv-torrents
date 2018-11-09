<?php

namespace App\RSS;

class HorribleSubs extends RSS
{
    public function getTorrents()
    {
        if(count($this->torrents)) return $this->torrents;

        foreach($this->items as $item)
        {
            $title_parts = explode(" - ", $item->get_title());
            if(count($title_parts) == 1) continue;

            $title = str_replace("[HorribleSubs] ", "", $title_parts[0]);

            if(count($title_parts) == 3)
            {
                $title.= " - ".$title_parts[1];
                $episode = str_replace(" [1080p].mkv", "", $title_parts[2]);
            }
            else $episode = str_replace(" [1080p].mkv", "", $title_parts[1]);

            if(!isset($this->torrents[$title])) $this->torrents[$title] = array();
            $this->torrents[$title][$episode] = $item->get_permalink();
        }

        return $this->torrents;
    }
}
