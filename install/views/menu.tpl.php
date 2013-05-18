<div class="box">

	<div class="box_title">Installation Process</div>

	<div class="box_content">
		<ul>
            <li>
                Step One: Start Installation
            </li>
            <li>
                <ul>
                    <li>
                        <?php if ($installStage < 1): ?>
                            <img src="<?php echo $images; ?>/bullet_red.png" />
                        <?php elseif ($installStage == 1): ?>
                            <img src="<?php echo $images; ?>/bullet_go.png" />
                        <?php elseif ($installStage > 1): ?>
                            <img src="<?php echo $images; ?>/tick.png" />
                        <?php endif; ?>
                        Select Language
                    </li>
                </ul>
            </li>
            <li>
                Step Two: Setup Database
            </li>
            <li>
                <ul>
                    <li>
                        <?php if ($installStage < 2): ?>
                            <img src="<?php echo $images; ?>/bullet_red.png" />
                        <?php elseif ($installStage == 2): ?>
                            <img src="<?php echo $images; ?>/bullet_go.png" />
                        <?php elseif ($installStage > 2): ?>
                            <img src="<?php echo $images; ?>/tick.png" />
                        <?php endif; ?>
                        Enter Connection Information
                    </li>
                    <li>
                        <?php if ($installStage < 3): ?>
                            <img src="<?php echo $images; ?>/bullet_red.png" />
                        <?php elseif ($installStage == 3): ?>
                            <img src="<?php echo $images; ?>/bullet_go.png" />
                        <?php elseif ($installStage > 3): ?>
                            <img src="<?php echo $images; ?>/tick.png" />
                        <?php endif; ?>
                        Confirm Database Information
                    </li>
                </ul>
            </li>
            <li>
                Step Three: Setup Admin Account
            </li>
            <li>
                <ul>
                    <li>
                        <?php if ($installStage < 4): ?>
                            <img src="<?php echo $images; ?>/bullet_red.png" />
                        <?php elseif ($installStage == 4): ?>
                            <img src="<?php echo $images; ?>/bullet_go.png" />
                        <?php elseif ($installStage > 4): ?>
                            <img src="<?php echo $images; ?>/tick.png" />
                        <?php endif; ?>
                        Enter Account Information
                    </li>
                    <li>
                        <?php if ($installStage < 5): ?>
                            <img src="<?php echo $images; ?>/bullet_red.png" />
                        <?php elseif ($installStage == 5): ?>
                            <img src="<?php echo $images; ?>/bullet_go.png" />
                        <?php elseif ($installStage > 5): ?>
                            <img src="<?php echo $images; ?>/tick.png" />
                        <?php endif; ?>
                        Confirm Account Information
                    </li>
                </ul>
            </li>
            <li>
                Step Four: Setup Website Information
            </li>
            <li>
                <ul>
                    <li>
                        <?php if ($installStage < 6): ?>
                            <img src="<?php echo $images; ?>/bullet_red.png" />
                        <?php elseif ($installStage == 6): ?>
                            <img src="<?php echo $images; ?>/bullet_go.png" />
                        <?php elseif ($installStage > 6): ?>
                            <img src="<?php echo $images; ?>/tick.png" />
                        <?php endif; ?>
                        Enter Site Information
                    </li>
                    <li>
                        <?php if ($installStage < 7): ?>
                            <img src="<?php echo $images; ?>/bullet_red.png" />
                        <?php elseif ($installStage == 7): ?>
                            <img src="<?php echo $images; ?>/bullet_go.png" />
                        <?php elseif ($installStage > 7): ?>
                            <img src="<?php echo $images; ?>/tick.png" />
                        <?php endif; ?>
                        Confirm Site Information
                    </li>
                </ul>
            </li>
            <li>
                Step Five: Install Site
            </li>
            <li>
                <ul>
                    <li>
                        <?php if ($installStage < 8): ?>
                            <img src="<?php echo $images; ?>/bullet_red.png" />
                        <?php elseif ($installStage == 8): ?>
                            <img src="<?php echo $images; ?>/bullet_go.png" />
                        <?php elseif ($installStage > 8): ?>
                            <img src="<?php echo $images; ?>/tick.png" />
                        <?php endif; ?>
                        Install Site
                    </li>
                </ul>
            </li>
            <li>
                Step Six: Installation Complete
            </li>
            <li>
                <ul>
                    <li>
                        <?php if ($installStage < 9): ?>
                            <img src="<?php echo $images; ?>/bullet_red.png" />
                        <?php elseif ($installStage == 9): ?>
                            <img src="<?php echo $images; ?>/bullet_go.png" />
                        <?php elseif ($installStage > 9): ?>
                            <img src="<?php echo $images; ?>/tick.png" />
                        <?php endif; ?>
                        Enter Your New Website!
                    </li>
                </ul>
            </li>
		</ul>
	</div>

</div>