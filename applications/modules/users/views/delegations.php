<h1><?php echo _TR_Delegations ?></h1>
<hr />

<h4><?php echo _TR_DelegationsGiven; ?></h4>
<div class="listview-outlook" data-role="listview" style="margin-top: 20px">
    <div class="list-group ">
        <div class="group-content">            
                <?php 
                if(sizeof($delegationsGiven) > 0)
                    foreach($delegationsGiven as $delegations)
                    {
                        echo '<span class="list pointer"><div class="list-content">';
                        echo '<span class="list-title">'.strtoupper($delegations->users2Name).'</span>';
                        if($delegations->instances == 0)
                            echo '<span class="list-remark" style="padding-top : 0px;">'._TR_Categories .' : '.$delegations->categoriesName.'</span>';
                        else
                            echo '<span class="list-remark" style="padding-top : 0px;">'._TR_Instances .' : '.$delegations->instancesName.'</span>';
                        echo '</div></span>';
                    }
                else
                    echo _TR_NoDelegation;
                ?>
        </div>
    </div>
</div>

<h4><?php echo _TR_DelegationsReceive; ?></h4>
<div class="listview-outlook" data-role="listview" style="margin-top: 20px">
    <div class="list-group ">
        <div class="group-content">            
                <?php 
                if(sizeof($delegationsReceive) > 0)
                    foreach($delegationsReceive as $delegations)
                    {
                        echo '<span class="list pointer"><div class="list-content">';
                        echo '<span class="list-title">'.strtoupper($delegations->users1Name).'</span>';
                        if($delegations->instances == 0)
                            echo '<span class="list-remark" style="padding-top : 0px;">'._TR_Categories .' : '.$delegations->categoriesName.'</span>';
                        else
                            echo '<span class="list-remark" style="padding-top : 0px;">'._TR_Instances .' : '.$delegations->instancesName.'</span>';
                        echo '</div></span>';
                    }
                else
                    echo _TR_NoDelegation;
                        
                ?>
        </div>
    </div>
</div>
