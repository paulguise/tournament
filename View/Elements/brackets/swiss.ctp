
<style>
body { width: <?php echo ($bracket->getCompletedRounds() * 325); ?>px; min-width: 100%; }
</style>

<div class="bracket swiss">
	<div class="container">
		<div class="container-head">
			<h3><?php echo __d('tournament', 'Rounds %s of %s', $bracket->getCompletedRounds(), $bracket->getMaxRounds()); ?></h3>
		</div>

		<div class="container-body">

			<?php foreach ($bracket->getRounds() as $round) { ?>

				<div class="bracket-column">
					<?php if ($matches = $bracket->getRoundMatches($round)) { ?>

						<ul>
							<?php foreach ($matches as $match) { ?>

								<li>
									<?php echo $this->element('brackets/match', array(
										'match' => $match,
										'home' => $bracket->getParticipant($match['home_id']),
										'away' => $bracket->getParticipant($match['away_id'])
									)) ?>
								</li>

							<?php } ?>
						</ul>

					<?php } ?>
				</div>

			<?php } ?>

			<span class="clear"></span>
		</div>
	</div>
</div>