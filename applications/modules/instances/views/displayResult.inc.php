<div class="tab-pane" id="result" style="text-align : justify">
<br />
<?php if($instances->quorumRequired != 0)
{
	?>
		<div class="notice">
			<div class="fg-white"><i class="glyphicon glyphicon-info-sign" style="font-size : 18px;"></i> Un quorum de <?php echo $instances->quorumRequired;?>% était requis par vote.</div>
		</div>
		<?php
	}
	
else
{
	?>
	<div class="notice bg-gray">
		<div class="fg-white"><i class="glyphicon glyphicon-info-sign" style="font-size : 18px;"></i> Aucun quorum requis pour le vote des propositions de cet atelier.</div>
	</div>
	<?php
}
?>
<br /><br />
<div class="row">
<div class="col-md-3">
	<div class="panel panel-success" style="min-height : 550px;">
      	<div class="panel-heading">Liste des propositions acceptées</div>
      	<div class="panel-body no-padding">
      		<table class="table ">
      		<?php
			if($votesFor)
			{
				foreach($votesFor as $voteFor)
					echo "<tr><td>".$voteFor->name."</td></tr>";
				echo "</ul>";
			}
			else
				echo "<tr><td><i class='fg-gray'>Aucune proposition acceptée</i></td></tr>";
			?>
			</table>
      	</div>
    </div>	
</div>
		
		
<div class="col-md-3">
	<div class="panel panel-danger" style="min-height : 550px;">
      	<div class="panel-heading">Liste des propositions rejetées</div>
      	<div class="panel-body no-padding">
      		<table class="table ">
      		<?php 
			if($votesAgainst)
			{
				foreach($votesAgainst as $voteAgainst)
					echo "<tr><td>".$voteAgainst->name."</td></tr>";
			}
			else
				echo "<tr><td><i class='fg-gray'>Aucune proposition rejetée</i></td></tr>";
			?>
			</table>
      	</div>
    </div>
</div>
	
	
<div class="col-md-3">
	<div class="panel panel-default" style="min-height : 550px;">
      	<div class="panel-heading">Liste des propositions votées neutre (blanc)</div>
      	<div class="panel-body no-padding">
      		<table class="table ">
      		<?php 
			if($votesWhite)
			{
				foreach($votesWhite as $voteWhite)
					echo "<tr><td>".$voteWhite->name."</td></tr>";
			}
			else
				echo "<tr><td><i class='fg-gray'>Aucune proposition votée blanc</i></td></tr>";
			?>
			</table>
			
      	</div>
    </div>
</div>
	
	
<div class="col-md-3">
	<div class="panel panel-info" style="min-height : 550px;">
      	<div class="panel-heading">Liste des propositions au statu quo (abstention)</div>
      	<div class="panel-body no-padding">
      		<table class="table ">
      		<?php 
			if($votesStatusQuo)
			{
				foreach($votesStatusQuo as $voteStatusQuo)
					echo "<tr><td>".$voteStatusQuo->name."</td></tr>";
			}
			else
				echo "<tr><td><i class='fg-gray'>Aucune proposition en statu quo. Toutes les propositions ont étés votées (soient validées, soient rejetées ou votées blanc.)</i></td></tr>";
			?>			
			</table>
      	</div>
    </div>
 </div>
 
</div>
</div>