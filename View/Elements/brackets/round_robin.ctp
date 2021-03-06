<?php // Loop over each pool
foreach ($bracket->getPools() as $pool) { ?>

<div id="pool-<?php echo $pool; ?>" class="robin">
	<?php if ($bracket->getMaxRounds() > 1) { ?>
		<div class="robin-head">
			<h3><?php echo __d('tournament', 'Pool %s', $pool); ?></h3>
		</div>
	<?php } ?>

	<div class="robin-body">
		<div class="bracket">

		<?php // Loop over each round
		foreach ($bracket->getRounds($pool) as $round) {
			$participants = $bracket->getParticipants($round, $pool);
			$participant_ids = array_keys($participants);
			$matchesCount = count($participants); ?>

			<table class="table">
				<thead>
					<tr>
						<th colspan="<?php echo $matchesCount + 1; ?>">
							<?php echo __d('tournament', 'Round %s of %s', $round, $bracket->getMaxRounds()); ?>
						</th>
						<th><?php echo __d('tournament', 'Score'); ?></th>
						<th><?php echo __d('tournament', 'Standing'); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<?php foreach ($participants as $participant) { ?>
							<td class="cell-participant">
								<?php echo $this->Bracket->participant($participant); ?>
							</td>
						<?php } ?>
						<td></td>
						<td></td>
					</tr>

					<?php // Loop over each participant
					foreach ($participants as $participant_id => $participant) {
						$matches = array_values($bracket->getMatches($round, $pool, $participant_id)); ?>

					<tr>
						<td class="cell-participant">
							<?php echo $this->Bracket->participant($participant); ?>
						</td>

						<?php // Loop over each match for the participant
						$count = 0;
						$wins = 0;
						$losses = 0;
						$ties = 0;

						for ($i = 0; $i < $matchesCount; $i++) {

							// Skip if playing against your self or no match found
							if ($participant_ids[$i] == $participant_id || empty($matches[$count])) { ?>

							<td class="cell-void"></td>

							<?php } else {
								$match = $matches[$count];
								$score = $this->Bracket->matchScore($participant_id, $match);
								$count++;

								if ($score[0] == $score[1]) {
									$ties++;
								} else if ($score[0] > $score[1]) {
									$wins++;
								} else {
									$losses++;
								} ?>

							<td class="cell-score status-<?php echo $this->Bracket->matchStatus($participant_id, $match); ?>">
								<?php if ($score) {
									echo implode(' - ', $score);
								} ?>
							</td>

							<?php }
						} ?>

						<td class="cell-total-score">
							<?php echo $wins; ?> -
							<?php echo $losses; ?>
						</td>

						<td class="cell-standing">
							<?php if ($bracket->canShowStanding($round)) {
								echo $this->Bracket->standing($participant['EventParticipant']['standing']);
							} ?>
						</td>
					</tr>

					<?php } ?>
				</tbody>
			</table>

		<?php } ?>

		</div>
	</div>
</div>

<?php } ?>