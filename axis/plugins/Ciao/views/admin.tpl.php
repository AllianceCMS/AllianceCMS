<div class="row-fluid">
    <div class="span12">
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Settings</a></li>
                <li><a href="#tab2" data-toggle="tab">Say Hello</a></li>
                <li><a href="#tab3" data-toggle="tab">Say Goodbye</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <h1><?php echo $greeting; ?></h1>

                    <p>
                        Welcome to the Ciao plugin, where we show you how to properly create a quality plugin!
                    </p>

                    <p>
                        <strong>This is an admin page!</strong>
                    </p>
                </div>
                <div class="tab-pane" id="tab2">
                    <h1>Say Hello: <?php echo $greeting; ?></h1>

                    <p>
                        <strong>This is an admin page!</strong>
                    </p>
                </div>
                <div class="tab-pane" id="tab3">
                    <h1>Say Goodbye: <?php echo $greeting; ?></h1>

                    <p>
                        <strong>This is an admin page!</strong>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>