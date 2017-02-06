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
        echo "Select Server " . $group->group_country;
      }
    }
}
