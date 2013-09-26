			<div id="header_background">&nbsp;</div>
			<div id="header_foreground">&nbsp;</div>
			<p class="header_text_template_1" style="display: none">
				Welke mannelijke en vrouwelijke student combineren intelligentie, ambitie, mediageniekheid &amp; een knap uiterlijk?
				De tiende editie van de Student of the Year verkiezing is gestart.
			</p>
			<p class="header_text_template_2" style="display: none">
				Studenten uit heel Nederland hebben zich ingeschreven voor de Student of the Year 2012 verkiezing.
				Het is nu aan jou om te bepalen wie er doorgaan naar de kwart finale. Breng je stem uit! 
			</p>
			<p class="header_text_template_3" style="display: none">
				Stem mee op foto’s en uitspraken om mee te bepalen wie er dit jaar in de finale belanden.
			</p>
			<div id="header">
				<p></p>
				<a href="<?php echo $this->createUrl('/contest/vote/index'); ?>" class="vote"></a>
				<a href="#" onclick="nextHeader(curNumber - 1); return false" class="prev">&nbsp;</a>
				<a href="#" onclick="nextHeader(curNumber + 1); return false" class="next">&nbsp;</a>
				<ul>
					<li class="thumbnail1"><a href="#" onclick="nextHeader(1); return false"><img src="images/slider_picbox_1.png" alt="scroll" /></a></li>
					<li class="thumbnail2"><a href="#" onclick="nextHeader(2); return false"><img src="images/slider_picbox_2.png" alt="scroll" /></a></li>
					<li class="thumbnail3"><a href="#" onclick="nextHeader(3); return false"><img src="images/slider_picbox_3.png" alt="scroll" /></a></li>
				</ul>
			</div>
			<div id="header_progress">&nbsp;</div>