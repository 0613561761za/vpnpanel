<?php

namespace App;
use Group;

class groupss
{
    $groups = Group::get();
    if($groups->count() < 1)
    {
      return "No Groups Found"
    }

    foreach($groups as $group)
    {
      echo "Select Server " . $group->group_country;
    }
}
