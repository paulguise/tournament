<div class="panel">
	<div class="panel-head">
		<h3<?php echo __d('tournament', 'Teams'); ?></h3>
	</div>

	<div class="panel-body">
		<table class="table">
			<thead>
				<tr>
					<th> </th>
					<th><?php echo __d('tournament', 'Team'); ?></th>
					<th><?php echo __d('tournament', 'Status'); ?></th>
					<th><?php echo __d('tournament', 'Role'); ?></th>
					<th><?php echo __d('tournament', 'Joined / Left'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($player['Team'] as $team) {
					echo $this->element('rows/team_member_for', array(
						'team' => $team
					));
				} ?>
			</tbody>
		</table>
	</div>
</div>