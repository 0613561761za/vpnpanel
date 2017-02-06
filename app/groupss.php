<?php

namespace App;
use \App\Group;

class groupss
{
    public function groups()
    {
      $groups = Group::get();
      if($groups->count() < 1)
      {
        return "No Groups Found";
      }

      foreach($groups as $group)
      {
        echo "<a href='/groups/" . $group->group_id . "'>Select Server " . $group->group_country . '</a>';
      }
    }
}
