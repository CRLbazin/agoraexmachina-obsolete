<?php 
function canVote($instances)
{
    if(date('Y-m-d') < $instances->deadline && ($instances->whoCanVote == "allUsers" || ($instances->whoCanVote == "guests" and $instances->userCanVote == 1)))
        return true;
    else
        return false;
}
?>